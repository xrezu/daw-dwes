<?php
class GestorBasadoEnFichero extends GestorDatos {
  private $formatoArchivo;
  private $modoAcceso;

  public function __construct($nombre,$descripcion,$formatoArchivo,$modoAcceso){
    parent::__construct($nombre,$descripcion);
    $this->formatoArchivo = $formatoArchivo;
    $this->modoAcceso = $modoAcceso;
  }

  public function obtenerDetalle(){
    return "Formato archivo:{$this->formatoArchivo} \n Modo Acceso:{$this->modoAcceso}";
  }

  use HTMLRender;
}


?>