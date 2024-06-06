<?php
class GestorNoRelacional extends GestorDatos{
  private $tipoModeloDatos;

  public function __construct($nombre, $descripcion, $tipoModeloDatos){
    parent::__construct($nombre,$descripcion);
    $this->tipoModeloDatos = $tipoModeloDatos;
  }

  public function obtenerDetalle(){
    return "Tipo de Modelo de Datos: {$this->tipoModeloDatos}";
  }
  use HTMLRender;
}

?>