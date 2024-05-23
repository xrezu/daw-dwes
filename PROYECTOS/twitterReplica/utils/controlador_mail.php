<?php

  require 'init.php';

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;

  require 'vendor/autoload.php';

  function validarCorreo($email){
    global $db;

    $sql = "SELECT * FROM usuarios WHERE correo_electronico = : email";
    $db = ejecuta($sql, $email);
    $userAsociado = $db->obtenerDatos(BaseDatos::FETCH_FILA);

    return $userAsociado ? true : false;
  } 

  function sendRecoveryMail($email){
    $mail = new PHPMailer(true);

    try{
      $token = generarToken();

      if (insertarTokenRecuperacionDB($token, $email)){
        $mail->isSMTP();
                $mail->Host = 'smtp.educa.madrid.org';
                $mail->SMTPAuth = false;
                $mail->Username = 'maksym.dovgan@educa.madrid.org';
                $mail->Password = 'c6drou56A7';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->CharSet = 'UTF-8';
                $mail->setFrom('maksym.dovgan@educa.madrid.org', 'Mini Twitter');
                $mail->addAddress($email, 'Maksym Dovgan');
                $mail->Subject = 'Recuperación de contraseña';
                $mail->Body = "Haz click en el siguiente enlace para recuperar tu contraseña: http://localhost/twitter/resetear_contra_proceso.php?token=$token";
        return true;
      } else{
        return false;
      } 

    } catch (Exception){
      return false;
    }
  }

?>