/**
 * Autosize
 * Copyright (c) 2013, Aquill Team. (MIT Licensed)
 */
$(function() {

    $.fn.autosize = function () {

        $(this).each(function () {
            var $text = $(this);
        
            function resize(e) {
                var bodyScrollPos = $('body').prop('scrollTop');
                $text.height('auto');
                $text.height($text.prop('scrollHeight') + 'px');
                $('body').prop('scrollTop', bodyScrollPos);
            }
            
            /* 0-timeout to get the already changed text */
            function delayedResize (e) {
                window.setTimeout(function(){
                    resize(e);
                }, 0);
            }
            
            $text.on('change', resize);
            $text.on('cut paste drop keydown', delayedResize);

            resize();
        });
    };
});