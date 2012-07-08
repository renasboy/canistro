$(function () {

    var menu    = location.href.match(/^https?:\/\/[^\/]+\/?([^\/]*).*$/)[1];

    switch (menu) {

        default:
            $('.nav .home').addClass('active');
        break;

        case 'about':
            $('.nav .about').addClass('active');
        break;

        case 'browse':
            $('.nav .browse').addClass('active');
        break;

        case 'contact':
            $('.nav .contact').addClass('active');
        break;

    }

});
