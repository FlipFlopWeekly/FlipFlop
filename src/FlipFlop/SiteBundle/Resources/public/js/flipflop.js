/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function() {
    $('#slideshowHolder').jqFancyTransitions({
        width: 975,
        height: 300,
        effect: 'zipper', // wave, zipper, curtain
        strips: 20, // number of strips
        delay: 5000, // delay between images in ms
        stripDelay: 50, // delay beetwen strips in ms
        titleOpacity: 0.7, // opacity of title
        titleSpeed: 1000, // speed of title appereance in ms
        position: 'alternate', // top, bottom, alternate, curtain
        direction: 'fountainAlternate', // left, right, alternate, random, fountain, fountainAlternate
        navigation: true, // prev and next navigation buttons
        links: true // show images as links

    });
    
    Modernizr.load({
        test: Modernizr.csstransforms3d && Modernizr.csstransitions,
        yep: ['bundles/flipflopsite/js/jquery-1.8.3.js', 'bundles/flipflopsite/js/jquery.hoverfold.js'],
        nope: '../css/fallback.css',
        callback: function(url, result, key) {
            if (url === 'bundles/flipflopsite/js/jquery.hoverfold.js') {
                $('#grid').hoverfold();
            }
        }
    });
});