<?php
/**
Plugin Name: Hummingbird
Version:     2.1.1
Plugin URI:  https://premium.wpmudev.org/project/wp-hummingbird/
Description: Hummingbird zips through your site finding new ways to make it load faster, from file compression and minification to browser caching – because when it comes to pagespeed, every millisecond counts.
Author:      WPMU DEV
Author URI:  http://premium.wpmudev.org
Network:     true
Text Domain: wphb
Domain Path: /languages


@package Hummingbird
 */

/*
Copyright 2007-2016 Incsub (http://incsub.com)
Author – Ignacio Cruz (igmoweb), Ricardo Freitas (rtbfreitas), Anton Vanyukov (vanyukov)
Contributors –

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License (Version 2 – GPLv2) as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
*/

namespace Hummingbird;

use Exception;
use WPMUDEV_Dashboard;

if ( ! defined( 'WPHB_VERSION' ) ) {
	define( 'WPHB_VERSION', '2.1.1' );
}

if ( ! defined( 'WPHB_SUI_VERSION' ) ) {
	define( 'WPHB_SUI_VERSION', 'sui-2-3-29' );
}

if ( ! defined( 'WPHB_DIR_PATH' ) ) {
	define( 'WPHB_DIR_PATH', trailingslashit( dirname( __FILE__ ) ) );
}

if ( ! defined( 'WPHB_DIR_URL' ) ) {
	define( 'WPHB_DIR_URL', plugin_dir_url( __FILE__ ) );
}

if ( file_exists( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'free-mods.php' ) ) {
	/* @noinspection PhpIncludeInspection */
	include_once 'free-mods.php';
}

if ( ! class_exists( 'WP_Hummingbird' ) ) {
	/**
	 * Class WP_Hummingbird
	 *
	 * Main Plugin class. Acts as a loader of everything else and intializes the plugin
	 */
	class WP_Hummingbird {

		/**
		 * Plugin instance
		 *
		 * @var null
		 */
		private static $instance = null;

		/**
		 * Admin main class
		 *
		 * @var Admin\Admin
		 */
		public $admin;

		/**
		 * Pro modules
		 *
		 * @since 1.7.2
		 *
		 * @var Core\Pro\Pro
		 */
		public $pro;

		/**
		 * Core
		 *
		 * @var Core\Core
		 */
		public $core;

		/**
		 * Hummingbird Pro project ID.
		 *
		 * @since  1.7.0
		 * @access private
		 * @var    int $project_id
		 */
		private static $project_id = 1081721;

		/**
		 * Return the plugin instance
		 *
		 * @return WP_Hummingbird
		 */
		public static function get_instance() {
			if ( ! self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * WP_Hummingbird constructor.
		 */
		public function __construct() {
			$this->maybe_disable_free_version();

			spl_autoload_register( array( $this, 'autoload' ) );

			$this->init();

			$this->init_pro();

			if ( is_admin() ) {
				add_action( 'admin_init', array( 'Hummingbird\\Core\\Installer', 'maybe_upgrade' ) );

				if ( is_multisite() ) {
					add_action( 'admin_init', array( 'Hummingbird\\Core\\Installer', 'maybe_upgrade_blog' ) );
				}
			}

			$this->load_textdomain();

			// Add upgrade schedule.
			add_action( 'wphb_upgrade_to_pro', array( $this, 'upgrade_to_pro' ) );
			// Try to update to pro version is user can do that.
			if ( self::is_free_installed() && self::can_install_pro() ) {
				$running_cron_update = get_site_option( 'wphb_cron_update_running' );
				if ( empty( $running_cron_update ) ) {
					// Schedule upgrade.
					wp_schedule_single_event( time(), 'wphb_upgrade_to_pro' );
					update_site_option( 'wphb_cron_update_running', true );
				}
			}

			add_action( 'init', array( $this, 'maybe_clear_all_cache' ) );
		}

		/**
		 * Autoload method.
		 *
		 * @since 2.1.0
		 * @param string $class  Class name to autoload.
		 */
		public function autoload( $class ) {
			// Project-specific namespace prefix.
			$prefix = 'Hummingbird\\';

			// Does the class use the namespace prefix?
			$len = strlen( $prefix );
			if ( 0 !== strncmp( $prefix, $class, $len ) ) {
				// No, move to the next registered autoloader.
				return;
			}

			// Get the relative class name.
			$relative_class = substr( $class, $len );

			$path = explode( '\\', strtolower( str_replace( '_', '-', $relative_class ) ) );
			$file = array_pop( $path );
			$file = WPHB_DIR_PATH . implode( '/', $path ) . '/class-' . $file . '.php';

			// If the file exists, require it.
			if ( file_exists( $file ) ) {
				/* @noinspection PhpIncludeInspection */
				require $file;
			}
		}

		/**
		 * Initialize the plugin.
		 */
		private function init() {
			// Initialize the plugin core.
			$this->core = new Core\Core();

			if ( is_admin() ) {
				// Initialize admin core files.
				$this->admin = new Admin\Admin();
			}

			/**
			 * Triggered when WP Hummingbird is totally loaded
			 */
			do_action( 'wp_hummingbird_loaded' );
		}

		/**
		 * Initialize pro modules.
		 *
		 * @since 1.7.2
		 */
		private function init_pro() {
			// Overwriting in wp-config.php file to exclude PRO.
			if ( defined( 'WPHB_LOAD_PRO' ) && false === WPHB_LOAD_PRO ) {
				return;
			}

			$pro_class = WPHB_DIR_PATH . 'core/pro/class-pro.php';
			if ( is_readable( $pro_class ) ) {
				$this->pro = Core\Pro\Pro::get_instance();
				$this->pro->init();
			}
		}

		/**
		 * Clear all cache?
		 */
		public function maybe_clear_all_cache() {
			$wphb_clear = filter_input( INPUT_GET, 'wphb-clear' );
			if ( ! $wphb_clear || ! current_user_can( Core\Utils::get_admin_capability() ) ) {
				return;
			}

			self::flush_cache();

			if ( 'all' === $wphb_clear ) {
				Core\Settings::reset_to_defaults();
				delete_option( 'wphb-quick-setup' );
				delete_option( 'wphb-new-user-tour' );

				// Clean all cron.
				wp_clear_scheduled_hook( 'wphb_performance_report' );
				wp_clear_scheduled_hook( 'wphb_uptime_report' );
				wp_clear_scheduled_hook( 'wphb_minify_clear_files' );

				if ( is_multisite() ) {
					global $wpdb;
					$offset = 0;
					$limit  = 100;
					while ( $blogs = $wpdb->get_results( "SELECT blog_id FROM {$wpdb->blogs} LIMIT {$offset}, {$limit}", ARRAY_A ) ) { // Db call ok; no-cache ok.
						if ( $blogs ) {
							foreach ( $blogs as $blog ) {
								switch_to_blog( $blog['blog_id'] );

								Core\Settings::reset_to_defaults();
								delete_option( 'wphb-quick-setup' );
								delete_option( 'wphb-new-user-tour' );

								// Clean all cron.
								wp_clear_scheduled_hook( 'wphb_minify_clear_files' );
							}
							restore_current_blog();
						}
						$offset += $limit;
					}
				}
			}

			wp_safe_redirect( remove_query_arg( 'wphb-clear' ) );
			exit;
		}

		/**
		 * Flush all WP Hummingbird Cache
		 *
		 * @param bool $remove_data      Remove data.
		 * @param bool $remove_settings  Remove settings.
		 */
		public static function flush_cache( $remove_data = true, $remove_settings = true ) {
			$hummingbird = self::get_instance();

			/**
			 * Hummingbird module.
			 *
			 * @var Core\Module $module
			 */
			foreach ( $hummingbird->core->modules as $module ) {
				if ( ! $module->is_active() ) {
					continue;
				}

				if ( 'page_cache' === $module->get_slug() ) {
					/**
					 * Page caching module. Remove page cache files.
					 *
					 * @var Core\Modules\Page_Cache $module
					 */
					$module->toggle_service( false );
				}

				if ( ! $remove_data ) {
					continue;
				}

				if ( 'Minify' === $module->get_name() ) {
					$module->clear_cache( false );
					continue;
				}

				$module->clear_cache();
			}

			if ( $remove_settings ) {
				if ( Core\Module_Server::is_htaccess_written( 'gzip' ) ) {
					Core\Module_Server::unsave_htaccess( 'gzip' );
				}

				if ( Core\Module_Server::is_htaccess_written( 'caching' ) ) {
					Core\Module_Server::unsave_htaccess( 'caching' );
				}
			}

			if ( $remove_data ) {
				Core\Filesystem::instance()->clean_up();
				Core\Logger::cleanup();
			}
		}

		/**
		 * Load translations
		 */
		private function load_textdomain() {
			load_plugin_textdomain( 'wphb', false, 'wp-hummingbird/languages/' );
		}

		/**
		 * Check if free version is installed.
		 *
		 * @return bool
		 */
		private static function is_free_installed() {
			if ( defined( 'WPHB_WPORG' ) && WPHB_WPORG && 'wp-hummingbird/wp-hummingbird.php' !== plugin_basename( __FILE__ ) ) {
				return true;
			}

			return false;
		}

		/**
		 * Check if it's possible to install pro version.
		 *
		 * @return bool
		 */
		private static function can_install_pro() {
			// Check that dashboard plugin is installed.
			if ( ! class_exists( 'WPMUDEV_Dashboard' ) ) {
				return false;
			}

			if ( ! is_object( WPMUDEV_Dashboard::$api ) ) {
				return false;
			}

			if ( ! method_exists( WPMUDEV_Dashboard::$api, 'has_key' ) ) {
				return false;
			}

			// If user can't install - exit.
			if ( ! WPMUDEV_Dashboard::$upgrader->user_can_install( self::$project_id ) ) {
				return false;
			}

			// Check permissions and configuration.
			if ( ! WPMUDEV_Dashboard::$upgrader->can_auto_install( self::$project_id ) ) {
				return false;
			}

			$plugin = WPMUDEV_Dashboard::$api->get_project_data( self::$project_id );
			if ( version_compare( WPHB_VERSION, $plugin['version'], '>' ) ) {
				return false;
			}

			return true;
		}

		/**
		 * Upgrade free version to pro.
		 *
		 * @since 1.7.0
		 */
		public function upgrade_to_pro() {
			/**
			 * If pro is already installed - exit.
			 *
			 * If ( WPMUDEV_Dashboard::$upgrader->is_project_installed( $project_id ) ) {
			 * //return uninstall_plugin( 'hummingbird-performance/wp-hummingbird.php' );
			 * }
			 */

			if ( WPMUDEV_Dashboard::$upgrader->install( self::$project_id ) ) {
				delete_site_option( 'wphb_cron_update_running' );
				activate_plugin( 'wp-hummingbird/wp-hummingbird.php' );
				// Do we need to deactivate?
				deactivate_plugins( 'hummingbird-performance/wp-hummingbird.php', true );
				delete_plugins( array( 'hummingbird-performance/wp-hummingbird.php' ) );
			}
		}

		/**
		 * Moved from above to class.
		 *
		 * Checks if HB has both the free and Pro versions installed and disables the Free version.
		 *
		 * @since 2.0.1
		 */
		private function maybe_disable_free_version() {
			// Free is not installed - exit check.
			if ( ! self::is_free_installed() ) {
				return;
			}

			// Add notice to rate the free version.
			$free_installation = get_site_option( 'wphb-free-install-date' );
			if ( empty( $free_installation ) ) {
				update_site_option( 'wphb-notice-free-rated-show', 'yes' );
				update_site_option( 'wphb-free-install-date', current_time( 'timestamp' ) );
			}

			// This plugin is the free version so if the Pro version is activated we need to deactivate this one.
			if ( ! function_exists( 'is_plugin_active' ) ) {
				/* @noinspection PhpIncludeInspection */
				include_once ABSPATH . 'wp-admin/includes/plugin.php';
			}

			$pro_installed = false;
			if ( file_exists( WP_PLUGIN_DIR . '/wp-hummingbird/wp-hummingbird.php' ) ) {
				$pro_installed = true;
			}

			if ( ! defined( 'WPHB_SWITCHING_VERSION' ) ) {
				define( 'WPHB_SWITCHING_VERSION', true );
			}

			// Check if the pro version exists and is activated.
			if ( is_plugin_active( 'wp-hummingbird/wp-hummingbird.php' ) ) {
				// Pro is activated, deactivate this one.
				deactivate_plugins( plugin_basename( __FILE__ ) );
				update_site_option( 'wphb-notice-free-deactivated-show', 'yes' );
				return;
			} elseif ( $pro_installed ) {
				// Pro is installed but not activated, let's activate it.
				deactivate_plugins( plugin_basename( __FILE__ ) );
				activate_plugin( 'wp-hummingbird/wp-hummingbird.php' );
			}
		}
	}
}

/* @noinspection PhpIncludeInspection */
require_once WPHB_DIR_PATH . 'core/class-installer.php';
register_activation_hook( __FILE__, array( 'Hummingbird\\Core\\Installer', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Hummingbird\\Core\\Installer', 'deactivate' ) );

// Init the plugin and load the plugin instance for the first time.
add_action( 'plugins_loaded', array( 'Hummingbird\\WP_Hummingbird', 'get_instance' ) );
