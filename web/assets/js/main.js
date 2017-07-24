$(document).ready(function () {

    window.setTimeout(function() {
        $(".alert").fadeTo(1500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);

    $('input').on('focus', function () {
        var help = '#' + this.id + '_help';
        $(help).addClass('help-message');
        $(help).show();
    });

    $('input').on('blur', function () {
        var help = '#' + this.id + '_help';
        $(help).hide();
    });
});