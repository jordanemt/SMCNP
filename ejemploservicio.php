<?php
    
    if($_SERVER['REQUEST_METHOD']=='GET'){
        if(isset($_GET['id'])){
            require 'libs/configuration.php';
            require 'model/ProductoModel.php';
            
            $producto=new ProductoModel();
            $data=$producto->buscarProducto($_GET['id']);
            
            header("HTTP/1.1 200 OK");
            echo json_encode($data);
            exit();
        }else{
            require './libs/configuration.php';
            require './model/ProductoModel.php';
            
            $producto=new ProductoModel();
            $data=$producto->listar();
            
            header("HTTP/1/1 200 OK");
            echo json_encode($data);
            exit();
        }
        
    } // GET

    if($_SERVER['REQUEST_METHOD']=='POST'){
        require './libs/configuration.php';
        require './model/ProductoModel.php';
        
        $input=$_POST;
        
        $producto=new ProductoModel();
        $producto->registrar($_POST['nombre']);
        
        header("HTTP/1/1 200 OK");
        echo json_encode($input);
        exit();        
    } // POST
    
    if($_SERVER['REQUEST_METHOD']=='PUT'){
        require './libs/configuration.php';
        require './model/ProductoModel.php';
        
        $input=$_GET;
        
        $producto=new ProductoModel();
        $producto->actualizar($_GET['id'], $_GET['nombre']);
        
        header("HTTP/1/1 200 OK");
        echo json_encode($input);
        exit(); 
        
    } // PUT
    
    if($_SERVER['REQUEST_METHOD']=='DELETE'){
        
        require './libs/configuration.php';
        require './model/ProductoModel.php';
        
        $input=$_GET;
        
        $producto=new ProductoModel();
        $producto->eliminar($_GET['id']);
        
        header("HTTP/1/1 200 OK");
        echo json_encode($input);
        exit(); 
        
    } // DELETE
?>

