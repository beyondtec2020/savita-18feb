if (typeof(jQuery) != 'undefined') {

    jQuery.noConflict(); // Reverts '$' variable back to other JS libraries

    (function($) {
        "use strict";

        // Counters
        animateCounterPro();
        //bitCounterDivHeightPro($('.bit-counters-list-pro').find('.counter-item-pro'));
        $(window).scroll(function() {
            animateCounterPro();
        });
        $(window).on('resize', function() {
            //bitCounterDivHeightPro($('.bit-counters-list-pro').find('.counter-item-pro'));
        });
        function bitCounterDivHeightPro($container){
            var maxHeight = 0;
            $($container).each(function(){
                if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
            });
            $($container).height(maxHeight);
        }
        function animateCounterPro() {

            $('.bit-counters-list-pro').each(function() {

                
                var textColor = $(this).find('.counter-item-pro').attr('data-text-color');
                
                var isPerc    = $(this).find('.counter-item-pro').attr('data-is-percentage');
                isPerc        = ( isPerc == 'yes') ? '%' : '';
                
                var counterOffsetBottom = $(this).offset().top + $(this).find('.counter-item-pro').height();
                var windowHeight = $(window).height();
                var scrollAmount = $(window).scrollTop();

                 $(this).find('.counter-item-pro').each(function() {

                    var iconColor = $(this).attr('data-icon-color');
                    $(this).find('.counter-border > span.counter-item-icon-pro i').css({'color': iconColor});
                    if ($(this).parent('.counter-pro').hasClass('theme-3')) {
                        $(this).find('.counter-border').css({'border-left':'3px solid' + iconColor});
                    }
                    var descriptionColor = $(this).attr('data-description-color');
                    $(this).find('.counter-border > .counter-item-title-pro').css({'color':descriptionColor});
                    $(this).find('.counter-border > span.counter-item-icon-pro.is-circle-border i').css({'border':'1px solid' + descriptionColor});

                    if ($(this).parent('.counter-pro').hasClass('theme-2')) {
                        $(this).find('.counter-border').css({'border':'1px solid' + descriptionColor});
                    }

                 })

                if (scrollAmount > (counterOffsetBottom - windowHeight)) {

                    if ($(this).find('.counter-item-pro').length > 0) {

                        $(this).find('.counter-item-pro').each(function() {
                            $(this).find('.tobe-pro').removeClass('tobe-pro');
                        });

                        $(this).find('.counter-item-number-pro.count-pro').each(function() {
                            var $this = $(this),
                              countTo = $this.attr('data-counter-value');
                            $({
                                countNum: $this.text()
                              }).animate({
                                  countNum: countTo
                                },
                                {
                                  duration: 3000,
                                  easing: 'swing',
                                  step: function() {
                                    $this.text(Math.ceil(this.countNum).toLocaleString('en') + isPerc);
                                  },
                                  complete: function() {
                                    $this.text(this.countNum.toLocaleString('en') + isPerc);
                                  }

                                });
                        });
                        $(this).find('.counter-item-number-pro').removeClass('count-pro').addClass('counted-pro');

                    }
                }

            })
        }

    }(jQuery));

}
