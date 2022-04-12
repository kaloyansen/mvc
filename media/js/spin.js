/**
 * spinning 
 */
$('.roco').mouseout(
    function() { $(this).addClass('hover'); },
    function() { $(this).removeClass('fa-spin'); }
);
$('.roco').hover(
    function() { $(this).addClass('fa-spin'); },
    function() { $(this).removeClass('hover'); }
);