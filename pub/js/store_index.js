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

    $.track = function () {
        _gaq.push(['_trackEvent', 'canistro-store', 'checkout'])
    };

    var interval_cart = null;
    var wait_cart = false;
    $.add_cart = function () {
        if (wait_cart) {
            return false;
        }
        wait_cart = true;
        //$.post('/renasboy/cart/add/id', $('form').serializeArray(), function (data) {
        //    if (data == 'success') {
                var qty = parseInt($('.label-success').html());
                $('.label-success').html(qty + 1);
                $.price = parseFloat($('.cart-total a').html().replace('€', '')) + 10;
                interval_cart = setInterval("$.update_cart_total($.price)", 100);
        //    }
        //});

        wait_cart = false;
    };
    $.remove_cart = function () {
        if (wait_cart) {
            return false;
        }
        wait_cart = true;
        //$.post('/renasboy/cart/del/id', $('form').serializeArray(), function (data) {
        //    if (data == 'success') {
                var qty = parseInt($('.label-success').html());
                $('.label-success').html(qty - 1);
                $.price = parseFloat($('.cart-total a').html().replace('€', '')) - 10;
                interval_cart = setInterval("$.update_cart_total($.price)", 100);
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
            return false;
        }
        $('.cart-total a').html('&euro;' + price.toFixed(2))
        var sound_cart = new Audio('/snd/coin.wav');
        sound_cart.play();
    };

    $(document).off('click', '#done').on('click', '#done', $.done);
    $(document).off('submit', 'form').on('submit', 'form', $.submit);
    $(document).off('click', '.btn-success').on('click', '.btn-success', $.track);
    $(document).off('click', '.add-cart').on('click', '.add-cart', $.add_cart);
    $(document).off('click', '.icon-trash').on('click', '.icon-trash', $.remove_cart);
});
