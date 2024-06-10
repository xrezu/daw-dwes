<?php
require 'bbdd/BaseDatos.php';
require_once 'init.php';

// Obtener la instancia de la base de datos
$db = BaseDatos::obtenerInstancia();

// Función para validar la fecha
function validateDate($date, $format = 'Y-m-d'){
  $d = DateTime::createFromFormat($format, $date);
  if (!$d || $d->format($format) !== $date) {
    return 'El formato de fecha no es válido';
  }
  $today = new DateTime();
  if ($d <= $today) {
    return 'La fecha debe ser posterior a la fecha actual';
  }
  return true;
}

// Función para actualizar la tabla flores y el stock
function actualizarStock($flor_id, $cantidad){
  global $db;
  $sql = "UPDATE flores SET stock = stock - ? WHERE id = ?";
  $db->ejecuta($sql, [$cantidad, $flor_id]);
}

// Obtener el nombre de la flor por ID
function obtenerFlorPorId($flor_id){
  global $db;
  $sql = "SELECT nombre FROM flores WHERE id = ?";
  $db->ejecuta($sql, [$flor_id]);
  return $db->obtenDatos(BaseDatos::FETCH_FILA)['nombre'];
}

// Obtener el listado de flores
function obtenerNbFlores(){
  global $db;
  $sql = "SELECT id, nombre, stock FROM flores"; 
  $db->ejecuta($sql);
  return $db->obtenDatos();
}

// Obtener el stock de una flor por ID
function obtenerStock($flor_id){
  global $db;
  $sql = "SELECT stock FROM flores WHERE id = ?";
  $db->ejecuta($sql, [$flor_id]);
  return $db->obtenDatos(BaseDatos::FETCH_FILA)['stock'];
}

// Insertar un pedido en la base de datos
function insertarPedido($flor_id, $fecha, $cantidad){
  global $db;
  $nbFlor = obtenerFlorPorId($flor_id);
  $direccionCompleta = "Calle de {$nbFlor}, {$cantidad}";
  $sql = "INSERT INTO pedidos (flor_id, direccion, fecha, unidades) VALUES (?, ?, ?, ?)";
  $db->ejecuta($sql, [$flor_id, $direccionCompleta, $fecha, $cantidad]);
}

function verificarSesion(){
  session_start();
  if(!isset($_SESSION['usuario_id'])){
    header('Location: login.php');
    exit();
  }
}

function obtenerPedidos($offset, $limit){
  global $db;
  $sql = "SELECT p.id, f.nombre AS flor, p.direccion, p.fecha, p.unidades
          FROM pedidos p
          JOIN flores f ON p.flor_id = f.id
          ORDER BY p.fecha ASC
          LIMIT ?, ?";
  $db->ejecuta($sql, [$offset, $limit]);
  return $db->obtenDatos();
}

function obtenerNumPedidos() {
  global $db;
  $sql = "SELECT COUNT(*) as total FROM pedidos";
  $db->ejecuta($sql);
  return $db->obtenDatos(BaseDatos::FETCH_FILA)['total'];
}


function obtenerTokensValidos(){
  global $db;
  $sql = "SELECT token FROM tokens WHERE consumido = 0 AND fecha_validez > NOW()";
  $db->ejecuta($sql);
  return $db->obtenDatos();
}

function obtenerIdPorToken($token) {
  global $db;

  $sql = "SELECT usuario_id FROM tokens WHERE token = :token";
  $db->ejecuta($sql, [$token]);
  $id_usuario = $db->obtenDatos(BaseDatos::FETCH_COLUMNA);

  return $id_usuario;
}

function validarNuevaContrasena($token, $contrasena) {
  global $db;

  $id_usuario = obtenerIdPorToken($token);

  $sql = "SELECT pass FROM usuarios WHERE id = :id";
  $db->ejecuta($sql, [$id_usuario]);
  $contra_actual_usuario = $db->obtenDatos(BaseDatos::FETCH_COLUMNA);

  return password_verify($contrasena, $contra_actual_usuario);
}

function actualizarPass($token, $contrasena){
  global $db;

  $id_usuario = obtenerIdPorToken($token);
  $hashed_pass = password_hash($contrasena, PASSWORD_DEFAULT);
  
  $sql ="UPDATE usuarios SET pass = :contrasena WHERE id = :id";
  $db->ejecuta($sql, [$hashed_pass, $id_usuario]);

}

function consumirToken($token) {
  global $db;

  $sql = "UPDATE tokens SET consumido = 1 WHERE token = :token";
  $db->ejecuta($sql, [$token]);
}

function validarUsuario($usuario, $contrasena) {
  global $db;

  $sql = "SELECT pass FROM usuarios WHERE nombre = ?";
  $db->ejecuta($sql, [$usuario]);
  $contrasena_hash = $db->obtenDatos(BaseDatos::FETCH_FILA)['pass'];

  return password_verify($contrasena, $contrasena_hash);
}

function obtenerInfoUsuarioPorNombre($nombre_usuario) {
  global $db;

  $sql = "SELECT * FROM usuarios WHERE nombre = ?";
  $db->ejecuta($sql, [$nombre_usuario]);
  return $db->obtenDatos(BaseDatos::FETCH_FILA);
}
?>
