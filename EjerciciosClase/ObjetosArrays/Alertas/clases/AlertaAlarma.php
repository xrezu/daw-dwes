<?php
class AlertaAlarma extends Alerta{
  public function mostrar(){
    echo "<script type='text/javascript'>alert('{$this->titulo}: {$this->mensaje}');</script>";
  }
}

?>