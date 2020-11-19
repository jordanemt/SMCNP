<?php
include_once 'public/header.php';
?>

<div class="content">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4">
                Sistema de Matrícula
                <br>
                Colegio Nocturno de Pococí
            </h1>
            <p class="lead">El siguiente formulario le permitirá realizar la matrícula para el curso lectivo 2021 con solo seguir los pasos que se describen a continuación:</p>
            <ul class="list-group">
                <li class="list-group-item">1. Llenar datos personales.</li>
                <li class="list-group-item">2. Matrícula de materias</li>
                <li class="list-group-item">3. Solicitud de becas.</li>
                <li class="list-group-item">4. Finalización de matrícula</li>
            </ul>
            <h4 class="display-5">Requisitos</h4>
            <div class="alert alert-info" role="alert">
                La matrícula no tendrá efecto si no hace la entrega de los siguientes documentos en las oficinas de secretaría del Colegio Nocturno:
            </div>
            <ul class="list-group">
                <li class="list-group-item">1. Copia de Cédula (pasaporte o cédula de residencia).</li>
                <li class="list-group-item">2. Hoja de matrícula llena.</li>
                <li class="list-group-item">3. Original y copia de la nota.</li>
                <li class="list-group-item">4. Original y copia del título (sexto o noveno según corresponda).</li>
                <li class="list-group-item">5. Si el estudiante es menor de edad, deberá ser matriculado por su encargado legal.</li>
                <li class="list-group-item">6. Si el estudiante tiene aprobado algunas materias en el año que va a cursar, presentar ambas notas.</li>
                <li class="list-group-item">7. Si no desea llevar la materia de Ética, debe aportar una carta indicándolo.</li>
                <li class="list-group-item">8. Si no desea llevar la materia de Sexualidad y Afectividad, debe aportar una carta indicándolo.</li>
            </ul>
            <br>
            <div class="alert alert-danger" role="alert">
                NOTA IMPORTANTE: Este registro quedará anulado si la información suministrada no es CORRECTA o bien no cumple con los requisitos antes mencionados.
            </div>
            <div class="d-flex justify-content-center">
                <a href="?controller=Enrollment" class="btn btn-primary btn-lg btn-block button col-sm-6">Ir al formulario</a>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'public/footer.php';
