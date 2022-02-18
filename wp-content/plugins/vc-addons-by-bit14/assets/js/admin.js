if (typeof (jQuery) != 'undefined') {

    jQuery.noConflict(); // Reverts '$' variable back to other JS libraries

    (function ($) {
        "use strict";

        $(function () {

            $(document.body).on('change', '.wpb-select.theme_style', function () {
                $('.bit14-testimonial-style').attr('src', assets_url + 'images/' + $(this).val() + '.jpg');
            });
         	
         	var allDivs = $('.same-height').length;
            var arr = [];
            for(var i = 0; i < allDivs; i++){
                arr.push($('.same-height').eq(i).innerHeight());
            }
            var maxHeight = Math.max(...arr) + 10;
            $('.same-height').css({'min-height': maxHeight});

        });

        $(window).resize(function(){
            var allDivs = $('.same-height').length;
            var arr = [];
            for(var i = 0; i < allDivs; i++){
                arr.push($('.same-height').eq(i).innerHeight());
            }
            var maxHeight = Math.max(...arr);
            $('.same-height').css({'min-height': maxHeight});
        });

    }(jQuery));
}