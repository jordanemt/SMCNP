<?php
class ProductoModel {
    protected $db;
    
    public function __construct() {
        require 'libs/SPDO.php';
        $this->db= SPDO::singleton();
    }
    
    public function registrar($nombre){
        $consulta= $this->db->prepare("call sp_registrar_producto('".$nombre."')");
        $consulta->execute();
    }

    public function buscarProducto($id){
        $consulta= $this->db->prepare('call sp_buscar_producto('.$id.')');
        $consulta->execute();
        $resultado=$consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function eliminar($id){
        $consulta= $this->db->prepare('call sp_eliminar_producto('.$id.')');
        $consulta->execute();
    }

    public function actualizar($id, $nombre){
        $consulta= $this->db->prepare("call sp_actualizar_producto(".$id.",'".$nombre."')");
        $consulta->execute();
    }

    public function listar(){
        $consulta=$this->db->prepare('call sp_listar()');
        $consulta->execute();
        $resultado=$consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }
    
}