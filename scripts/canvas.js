var addComponent = function (comp, posX, posY) {
    var id = $(comp).attr('id');
    components.push(id);
    $('#canvas').append($(comp));

    $(comp).css({
        position: 'absolute',
        display: 'block'
    });
    setMode('#' + id);

    drag({ x: posX, y: posY }, $(comp), $('#canvas'), HorizPosition.CENTER, VertPosition.CENTER);
    startDrag($(comp), $('#canvas'), HorizPosition.CENTER, VertPosition.CENTER);
}

var saveEditComb = function () {
    var cardId = '#' + $('#edit-comb-form').attr('data-id');
    var cardTitle = $('input[name=edit-comb-card-title]').val();
    var cardText = $('textarea#edit-comb-card-text').val();
    var img = $('#edit-comb-display').attr('data-img');

    var $cardImg = $(cardId).find('.card-img-top');
    if (img != undefined && img != 'none') {
        $cardImg.removeClass('disabled');
        $cardImg.attr('src', img);
    } else $cardImg.addClass('disabled');

    $(cardId).find('.card-title').text(cardTitle);
    $(cardId).find('.card-text').text(cardText);
}

var resizeCanvas = function () {
    $('#canvas').css({
        'min-height': ($(window).height() - $('#navbar').outerHeight()) + 'px',
        'max-height': ($(window).height() - $('#navbar').outerHeight()) + 'px'                    
    });
}