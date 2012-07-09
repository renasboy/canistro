$(function () {

    // set jquery validator default values
    $.validator.setDefaults({
        highlight: function(element, errorClass, validClass) {
            validClass = 'success';
            $(element).parents('.control-group').addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function(element, errorClass, validClass) {
            validClass = 'success';
            $(element).parents('.control-group').removeClass(errorClass).addClass(validClass);
        },
        errorPlacement: function (error, element) {
            element.parents('.control-group').find('.help-block').html(error);
        },
        success: function (label) {
            $('#' + label.attr('for')).parents('.control-group').find('.help-block').html('This field is verified');
        },
        errorElement: 'span'
    });

    // simple method validate form, to config jquery validator
    $.validate_form = function () {
        $('form').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    email: 'Please enter a valid email here.'
                }
            }
        });
    };

    // method done while clicking to send the form
    $.done = function (e) {
        e.preventDefault();
        _gaq.push(['_trackEvent', 'canistro-store', 'done'])
        $.validate_form();
        $('form').submit();
    };

    // reset form after successful post
    $.reset_form = function () {
        $('form input, form textarea').val('');
        $('form .success').removeClass('success');
        $('#email').parents('.control-group').find('.help-block').html('enter your email address here');
        //$('#address').parents('.control-group').find('.help-block').html('enter your delivery address here');
        //$('#comments').parents('.control-group').find('.help-block').html('enter your comments here');
        $('.alert-success').removeClass('in').addClass('out, hide');
    };

    // submit the form after successful validation
    $.submit = function (e) {
        e.preventDefault();
        //$.post('/create', $('form').serializeArray(), function (data) {
        //    if (data == 'success') {
                $('.alert-success').removeClass('out, hide').addClass('in').alert();
                // TODO reset here or after closing alert and form?
                setTimeout(function () {$.reset_form();}, 5000);
        //    }
        //});
    };

    var sound_modal = new Audio('/snd/powerup.wav');
    $.track = function () {
        sound_modal.play();
        _gaq.push(['_trackEvent', 'canistro-store', 'checkout'])
    };

    var interval_cart = null;
    var wait_cart = false;
    $.add_cart = function (e) {
        e.preventDefault();
        if (wait_cart) {
            return false;
        }
        wait_cart = true;
        //$.post('/renasboy/cart/add/id', $('form').serializeArray(), function (data) {
        //    if (data == 'success') {
                var sound_cart = new Audio('/snd/coin.wav');
                $('.label-success').addClass('label-warning').removeClass('label-success');
                var qty = parseInt($('.label-warning').html());
                $('.label-warning').html(qty + 1);
                $('.cart-total').addClass('active');
                $.price = parseFloat($('.cart-total a').html().replace('€', '')) + 10;
                interval_cart = setInterval("$.update_cart_total($.price)", 100);
                sound_cart.play();
        //    }
        //});

        wait_cart = false;
    };
    $.remove_cart = function (e) {
        e.preventDefault();
        if (wait_cart) {
            return false;
        }
        wait_cart = true;
        //$.post('/renasboy/cart/del/id', $('form').serializeArray(), function (data) {
        //    if (data == 'success') {
                var sound_cart = new Audio('/snd/coin.wav');
                $('.label-success').addClass('label-warning').removeClass('label-success');
                var qty = parseInt($('.label-warning').html());
                $('.label-warning').html(qty - 1);
                $('.cart-total').addClass('active');
                $.price = parseFloat($('.cart-total a').html().replace('€', '')) - 10;
                interval_cart = setInterval("$.update_cart_total($.price)", 100);
                sound_cart.play();
        //    }
        //});
        wait_cart = false;
    };
    $.update_cart_total = function (total) {
        var price = parseFloat($('.cart-total a').html().replace('€', ''));
        if (price > total) {
            price--;
        }
        else if (total > price) {
            price++;
        }
        else { 
            clearInterval(interval_cart);
            $('.label-warning').removeClass('label-warning').addClass('label-success');
            $('.cart-total').removeClass('active');
            return false;
        }
        $('.cart-total a').html('&euro;' + price.toFixed(2))
    };

    // animate slider based on thumbs
    $.change_carousel = function (e) {
        e.preventDefault();
        var slide = $(this).data('slide');
        $('#product-carousel').carousel(slide);
    };

    // animate thumbs based on slider
    $.change_thumbs = function (e) {
        var slide = $('#product-carousel .active').data('slide');
        var top = $('.carousel-inner > a').eq(slide).offset().top + $('.thumbnails-wrapper').scrollTop() - ($('.thumbnails-wrapper').height() / 2)
        $('.thumbnails-wrapper').animate({'scrollTop': top});
    }

    $.build = function () {
        // resize wrapper
        $('.thumbnails-wrapper').css({'height': $('#product-carousel').height(), 'width': $('.thumbnails-wrapper').width() + 20, 'overflow':'auto' });
        // apply margin to first and last thumbs
        var margin = ($('.thumbnails-wrapper').height() - $('.thumbnails .span3').eq(0).outerHeight(true)) / 2;
        $('.thumbnails .span3:first').css({'margin-top': margin});
        $('.thumbnails .span3:last').css({'margin-bottom': margin});

        $(document).off('slid', '#product-carousel').on('slid', '#product-carousel', $.change_thumbs);
        $(document).off('click', '.carousel-inner > a').on('click', '.carousel-inner > a', $.change_carousel);
        $(document).off('click', '#done').on('click', '#done', $.done);
        $(document).off('submit', 'form').on('submit', 'form', $.submit);
        $(document).off('click', '.btn-success').on('click', '.btn-success', $.track);
        $(document).off('click', '.add-cart').on('click', '.add-cart', $.add_cart);
        $(document).off('click', '.icon-trash').on('click', '.icon-trash', $.remove_cart);
    };


    $.build();
});
