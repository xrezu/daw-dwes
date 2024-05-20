<?php
class AlertaWarning extends Alerta{
  public function mostrar(){
    echo "<div style='border: 1px solid yellow; padding: 10px;'>
    <h1 style='text-decoration: underline; color: yellow;'>⚠️ {$this->titulo}</h1>
    <p>{$this->mensaje}</p>";
  }
}

?>