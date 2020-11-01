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

function showDegreeContainerSelected() {
    hideDegrees();
    switchVisibilityToShow('level' + $('#degree').val() + '_container');
}

function cardMask(cardId) {
    $('#' + cardId).mask("0-0000-0000");
}

function unMask(cardId) {
    $('#' + cardId).unmask();
}

function setMasks() {
    $('.card').mask("0-0000-0000");
    $('.phone').mask("0000-0000");
}

$(document).ready(function () {
    setMasks();

    $('#birthdate').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format('YYYY'), 10)
    }, function (start) {
        var years = moment().diff(start, 'years');
        if (years <= 19) {
            switchVisibilityToShow('is_teenage_father-container');
        } else {
            switchVisibilityToHide('is_teenage_father-container');
        }
    });

    $('select').selectpicker();
});