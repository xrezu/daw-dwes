CREATE DATABASE earth_day;

USE earth_day;

CREATE TABLE actions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    place VARCHAR(255) NOT NULL,
    name VARCHAR(255),
    description TEXT,
    photo VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
