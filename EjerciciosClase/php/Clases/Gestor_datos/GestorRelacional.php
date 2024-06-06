<?php
class GestorRelacional extends GestorDatos{
  private $sistemasOperativos;
  private $version;
  private $soporteTransacciones;

  public function __construct($nombre,$descripcion,$sistemasOperativos,$version,$soporteTransacciones){
    parent::__construct($nombre,$descripcion);
    $this->sistemasOperativos = $sistemasOperativos;
    $this->version = $version;
    $this->soporteTransacciones = $soporteTransacciones;
  }

  public function obtenerDetalle(){
    return "Sistemas Operativos: {$this->sistemasOperativos}, Versión: {$this->version}, Soporte transacciones: {$this->soporteTransacciones}";
  }
  use HTMLRender;
}
?>