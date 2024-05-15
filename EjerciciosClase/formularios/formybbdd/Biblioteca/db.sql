CREATE TABLE libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    ano_publicacion INT NOT NULL
);

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    telefono VARCHAR(20) NOT NULL
);

CREATE TABLE prestamos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_libro INT,
    id_cliente INT,
    fecha_prestamo DATE,
    FOREIGN KEY (id_libro) REFERENCES libros(id),
    FOREIGN KEY (id_cliente) REFERENCES clientes(id)
);

INSERT INTO libros (titulo, autor, ano_publicacion) VALUES
('El gran Gatsby', 'F. Scott Fitzgerald', 1925),
('Cien años de soledad', 'Gabriel García Márquez', 1967),
('1984', 'George Orwell', 1949),
('Don Quijote de la Mancha', 'Miguel de Cervantes', 1605),
('Orgullo y prejuicio', 'Jane Austen', 1813);

INSERT INTO clientes (nombre, telefono) VALUES
('Juan Pérez', '123-456-7890'),
('María López', '456-789-0123'),
('Pedro García', '789-012-3456'),
('Ana Martínez', '012-345-6789'),
('Luis Rodríguez', '345-678-9012');

INSERT INTO prestamos (id_libro, id_cliente, fecha_prestamo) VALUES
(1, 2, '2024-05-10'), -- El gran Gatsby prestado a María López el 10 de mayo de 2024
(3, 4, '2024-05-12'); -- 1984 prestado a Ana Martínez el 12 de mayo de 2024
