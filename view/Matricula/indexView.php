<?php
include_once 'public/header.php';
?>

<div class="content">
    <h2>Formulario de Matrícula</h2>
    <hr>
    <form id="matriculaForm">
        <h4>Datos personales</h4>
        
        <div class="d-none form-group">
            <input type="text" class="form-control card" id="id_student" name="id_student" value="0">
        </div>
        
        <div class="form-group">
            <label for="card">Cédula</label>
            <input type="text" class="form-control card" id="card" name="card" placeholder="Ingrese la cédula">
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="card_type1" name="card-type" checked onclick="cardMask('card')">
                    <label class="form-check-label" for="card_type1">Nacional</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="card_type2" name="card-type" onclick="unMask('card')">
                    <label class="form-check-label" for="card_type2">Extranjero</label>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese su nombre">
        </div>
        
        <div class="form-group">
            <label for="first_lastname">Primer apellido</label>
            <input type="text" class="form-control" id="first_lastname" name="first_lastname" placeholder="Ingrese su primer apellido">
        </div>
        
        <div class="form-group">
            <label for="second_lastname">Segundo apellido</label>
            <input type="text" class="form-control" id="second_lastname" name="second_lastname" placeholder="Ingrese su segundo apellido">
        </div>
        
        <div class="form-group">
            <label>Sexo</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="gender_Femenino" name="gender" value="Femenino">
                <label class="form-check-label" for="gender_Femenino">
                    Femenino
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="gender_Masculino" name="gender" value="Masculino">
                <label class="form-check-label" for="gender_Masculino">
                    Masculino
                </label>
            </div>
        </div>
        
        <div class="form-group">
            <label for="birthdate">Fecha de nacimiento</label>
            <input type="text" class="form-control" id="birthdate" name="birthdate" placeholder="Ingrese su fecha de nacimiento">
        </div>
        
        <div id="is_teenage_father-container" class="form-group"> <script>$('#is_teenage_father-container').hide();</script>
            <label>¿Es madre o padre adolescente (menor que 19 años)?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="teenage_fatherYes" name="is_teenage_father" value="1">
                <label class="form-check-label" for="teenage_fatherYes">
                    Sí
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="teenage_fatherNo" name="is_teenage_father" value="0">
                <label class="form-check-label" for="teenage_fatherNo">
                    No
                </label>
            </div>
        </div>
        
        <div class="form-group">
            <label for="nationality">Nacionalidad</label>
            <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Ingrese su nacionalidad">
        </div>
        
        <div class="form-group">
            <label for="personal_phone">Número de teléfono</label>
            <input type="text" class="form-control phone" id="personal_phone" name="personal_phone" placeholder="Ingrese su número de teléfono">
        </div>
        
        <div class="form-group">
            <label for="other_phone">Otro teléfono</label>
            <input type="text" class="form-control phone" id="personal_phone" name="other_phone" placeholder="Ingrese otro número de teléfono">
            <small class="form-text text-muted">Opcional</small>
        </div>
        
        <div class="form-group">
            <label for="mep_mail">Correo del MEP</label>
            <input type="text" class="form-control" id="mep_mail" name="mep_mail" placeholder="Ingrese su correo del MEP">
        </div>
        
        <div class="form-group">
            <label for="other_mail">Otro correo</label>
            <input type="text" class="form-control" id="other_mail" name="other_mail" placeholder="Ingrese otro correo">
            <small class="form-text text-muted">Opcional</small>
        </div>
        
        <div class="form-group">
            <label for="id_district">Distrito actual</label>
            <select class="form-control" id="comunidad" name="id_district">
                <option selected disabled>Seleccione una opción</option>
                <option value="1">Guápiles</option>
                <option value="2">La Rita</option>
                <option value="3">Roxana</option>
                <option value="4">La Colonia - La Teresa</option>
                <option value="5">Jiménez</option>
                <option value="6">Cariari</option>
                <option value="7">San Antonio</option>
                <option value="8">Bella Vista - Buenos Aires</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="direction">Dirección de exacta</label>
            <textarea class="form-control" id="direction" name="direction" placeholder="Ingrese la dirección"></textarea>
        </div>
        
        <div class="form-group">
            <label>¿Padece de alguna enfermedad?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="sufferingYes" name="is_suffering" value="1" 
                       onclick="switchVisibilityToShow('suffering_container')">
                <label class="form-check-label" for="sufferingYes">
                    Sí
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="sufferingNo" name="is_suffering" value="0" 
                       onclick="switchVisibilityToHide('suffering_container')">
                <label class="form-check-label" for="sufferingNo">
                    No
                </label>
            </div>
        </div>
        <div id="suffering_container" class="form-group"> <script>$('#suffering_container').hide();</script>
            <label for="suffering">¿Qué enfermedad?</label>
            <input type="text" class="form-control" id="suffering" name="suffering" placeholder="Ingrese la enfermedad">
        </div>
        
        <div class="form-group">
            <label>¿Tiene alguna adecuación curricular?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="adequacySi" name="adequacy" value="1"
                       onclick="switchVisibilityToShow('adequacy_container');">
                <label class="form-check-label" for="adecuacionYes">
                    Sí
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="adequacyNo" name="adequacy" value="0"
                       onclick="switchVisibilityToHide('adequacy_container');">
                <label class="form-check-label" for="adecuacionNo">
                    No
                </label>
            </div>
        </div>
        <div id="adequacy_container"> <script>$('#adequacy_container').hide();</script>
            <div class="form-group">
                <label for="id_adequacy">¿Qué tipo de adecuación tiene usted?</label>
                <select class="form-control" id="id_adequacy" name="id_adequacy">
                    <option selected disabled>Seleccione una opción</option>
                    <option value="1">De acceso (problemas físicos o de alguna discapacidad)</option>
                    <option value="2">Adecuación no significativa</option>
                    <option value="3">Adecuación significativa</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label>¿Cuenta con el beneficio del IMAS?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="imas_benefitYes" name="is_imas_benefit" value="1">
                <label class="form-check-label" for="imas_benefitYes">
                    Sí
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="imas_benefitNo" name="is_imas_benefit" value="0">
                <label class="form-check-label" for="imas_benefitNo">
                    No
                </label>
            </div>
        </div>

        <div class="form-group">
            <label>¿Actualmente trabaja?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="workingYes" name="is_working" value="1">
                <label class="form-check-label" for="workingYes">
                    Sí
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="workingNo" name="is_working" value="0">
                <label class="form-check-label" for="workingNo">
                    No
                </label>
            </div>
        </div>

        <div class="form-group">
            <label>¿Desea llevar la materia de Ética?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="ethics_matterYes" name="is_ethics_matter" value="1" 
                       onclick="switchVisibilityToHide('alert-ethics_matter');">
                <label class="form-check-label" for="ethics_matterYes">
                    Sí
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="ethics_matterNo" name="is_ethics_matter" value="0"
                       onclick="switchVisibilityToShow('alert-ethics_matter');">
                <label class="form-check-label" for="ethics_matterNo">
                    No
                </label>
            </div>
        </div>
        <div id="alert-ethics_matter" class="alert alert-danger" role="alert"> <script>$('#alert-ethics_matter').hide();</script>
            Debe aportar una carta firmada indicando que no desea llevar la materia de Ética
        </div>

        <div class="form-group">
            <label>¿Desea llevar la materia de Sexualidad y Afectividad?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="sexual_matterYes" name="is_sexual_matter" value="1"
                       onclick="switchVisibilityToHide('alert-sexual_matter');">
                <label class="form-check-label" for="sexual_matterYes">
                    Sí
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="sexual_matterNo" name="is_sexual_matter" value="0"
                       onclick="switchVisibilityToShow('alert-sexual_matter');">
                <label class="form-check-label" for="sexual_matterNo">
                    No
                </label>
            </div>
        </div>
        <div id="alert-sexual_matter" class="alert alert-danger" role="alert"> <script>$('#alert-sexual_matter').hide();</script>
            Debe aportar una carta firmada indicando que no desea llevar la materia de Sexualidad y Afectividad
        </div>

        <div class="form-group">
            <label for="contact_name">Nombre completo de un contacto de emergencia</label>
            <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Ingrese el nombre completo del contacto">
        </div>
        <div class="form-group">
            <label for="contact_phone">Teléfono del contacto de emergencia</label>
            <input type="text" class="form-control phone" id="contact_phone" name="contact_phone" placeholder="Ingrese el teléfono del contacto">
        </div>
        
        <div id="encargado-container">
            <script>$('#encargado-container').hide();</script>
            <h4>Datos de padre, madre o encargado</h4>
            <div class="form-group">
                <label for="card-encargado">Cédula</label>
                <input type="text" class="form-control card" id="card-encargado" name="card-encargado" placeholder="Ingrese la cédula">
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="card_type1-encargado" name="card-type-encargado" checked onclick="cardMask('card-encargado')">
                        <label class="form-check-label" for="card_type1-encargado">Nacional</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="card_type2-encargado" name="card-type-encargado" onclick="unMask('card-encargado')">
                        <label class="form-check-label" for="card_type2-encargado">Extranjero</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="full_name-encargado">Nombre completo</label>
                <input type="text" class="form-control" id="full_name-encargado" name="full_name-encargado" placeholder="Ingrese el nombre completo">
            </div>
            <div class="form-group">
                <label for="nationality-encargado">Nacionalidad</label>
                <input type="text" class="form-control" id="full_name-encargado" name="nationality-encargado" placeholder="Ingrese la nacionalidad">
            </div>
            <div class="form-group">
                <label for="ocupation-encargado">Ocupación</label>
                <input type="text" class="form-control" id="ocupation-encargado" name="ocupation-encargado" placeholder="Ingrese la ocupación">
            </div>
            <div class="form-group">
                <label for="work_place-encargado">Lugar de trabajo</label>
                <input type="text" class="form-control" id="work_place-encargado" name="work_place-encargado" placeholder="Ingrese el lugar de trabajo">
            </div>
            <div class="form-group">
                <label for="phone-encargado">Teléfono</label>
                <input type="text" class="form-control phone" id="phone-encargado" name="phone-encargado" placeholder="Ingrese el teléfono">
            </div>
        </div>
        
        <h4>Matricula</h4>
        <div class="form-group">
            <label for="degree">Nivel de matrícula</label>
            <select class="form-control" id="degree" name="degree" onchange="showDegreeContainerSelected();">
                <option selected disabled>Seleccione una opción</option>
                <option value="7">Séptimo</option>
                <option value="8">Octavo</option>
                <option value="9">Noveno</option>
                <option value="10">Décimo</option>
                <option value="11">Undécimo</option>
            </select>
        </div>
        <div id="level7_container"> <script>$('#level7_container').hide();</script>
            <div class="form-group">
                <label for="level_num7">Elija la sección donde desea matricular</label>
                <select class="form-control" id="level_num7" name="id_section">
                    <option selected disabled>Seleccione una opción</option>
                    <option value="1">7-1 (Informática)</option>
                    <option value="2">7-2 (Contaduría)</option>
                    <option value="3">7-3 (Inglés)</option>
                </select>
            </div>
        </div>
        <div id="level8_container"> <script>$('#level8_container').hide();</script>
            <div class="form-group">
                <label for="level_num8">Elija la sección donde desea matricular</label>
                <select class="form-control" id="level_num8" name="id_section">
                    <option selected disabled>Seleccione una opción</option>
                    <option value="1">8-1 (Informática)</option>
                    <option value="2">8-2 (Contaduría)</option>
                    <option value="3">8-3 (Inglés)</option>
                    <option value="4">8-4 (Informática)</option>
                </select>
            </div>
        </div>
        <div id="level9_container"> <script>$('#level9_container').hide();</script>
            <div class="form-group">
                <label for="level_num9">Elija la sección donde desea matricular</label>
                <select class="form-control" id="level_num9" name="id_section">
                    <option selected disabled>Seleccione una opción</option>
                    <option value="1">9-1 (Informática)</option>
                    <option value="2">9-2 (Contaduría)</option>
                    <option value="3">9-3 (Inglés)</option>
                    <option value="4">9-4 (Informática)</option>
                    <option value="5">9-5 (Inglés)</option>
                    <option value="6">9-6 (Informática)</option>
                </select>
            </div>
        </div>
        <div id="level11_container"> <script>$('#level11_container').hide();</script>
            <div class="form-group">
                <label for="level_num10">Debe indicar en cual ciencia va a realizar el bachillerato</label>
                <select class="form-control" id="level_num10" name="id_section">
                    <option selected disabled>Seleccione una opción</option>
                    <option value="1">Biología</option>
                    <option value="2">Física</option>
                    <option value="3">Química</option>
                    <option value="3">Biología</option>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label>¿Repite materias?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="repeating_mattersYes" name="is_repeating_matters" value="1" 
                       onclick="switchVisibilityToShow('repeating_matters-container')">
                <label class="form-check-label" for="repeating_mattersYes">
                    Sí
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="repeating_mattersNo" name="is_repeating_matters" value="0" 
                       onclick="switchVisibilityToHide('repeating_matters-container')">
                <label class="form-check-label" for="repeating_mattersNo">
                    No
                </label>
            </div>
        </div>
        
        <div id='repeating_matters-container' class="form-group"> <script>$('#repeating_matters-container').hide();</script>
            <label for="repeating_matters">Seleccione las materias que repite o no ha ganado</label>
            <select class="form-control" id="repeating_matters" name="repeating_matters" title="Seleccione una o varias opciones" multiple>
                <option value="Español">Español</option>
                <option value="Ciencias">Ciencias</option>
                <option value="Estudios Sociales">Estudios Sociales</option>
                <option value="Matemática">Matemática</option>
                <option value="Inglés">Inglés</option>
                <option value="Cívica">Cívica</option>
                <option value="Taller lll ciclo">Taller lll ciclo</option>
                <option value="Ética">Ética</option>
                <option value="Química">Química</option>
                <option value="Biología">Biología</option>
                <option value="Física">Física</option>
            </select>
        </div>

        <h4>Solicitud de servicios</h4>
        <div class="form-group">
            <label>Elija los servicios que usted solicitará formalmente en el Colegio (debe llenar y entregar toda la documentación que se le solicite en el colegio)</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="service" name="id_service" onclick="switchVisibility('route_container');">
                <label class="form-check-label" for="service1">
                    Servicio de transporte
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="2" id="service" name="id_service">
                <label class="form-check-label" for="service2">
                    Servicio de comedor
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="3" id="service3" name="id_service">
                <label class="form-check-label" for="service3">
                    Beca de FONABE
                </label>
            </div>
            <small class="form-text text-muted">Puede marcar más de una opción o deje en blanco si no desea algún servicio</small>
        </div>

        <div id="route_container"> <script>$('#route_container').hide();</script>
            <div class="form-group">
                <label for="id_Route">¿Escoja una ruta para el servicio de transporte?</label>
                <select class="form-control" id="id_Route" name="id_route">
                    <option selected disabled>Seleccione una opción</option>
                    <option value="1">Bellavista</option>
                    <option value="2">Buenos Aires</option>
                    <option value="3">Toro Amarillo-La Unión</option>
                    <option value="4">Suerre</option>
                    <option value="5">Sauces</option>
                    <option value="6">San Luis, Jiménez, San Martín</option>
                    <option value="7">Campo 2, Cariari</option>
                    <option value="8">La Rita, Roxana, El Humo</option>
                    <option value="9">La Colonia, La Teresa, Ticabán 1</option>
                </select>
            </div>
        </div>

        <h4>Términos y condiciones</h4>
        <div class="form-group">
            <div>
                <label>
                    - Portar y mostrar siempre el carné, la libreta y la camiseta.
                </label>
            </div>
            <div>
                <label>
                    - Cumplir con el reglamento interno.
                </label>
            </div>
            <div>
                <label>
                    - Autorizar el uso educativo de fotos.
                </label>
            </div>
            <div>
                <label>
                    - Declaro que los datos suministrados son verdaderos y acepto que este proceso no tiene validez sin la entrega de la documentación respectiva en la oficina de auxiliares del colegio.
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="conditions">
                <label class="form-check-label" for="conditions">
                    Aceptar términos y condiciones
                </label>
            </div>
        </div>
        <button type="button" class="btn btn-primary">Enviar</button>
    </form>
</div>

<?php
include_once 'public/footer.php';
