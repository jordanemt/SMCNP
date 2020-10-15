<?php
include_once 'public/header.php';
?>

<div class="content">
    <h2>Formulario de Matrícula</h2>
    <hr>
    <form id="matriculaForm">
        <div id="datosPersonales">
            <h4>Datos personales</h4>
            <div class="form-group">
                <label for="cedula">Digite Número de Cédula</label>
                <input type="text" class="form-control" id="cedula" aria-describedby="cedulaHelp" placeholder="Ingrese la cédula">
                <small id="cedulaHelp" class="form-text text-muted">Escriba en formato 0-0000-0000 si es nacional o digite sin guiones si su cédula es de extranjero</small>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre" aria-describedby="nombreHelp" placeholder="Ingrese el nombre completo">
                <small id="nombreHelp" class="form-text text-muted">Nombre y apellidos</small>
            </div>
            <div class="form-group">
                <label for="telefono">Número de teléfono</label>
                <input type="text" class="form-control" id="telefono" aria-describedby="telefonoHelp" placeholder="Ingrese el número de teléfono">
                <small id="telefonoHelp" class="form-text text-muted">Teléfono donde localizarlo (celular o teléfono fijo)</small>
            </div>
            <div class="form-group">
                <label for="correo">Correo Personal</label>
                <input type="text" class="form-control" id="correo" aria-describedby="correoHelp" placeholder="Ingrese el correo">
                <small id="correoHelp" class="form-text text-muted">Ingrese el correo de mayor uso</small>
            </div>
            <div class="form-group">
                <label for="comunidad">Dirección de residencia actual</label>
                <select class="form-control" id="comunidad" name="comunidad" aria-describedby="comunidadHelp">
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
                <small id="comunidadHelp" class="form-text text-muted">Indique la comunidad donde vive actualmente</small>
            </div>
            <div class="form-group">
                <label for="direccion">Dirección de residencia actual</label>
                <textarea class="form-control" id="direccion" aria-describedby="direccionHelp" placeholder="Ingrese la dirección"></textarea>
                <small id="direccionHelp" class="form-text text-muted">Indique la dirección exacta donde vive actualmente</small>
            </div>
        </div>
        <div id="nivelMatricula">
            <h4>Nivel a matricular</h4>
            <div class="form-group">
                <label for="nivel">Nivel de matrícula</label>
                <select class="form-control" id="nivel" name="nivel" aria-describedby="nivelHelp">
                    <option selected disabled>Seleccione una opción</option>
                    <option value="1">Sétimo</option>
                    <option value="2">Octavo</option>
                    <option value="3">Noveno</option>
                    <option value="4">Décimo</option>
                    <option value="5">Undécimo</option>
                </select>
                <small id="nivelHelp" class="form-text text-muted">Indique el nivel a matricular</small>
            </div>
        </div>
        <div id="estudianteNuevo">
            <h4>Estudiante nuevo</h4>
            <div class="form-group">
                <label for="nuevo">¿Es estudiante nuevo en el Colegio Nocturno de Pococí?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="nuevo" id="nuevoSi" value="1">
                    <label class="form-check-label" for="nuevoSi">
                        Sí
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="nuevo" id="nuevoNo" value="2">
                    <label class="form-check-label" for="nuevoNo">
                        No
                    </label>
                </div>
            </div>
        </div>
        <div id="SeccionesContainer">
            <div id="seccionSetimoContainer">
                <h4>Secciones de sétimo</h4>
                <div class="form-group">
                    <label for="setimoSeccion">Elija la sección donde desea matricular</label>
                    <select class="form-control" id="setimoSeccion" name="seccion">
                        <option selected disabled>Seleccione una opción</option>
                        <option value="1">7-1 (TallerPendiente)</option>
                        <option value="2">7-2 (TallerPendiente)</option>
                        <option value="3">7-3 (TallerPendiente)</option>
                        <option value="4">7-4 (TallerPendiente)</option>
                        <option value="5">7-5 (TallerPendiente)</option>
                    </select>
                </div>
            </div>
            <div id="seccionOctavoContainer">
                <h4>Secciones de octavo</h4>
                <div class="form-group">
                    <label for="octavoSeccion">Elija la sección donde desea matricular</label>
                    <select class="form-control" id="octavoSeccion" name="seccion">
                        <option selected disabled>Seleccione una opción</option>
                        <option value="1">8-1 (TallerPendiente)</option>
                        <option value="2">8-2 (TallerPendiente)</option>
                        <option value="3">8-3 (TallerPendiente)</option>
                        <option value="4">8-4 (TallerPendiente)</option>
                        <option value="5">8-5 (TallerPendiente)</option>
                        <option value="6">8-6 (TallerPendiente)</option>
                    </select>
                </div>
            </div>
            <div id="seccionNovenoContainer">
                <h4>Secciones de noveno</h4>
                <div class="form-group">
                    <label for="novenoSeccion">Elija la sección donde desea matricular</label>
                    <select class="form-control" id="novenoSeccion" name="seccion">
                        <option selected disabled>Seleccione una opción</option>
                        <option value="1">9-1 (TallerPendiente)</option>
                        <option value="2">9-2 (TallerPendiente)</option>
                        <option value="3">9-3 (TallerPendiente)</option>
                        <option value="4">9-4 (TallerPendiente)</option>
                        <option value="5">9-5 (TallerPendiente)</option>
                        <option value="6">9-6 (TallerPendiente)</option>
                    </select>
                </div>
            </div>
            <div id="seccionUndecimoContainer">
                <h4>Matrícula Undécimo</h4>
                <div class="form-group">
                    <label for="undecimoSeccion">Debe indicar en cual ciencia va a realizar el bachillerato</label>
                    <select class="form-control" id="undecimoSeccion" name="seccion">
                        <option selected disabled>Seleccione una opción</option>
                        <option value="1">Biología</option>
                        <option value="2">Física</option>
                        <option value="3">Química</option>
                    </select>
                </div>
            </div>
        </div>
        <div id="adcuacionCurricular">
            <h4>Adecuación curricular</h4>
            <div class="form-group">
                <label for="adecuacion">¿Tiene alguna adecuación curricular?</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="adecuacion" id="adecuacionSi" value="1">
                    <label class="form-check-label" for="adecuacionSi">
                        Sí
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="adecuacion" id="adecuacionNo" value="2">
                    <label class="form-check-label" for="adecuacionNo">
                        No
                    </label>
                </div>
            </div>
        </div>
        <div id="tipoAdecuacion">
            <div class="form-group">
                <label for="tipo">¿Qué tipo de adecuación tiene usted?</label>
                <select class="form-control" id="tipo" name="tipo">
                    <option selected disabled>Seleccione una opción</option>
                    <option value="1">De acceso (problemas físicos o de alguna discapacidad)</option>
                    <option value="2">Adecuación No significativa</option>
                    <option value="3">Adecuación Significativa</option>
                </select>
            </div>
        </div>
        <div id="solicitudServicios">
            <h4>Solicitud de servicios</h4>
            <div class="form-group">
                <label>Elija los servicios que usted solicitará formalmente en el Colegio(debe llenar y entregar toda la documentación que se le solicite en el Colegio)</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="servicio1">
                    <label class="form-check-label" for="servicio1">
                        Servicio de transporte
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="servicio2">
                    <label class="form-check-label" for="servicio2">
                        Servicio de Comedor
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="servicio3">
                    <label class="form-check-label" for="servicio3">
                        Beca de FONABE
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="servicio4">
                    <label class="form-check-label" for="servicio4">
                        Ninguno
                    </label>
                </div>
            </div>
        </div>
        <div id="terminosCondiciones">
            <h4>Términos y condiciones</h4>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="terminos">
                    <label class="form-check-label" for="terminos">
                        Declaro que los datos suministrados son verdaderos y acepto que este proceso no tiene validez sin la entrega de la documentación respectiva en la oficina de auxiliares del Colegio.
                    </label>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary">Enviar</button>
    </form>
</div>

<?php
include_once 'public/footer.php';
