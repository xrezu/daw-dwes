<?php
class Cigarro extends OVNI
{
  private $longitud;

  public function __construct($velocidad, $camuflaje, $longitud)
  {
    parent::__construct($velocidad, $camuflaje);
    $this->longitud = $longitud;
  }

  public function pintarHTML()
  {
    return "<div>Cigarro - Velocidad: $this->velocidad, Camuflaje: $this->camuflaje, Longitud: $this->longitud</div>";
  }

  public function cargarInfo($cadena)
  {
    list($this->velocidad, $this->camuflaje, $this->longitud) = explode(';', $cadena);
  }
}

?>