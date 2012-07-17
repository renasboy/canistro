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
                $('#' + label.attr('for')).parents('.control-group').find('.help-block').html($.validate_verified);
            },
            errorElement: 'span'
        });

        $.validator.messages.required = $.validate_required;

        // add jquery validator regexp method for precise matching
        $.validator.addMethod('regexp', function(value, element, param) {
            return this.optional(element) || value.match(param);
        }, 'This value doesn\'t match the acceptable pattern.');


        $('#modal-form form').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: '/validation/email',
                        data: {
                            value: function () {
                                return $('#email').val();
                            }
                        }
                    }
                },
                name: {
                    required: true,
                    minlength: 5,
                    maxlength: 30,
                    regexp: /^([A-Za-z0-9_-]{5,30})$/,
                    remote: {
                        url: '/validation/name',
                        data: {
                            value: function () {
                                return $('#name').val();
                            }
                        }
                    }
                }
            },
            messages: {
                email: {
                    //required: 'Please enter your email here.',
                    email: $.validate_email,
                    remote: $.validate_email_remote
                },
                name: {
                    //required: $.validate_name,
                    minlength: $.validate_name_minlength,
                    maxlength: $.validate_name_maxlenght,
                    regexp: $.validate_name_regexp,
                    remote: $.validate_name_remote 
                }
            }
        });
    };

    var sound_incorrect = new Audio('/snd/incorrect.wav');
    // method done while clicking to send the form
    $.done = function (e) {
        e.preventDefault();
        _gaq.push(['_trackEvent', 'canistro-home', 'done'])
        $('#modal-form form').validate();
        if (!$('#modal-form form').valid()) {
            sound_incorrect.play();
            return false;
        }
        _gaq.push(['_trackEvent', 'canistro-home', 'done-valid'])
        $('#modal-form form').submit();
    };

    // reset form after successful post
    $.reset_form = function () {
        $('#modal-form form input').val('');
        $('#modal-form form .success').removeClass('success');
        $('#email').parents('.control-group').find('.help-block').html($.email_info);
        $('#name').parents('.control-group').find('.help-block').html($.name_info);
        $('.alert-success').removeClass('in').addClass('out, hide');
    };

    var sound_message = new Audio('/snd/message.wav');
    // submit the form after successful validation
    $.submit = function (e) {
        e.preventDefault();
        $.post('/signup', $('#modal-form form').serializeArray(), function (data) {
            if (data == 'success') {
                $('.alert-success').removeClass('out, hide').addClass('in').alert();
                sound_message.play();
                setTimeout(function () {$('#modal-form').modal('hide');}, 5000);
                _gaq.push(['_trackEvent', 'canistro-home', 'success'])
            }
        });
    };

    var sound_modal = new Audio('/snd/powerup.wav');
    $.track = function () {
        sound_modal.play();
        _gaq.push(['_trackEvent', 'canistro-home', 'try free'])
    };

    $.build = function () {
        $(document).off('click', '#done').on('click', '#done', $.done);
        $(document).off('submit', '#modal-form form').on('submit', '#modal-form form', $.submit);
        $(document).off('click', '.btn-success').on('click', '.btn-success', $.track);
        $(document).off('hidden', '#modal-form').on('hidden', '#modal-form', $.reset_form);
        $.validate_form();
    };

    $.validate_required = null;
    $.validate_verified = null;
    $.validate_email = null;
    $.validate_email_remote = null;
    $.validate_name = null;
    $.validate_name_minlength = null;
    $.validate_name_maxlenght = null;
    $.validate_name_regexp = null;
    $.validate_name_remote = null;
    $.name_info = null;
    $.email_info = null;
    $.get('/language/signup', function (data) {
        if (data) {
            $.validate_required = data.validate_required;
            $.validate_verified = data.validate_verified;
            $.validate_email = data.validate_email;
            $.validate_email_remote = data.validate_email_remote;
            $.validate_name = data.validate_name;
            $.validate_name_minlength = data.validate_name_minlength;
            $.validate_name_maxlenght = data.validate_name_maxlenght;
            $.validate_name_regexp = data.validate_name_regexp;
            $.validate_name_remote = data.validate_name_remote;
            $.name_info = data.name_info;
            $.email_info = data.email_info;
            $.build();
        }
    });

});
