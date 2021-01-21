var VertPosition = {
    TOP: 0.0,
    CENTER: 0.5,
    BOTTOM: 1.0
}

var HorizPosition = {
    LEFT: 0.0,
    CENTER: 0.5,
    RIGHT: 1.0
}

/* Inspired by https://codepen.io/tessat/pen/aAEDd */

var startDrag = function($dragging, $anchor, hPos, vPos) {
    $dragging.addClass('dragging');

    $anchor.on('mousemove', function(e) {
        e.preventDefault();
        drag({x: e.clientX, y: e.clientY}, $dragging, $anchor, hPos, vPos);
    });

    $anchor.on('mouseup', function() {
        stopDrag($dragging, $anchor);
    });
}

var stopDrag = function($dragging, $anchor) {
    $dragging.removeClass('dragging');
    $anchor.off('mousemove mouseup');
}

var drag = function(pos, $dragging, $anchor, hPos, vPos) {
    var offset = $anchor.offset();

    // Finding positioning relative to anchor of the cursor normalized
    // based on the position inside the dragged element
    var xPos = pos.x - offset.left - hPos * $dragging.width();
    var yPos = pos.y - offset.top - vPos * $dragging.height();

    var xMax = $anchor.width() - $dragging.width();
    var yMax = $anchor.height() - $dragging.height();

    // Setting the new positions
    $dragging.css({
        left: min(xMax, max(xPos, 0)) + 'px',
        top: min(yMax, max(yPos, 0)) + 'px',
    });

    console.log('=== Dragging Log ===');
    console.log(offset.left + ' ' + $anchor.width() + ' - ' + xPos + ' ' + xMax);
    console.log(offset.top + ' ' + $anchor.height() + ' - ' + yPos + ' ' + yMax);
    console.log(($dragging.offset().left - offset.left) + ' ' + ($dragging.offset().top - offset.top));
}