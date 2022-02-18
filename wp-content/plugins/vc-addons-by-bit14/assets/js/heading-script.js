if (typeof(jQuery) != 'undefined') {

    jQuery.noConflict(); // Reverts '$' variable back to other JS libraries

    (function($) {
        "use strict";

        $(function() {
        	
        	// heading
            $('.bit-pb-heading').each(function(){
                var heading_position = $(this).attr('data-heading-position');
                var icon_position    = $(this).attr('data-icon-position');
                var border_color     = $(this).attr('data-border-color');
                var icon_color       = $(this).attr('data-icon-color');
                var heading_color    = $(this).attr('data-heading-color');
                var background_color = $(this).attr('data-background-color');

                $(this).find('h2').css({'text-align':heading_position, 'color': heading_color, 'background-color': background_color});
                $(this).find('h2.top-bordered').css({'border-top':'3px solid ' + border_color, 'padding-top' : '30px'});
                if($(this).find('h2').hasClass('top-bordered') || $(this).find('h2').hasClass('border_bottom_icon') || $(this).find('h2').hasClass('border_top_icon')){
                    $(this).parent().css({'text-align':heading_position});
                }
                $(this).find('h2.bottom-bordered').css({'border-bottom':'3px solid ' + border_color, 'padding-bottom' : '15px'});
                $(this).find('span').find('i').css({'text-align':icon_position, 'color': icon_color});
            });

            
        });
    }(jQuery));

}
    