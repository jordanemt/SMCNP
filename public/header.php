<!DOCTYPE html>
<html lang="es">

<head>
	<title>Ejemplo utilizando Bootstrap</title>
	<meta charset="utf-8"/>
	<meta name="description" content="Primer sitio con html 5" />
        <meta name="viewport" content="width=device-width,initial-scale=1"/>
	<!--<link rel="stylesheet" type="text/css" href="public/css/estilo.css"/>-->
        <link rel="shortcut icon" type="image/x-icon" href="public/img/icono.ico"/> 
        
        
        <link rel="stylesheet" type="text/css" href="public/css/bootstrap.css"/>
        
        <script type="text/javascript" src="public/js/jquery-3.2.1.js"></script>
        
        <script>
            function registarProductoAjax(nombreProducto){
                var parametros={"nombre":nombreProducto};
                $.ajax(
                        {
                            data: parametros,
                            url: '?controlador=Producto&accion=registrarajax',
                            type: 'post',
                            beforeSend: function(){
                                $("#resultado").html("Procesando, espere por favor ...");
                            },
                            success:function(response){
                                $("#resultado").html(response);
                            }
                        }
                );
            } // registarProductoAjax
        </script>
        
</head>

<body>
    <div class="container">
        
        <div class="row">
            
            <div class="col-lg-8">
                <h1>
                    <a href="index.php">
                        <img alt="Curso Lenguajes" src="public/img/logo.png"/>
                    </a>
                </h1>
            </div>
            
            <div class="col-lg-4">
                <nav class="navbar navbar-default">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.php">Inicio</a></li>
                        <li><a href="?controlador=Producto">Registrar Producto</a></li>
                        <li><a href="?controlador=Producto&accion=mostrarajax">Registrar ajax</a></li>
                        <li><a href="?controlador=Producto&accion=listar">Ver Producto</a></li>
                    </ul>
                </nav>
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-lg-8">
                
                


            