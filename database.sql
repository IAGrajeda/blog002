Create database blog002;
use blog002;

CREATE TABLE posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(255) NOT NULL,
  fecha DATE NOT NULL,
  imagen VARCHAR(255),
  categoria VARCHAR(100),
  contenido TEXT
);

INSERT INTO posts (titulo, fecha, imagen, categoria, contenido) VALUES
('¿Qué es CodeIgniter y por qué usarlo?', '2025-07-20', 'codeigniter.webp', 'Frameworks', 'Una introducción básica a CodeIgniter y sus ventajas.'),
('Tailwind CSS: Estilo rápido y moderno', '2025-07-18', 'tailwind.webp', 'CSS', 'Exploramos cómo Tailwind CSS puede acelerar tu maquetación frontend.'),
('Introducción a PHP para principiantes', '2025-07-15', 'php.webp', 'PHP', 'Todo lo que necesitas saber para empezar a programar en PHP.'),
('Cómo conectar PHP con MySQL', '2025-07-10', 'sql.webp', 'Base de Datos', 'Guía paso a paso para conectar tus aplicaciones PHP a una base de datos MySQL.'),
('Organiza tu backend con MVC', '2025-07-05', 'mvc.webp', 'Arquitectura', 'Entiende el patrón Modelo-Vista-Controlador usando CodeIgniter.')
;