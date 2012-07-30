$(function(){
    var container = $('.browse-grid');
    container.imagesLoaded( function(){
        container.masonry({
            itemSelector : 'div.span3'
        });
    });
});
