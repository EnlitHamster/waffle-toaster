var lastId = '0';
var components = [];

var _nextId = function (id) {
    // To avoid overflow, we only consider the last number
    var iid = parseInt(id.slice(-1));

    // If the last digit is not 9, we just add 1
    if (iid != 9) return (iid + 1).toString();
    // Otherwise, we search backwards
    else if (id.length > 1) return nextId(id.substring(0, id.length - 1)) + '0';
    // And if the last number was all made of 9, we start with 10
    else return '10';
}

var nextId = function () {
    lastId = _nextId(lastId);
    return lastId;
}

var genComb = function () {
    var card = document.createElement('div');
    var cardBody = document.createElement('div');
    var cardImg = document.createElement('img');
    var cardTitle = document.createElement('h5');
    var cardText = document.createElement('p');
    var cardEdit = document.createElement('a');

    // Setting card style, id & components
    $(card).addClass('card scrollbar');
    $(card).attr('id', 'img-' + nextId());
    $(card).append(cardImg)
        .append($(cardBody));
    $(card).css({
        'overflow-y': 'overlay',
        'overflow-x': 'hidden',
        'min-width': '160px',
        'min-height': '160px',
        width: '160px',
        height: '160px'
    });

    // Setting card image style & text
    $(cardImg).addClass('card-img-top disabled');

    // Setting card body style & components
    $(cardBody).addClass('card-body');
    $(cardBody).append(cardTitle)
        .append(cardText)
        .append(cardEdit);

    // Setting card title style & text
    $(cardTitle).addClass('card-title');
    $(cardTitle).text('Card Title');

    // Setting card text style & text
    $(cardText).addClass('card-text');
    $(cardText).text('Card content');

    // Setting edit button style, text & click handler
    $(cardEdit).addClass('btn btn-primary');
    $(cardEdit).attr({
        'data-toggle': 'modal',
        'data-target': '#edit-comb-modal'
    });
    $(cardEdit).text('Edit');
    $(cardEdit).on('click', function () {
        var img = $(cardImg).attr('src');

        $('#edit-comb-form').attr('data-id', $(card).attr('id'));
        $('input[name=edit-comb-card-title]').val($(cardTitle).text());
        $('textarea#edit-comb-card-text').val($(cardText).text());

        if (img != undefined && img != 'none') {
            $('#edit-comb-display').removeClass('disabled');
            $('#edit-comb-display').css({ 'background-image': 'url(\'' + img + '\')' });
        } else $('#edit-comb-display').addClass('disabled');
    });

    return $(card);
}

var addComb = function (e) {
    var newCombined = genComb();
    $(newCombined).addClass('combined-element');

    addComponent(newCombined, e.clientX, e.clientY);
}