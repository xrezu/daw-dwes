<?php

abstract class OVNI
{
  protected $velocidad;
  protected $camuflaje;

  public function __construct($velocidad, $camuflaje)
  {
    $this->velocidad = $velocidad;
    $this->camuflaje = $camuflaje;
  }

  abstract public function pintarHTML();
  abstract public function cargarInfo($cadena);
}
?>




