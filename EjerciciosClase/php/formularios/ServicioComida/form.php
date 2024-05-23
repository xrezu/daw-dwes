<?php
  $errores = [];

  $alergenos = [
    "Gluten",
    "Crustaceos",
    "Huevos",
    "Pescado",
    "Cacahuetes",
    "Soja",
    "Lacteos",
    "Frutos de cascara",
    "Apio",
    "Mostaza",
    "Sesamo",
    "Sulfitos",
    "Altramuces",
    "Moluscos"
  ];

  if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['enviar']))) {
    if (empty($_POST["nombre"])) {
      $errores["nombre"] = "El nombre es obligatorio";
    }

    if (empty($_POST["direccion"])) {
      $errores["direccion"] = "La dirección es obligatoria";
    }

    if (empty($_POST["platos"]) || $_POST["platos"] < 3) {
      $errores["platos"] = "Debe pedir al menos 3 platos";
    }

    if (empty($_POST["vegetariano"])) {
      $errores["vegetariano"] = "Debes seleccionar si eres vegetariano o no";
    }

    if (empty($errores)) {
      $nombre = urlencode($_POST["nombre"]);
      $direccion = urlencode($_POST["direccion"]);
      $platos = urlencode($_POST["platos"]);
      $vegetariano = urlencode($_POST["vegetariano"]);
      $alergias = isset($_POST["alergias"]) ? implode(", ", $_POST["alergias"]) : '';
        header('Location: exito.php?nombre=' . $nombre . '&direccion=' . $direccion . '&platos=' . $platos . '&vegetariano=' . $vegetariano . '&alergias=' . $alergias);
        exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Comida semanal a domicilio </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="number"],
        select {
            width: calc(100% - 10px);
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
        .error {
            color: #ff0000;
            font-size: 14px;
        }
        .checkbox-container {
            display: flex;
            flex-wrap: wrap;
        }
        .checkbox-item {
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <h1> Servicio de comida </h1>
    <form action="form.php" method="post">
        <label for="nombre"> Nombre: </label> <br>
        <input type="text" name="nombre" value="<?= isset($_POST["nombre"]) ? $_POST["nombre"] : ''; ?>"> <br>
        <?php if (isset($errores["nombre"])): ?>
            <span class="error"><?= $errores["nombre"]; ?></span>
        <?php endif; ?> <br> <br>

        <label for="direccion"> Dirección: </label> <br>
        <input type="text" name="direccion" value="<?= isset($_POST["direccion"]) ? $_POST["direccion"] : ''; ?>"> <br>
        <?php if (isset($errores['direccion'])): ?>
            <span class="error"><?= $errores["direccion"]; ?></span>
        <?php endif; ?> <br> <br>

        <label for="platos"> Numero de platos: </label> <br>
        <input type="number" name="platos" value="<?= isset($_POST["platos"]) ? $_POST["platos"] : ''; ?>"> <br>
        <?php if (isset($errores["platos"])): ?>
            <span class="error"><?= $errores["platos"]; ?></span>
        <?php endif; ?> <br> <br>

        <label for="vegetariano"> ¿Eres vegetariano? </label> <br>
        <select name="vegetariano">
            <option disabled selected> Selecciona una opcion </option>
            <option value="vegetariano" <?= (isset($_POST["vegetariano"]) && $_POST["vegetariano"] == "vegetariano") ? "selected" : ''; ?>> Si</option>
            <option value="no_vegetariano" <?= (isset($_POST["vegetariano"]) && $_POST["vegetariano"] == "no_vegetariano") ? "selected" : ''; ?>> No </option>
        </select> <br>
        <?php if (isset($errores["vegetariano"])): ?>
            <span class="error"><?= $errores["vegetariano"]; ?></span>
        <?php endif; ?> <br> <br>

        <label for="alergias"> Alergias: </label> <br>
        <?php foreach($alergenos as $alergia): ?>
            <span><input type="checkbox" name="alergias[]" value="<?= $alergia ?>" <?= (isset($_POST["alergias"]) && in_array($alergia, $_POST["alergias"])) ? "checked" : '' ?>> <?= $alergia ?> </span>
        <?php endforeach ?> <br> <br>

        <input type="submit" name="enviar" value="ENVIAR">
    </form>
</body>
</html>