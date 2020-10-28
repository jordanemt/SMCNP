function switchVisibility(elementId) {
    if ($('#' + elementId).is(":visible")) {
        $('#' + elementId).hide();
    } else {
        $('#' + elementId).show();
    }
}

function switchVisibilityToShow(elementId) {
    $('#' + elementId).show();
}

function switchVisibilityToHide(elementId) {
    $('#' + elementId).hide();
}

function hideDegrees() {
    switchVisibilityToHide('level7_container');
    switchVisibilityToHide('level8_container');
    switchVisibilityToHide('level9_container');
    switchVisibilityToHide('level11_container');
}