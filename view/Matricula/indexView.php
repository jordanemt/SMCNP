<?php
include_once 'public/header.php';
?>

<div class="content">
    <h2>Formulario de Matrícula</h2>
    <hr>
    <form id="matriculaForm">
        <h4>Datos personales</h4>
        <div class="form-group">
            <label for="cedula">Digite su número de cédula</label>
            <input type="text" class="form-control" id="card" name="card" placeholder="Ingrese la cédula">
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="card_type1" name="card-type" checked>
                    <label class="form-check-label" for="card_type1">Nacional</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="card_type2" name="card-type">
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
            <label for="personal_phone">Fecha de nacimiento</label>
            <input type="date" class="form-control" id="personal_phone" name="birthdate" placeholder="Ingrese su fecha de nacimiento">
        </div
        <div class="form-group">
            <label for="personal_phone">Número de teléfono</label>
            <input type="text" class="form-control" id="personal_phone" name="personal_phone" placeholder="Ingrese su número de teléfono">
        </div>
        <div class="form-group">
            <label for="other_phone">Otro teléfono</label>
            <input type="text" class="form-control" id="personal_phone" name="other_phone" placeholder="Ingrese otro número de teléfono">
            <small class="form-text text-muted">Opcional</small>
        </div>
        <div class="form-group">
            <label for="mep_mail">Correo del MEP</label>
            <input type="text" class="form-control" id="mep_mail" name="other_mail" placeholder="Ingrese su correo del MEP">
        </div>
        <div class="form-group">
            <label for="other_mail">Otro correo</label>
            <input type="text" class="form-control" id="other_mail" name="other_mail" placeholder="Ingrese otro correo">
            <small class="form-text text-muted">Opcional</small>
        </div>
        <div class="form-group">
            <label for="id_Community">Comunidad actual</label>
            <select class="form-control" id="comunidad" name="id_Community">
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
            <label for="direction">Dirección de residencia actual</label>
            <textarea class="form-control" id="direction" name="direction" placeholder="Ingrese la dirección"></textarea>
        </div>
        <div class="form-group">
            <label for="contact_name">Nombre completo de un contacto extra</label>
            <input type="text" class="form-control" id="contact_name" name="other_mail" placeholder="Ingrese el nombre completo del contacto">
        </div>
        <div class="form-group">
            <label for="contact_phone">Teléfono del contacto</label>
            <input type="text" class="form-control" id="contact_phone" name="other_mail" placeholder="Ingrese el teléfono del contacto">
        </div>

        <div class="row justify-content-center">
            <div class="form-group col-sm-4">
                <label>¿Cuenta con el beneficio del IMAS?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="imas_benefitYes" name="imas_benefit" value="1">
                    <label class="form-check-label" for="imas_benefitYes">
                        Sí
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="imas_benefitNo" name="imas_benefit" value="0">
                    <label class="form-check-label" for="imas_benefitNo">
                        No
                    </label>
                </div>
            </div>
            <div class="form-group col-sm-4">
                <label>¿Es madre o padre adolescente?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="teenage_fatherYes" name="teenage_father" value="1">
                    <label class="form-check-label" for="teenage_fatherYes">
                        Sí
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="teenage_fatherNo" name="teenage_father" value="0">
                    <label class="form-check-label" for="teenage_fatherNo">
                        No
                    </label>
                </div>
            </div>
            <div class="form-group col-sm-4">
                <label>¿Actualmente trabaja?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="workingYes" name="working" value="1">
                    <label class="form-check-label" for="workingYes">
                        Sí
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="workingNo" name="working" value="0">
                    <label class="form-check-label" for="workingNo">
                        No
                    </label>
                </div>
            </div>
        </div>

        <h4>Nivel a matricular</h4>
        <div class="form-group">
            <label for="level">Nivel de matrícula</label>
            <select class="form-control" id="level" name="level">
                <option selected disabled>Seleccione una opción</option>
                <option value="7">Séptimo</option>
                <option value="8">Octavo</option>
                <option value="9">Noveno</option>
                <option value="10">Décimo</option>
                <option value="11">Undécimo</option>
            </select>
        </div>
        <div id="level7">
            <h4>Secciones de séptimo</h4>
            <div class="form-group">
                <label for="level_num7">Elija la sección donde desea matricular</label>
                <select class="form-control" id="level_num7" name="level_num">
                    <option selected disabled>Seleccione una opción</option>
                    <option value="1">7-1 (Informática)</option>
                    <option value="2">7-2 (Contaduría)</option>
                    <option value="3">7-3 (Inglés)</option>
                </select>
            </div>
        </div>
        <div id="level8">
            <h4>Secciones de octavo</h4>
            <div class="form-group">
                <label for="level_num8">Elija la sección donde desea matricular</label>
                <select class="form-control" id="level_num8" name="level_num">
                    <option selected disabled>Seleccione una opción</option>
                    <option value="1">8-1 (Informática)</option>
                    <option value="2">8-2 (Contaduría)</option>
                    <option value="3">8-3 (Inglés)</option>
                    <option value="4">8-4 (Informática)</option>
                </select>
            </div>
        </div>
        <div id="level9">
            <h4>Secciones de noveno</h4>
            <div class="form-group">
                <label for="level_num9">Elija la sección donde desea matricular</label>
                <select class="form-control" id="level_num9" name="level_num">
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
        <div id="level11">
            <h4>Matrícula Undécimo</h4>
            <div class="form-group">
                <label for="level_num10">Debe indicar en cual ciencia va a realizar el bachillerato</label>
                <select class="form-control" id="level_num10" name="level_num">
                    <option selected disabled>Seleccione una opción</option>
                    <option value="1">Biología</option>
                    <option value="2">Física</option>
                    <option value="3">Química</option>
                    <option value="3">Biología</option>
                </select>
            </div>
        </div>

        <h4>Adecuación curricular</h4>
        <div class="form-group">
            <label>¿Tiene alguna adecuación curricular?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="adequacySi" name="adequacy" value="1">
                <label class="form-check-label" for="adecuacionYes">
                    Sí
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="adequacyNo" name="adequacy" value="0">
                <label class="form-check-label" for="adecuacionNo">
                    No
                </label>
            </div>
        </div>

        <div id="adequacy_section">
            <div class="form-group">
                <label for="id_Adequacy">¿Qué tipo de adecuación tiene usted?</label>
                <select class="form-control" id="id_Adequacy" name="id_Adequacy">
                    <option selected disabled>Seleccione una opción</option>
                    <option value="1">De acceso (problemas físicos o de alguna discapacidad)</option>
                    <option value="2">Adecuación no significativa</option>
                    <option value="3">Adecuación significativa</option>
                </select>
            </div>
        </div>


        <h4>Solicitud de servicios</h4>
        <div class="form-group">
            <label>Elija los servicios que usted solicitará formalmente en el Colegio (debe llenar y entregar toda la documentación que se le solicite en el colegio)</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="service" name="id_Service">
                <label class="form-check-label" for="service1">
                    Servicio de transporte
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="2" id="service" name="id_Service">
                <label class="form-check-label" for="service2">
                    Servicio de comedor
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="3" id="service3" name="id_Service">
                <label class="form-check-label" for="service3">
                    Beca de FONABE
                </label>
            </div>
            <small class="form-text text-muted">Puede marcar más de una opción o deje en blanco si no desea algún servicio</small>
        </div>
        
        <div id="route_section">
            <div class="form-group">
                <label for="id_Route">¿Escoja una ruta para el servicio de transporte?</label>
                <select class="form-control" id="id_Route" name="id_Route">
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
