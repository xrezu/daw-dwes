<?php

$errores = [];
$titulo = '';

// si el ususario envia el formulario
if(isset($_POST["enviar"])){
  // si hay errores en el formulario
    //rellenar el array de errores 
  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
    }
    .container {
      width: 80%;
      margin: 0 auto;
    }
    h1 {
      text-align: center;
    }
    form {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .form-group {
      margin-bottom: 15px;
    }
    .form-group label {
      display: block;
      font-weight: bold;
    }
    .form-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .form-group button {
      background-color: #333;
      color: #fff;
      padding: 10px 15px;
      border: 0;
      border-radius: 5px;
      cursor: pointer;
    }
    .form-group button:hover {
      background-color: #555;
    }

    .error {
      background-color: #f8d7da;
      color: #842029;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 5px;
    }
  </style>

  <body>
    <div class="container">
      <form action="" method="post">
        <?php 
          if(isset($errores["titulo"])){
            echo '<span class="error">'.$errores["titulo"].'</span>';
          }
        ?>
          <label for="titulo">Título</label><input type="text" name="titulo" id="titulo" value="<?=$titulo;?>">
      </form>
    </div>
  </body>
</head>
</html>