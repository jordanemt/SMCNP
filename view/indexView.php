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
            <p class="lead">El siguiente formulario le permitirá realizar la matrícula para el curso lectivo 2019 con solo seguir los pasos que se describen a continuación:</p>
            <ul class="list-group">
                <li class="list-group-item">1. Llenar datos personales.</li>
                <li class="list-group-item">2. Matrícula de materias</li>
                <li class="list-group-item">3. Solicitud de becas.</li>
                <li class="list-group-item">2. Matrícula de materias</li>
                <li class="list-group-item">4. Finalización de matrícula</li>
            </ul>
            <h4 class="display-5">Requisitos</h4>
            <div class="alert alert-info" role="alert">
                La matrícula no tendrá efecto si no hace la entrega de los siguientes documentos en las oficinas de secretaría del Colegio Nocturno:
            </div>
            <ul class="list-group">
                <li class="list-group-item">1. Si matricula sétimo: fotografía, hoja de matrícula, copia de título de sexto año y contribución de matrícula .</li>
                <li class="list-group-item">2. Si matricula décimo: fotografía, hoja de matrícula, copia de título de noveno año y contribución de matrícula.</li>
                <li class="list-group-item">3. Si tiene entre 15  y 17 años debe presentar original y copia de la cédula del padre, madre o encargado.</li>
                <li class="list-group-item">4. Todos los estudiantes deben pasar a confeccionar su carné.</li>
            </ul>
            <br>
            <div class="alert alert-danger" role="alert">
                This is a warning alert—check it out!
            </div>
            <div class="d-flex justify-content-center">
                <a href="?controlador=Matricula" class="btn btn-primary btn-lg btn-block button col-sm-6">Ir al formulario</a>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'public/footer.php';
