/**
 * code by Kaloyan KRASTEV
 */
$(document).ready(function() {
/*
    $('input').change(function() {
        var color = $(this).val();
        $('.color-code').html(color);
        $('.color').css('background-color', color);
    });
*/
    $('#submit').click(function() {
        var retour = true;
        
        if ($('#pseudo').val() == '') {
            $('#pseudo').css('border-color', 'red');
            $('.pseudoErr').html('<i>fill pseudo</i>').css('color', 'red');
            retour = false;
        } else {
            $('#pseudo').css('border-color', 'green');
            $('.pseudoErr').html('ok').css('color', 'blue');            
        }

        if ($('#password').val() == '') {
            $('#password').css('border-color', 'red');
            $('.passwordErr').html('<i>fill password</i>').css('color', 'red');
            retour = false;
        } else {
            $('#password').css('border-color', 'green');
            $('.passwordErr').html('ok').css('color', 'blue');
        }

        return retour;
    });
});