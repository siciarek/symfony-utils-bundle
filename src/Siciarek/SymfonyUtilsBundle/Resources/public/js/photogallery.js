jQuery(document).ready(function ($) {

    var playSpeed = 3000;
    var changeSpeed = 500;
    var changeEffect = 'fade';

    $('ul.photogallery a').fancybox({
        playSpeed: playSpeed,

        openEffect: changeEffect,
        openSpeed: changeSpeed,

        closeEffect: changeEffect,
        closeSpeed: changeSpeed,

        prevEffect: changeEffect,
        prevSpeed: changeSpeed,

        nextEffect: changeEffect,
        nextSpeed: changeSpeed,

        closeBtn: false,
        nextClick: true,
        mouseWheel: true,

        helpers: {
            title: null
        },

        keys: {
            next: {
                32: 'left', // space
                13: 'left', // enter
                34: 'up',   // page down
                39: 'left', // right arrow
                40: 'up'    // down arrow
            },

            play: [83] // letter "s" - start/stop slideshow
        },

        padding: 0
    });
});
