function clearFiles() {
    $('.enrroll_files').val('');
}

function loading() {
    $('#submit').attr('disabled', true);
    switchVisibilityToShow('alert-loading');
}

function createEnrollment() {
    if ($('#enrollment-form').valid()){
        loading();
        switchVisibilityToHide('alert-errors');
        var url = "?controller=Enrollment&action=enroll";
        var form = new FormData($("#enrollment-form")[0]);
        $.ajax({
            url: url,
            type: "POST",
            contentType: false,
            cache: false,
            processData: false,
            data: form,
            enctype: 'multipart/form-data',
            success: function (data) {
                alert(data);
                window.location.replace('https://ligatealnocturno.os.cr/matricula');
//                $('#submit').attr('disabled', false);
//                switchVisibilityToHide('alert-loading');
            },
            error: function (error) {
                alert('Error inesperado');
                $('#submit').attr('disabled', false);
                switchVisibilityToHide('alert-loading');
            }
        });
    } else {
        switchVisibilityToShow('alert-errors');
    }
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
    switchVisibilityToHide('level10_container');
    switchVisibilityToHide('level11_container');
    $('#level_num7 option:eq(0)').prop('selected', true);
    $('#level_num8 option:eq(0)').prop('selected', true);
    $('#level_num9 option:eq(0)').prop('selected', true);
    $('#level_num10 option:eq(0)').prop('selected', true);
    $('#level_num11 option:eq(0)').prop('selected', true);
    $('select').selectpicker('refresh');
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

function overwriteJQueryMessages() {
    jQuery.extend(jQuery.validator.messages, {
        required: "Este campo es necesario.",
        remote: "Please fix this field.",
        email: "Ingrese un correo válido.",
        url: "Please enter a valid URL.",
        date: "Please enter a valid date.",
        dateISO: "Please enter a valid date (ISO).",
        number: "Solo se permiten números.",
        digits: "Please enter only digits.",
        creditcard: "Please enter a valid credit card number.",
        equalTo: "Please enter the same value again.",
        accept: "Please enter a value with a valid extension.",
        maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
        minlength: jQuery.validator.format("Por favor ingrese al menos {0} carácteres."),
        rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
        range: jQuery.validator.format("Please enter a value between {0} and {1}."),
        max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
        min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
    });
}

function hideAll() {
    switchVisibilityToHide('is_teenage_father-container');
    switchVisibilityToHide('encargado-container');
    switchVisibilityToHide('adequacy_container');
    switchVisibilityToHide('alert-sexual_matter');
    switchVisibilityToHide('alert-ethics_matter');
    switchVisibilityToHide('level7_container');
    switchVisibilityToHide('level8_container');
    switchVisibilityToHide('level9_container');
    switchVisibilityToHide('level11_container');
    switchVisibilityToHide('repeating_matters-container');
    switchVisibilityToHide('route_container');
}

function setValMepMail() {
    var value = $('#card').val().replace('-', '');
    value = value.replace('-', '');
    value = value + "@est.mep.go.cr";
    $('#mep_mail').val(value);
}

var student_is_charged = false;
function getStudentByCard() {
    var url = "?controller=Student&action=getByCard";
    $.ajax({
        url: url,
        cache: false,
        type: "POST",
        data: {
            card: $('#card').val()
        },
        success: function (data) {
            var student = JSON.parse(data);
            if (student !== null) {
                hideAll();
                $('#id').val(student['id']);
                if(student['name'] !== null) $('#name').val(student['name']);
                if(student['first_lastname'] !== null) $('#first_lastname').val(student['first_lastname']);
                if(student['second_lastname'] !== null) $('#second_lastname').val(student['second_lastname']);
                if (student['gender'] === 'MASCULINO') {
                    $('#gender_Masculino').prop('checked', true);
                } else if (student['gender'] === 'FEMENINO') {
                    $('#gender_Femenino').prop('checked', true);
                }
                if(student['birthdate'] !== null) {
                    var birthdate = moment(student['birthdate']);
                    var years = moment().diff(birthdate, 'years');
                    if(years < 19) {
                        switchVisibilityToShow('is_teenage_father-container');
                        switchVisibilityToShow('encargado-container');
                        if (student['is_teenage_father'] === 1) {
                            $('#teenage_fatherYes').prop('checked', true);
                        } else if (student['is_teenage_father'] === 0) {
                            $('#teenage_fatherNo').prop('checked', true);
                        }
                    } else {
                        switchVisibilityToHide('is_teenage_father-container');
                        switchVisibilityToHide('encargado-container');
                    }
                    $('#birthdate').val(birthdate.format('DD/MM/YYYY'));
                }
                if(student['nationality'] !== null) $('#nationality').val(student['nationality']);
                if(student['personal_phone'] !== null) $('#personal_phone').val(student['personal_phone']);
                if(student['other_phone'] !== null) $('#other_phone').val(student['other_phone']);
                if(student['mep_mail'] !== null) $('#mep_mail').val(student['mep_mail']);
                if(student['other_mail'] !== null) $('#other_mail').val(student['other_mail']);
                if(student['id_district'] !== null) $('#id_district').val(student['id_district']);
                if(student['direction'] !== null) $('#direction').val(student['direction']);
                if(student['contact_name'] !== null) $('#contact_name').val(student['contact_name']);
                if(student['contact_phone'] !== null) $('#contact_phone').val(student['contact_phone']);
                $('select').selectpicker('refresh');
                student_is_charged = true;
            } else if (student_is_charged) {
                $('#id').val('');
                var card = $('#card').val();
                $('#enrollment-form').trigger("reset");
                $('#card').val(card);
//                $('#birthdate').val('');
                hideAll();
                $('select').selectpicker('refresh');
                student_is_charged = false;
            }
            
            if (student_is_charged) {
                $('.required-file').removeAttr('required');
            } else {
                $('.required-file').attr('required', 'true');
            }
        },
        error: function (error) {
            alert('Error al cargar datos del estudiante');
        },
        complete: function () {
            setValMepMail();
        }
    });
}

function clearParent() {
    $('#id_parent').val('');
    $('#card_parent').val('');
    $('#full_name_parent').val('');
    $('#nationality_parent').val('');
    $('#ocupation_parent').val('');
    $('#work_place_parent').val('');
    $('#phone_parent').val('');
}

var parent_is_charged = false;
function getParentByCard() {
    var url = "?controller=Parent&action=getByCard";
    $.ajax({
        url: url,
        cache: false,
        type: "POST",
        data: {
            card: $('#card_parent').val()
        },
        success: function (data) {
            var parent = JSON.parse(data);
            if (parent !== null) {
                clearParent();
                if (parent['id'] !== null)
                    $('#id_parent').val(parent['id']);
                if (parent['card'] !== null)
                    $('#card_parent').val(parent['card']);
                if (parent['full_name'] !== null)
                    $('#full_name_parent').val(parent['full_name']);
                if (parent['nacionality'] !== null)
                    $('#nationality_parent').val(parent['nacionality']);
                if (parent['ocupation'] !== null)
                    $('#ocupation_parent').val(parent['ocupation']);
                if (parent['work_place'] !== null)
                    $('#work_place_parent').val(parent['work_place']);
                if (parent['phone'] !== null)
                    $('#phone_parent').val(parent['phone']);
                parent_is_charged = true;
            } else if (parent_is_charged) {
                $('#id_parent').val('');
                var card = $('#card_parent').val();
                clearParent();
                $('#card_parent').val(card);
                parent_is_charged = false;
            }
        },
        error: function (error) {
            alert('Error al cargar datos del encargado');
        }
    });
}

$(document).ready(function () {
    $('#enrollment-form').trigger("reset");
    
    $('select').selectpicker();
    setMasks();

    $('#birthdate').daterangepicker({
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        maxYear: parseInt(moment().format('YYYY'), 10)
    });
    
    $('#birthdate').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY'));
        var years = moment().diff(picker.startDate, 'years');
        if (years <= 18) {
            switchVisibilityToShow('is_teenage_father-container');
            switchVisibilityToShow('encargado-container');
        } else {
            switchVisibilityToHide('is_teenage_father-container');
            switchVisibilityToHide('encargado-container');
            clearParent();
        }
    });
    
    $("input[type=text]").keyup(function () {
        $(this).val($(this).val().toUpperCase());
    });
    
    overwriteJQueryMessages();
    $('.required-file').attr('required', 'true');
});