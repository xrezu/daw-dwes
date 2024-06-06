<?php
abstract class GestorDatos{
  protected $nombre;
  protected $descripcion;

  public function __construct($nombre, $descripcion){
    $this->nombre = $nombre;
    $this->descripcion = $descripcion;
  }

  abstract public function obtenerDetalle();
}


?>