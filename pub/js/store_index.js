$(function () {

    // simple method validate form, to config jquery validator
    $.validate_form = function () {
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
                $('#' + label.attr('for')).parents('.control-group').find('.help-block').html($.field_verified);
            },
            errorElement: 'span',
            ignore: null // This is necessary to not ignore type="hidden"
        });

        $.validator.messages.required = $.field_required;

        $('#modal-form-checkout form').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: {
                    email: $.valid_email
                }
            }
        });

        $('#modal-form-product form').validate({
            rules: {
                img: {
                    required: true
                },
                name: {
                    required: true
                },
                price: {
                    required: true,
                    digits: true,
                    min: 1
                },
                description: {
                    maxlength: 255
                }
            },
            messages: {
                price: {
                    digits: $.valid_digits,
                    min: $.valid_min 
                },
                description: {
                    maxlength: $.valid_maxlength,
                }
            }
        });
    };

    // method while clicking on send the form
    $.done = function (e) {
        e.preventDefault();
        _gaq.push(['_trackEvent', 'canistro-store', 'done'])

        $('#modal-form-checkout form').validate();
        if (!$('#modal-form-checkout form').valid()) {
            $.sound_incorrect.play();
            return false;
        }
        $('#modal-form-checkout form').submit();
    };

    // reset form after successful post
    $.reset_checkout_form = function () {
        $('#modal-form-checkout form input, #modal-form-checkout form textarea').val('');
        $('#modal-form-checkout form .success').removeClass('success');
        $('#modal-form-checkout form .error').removeClass('error');
        $('#email').parents('.control-group').find('.help-block').html($.info_email);
        $('#modal-form-checkout .alert-success').removeClass('in').addClass('out, hide');
    };

    // submit the form after successful validation
    $.checkout = function (e) {
        e.preventDefault();
        $.post('/' + $('.brand').html() + '/checkout', $('#modal-form-checkout form').serializeArray(), function (data) {
            if (data == 'success') {
                $('#modal-form-checkout .alert-success').removeClass('out, hide').addClass('in').alert();
                $.sound_message.play();
                // update shopping cart
                $.update_cart('get'); 
                setTimeout(function () {$('#modal-form-checkout').modal('hide');}, 5000);
                _gaq.push(['_trackEvent', 'canistro-store', 'success'])
            }
        });
    };

    $.show_form = function () {
        $.sound_modal.play();
    }

    $.track = function () {
        _gaq.push(['_trackEvent', 'canistro-store', 'checkout'])
    };

    var interval_cart   = null;
    var wait_cart       = false;
    $.update_cart = function (action, id) {
        if (wait_cart) {
            return false;
        }
        wait_cart = true;
        $('.label-success').addClass('label-warning').removeClass('label-success');
        $('.cart-total').addClass('active');
        if (id) {
            $.sound_cart.play();
        }
        // TODO add error handling for http call
        $.post('/' + $('.brand').html() + '/cart/' + action, {'id': id}, function (data) {
            if (data) {
                var total = data.total;
                var qty = data.quantity;

                if (data.products) {
                    // TODO check on using jquery-templ , but I did not like it last time
                    // well check on doing something better
                    var html = '<table class="table table-striped table-condensed">';
                    html += '<thead>';
                    html += '<tr>';
                    html += '<th>#</th>';
                    html += '<th>' + $.product_name + '</th>';
                    html += '<th>' + $.product_price + '</th>';
                    html += '<th>&nbsp;</th>';
                    html += '</tr>';
                    html += '</thead>';
                    html += '<tbody>';

                    for (key in data.products) {
                        product = data.products[key];
                        html += '<tr>';
                        html += '<td>' + product.quantity +'</td>';
                        html += '<td><a href="">' + product.name + '</a></td>';
                        html += '<td>&euro;' + product.price + '</td>';
                        html += '<td><a href="#"><i class="icon-trash" data-product="' + product.id + '"></i></a></td>';
                        html += '</tr>';
                    }

                    html += '<tr>';
                    html += '<td>&nbsp;</td>';
                    html += '<td>' + $.cart_total + '</td>';
                    html += '<td>&euro;' + data.total + '</td>';
                    html += '<td>&nbsp;</td>';
                    html += '</tr>';

                    html += '<tr>';
                    html += '<td colspan="4" class="checkout"><a class="btn-success btn-large btn pull-right" data-target="#modal-form-checkout" href="#modal-form-checkout" data-toggle="modal"><i class="icon-ok icon-white"></i> ' + $.cart_checkout + '</a></td>';
                    html += '</tr>';

                    html += '</tbody>';
                    html += '</table>';
                }
            }
            else {
                var total   = '0.00';
                var qty     = 0;
                var html    = '<h3>' + $.cart_empty + '</h3>';

            }
            setTimeout("$.turn_off_cart();", 500);
            $('.cart-total a').html('&euro;' + total)
            $('.label-warning, .label-success').html(parseInt(qty));
            $('.dropdown-menu').html(html);
            if (qty == 0) {
                $.old_checkout_height = $('.checkout').height();
                $('.checkout').animate({'height': 0});
            }
            else {
                $('.checkout').animate({'height': $.old_checkout_height });
            }
        });
        wait_cart = false;
    };

    $.turn_off_cart = function () {
        $('.label-warning').removeClass('label-warning').addClass('label-success');
        $('.cart-total').removeClass('active');
    };

    $.add_cart = function (e) {
        e.preventDefault();
        $.update_cart('add', $(this).data('product'));
    };

    $.remove_cart = function (e) {
        e.preventDefault();
        $.update_cart('del', $(this).data('product'));
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
        $('.thumbnail').removeClass('selected');
        $('.thumbnail').eq(slide).addClass('selected');
        var top = $('.thumbnail .carousel-inner > a').eq(slide).offset().top + $('.thumbnails-wrapper').scrollTop() - ($('.thumbnails-wrapper').height() / 2)
        $('.thumbnails-wrapper').animate({'scrollTop': top});
    }

    $.expand_nav = function () {
        // resize wrapper
        $('.thumbnails-wrapper').css({'width': $('.thumbnails-wrapper').width() + 20});
        $('.thumbnails-wrapper').animate({'height': $('#product-carousel').height()}, 1000, function () {
            // apply margin to first and last thumbs
            var margin = ($('.thumbnails-wrapper').height() - $('.thumbnails .span3').eq(0).outerHeight(true)) / 2;
            $('.thumbnails .span3:first').css({'margin-top': margin});
            $('.thumbnails .span3:last').css({'margin-bottom': margin});
            if ($('.thumbnail .carousel-inner > a').eq(1).length) {
                var top = $('.thumbnail .carousel-inner > a').eq(1).offset().top + $('.thumbnails-wrapper').scrollTop() - ($('.thumbnails-wrapper').height() / 2)
            }
            else {
                var top = 100;
            }
            $('.thumbnails-wrapper').animate({'scrollTop': top});
        });
    };

    // admin methods
    // method while clicking on send the form
    $.product = function (e) {
        e.preventDefault();

        $('#modal-form-product form').validate();
        if (!$('#modal-form-product form').valid()) {
            $.sound_incorrect.play();
            return false;
        }
        $('#modal-form-product form').submit();
    };

    $.save_product = function (e) {
        e.preventDefault();
        $.post('/' + $('.brand').html() + '/product', $('#modal-form-product form').serializeArray(), function (data) {
            if (data == 'success') {
                $('#modal-form-product .alert-success').removeClass('out, hide').addClass('in').alert();
                $.sound_message.play();
                // update shopping cart
                setTimeout(function () {$('#modal-form-product').modal('hide');}, 5000);
            }
        });
    };

    // reset form after successful post
    $.reset_product_form = function () {
        $('#modal-form-product form img').attr('src', 'http://placehold.it/80&text=browse');
        $('#modal-form-product form input, #modal-form-product form textarea').val('');
        $('#modal-form-product form .success').removeClass('success');
        $('#modal-form-product form .error').removeClass('error');
        $('#name').parents('.control-group').find('.help-block').html('enter product name here');
        $('#price').parents('.control-group').find('.help-block').html('enter product price here');
        $('#modal-form-product .alert-success, #modal-form-product .alert-error').removeClass('in').addClass('out, hide');
    };

    $.build_uploader = function () {
        // Upload button
        var uploader = new plupload.Uploader({
            runtimes : 'html5',
            url : '/' + $('.brand').html() + '/upload',
            max_file_size : '3mb',
            browse_button : 'upload',
            filters : [
                {title : "Images", extensions : "jpg,jpeg,gif,png"}
            ]
        });
        uploader.bind('Error', function (uploader, error) {
            var message = 'error';
            if (error.message == 'File extension error.') {
                message = $.upload_type_error;
            }
            else if (error.message == 'File size error.') {
                message = $.upload_size_error;
            }
            $('#modal-form-product .alert-error').removeClass('out, hide').addClass('in').alert();
            setTimeout(function () {$('#modal-form-product .alert-error').removeClass('in').addClass('out, hide');}, 3000);
            //$.append_error(message);
        });
        uploader.bind('QueueChanged', function (uploader) {
            uploader.start();
        });
        /* TODO TEST IE AND OPERA BEFORE APPLYING THIS
        uploader.bind('Refresh', function(up) {
            // fixing positioning for browsers that do not work
            if ($.browser.msie || $.browser.opera) {
                // show button and all parents in order to get the properties
                var button  = $('#upload').parents().show();
                $('form[target="' + uploader.id + '_iframe"]').css({
                    top:    button.offset().top,
                    left:   button.offset().left,
                    width:  button.outerWidth(),
                    height: button.outerHeight(),
                    zIndex: 300
                });
            }
        });
        */
        uploader.bind('FileUploaded', function (uploader, file, response) {
            if (!response.response.match(/^tmp\//)) {
                $('#modal-form-product .alert-important').removeClass('out, hide').addClass('in').alert();
                return;
            }
            $('#upload-image').attr('src', '/img/' + response.response.replace('/', '/fit-80x80-white/') + '?' + Math.random());
            $('#img').val(response.response);
        });
        //uploader.refresh();
        uploader.init();
    };

    $.product_edit = function () {
        var product = $(this).parents('.item').data('product');
        $('#modal-form-product #id').val(product.id);
        $('#modal-form-product #img').val(product.img);
        $('#upload-image').attr('src', '/img/' + product.img.replace('/', '/fit-80x80-white/') + '?' + Math.random());
        $('#modal-form-product #name').val(product.name);
        $('#modal-form-product #price').val(parseInt(product.price));
        $('#modal-form-product #description').val(product.description);
        $('#modal-form-product').modal('show');
    };

    $.product_flag = function () {
        var product = $(this).parents('.item').data('product');
        var button  = $(this);
        $.post('/' + $('.brand').html() + '/flag', { 'id': product.id }, function (data) {
            if (data == 'success') {
                if (button.html().match(/OFF/)) {
                    button.html(button.html().replace(/OFF/, 'ON'));
                    button.parents('.item').removeClass('off');
                }
                else {
                    button.html(button.html().replace(/ON/, 'OFF'));
                    button.parents('.item').addClass('off');
                }
            }
        });
    };

    $.build = function () {
        $.sound_incorrect   = new Audio('/snd/incorrect.wav');
        $.sound_message     = new Audio('/snd/message.wav');
        $.sound_modal       = new Audio('/snd/powerup.wav');
        $.sound_cart        = new Audio('/snd/coin.wav');

        $(document).off('slid', '#product-carousel').on('slid', '#product-carousel', $.change_thumbs);
        $(document).off('click', '.carousel-inner > a').on('click', '.carousel-inner > a', $.change_carousel);
        $(document).off('click', '#done').on('click', '#done', $.done);
        $(document).off('submit', '#modal-form-checkout form').on('submit', '#modal-form-checkout form', $.checkout);
        $(document).off('click', '.checkout .btn-success').on('click', '.checkout .btn-success', $.track);
        $(document).off('click', '.add-cart').on('click', '.add-cart', $.add_cart);
        $(document).off('click', '.icon-trash').on('click', '.icon-trash', $.remove_cart);
        $(document).off('show', '#modal-form-checkout').on('show', '#modal-form-checkout', $.show_form);
        $(document).off('hidden', '#modal-form-checkout').on('hidden', '#modal-form-checkout', $.reset_checkout_form);
        $('#product-carousel').carousel();
        $.update_cart('get');
        $.validate_form();

        // admin events if admin button is present
        if ($('.product-add').length) {
            $(document).off('click', '#product').on('click', '#product', $.product);
            $(document).off('submit', '#modal-form-product form').on('submit', '#modal-form-product form', $.save_product);
            $(document).off('show', '#modal-form-product').on('show', '#modal-form-product', $.show_form);
            $(document).off('hidden', '#modal-form-product').on('hidden', '#modal-form-product', $.reset_product_form);
            $(document).off('click', '.product-edit').on('click', '.product-edit', $.product_edit);
            $(document).off('click', '.product-flag').on('click', '.product-flag', $.product_flag);
            $.build_uploader();
        }
    };

    $.field_verified = null;
    $.field_required = null;
    $.valid_email = null;
    $.valid_digits = null;
    $.valid_min = null;
    $.valid_maxlength = null;
    $.info_email = null;
    $.product_name = null;
    $.product_price = null;
    $.cart_total = null;
    $.cart_checkout = null;
    $.cart_empty = null;
    $.upload_type_error = null;
    $.upload_size_error = null;
    $.get('/language/store_js', function (data) {
        if (data) {
            $.field_verified = data.field_verified;
            $.field_required = data.field_required;
            $.valid_email = data.valid_email;
            $.valid_digits = data.valid_digits;
            $.valid_min = data.valid_min;
            $.valid_maxlength = data.valid_maxlength;
            $.info_email = data.info_email;
            $.product_name = data.product_name;
            $.product_price = data.product_price;
            $.cart_total = data.cart_total;
            $.cart_checkout = data.cart_checkout;
            $.cart_empty = data.cart_empty;
            $.upload_type_error = data.upload_type_error;
            $.upload_size_error = data.upload_size_error;
        }
        $.build();
    });

    $('#product-carousel .active img').load(function () {
        setTimeout($.expand_nav, 1000);
    });

});
