var requestNewMainBoard = function () {
    $.ajax({
        url: '/waffle-toaster/php-scripts/store-data.php?action=create',
        method: 'POST',
        data: { root: {
            name: $('#new-main-board-name').val(),
            size: $('#new-main-board-canvas-size').val(),
            bg: {
                type: $('input[name=new-main-board-show-grid]:checked').val(),
                cellsize: $('#new-main-board-grid-size').val()
            }
        }}
    }).fail(function (jqXHR, textStatus, errorThrown) {
        alert(textStatus);
    });
}
