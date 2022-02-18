<?php

class HappyForms_Part_Mailchimp_Dummy extends HappyForms_Form_Part {

	public $type = 'mailchimp_dummy';

	public function __construct() {
		$this->label = __( 'Mailchimp', 'happyforms' );
		$this->description = __( 'For requiring permission before opting into your mailing list.', 'happyforms' );
	}

}
