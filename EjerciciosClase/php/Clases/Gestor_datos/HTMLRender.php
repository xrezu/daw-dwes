<?php
trait HTMLRender {
  public function renderHTML() {
    $html = "<h1>{$this->nombre}</h1>";
    $html .= "<p>{$this->descripcion}</p>";
    $html .= "<p>{$this->obtenerDetalle()}</p>";
    return $html;
  }
}

?>