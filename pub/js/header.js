$(function () {

    $.turn_on = function () {
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
    };

    // simple method validate form, to config jquery validator
    $.validate_signin_form = function () {

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
                return false;
            },
            success: function (label) {
                return false;
            },
            errorElement: 'span'
        });

        $('form.navbar-form').validate({
            rules: {
                username: {
                    required: true,
                }
            }
        });
    };

    var sound_incorrect = new Audio('/snd/incorrect.wav');
    // method done while clicking to send the form
    $.signin = function (e) {
        e.preventDefault();
        _gaq.push(['_trackEvent', 'canistro-home', 'signin'])
        $('form.navbar-form').validate();
        if (!$('form.navbar-form').valid()) {
            sound_incorrect.play();
            return false;
        }
        _gaq.push(['_trackEvent', 'canistro-home', 'signin-valid'])
        $('form.navbar-form').submit();
    };

    var sound_message = new Audio('/snd/message.wav');
    $.submit_signin = function (e) {
        e.preventDefault();
        $.post('/signin', $('form.navbar-form').serializeArray(), function (data) {
            if (data == 'success') {
                $('.label-success').removeClass('out, hide').addClass('in');
                $('.navbar .label-important').addClass('out, hide').removeClass('in');
                sound_message.play();
                _gaq.push(['_trackEvent', 'canistro-home', 'sign-in success'])
            }
        }).error(function () {
            $('.label-important').removeClass('out, hide').addClass('in');
            sound_incorrect.play();
        });
    };

    $.build_header = function () {
        $.turn_on();
        $(document).off('click', '#signin').on('click', '#signin', $.signin);
        $(document).off('submit', 'form.navbar-form').on('submit', 'form.navbar-form', $.submit_signin);
        $.validate_signin_form();
    };

    $.build_header();

});
