//Show and Hide tooltip with Map in Home section
tooltip()
function tooltip() {
    var tooltopId;
    $('.tooltip__item').css({'visibility': 'hidden', 'display':'none'})

    //show tooltip
    $('.tooltip__link').click(function (event) {
        event.preventDefault();
        $('.tooltip__item').css({'visibility': 'hidden', 'display':'none'})
        tooltopId = $(this).attr('data-tooltip-id');
        if ( $('#' + tooltopId).css('visibility') == 'hidden' ) {
            $('#' + tooltopId).css('visibility', 'visible');
            $('#' + tooltopId).show('slow');
        }
        else {
            $('#' + tooltopId).css('visibility', 'hidden');
            $('#' + tooltopId).hide('slow');
        }





    });

    //Hide tooltip, if we click 1)not a link 2)not a map
    $(document).click(function (event) {
        if ($(event.target).closest($('.tooltip__link[data-tooltip-id =' + tooltopId + ']')).length) {
            return;
        }
        if ($(event.target).closest($('#' + tooltopId)).length) {
            return;
        }
        $('#' + tooltopId).css('visibility', 'hidden');
        $('#' + tooltopId).hide('slow');
        event.stopPropagation();
    });
}





