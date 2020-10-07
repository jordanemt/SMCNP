<?php
class ProductoController {
    public function __construct() {
        $this->view = new View();
    }
    
    public function mostrar(){
        $this->view->show("registrarproducto.php", null);
    }

    public function mostrarajax(){
        $this->view->show("registrarproductoajax.php", null);
    }
    
    public function registrarajax(){
        require 'model/ProductoModel.php';
        $producto=new ProductoModel();
        $producto->registrar($_POST['nombre']);
        echo 'Producto registrado';
    } 
    
    public function registrar(){
        require 'model/ProductoModel.php';
        $producto=new ProductoModel();
        $producto->registrar($_POST['nombre']);
        
        $this->view->show("registrarproducto.php", null);
    }

    public function listar(){
         require 'model/ProductoModel.php';
         $productos=new ProductoModel();
         $data['listado']=$productos->listar();   
         $this->view->show("listar.php", $data);
     }
} 
