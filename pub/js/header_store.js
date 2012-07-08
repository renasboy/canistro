$(function () {

    var submenu = location.href.match(/^https?:\/\/[^\/]+\/?([^\/]*).*\/([^\/]*).*$/)[2];

    switch (submenu) {

        default:
            $('.nav .home').addClass('active');
        break;

        case 'about':
            $('.nav .about').addClass('active');
        break;

        case 'payment-and-delivery':
            $('.nav .info').addClass('active');
        break;

        case 'contact':
            $('.nav .contact').addClass('active');
        break;

    }

});
