<?php
class LuzMisteriosa extends OVNI{
  private $duracion;

  public function __construct($velocidad, $camuflaje, $duracion)
  {
    parent::__construct($velocidad, $camuflaje);
    $this->duracion = $duracion;
  }

  public function pintarHTML()
  {
    return "<div>Luz Misteriosa - Velocidad: $this->velocidad, Camuflaje: $this->camuflaje, Duración: $this->duracion</div>";
  }

  public function cargarInfo($cadena)
  {
    list($this->velocidad, $this->camuflaje, $this->duracion) = explode(';', $cadena);
  }
}
?>