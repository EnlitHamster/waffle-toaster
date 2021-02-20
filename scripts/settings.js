// Default settings
var showGrid = false;
var canvasWidth = 1000;
var canvasHeight = 1000;

var applySettings = function () {
    // Grid options
    // !!! Order matters !!!
    // CSS the inline css has to be removed prior and added after the 
    // manipulation of the grid-bg class to avoid conflict
    if (showGrid) {
        $('#canvas').css('background', '');
        $('#canvas').addClass('grid-bg');
    } else {
        $('#canvas').removeClass('grid-bg');
        $('#canvas').css('background', 'white');
    }

    // Dimensions
    $('#canvas').css({
        'width': canvasWidth + 'px',
        'min-width': canvasWidth + 'px',
        'max-width': canvasWidth + 'px',
        'height': canvasHeight + 'px',
        'min-height': canvasHeight + 'px',
        'max-height': canvasHeight + 'px',
    });
}

var parseSettings = function (_showGrid, _canvasSize) {
    parseShowGrid(_showGrid);
    parseCanvasSize(_canvasSize);
} 

var parseShowGrid = function (_showGrid) {
    if (_showGrid && !/^\s*$/.test(_showGrid)) showGrid = _showGrid == 'true';
}

var parseCanvasSize = function (_canvasSize) {
    if (_canvasSize && /^([1-9][0-9]*)x([1-9][0-9]*)$/.test(_canvasSize)) {
        var sizes = _canvasSize.split('x');
        canvasWidth = parseInt(sizes[0]);
        canvasHeight = parseInt(sizes[1]);
    }
}