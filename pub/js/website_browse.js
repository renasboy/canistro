$(function(){
    var container = $('.browse');
    container.imagesLoaded( function(){
        container.masonry({
            itemSelector : 'div.span3'
        });
    });
});
