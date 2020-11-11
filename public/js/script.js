function createEnrollment() {
//    if ($('#enrollment-form').valid()){
//        alert($('#enrollment-form').serialize());
        var url = "?controller=Matricula&action=enroll";
        $.ajax({
            url: url,
            cache: false,
            type: "POST",
            data: $('#enrollment-form').serialize(),
            success: function (data) {
                alert(data);
            },
            error: function (error) {
                alert(error.responseText);
            }
        });
//    }
}

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
    $('#degree-error').hide();
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
        if (years <= 18) {
            switchVisibilityToShow('is_teenage_father-container');
            switchVisibilityToShow('encargado-container');
        } else {
            switchVisibilityToHide('is_teenage_father-container');
            switchVisibilityToHide('encargado-container');
        }
    });

    $('select').selectpicker();
});