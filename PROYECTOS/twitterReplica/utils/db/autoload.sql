-- Eliminar tabla textos 
DROP TABLE IF EXISTS textos;

-- Eliminar tabla usuarios
DROP TABLE IF EXISTS usuarios;

-- Eliminar tabla tokens
DROP TABLE IF EXISTS tokens;

-- Crear la tabla usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
    biografia VARCHAR(100),
    contrasena VARCHAR(255) NOT NULL,
    correo_electronico VARCHAR(100) NOT NULL,
    foto_perfil VARCHAR(255)
);

-- Crear la tabla textos
CREATE TABLE textos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    contenido TEXT NOT NULL,
    fecha_creacion DATETIME NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Crear la tabla tokens
CREATE TABLE tokens (
    token VARCHAR(255) PRIMARY KEY,
    usuario_id INT NOT NULL,
    fecha_validez DATETIME NOT NULL,
    consumido BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Insertar algunos datos de prueba en la tabla usuarios
INSERT INTO usuarios (nombre_usuario, biografia, contrasena, correo_electronico, foto_perfil) 
VALUES 
('lm10', 'Anda pa sha bobo', '$2y$10$6awBOcJVyDGWwSN/VlkaJOdJOVbVifNc62n601v5SBpuHQ6T5ZqF2', 'leo@example.com', 'https://us-tuna-sounds-images.voicemod.net/f0a3dd8a-eea8-4f46-9e4b-26637d97899c-1682820619597.jpeg'),
('el_bicho', 'SIUUUUUUUUUU', '$2y$10$9ZpLJfVXTJY8wY9ilZtL6.p1TZny3hBcN9DiFjpIDxeQKJX7TikVa', 'cr7@example.com', 'https://images7.memedroid.com/images/UPLOADED242/60b3de4a5107d.jpeg');

-- Insertar algunos datos de prueba en la tabla textos
INSERT INTO textos (contenido, usuario_id, fecha_creacion) 
VALUES 
('¡Golazo de Messi en el último minuto del partido!', 1, NOW()),
('Hat-trick de Cristiano Ronaldo en la Champions League.', 2, NOW()),
('Partidazo de Neymar en el clásico.', 1, NOW());
