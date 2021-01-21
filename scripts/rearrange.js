var componentDragListener = function(e) {
    var offset = $(this).offset();
    var dx = (e.clientX - offset.left) / $(this).width();
    var dy = (e.clientY - offset.top) / $(this).height();
    startDrag($(this), $('#canvas'), dx, dy);
}

var moveMode = function() {
    $('#move-resize').attr('data-mode', 'move');
    $('#move-resize').addClass('active');
    $('#move-resize').css({'font-weight': '500'});
}

var resizeMode = function() {
    $('#move-resize').attr('data-mode', 'resize');
    $('#move-resize').removeClass('active');
    $('#move-resize').css({'font-weight': '400'});
}

var setMode = function(id) {
    if ($('#move-resize').attr('data-mode') == 'move') {
        $(id).css({resize: 'none'});
        $(id).on('mousedown', componentDragListener);
    } else {
        if (id.startsWith('#txt')) $(id).css({resize: 'both'});
        else if (id.startsWith('#img')) $(id).css({resize: 'both'});
        $(id).off('mousedown', componentDragListener);
    }
}

var switchMode = function () {
    if ($(this).attr('data-mode') == 'move') resizeMode();
    else moveMode();

    components.forEach(function (entry) { setMode('#' + entry); });
}