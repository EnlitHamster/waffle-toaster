var openBoard = null;

var requestNewMainBoard = function () {
    var boardName = $('#new-main-board-name').val()
    $.ajax({
        url: '/waffle-toaster/php-scripts/store-data.php?action=create',
        method: 'POST',
        data: { 
            root: {
                name: boardName,
                size: $('#new-main-board-canvas-size').val(),
                bg: {
                    type: $('input[name=new-main-board-show-grid]:checked').val(),
                    cellsize: $('#new-main-board-grid-size').val()
                }
            }
        }
    }).done(function (data, textStatus, jqXHR) {
        openBoard = boardName;
    }).fail(function (jqXHR, textStatus, errorThrown) {
        alert(textStatus + "\n" + errorThrown);
    });
}


var requestNewCard = function (_id) {
    var card = $(_id);
    $.ajax({
        url: 'waffle-toaster/php-scripts/store-data.php?action=add',
        method: 'POST',
        data: {
            root: {
                name: openBoard,
                type: 'card',
                object: {
                    position: {
                        left: card.css('left'),
                        top: card.css('top'),
                    }, 
                    size: {
                        width: card.width(),
                        height: card.height(),
                    },
                    content: {
                        title: card.find('.card-title').text(),
                        text: card.find('.card-text').text(),
                        image: card.find('.card-img-top').attr('src'),
                    }
                }
            }
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        alert(textStatus + "\n" + errorThrown);
        return false;
    });
    
    return true;
}