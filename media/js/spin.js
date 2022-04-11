/**
 * spinning 
 */
$('.loco').mouseout(
    function() { $(this).addClass('hover'); },
    function() { $(this).removeClass('fa-spin'); }
);
$('.loco').hover(
    function() { $(this).addClass('fa-spin'); },
    function() { $(this).removeClass('hover'); }
);