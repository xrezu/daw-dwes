<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de Rugby</title>
</head>
<body>
    <h1>Introducir Resultado de Partido</h1>
    <form action="guardar_resultado.php" method="post">
        <label for="contrincante">País Contrincante:</label>
        <input type="text" id="contrincante" name="contrincante" required><br>
        <?php if (isset($errores['contrincante'])): ?><span class="error"><?php echo $errores['contrincante']; ?></span><?php endif; ?><br><br>
        
        <label for="lugar">Lugar:</label>
        <input type="text" id="lugar" name="lugar" required><br>
        <?php if (isset($errores['lugar'])): ?><span class="error"><?php echo $errores['lugar']; ?></span><?php endif; ?><br>
        <br>
        
        <label for="resultado_a">Resultado de España:</label>
        <input type="number" id="resultado_a" name="resultado_a" required><br>
        <?php if (isset($errores['resultado_a'])): ?><span class="error"><?php echo $errores['resultado_a']; ?></span><?php endif; ?>
        <br>
        
        <label for="resultado_b">Resultado del Contrincante:</label>
        <input type="number" id="resultado_b" name="resultado_b" required><br>
        <?php if (isset($errores['resultado_b'])): ?><span class="error"><?php echo $errores['resultado_b']; ?></span><?php endif; ?>
        <br>
        
        <input type="submit" value="Guardar">
    </form>
</body>
</html>
