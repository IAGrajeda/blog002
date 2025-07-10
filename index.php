<?php
// Datos para la conexión a la base de datos
$host = 'localhost';
$db = 'mini_blog';
$user = 'root';
$pass = '';

// Crear conexión a la base de datos usando mysqli
$conn = new mysqli($host, $user, $pass, $db);

// Verificar si la conexión falló y detener el script con mensaje de error
if ($conn->connect_error) die("Conexión fallida: " . $conn->connect_error);

// Consulta SQL para obtener todos los posts ordenados por fecha descendente
$query = "SELECT * FROM posts ORDER BY fecha DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" /> <!-- Para hacer la página responsiva -->
    <title>Mini Blog</title>
    <!-- Tailwind CSS desde CDN para estilos rápidos -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

   <!-- Navegación fija en la parte superior, centrada y con estilo oscuro -->
   <header class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-black text-white px-6 py-4 rounded-lg shadow-lg z-50 w-[90%] max-w-4xl">
    <div class="flex justify-between items-center">
        <div class="text-lg font-semibold">BlogLogo</div> <!-- Nombre a la izquierda -->
        <div class="text-sm text-gray-300">+52 772 160 3876</div> <!-- Teléfono a la derecha -->
    </div>
   </header>

    <!-- Contenedor principal con margen superior para no tapar el header -->
    <main class="max-w-6xl mx-auto mt-24 px-4">

        <!-- Título principal grande y centrado -->
        <h1 class="font-semibold text-center mb-10 text-gray-800" style="font-size: 5rem;">
            Insights & stories from the digital world
        </h1>

        <!-- Grid responsivo para mostrar los posts -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" id="post-container">
            <?php
            $count = 0;
            // Recorremos los resultados de la consulta
            while($row = $result->fetch_assoc()):
                // Condición para ocultar posts que exceden el límite visible (8)
                $isHidden = $count >= 8 ? 'hidden extra-post' : '';
            ?>
                <!-- Cada post individual, con clases para ocultar según condición -->
                <div class="bg-white shadow-md p-4 rounded-2xl flex flex-col justify-between h-full <?= $isHidden ?>">
                    <!-- Imagen del post -->
                    <img src="<?= htmlspecialchars($row['imagen']) ?>" alt="imagen" class="w-full h-48 object-cover mb-3 rounded-lg">

                    <!-- Título del post -->
                    <h2 class="text-lg font-semibold"><?= htmlspecialchars($row['titulo']) ?></h2>

                    <!-- Detalles del post: fecha y categoría -->
                    <p class="text-sm text-gray-600 mb-2">
                        Publicado el <?= htmlspecialchars($row['fecha']) ?><br>
                        Categoría: <?= htmlspecialchars($row['categoria']) ?>
                    </p>

                    <div class="flex justify-between mt-4">
                        <!-- Espacio para botones o acciones futuras -->
                    </div>
                </div>
            <?php
            $count++;
            endwhile;
            ?>
        </div>

        <!-- Botón para mostrar más o menos posts, solo si hay más de 8 -->
        <?php if ($count > 8): ?>
            <div class="text-center mt-6">
                <button id="toggleBtn" onclick="togglePosts()" class="bg-white border border-gray-400 text-gray-600 px-5 py-3 rounded-full shadow hover:bg-gray-100 transition">
                    Ver más artículos
                </button>
            </div>
        <?php endif; ?>
    </main>


    <!-- Script para mostrar u ocultar posts adicionales -->
    <script>
        function togglePosts() {
            // Selecciona todos los posts ocultos
            const hiddenPosts = document.querySelectorAll('.extra-post');
            const btn = document.getElementById('toggleBtn');
            // Verifica si los posts están ocultos actualmente
            const isHidden = hiddenPosts[0]?.classList.contains('hidden');

            // Alterna la clase 'hidden' para mostrar/ocultar posts
            hiddenPosts.forEach(post => {
                post.classList.toggle('hidden');
            });

            // Cambia el texto del botón según el estado
            btn.textContent = isHidden ? 'Ver menos artículos' : 'Ver más artículos';
        }
    </script>
</body>
<button
  onclick="window.location.href='CRUD_page.php'"
  class="block md:fixed md:top-4 md:right-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow-lg
         text-center mx-auto md:mx-0 my-4 md:my-0
         text-sm sm:text-base
         z-50"
>
  Ir a Gestión de Posts
</button>
<footer class="w-full border-t border-gray-300 py-8 px-6 flex justify-between items-center">
  <!-- Texto a la izquierda -->
  <div class="text-gray-800 font-medium text-sm">
    BlogLogo
  </div>

  <!-- Íconos a la derecha -->
  <div class="flex items-center space-x-4 text-gray-600 cursor-pointer">
    <!-- Facebook Icon -->
    <a href="#" aria-label="Facebook" class="hover:text-gray-900">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
        <path d="M22.675 0h-21.35C.6 0 0 .6 0 1.337v21.326C0 23.4.6 24 1.325 24h11.495v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.894-4.788 4.659-4.788 1.325 0 2.463.098 2.795.142v3.24h-1.918c-1.504 0-1.795.715-1.795 1.763v2.312h3.59l-.467 3.622h-3.123V24h6.116c.725 0 1.325-.6 1.325-1.337V1.337C24 .6 23.4 0 22.675 0z"/>
      </svg>
    </a>

    <!-- Instagram Icon -->
    <a href="#" aria-label="Instagram" class="hover:text-gray-900">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
        <path d="M16 11.37a4 4 0 1 1-4.73-4.73 4 4 0 0 1 4.73 4.73z"/>
        <line x1="17.5" y1="6.5" x2="17.5" y2="6.5"/>
      </svg>
    </a>

    <!-- Twitter X Icon -->
    <button aria-label="Twitter X" class="hover:text-gray-900 focus:outline-none">
  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" class="h-5 w-5">
    <path d="M2.25 2.25l19.5 19.5-1.5 1.5L.75 3.75 2.25 2.25zM21.75 2.25l-19.5 19.5-1.5-1.5 19.5-19.5 1.5 1.5z"/>
  </svg>
</button>

  </div>
  
</footer>

</html>
