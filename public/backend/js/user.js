$('.see-password').on('click', function() {
    if ($(this).hasClass('close')) {
        $(this).removeClass('close');
        $(this).parents('.form-group').find('.hide-password').prop('type', 'text');
    } else {
        $(this).addClass('close');
        $(this).parents('.form-group').find('.hide-password').prop('type', 'password')
    }
});