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
                $('#' + label.attr('for')).parents('.control-group').find('.help-block').html('');
            },
            errorElement: 'span',
            ignore: null // This is necessary to not ignore type="hidden"
        });

        $('form').validate({
            rules: {
                contact: {
                    required: true
                }
            }
        });
    };

    $.save_content = function (e) {
        e.preventDefault();

        if (!$('form').valid()) {
            $.sound_incorrect.play();
            return false;
        }

        $.post('/' + $('.brand').html() + '/contact', {'contact': $('#contact').val() }, function (data) {
            if (data == 'success') {
                $('.hero-unit .alert-success').removeClass('out, hide').addClass('in').alert();
                $.sound_message.play();
                setTimeout(function () {$('.hero-unit .alert-success').removeClass('in').addClass('out, hide');}, 3000);
            }
        });
    };

    $.build = function () {
        $.sound_incorrect   = new Audio('/snd/incorrect.wav');
        $.sound_message     = new Audio('/snd/message.wav');

        // admin events if admin button is present
        if ($('.content-edit').length) {
            // make html5 editor
            $('.hero-unit textarea').css({'height':'200px'}).wysihtml5({
                height: '200px'
            });
            $(document).off('click', '.content-edit').on('click', '.content-edit', $.save_content);
            $.validate_form();
        }
    };

    $.build();
});
