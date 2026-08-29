CREATE DATABASE IF NOT EXISTS taskboard; 
USE taskboard; 
  
CREATE TABLE tareas ( 
    id INT AUTO_INCREMENT PRIMARY KEY, 
    titulo VARCHAR(150) NOT NULL, 
    descripcion TEXT, 
    completada BOOLEAN DEFAULT FALSE, 
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);