<?php

include 'conexion.php';

if(isset($_POST['actualizar'])){
  $cliente_id = $_POST["cliente_id"];
  $nuevo_telefono = $_POST["nuevo_telefono"];

  //Comprobamos que el id del cliente introducido exista
  $stmt = $conn->prepare("SELECT * FROM clientes WHERE id = :id");
  $stmt->bindParam(':id',$cliente_id);
  $stmt->execute();
  $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

  if(!$cliente){
    echo "El ID del cliente no existe";
    exit;
  }

  //En caso de que el cliente exista, cambiamos el número
  $sql = "UPDATE clientes SET telefono =:telefono WHERE id=:id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':telefono', $nuevo_telefono);
  $stmt->bindParam(':id',$cliente_id);
  $stmt->execute();

  echo "El número de teléfono ha sido actualizado";
}