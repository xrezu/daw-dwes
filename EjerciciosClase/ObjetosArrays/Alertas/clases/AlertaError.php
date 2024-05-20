<?php
class AlertaError extends Alerta {
  public function mostrar(){
    echo "<div style='border: 1px solid red; padding: 10px;'>
    <h1 style='text-decoration: underline; color: red;'>❌ {$this->titulo}</h1>
    <p>{$this->mensaje}</p>";
  }
}
?>
