-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS mini_twitter;

-- Seleccionar la base de datos mini_twitter
USE mini_twitter;

-- Crear la tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(255) NOT NULL,
    correo_electronico VARCHAR(255) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    foto_perfil BLOB 
);

-- Crear la tabla de textos
CREATE TABLE IF NOT EXISTS textos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contenido TEXT NOT NULL,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Insertar algunos datos de prueba en la tabla de usuarios
INSERT INTO usuarios (nombre_usuario, correo_electronico, contrasena) VALUES
('usuario1', 'usuario1@example.com', 'contrasena1'),
('usuario2', 'usuario2@example.com', 'contrasena2');

-- Insertar algunos datos de prueba en la tabla de textos
INSERT INTO textos (contenido, usuario_id) VALUES
('Este es un texto de prueba del usuario 1', 1),
('Este es otro texto de prueba del usuario 1', 1),
('Un texto de prueba del usuario 2', 2);
