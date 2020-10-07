<?php
    include_once 'public/header.php';
?>

<form action="?controlador=Producto&accion=registrar" method="post">
    <legend>Registrar producto</legend>
    <div>
        <label for="nombre">Nombre del producto</label>
        <input type="text" id="nombre" name="nombre" required />
    </div>
    <div>
        <input type="submit" id="registrar" name="registrar" value="Registrar"/>
    </div>
</form>


<?php
    include_once 'public/footer.php';
?>