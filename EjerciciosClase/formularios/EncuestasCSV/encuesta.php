<?php
  define('FICHERO_PREGUNTAS', 'preguntas.csv');
  define('FICHERO_RESPUESTAS', 'respuestas.csv');

  $errores = [];

  $preguntas = [];

  $archivos_preguntas = fopen(FICHERO_PREGUNTAS, 'r');
  if($archivos_preguntas !== false){
    while(($linea = fgetcsv($archivo_preguntas)) !== false){
      $preguntas[] = $linea[0];
    }
    fclose($archivo_preguntas);
  } else {
    $errores['preguntas'] = "Error al abrir el archivo de preguntas.";
  }

  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enviar'])){
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
    if(empty($nombre)){
      $errores['nombre'] = "Por favor, introduzca su nombre";
    }

    $respuestas = $_POST['respuestas'] ?? [];
    $pregunta_vacia = false;

    foreach($preguntas as $i => $pregunta){
      if(!isset($respuestas[$indice]) || $respuestas[$indice] === ""){
        $pregunta_vacia = true;
        break;
      }
    }

    if($pregunta_vacia){
      $errores['respuestas'] = "Por favor, responda a todas las preguntas";
    }

    if(empty($errores)){
      $respuestas_csv = strtolower($nombre) . ';' . implode(';', $respuestas) . PHP_EOL;
      file_put_contents(FICHERO_RESPUESTAS, $respuestas_csv, FILE_APPEND);

      header("Location: exito.php");
      exit();
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
      body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #333333;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: #333333;
        }

        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }

        .question {
            margin-bottom: 20px;
        }

        .question p {
            font-size: 16px;
            color: #333333;
        }

        .question label {
            display: inline-block;
            margin-right: 10px;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        input[type="submit"] {
            background: #5cb85c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background: #4cae4c;
        }

        .form-group {
            margin-bottom: 15px;
        }
    </style>
  </head>
  <body>
    <h1> Encuesta </h1>

    <form method="POST" action="encuesta.php">
      <label for="nombre"> Nombre: </label>

      <input type="text" name="nombre" value="<?= $nombre ?? ''?>"> 
      <?php if(isset($errores['nombre'])): ?>
        <span class="error"> <?= $errores['nombre']; ?> </span>
      <?php endif; ?>

      <?php foreach ($preguntas as $indice => $pregunta): ?>
        <p><b> <?= $pregunta;?> </b></p>
        <?php
          $checked_nada = "";
          $checked_normal = "";
          $checked_mucho = "";

          if (isset($_POST['respuestas'][$indice])){
            $respuesta_seleccionada = $_POST['respuestas'][$indice];
            if($respuesta_seleccionada == "0"){
              $checked_nada = "checked";
            } elseif ($respuesta_seleccionada == "1"){
              $checked_normal = "checked";
            } elseif ($respuesta_seleccionada == "2"){
              $checked_mucho = "checked";
            }
          }
        ?>
        <input type="radio" name="respuestas[<?php echo $indice; ?>]" value="0" <?php echo $checked_nada; ?>>
        <label for=""> Nada </label>
        <input type="radio" name="respuestas[<?php echo $indice; ?>]" value="1" <?php echo $checked_normal; ?>>
        <label for=""> Normal </label>
        <input type="radio" name="respuestas[<?php echo $indice; ?>]" value="2" <?php echo $checked_mucho; ?>>
        <label for=""> Mucho </label> <br>
        <?php endforeach;
          if(isset($errores['respuestas'])):
        ?>
          <span class="error"> <?= $errores['respuestas']; ?> </span> 
        <?php endif; ?> <br>

        <input type="submit" name="enviar" value="Enviar">
    </form>

  </body>
</html>
