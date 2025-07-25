# Mini Blog en CodeIgniter 4

Este proyecto es un blog básico desarrollado con **CodeIgniter 4**, que permite gestionar publicaciones desde un panel de administración.

## 🧩 Tecnologías usadas

- PHP 8+
- CodeIgniter 4
- Tailwind CSS
- MySQL (o SQLite)
- Git + GitHub

## 📂 Estructura

- `/app/Controllers/Admin.php`: Controlador principal del panel.
- `/app/Views/admin/`: Vistas del panel de administración.
- `/app/Views/component/`: Header y Footer reutilizables.
- `/public/uploads/`: Carpeta donde se guardan las imágenes.
- `/app/Models/PostModel.php`: Modelo de datos de los posts.

## 🔐 Acceso al panel

Para entrar al panel, debes iniciar sesión con:

```
Usuario: admin
Contraseña: admin
```

## 📝 Funcionalidades

- Crear, editar y eliminar posts
- Subida de imágenes
- Panel visual con Tailwind CSS
- Modal de confirmación al eliminar
- Validación de sesión (login sencillo)

## 📦 Instalación

1. Clona el repositorio:
   ```bash
   git clone <URL-del-repo>
   ```

2. Copia el contenido de `blog002` dentro de la carpeta del repositorio clonado.

3. Asegúrate de tener configurado tu entorno (`.env`) en modo desarrollo:
   ```
   CI_ENVIRONMENT = development
   ```

4. Inicia el servidor de desarrollo de CodeIgniter:
   ```bash
   php spark serve
   ```

5. Visita `http://localhost:8080`.

## 📌 Notas

- Las imágenes se almacenan en `/public/uploads/`
- Al actualizar o eliminar un post, también se elimina su imagen asociada
- No es necesario subir la carpeta `vendor` al repo (usa `.gitignore`)
