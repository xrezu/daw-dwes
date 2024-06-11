<?php

class Avistamiento
{
  private $localizacion;
  private $fecha;
  private $hora;
  private $notas;
  private $ovni;

  public function __construct($localizacion, $fecha, $hora, $notas, OVNI $ovni)
  {
    $this->localizacion = $localizacion;
    $this->fecha = $fecha;
    $this->hora = $hora;
    $this->notas = $notas;
    $this->ovni = $ovni;
  }

  public function pintarHTML()
  {
    $html = "<div>Avistamiento en $this->localizacion el $this->fecha a las $this->hora: $this->notas</div>";
    $html .= $this->ovni->pintarHTML();
    return $html;
  }

  public static function cargarInfo($cadena)
  {
    list($localizacion, $fecha, $hora, $notas, $tipo, $velocidad, $camuflaje, $extra) = explode(';', $cadena);

    $tipo = strtolower(trim($tipo));
    switch ($tipo) {
      case 'disco':
        $ovni = new DiscoVolador($velocidad, $camuflaje, $extra);
        break;
      case 'cigarro':
        $ovni = new Cigarro($velocidad, $camuflaje, $extra);
        break;
      case 'luz':
        $ovni = new LuzMisteriosa($velocidad, $camuflaje, $extra);
        break;
      default:
        throw new Exception("Tipo de OVNI desconocido: $tipo");
    }

    return new Avistamiento($localizacion, $fecha, $hora, $notas, $ovni);
  }
}
