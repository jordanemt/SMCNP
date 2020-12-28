<?php
include_once 'public/header.php';
?>

<div class="content container" style="padding: 15px">
    <h2>Formulario de Matrícula</h2>
    <hr>
    <form id="enrollment-form" enctype="multipart/form-data">
        <h4>Datos personales</h4>

        <div class="d-none form-group">
            <input type="text" class="form-control card" id="id" name="id">
        </div>

        <div class="form-group">
            <label for="card">Cédula (0-0000-0000)</label>
            <input type="text" class="form-control card" id="card" name="card" placeholder="Ingrese la cédula" 
                   onchange="getStudentByCard();" required>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="card_type1" checked onclick="cardMask('card')" name="card_type">
                    <label class="form-check-label" for="card_type1">Nacional</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="card_type2" onclick="unMask('card')" name="card_type">
                    <label class="form-check-label" for="card_type2">Extranjero</label>
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label for="cedula">Copia de la Cédula</label>
            <input type="file" class="form-control-file" id="cedula" name="cedula" required>
            <small class="form-text text-muted">No se permiten archivos de más de 5mb</small>
            <small class="form-text text-muted">Se permiten (pdf, docx, jpg, jpeg y png)</small>
        </div>

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese su nombre" maxlength="25" required>
        </div>

        <div class="form-group">
            <label for="first_lastname">Primer apellido</label>
            <input type="text" class="form-control" id="first_lastname" name="first_lastname" placeholder="Ingrese su primer apellido" maxlength="20" required>
        </div>

        <div class="form-group">
            <label for="second_lastname">Segundo apellido</label>
            <input type="text" class="form-control" id="second_lastname" name="second_lastname" placeholder="Ingrese su segundo apellido" maxlength="20" required>
        </div>
        
        <div class="form-group">
            <label for="birthdate">Fecha de nacimiento</label>
            <input type="text" class="form-control" id="birthdate" name="birthdate" placeholder="Ingrese su fecha de nacimiento" readonly required>
        </div>

        <div class="form-group">
            <label>Sexo</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="gender_Femenino" name="gender" value="FEMENINO" required>
                <label class="form-check-label" for="gender_Femenino">
                    Femenino
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="gender_Masculino" name="gender" value="MASCULINO" required>
                <label class="form-check-label" for="gender_Masculino">
                    Masculino
                </label>
            </div>
            <label id="gender-error" class="error" for="gender" style="display: none"></label>
        </div>

        <div class="form-group">
            <label for="nationality">Nacionalidad</label>
            <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Ingrese su nacionalidad" maxlength="30" required>
        </div>

        <div class="form-group">
            <label for="personal_phone">Número de teléfono</label>
            <input type="text" class="form-control phone" id="personal_phone" name="personal_phone" placeholder="Ingrese su número de teléfono" minlength="9" required>
        </div>

        <div class="form-group">
            <label for="other_phone">Teléfono hogar/Otro teléfono</label>
            <input type="text" class="form-control phone" id="other_phone" name="other_phone" placeholder="Ingrese otro número de teléfono" minlength="9" required>
        </div>

        <div class="form-group">
            <label for="mep_mail">Correo del MEP</label>
            <input type="email" class="form-control" id="mep_mail" name="mep_mail" placeholder="Ingrese su correo del MEP" maxlength="100" readonly required>
        </div>

        <div class="form-group">
            <label for="other_mail">Correo personal</label>
            <input type="email" class="form-control" id="other_mail" name="other_mail" placeholder="Ingrese otro correo" maxlength="100">
            <small class="form-text text-muted">Opcional (se recomienda agregar)</small>
        </div>

        <div class="form-group">
            <label for="id_district">Distrito actual</label>
            <select class="form-control" id="id_district" name="id_district" onchange="$('#id_district-error').hide();" required>
                <option selected disabled>Seleccione una opción</option>
                <?php
                foreach ($vars['district_list'] as $item) {
                    ?>

                    <option value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>

                    <?php
                }
                ?>
            </select>
            <label id="id_district-error" class="error" for="id_district" style="display: none"></label>
        </div>

        <div class="form-group">
            <label for="direction">Dirección de exacta</label>
            <textarea class="form-control" id="direction" name="direction" placeholder="Ingrese la dirección" maxlength="300" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="contact_name">Nombre completo de un contacto de emergencia</label>
            <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Ingrese el nombre completo del contacto" maxlength="65" required>
        </div>
        <div class="form-group">
            <label for="contact_phone">Teléfono del contacto de emergencia</label>
            <input type="text" class="form-control phone" id="contact_phone" name="contact_phone" placeholder="Ingrese el teléfono del contacto" required>
        </div>
        
        <div id="is_teenage_father-container" class="form-group"> <script>$('#is_teenage_father-container').hide();</script>
            <label>¿Es madre o padre adolescente (menor que 19 años)?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="teenage_fatherYes" name="is_teenage_father" value="Sí" required>
                <label class="form-check-label" for="teenage_fatherYes">
                    Sí
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="teenage_fatherNo" name="is_teenage_father" value="No" required>
                <label class="form-check-label" for="teenage_fatherNo">
                    No
                </label>
            </div>
            <label id="is_teenage_father-error" class="error" for="is_teenage_father" style="display: none"></label>
        </div>

        <div class="form-group">
            <label>¿Padece de alguna enfermedad?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="sufferingYes" name="is_suffering" 
                       onclick="switchVisibilityToShow('suffering_container')" required>
                <label class="form-check-label" for="sufferingYes">
                    Sí
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="sufferingNo" name="is_suffering"
                       onclick="switchVisibilityToHide('suffering_container')" required>
                <label class="form-check-label" for="sufferingNo">
                    No
                </label>
            </div>
            <label id="is_suffering-error" class="error" for="is_suffering" style="display: none"></label>
        </div>
        <div id="suffering_container" class="form-group"> <script>$('#suffering_container').hide();</script>
            <label for="suffering">¿Qué enfermedad?</label>
            <input type="text" class="form-control" id="suffering" name="suffering" placeholder="Ingrese la enfermedad" maxlength="35" required>
        </div>

        <div class="form-group">
            <label>¿Tiene alguna adecuación curricular?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="adequacyYes" name="is_adequacy"
                       onclick="switchVisibilityToShow('adequacy_container');" required>
                <label class="form-check-label" for="adecuacionYes">
                    Sí
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="adequacyNo" name="is_adequacy"
                       onclick="switchVisibilityToHide('adequacy_container');" required>
                <label class="form-check-label" for="adecuacionNo">
                    No
                </label>
            </div>
            <label id="is_adequacy-error" class="error" for="is_adequacy" style="display: none"></label>
        </div>
        <div id="adequacy_container"> <script>$('#adequacy_container').hide();</script>
            <div class="form-group">
                <label for="id_adequacy">¿Qué tipo de adecuación tiene usted?</label>
                <select class="form-control" id="id_adequacy" name="id_adequacy" required>
                    <option selected disabled>Seleccione una opción</option>
                    <?php
                    foreach ($vars['adequacy_list'] as $item) {
                        ?>

                        <option value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>

                        <?php
                    }
                    ?>
                </select>
            </div>
            <label id="id_adequacy-error" class="error" for="id_adequacy" style="display: none"></label>
        </div>

        <div class="form-group">
            <label>¿Cuenta con el beneficio del IMAS?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="imas_benefitYes" name="is_imas_benefit" value="Sí" required>
                <label class="form-check-label" for="imas_benefitYes">
                    Sí
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="imas_benefitNo" name="is_imas_benefit" value="No" required>
                <label class="form-check-label" for="imas_benefitNo">
                    No
                </label>
            </div>
            <label id="is_imas_benefit-error" class="error" for="is_imas_benefit" style="display: none"></label>
        </div>

        <div class="form-group">
            <label>¿Actualmente trabaja?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="workingYes" name="is_working" value="Sí" required>
                <label class="form-check-label" for="workingYes">
                    Sí
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="workingNo" name="is_working" value="No" required>
                <label class="form-check-label" for="workingNo">
                    No
                </label>
            </div>
            <label id="is_working-error" class="error" for="is_working" style="display: none"></label>
        </div>

        <div class="form-group">
            <label>¿Desea llevar la materia de Ética?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="ethics_matterYes" name="is_ethics_matter" value="Sí" 
                       onclick="switchVisibilityToHide('alert-ethics_matter');" required>
                <label class="form-check-label" for="ethics_matterYes">
                    Sí
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="ethics_matterNo" name="is_ethics_matter" value="No"
                       onclick="switchVisibilityToShow('alert-ethics_matter');" required>
                <label class="form-check-label" for="ethics_matterNo">
                    No
                </label>
            </div>
            <label id="is_ethics_matter-error" class="error" for="is_ethics_matter" style="display: none"></label>
        </div>
        <div id="alert-ethics_matter" class="alert alert-info" role="alert"> <script>$('#alert-ethics_matter').hide();</script>
            Debe aportar una carta firmada indicando que no desea llevar la materia de Ética
            <div class="form-group">
                <label for="cedula">Carta (opcional)</label>
                <input type="file" class="form-control-file" id="carta_etica" name="carta_etica">
                <small class="form-text text-muted">No se permiten archivos de más de 5mb</small>
                <small class="form-text text-muted">Se permiten (pdf, docx, jpg, jpeg y png)</small>
            </div>
        </div>

        <div class="form-group">
            <label>¿Desea llevar la materia de Sexualidad y Afectividad?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="sexual_matterYes" name="is_sexual_matter" value="Sí"
                       onclick="switchVisibilityToHide('alert-sexual_matter');" required>
                <label class="form-check-label" for="sexual_matterYes">
                    Sí
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="sexual_matterNo" name="is_sexual_matter" value="No"
                       onclick="switchVisibilityToShow('alert-sexual_matter');" required>
                <label class="form-check-label" for="sexual_matterNo">
                    No
                </label>
            </div>
            <label id="is_sexual_matter-error" class="error" for="is_sexual_matter" style="display: none"></label>
        </div>
        <div id="alert-sexual_matter" class="alert alert-info" role="alert"> <script>$('#alert-sexual_matter').hide();</script>
            Debe aportar una carta firmada indicando que no desea llevar la materia de Sexualidad y Afectividad
            <div class="form-group">
                <label for="cedula">Carta (opcional)</label>
                <input type="file" class="form-control-file" id="carta_sexualidad" name="carta_sexualidad">
                <small class="form-text text-muted">No se permiten archivos de más de 5mb</small>
                <small class="form-text text-muted">Se permiten (pdf, docx, jpg, jpeg y png)</small>
            </div>
        </div>

        <div id="encargado-container">
            <script>$('#encargado-container').hide();</script>
            <h4>Datos de padre, madre o encargado</h4>

            <div class="d-none form-group">
                <input type="text" class="form-control" id="id_parent" name="id_parent" required>
            </div>
            
            <div class="form-group">
                <label for="card_parent">Cédula (0-0000-0000)</label>
                <input type="text" class="form-control card" id="card_parent" name="card_parent" placeholder="Ingrese la cédula" onchange="getParentByCard();" required>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="card_type1-encargado" checked onclick="cardMask('card_parent')" name="card_parent_type">
                        <label class="form-check-label" for="card_type1-encargado">Nacional</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="card_type2-encargado" onclick="unMask('card_parent')" name="card_parent_type">
                        <label class="form-check-label" for="card_type2-encargado">Extranjero</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="full_name_parent">Nombre completo</label>
                <input type="text" class="form-control" id="full_name_parent" name="full_name_parent" placeholder="Ingrese el nombre completo" maxlength="65" required>
            </div>
            <div class="form-group">
                <label for="nationality_parent">Nacionalidad</label>
                <input type="text" class="form-control" id="nationality_parent" name="nationality_parent" placeholder="Ingrese la nacionalidad" maxlength="30" required>
            </div>
            <div class="form-group">
                <label for="ocupation_parent">Ocupación</label>
                <input type="text" class="form-control" id="ocupation_parent" name="ocupation_parent" placeholder="Ingrese la ocupación" maxlength="30" required>
            </div>
            <div class="form-group">
                <label for="work_place_parent">Lugar de trabajo</label>
                <input type="text" class="form-control" id="work_place_parent" name="work_place_parent" placeholder="Ingrese el lugar de trabajo" maxlength="30" required>
            </div>
            <div class="form-group">
                <label for="phone_parent">Teléfono</label>
                <input type="text" class="form-control phone" id="phone_parent" name="phone_parent" placeholder="Ingrese el teléfono" minlength="9" required>
            </div>
        </div>

        <h4>Matricula</h4>
        <div class="form-group">
            <label for="degree">Nivel de matrícula</label>
            <select class="form-control" id="degree" name="degree" onchange="showDegreeContainerSelected(); clearFiles();" required>
                <option selected disabled>Seleccione una opción</option>
                <option value="7">Séptimo</option>
                <option value="8">Octavo</option>
                <option value="9">Noveno</option>
                <option value="10">Décimo</option>
                <option value="11">Undécimo</option>
            </select>
            <label id="degree-error" class="error" for="degree" style="display: none"></label>
        </div>
        <div id="level7_container"> <script>$('#level7_container').hide();</script>
            <div class="form-group">
                <label for="level_num7">Elija la sección donde desea matricular</label>
                <select class="form-control" id="level_num7" name="id_section" onchange="$('#level_num7-error').hide();" required>
                    <option selected disabled>Seleccione una opción</option>
                    <?php
                    foreach ($vars['degree7'] as $item) {
                        if ($item['current_quota'] != 0) {
                            ?>

                            <option value="<?php echo $item['id'] ?>"><?php echo $item['name'] . ' (' . $item['workshops'] . ') ' . $item['current_quota'] ?></option>

                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <label id="level_num7-error" class="error" for="level_num7" style="display: none"></label>
            <div class="form-group">
                <label for="titulo_sexto">Copia del título de sexto año (opcional si ya es estudiante del Colegio)</label>
                <input type="file" class="form-control-file enrroll_files required-file" id="titulo_sexto" name="titulo_sexto" required>
                <small class="form-text text-muted">No se permiten archivos de más de 5mb</small>
                <small class="form-text text-muted">Se permiten (pdf, docx, jpg, jpeg y png)</small>
            </div>
            <div class="form-group">
                <label for="nota_nivel_anterior">Copia de la nota aprobada de sexto año (opcional si ya es estudiante del Colegio)</label>
                <input type="file" class="form-control-file enrroll_files required-file" id="nota_nivel_anterior_6" name="nota_nivel_anterior_sexto" required>
                <small class="form-text text-muted">No se permiten archivos de más de 5mb</small>
                <small class="form-text text-muted">Se permiten (pdf, docx, jpg, jpeg y png)</small>
            </div>
        </div>
        <div id="level8_container"> <script>$('#level8_container').hide();</script>
            <div class="form-group">
                <label for="level_num8">Elija la sección donde desea matricular</label>
                <select class="form-control" id="level_num8" name="id_section" onchange="$('#level_num8-error').hide();" required>
                    <option selected disabled>Seleccione una opción</option>
                    <?php
                    foreach ($vars['degree8'] as $item) {
                        if ($item['current_quota'] != 0) {
                            ?>

                            <option value="<?php echo $item['id'] ?>"><?php echo $item['name'] . ' (' . $item['workshops'] . ') ' . $item['current_quota'] ?></option>

                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <label id="level_num8-error" class="error" for="level_num8" style="display: none"></label>
            <div class="form-group">
                <label for="nota_nivel_anterior">Si es estudiante de otra institución agregue la copia de la nota aprobada de séptimo año (opcional si ya es estudiante del Colegio)</label>
                <input type="file" class="form-control-file enrroll_files required-file" id="nota_nivel_anterior_7" name="nota_nivel_anterior_septimo" required>
                <small class="form-text text-muted">No se permiten archivos de más de 5mb</small>
                <small class="form-text text-muted">Se permiten (pdf, docx, jpg, jpeg y png)</small>
            </div>
        </div>
        <div id="level9_container"> <script>$('#level9_container').hide();</script>
            <div class="form-group">
                <label for="level_num9">Elija la sección donde desea matricular</label>
                <select class="form-control" id="level_num9" name="id_section" onchange="$('#level_num9-error').hide();" required>
                    <option selected disabled>Seleccione una opción</option>
                    <?php
                    foreach ($vars['degree9'] as $item) {
                        if ($item['current_quota'] != 0) {
                            ?>

                            <option value="<?php echo $item['id'] ?>"><?php echo $item['name'] . ' (' . $item['workshops'] . ') ' . $item['current_quota'] ?></option>

                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <label id="level_num9-error" class="error" for="level_num9" style="display: none"></label>
            <div class="form-group">
                <label for="nota_nivel_anterior">Si es estudiante de otra institución agregue la copia de la nota aprobada de octavo año (opcional si ya es estudiante del Colegio)</label>
                <input type="file" class="form-control-file enrroll_files required-file" id="nota_nivel_anterior_8" name="nota_nivel_anterior_octavo" required>
                <small class="form-text text-muted">No se permiten archivos de más de 5mb</small>
                <small class="form-text text-muted">Se permiten (pdf, docx, jpg, jpeg y png)</small>
            </div>
        </div>
        <div id="level10_container"> <script>$('#level10_container').hide();</script>
            <div class="form-group">
                <label for="level_num10">Elija la sección donde desea matricular</label>
                <select class="form-control" id="level_num10" name="id_section" onchange="$('#level_num10-error').hide();" required>
                    <option selected disabled>Seleccione una opción</option>
                    <?php
                    foreach ($vars['degree10'] as $item) {
                        if ($item['current_quota'] != 0) {
                            ?>

                            <option value="<?php echo $item['id'] ?>"><?php echo $item['name'] . ' ' . $item['current_quota'] ?></option>

                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <label id="level_num10-error" class="error" for="level_num10" style="display: none"></label>
            <div class="form-group">
                <label for="titulo_noveno">Copia del título de noveno año (opcional si ya es estudiante del Colegio)</label>
                <input type="file" class="form-control-file enrroll_files required-file" id="titulo_noveno" name="titulo_noveno" required>
                <small class="form-text text-muted">No se permiten archivos de más de 5mb</small>
                <small class="form-text text-muted">Se permiten (pdf, docx, jpg, jpeg y png)</small>
            </div>
            <div class="form-group">
                <label for="nota_nivel_anterior">Si es estudiante de otra institución agregue la copia de la nota aprobada de noveno año (opcional si ya es estudiante del Colegio)</label>
                <input type="file" class="form-control-file enrroll_files required-file" id="nota_nivel_anterior_9" name="nota_nivel_anterior_noveno" required>
                <small class="form-text text-muted">No se permiten archivos de más de 5mb</small>
                <small class="form-text text-muted">Se permiten (pdf, docx, jpg, jpeg y png)</small>
            </div>
        </div>
        <div id="level11_container"> <script>$('#level11_container').hide();</script>
            <div class="form-group">
                <label for="level_num11">Debe indicar en cual ciencia va a realizar el bachillerato</label>
                <select class="form-control" id="level_num11" name="id_section" onchange="$('#level_num11-error').hide();" required>
                    <option selected disabled>Seleccione una opción</option>
                    <?php
                    foreach ($vars['degree11'] as $item) {
                        if ($item['current_quota'] != 0) {
                            ?>

                            <option value="<?php echo $item['id'] ?>"><?php echo $item['name'] . ' (' . $item['workshops'] . ') ' . $item['current_quota'] ?></option>

                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <label id="level_num11-error" class="error" for="level_num11" style="display: none"></label>
            <div class="form-group">
                <label for="nota_nivel_anterior">Si es estudiante de otra institución agregue la copia de la nota aprobada de décimo año (opcional si ya es estudiante del Colegio)</label>
                <input type="file" class="form-control-file enrroll_files required-file" id="nota_nivel_anterior_10" name="nota_nivel_anterior_decimo" required>
                <small class="form-text text-muted">No se permiten archivos de más de 5mb</small>
                <small class="form-text text-muted">Se permiten (pdf, docx, jpg, jpeg y png)</small>
            </div>
        </div>

        <div class="form-group">
            <label>¿Repite materias?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="repeating_mattersYes" name="is_repeating_matters" value="1" 
                       onclick="switchVisibilityToShow('repeating_matters-container')" required>
                <label class="form-check-label" for="repeating_mattersYes">
                    Sí
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" id="repeating_mattersNo" name="is_repeating_matters" value="0" 
                       onclick="switchVisibilityToHide('repeating_matters-container')" required>
                <label class="form-check-label" for="repeating_mattersNo">
                    No
                </label>
            </div>
            <label id="is_repeating_matters-error" class="error" for="is_repeating_matters" style="display: none"></label>
        </div>
        
        <div id='repeating_matters-container' class="form-group"> <script>$('#repeating_matters-container').hide();</script>
            <label for="repeating_matters">Seleccione las materias que repite o no ha ganado</label>
            <select class="form-control" id="repeating_matters" name="repeating_matters[]" title="Seleccione una o varias opciones" multiple required>
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
            <label id="repeating_matters-error" class="error" for="repeating_matters" style="display: none"></label>
        </div>

        <h4>Solicitud de servicios</h4>
        <div class="form-group">
            <label>Elija los servicios que usted solicitará formalmente en el Colegio (debe llenar y entregar toda la documentación que se le solicite en el colegio)</label>
            <?php
            foreach ($vars['service_list'] as $item) {
                ?>
            
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="<?php echo $item['id'] ?>" name="id_service[]" 
                           <?php if ($item['id'] == 1) { ?> onclick="switchVisibility('route_container');" <?php } ?>>
                    <label class="form-check-label" for="service1">
                        <?php echo $item['name'] ?>
                    </label>
                </div>

                <?php
            }
            ?>
            <small class="form-text text-muted">Puede marcar más de una opción o deje en blanco si no desea algún servicio</small>
        </div>

        <div id="route_container"> <script>$('#route_container').hide();</script>
            <div class="form-group">
                <label for="id_Route">¿Escoja una ruta para el servicio de transporte?</label>
                <select class="form-control" id="id_route" name="id_route" required>
                    <option selected disabled>Seleccione una opción</option>
                    <?php
                    foreach ($vars['route_list'] as $item) {
                        ?>

                        <option value="<?php echo $item['id'] ?>"><?php echo $item['description'] ?></option>

                        <?php
                    }
                    ?>
                </select>
                <label id="id_route-error" class="error" for="id_route" style="display: none"></label>
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
                <input class="form-check-input" type="checkbox" value="1" id="conditions" name="conditions" required>
                <label class="form-check-label" for="conditions">
                    Aceptar términos y condiciones
                </label>
                <label id="conditions-error" class="error" for="conditions" style="display: none"></label>
            </div>
            
            <div id="alert-errors" class="alert alert-danger" role="alert"> <script>$('#alert-errors').hide();</script>
                Hay espacios sin llenar en el formulario
            </div>
            
            <div id="alert-loading" class="alert alert-info" role="alert"> <script>$('#alert-loading').hide();</script>
                Por favor espere... este proceso puede tardar algunos segundos
            </div>
        </div>
        <button id="submit" type="button" class="btn btn-primary" onclick="createEnrollment();">Enviar</button>
    </form>
</div>

<?php
include_once 'public/footer.php';
