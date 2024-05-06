<?php
/*Define una clase `Coche` con propiedades como modelo, marca y año, e implementa métodos para cambiar y obtener cada propiedad.*/
class Car {
  public $model;
  public $brand;
  public $year;

  function set_model($model){
    $this->model = $model;
  }

  function get_model(){
    return $this->model;
  }

  function set_brand($brand){
    $this->brand = $brand;
  }

  function get_brand(){
    return $this->brand;
  }

  function set_year($year){
    $this->year = $year;
  }

  function get_year(){
    return $this->year;
  }
}
?>

