<?php
$conn = new mysqli('localhost', 'root', '', 'mini_blog');
if ($conn->connect_error) die("Error de conexión");

$editarPost = null;

// Obtener datos si hay ID
if (isset($_GET['id'])) {
    $idEditar = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->bind_param("i", $idEditar);
    $stmt->execute();
    $result = $stmt->get_result();
    $editarPost = $result->fetch_assoc();
    $stmt->close();
}

// Eliminar post
if (isset($_POST['delete'])) {
    $id = intval($_POST['id']);
    $stmt = $conn->prepare("DELETE FROM posts WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Crear o editar
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['accion'])) {
    $accion = $_POST['accion'];
    $titulo = $_POST['titulo'];
    $fecha = $_POST['fecha'];
    $categoria = $_POST['categoria'];

    $imagen_path = null;
    if (!empty($_FILES['imagen_file']['name'])) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);
        $filename = basename($_FILES['imagen_file']['name']);
        $target_file = $upload_dir . uniqid() . "_" . $filename;
        if (move_uploaded_file($_FILES['imagen_file']['tmp_name'], $target_file)) {
            $imagen_path = $target_file;
        }
    } elseif (!empty($_POST['imagen_url'])) {
        $imagen_path = $_POST['imagen_url'];
    }

    if ($accion === 'crear') {
        $stmt = $conn->prepare("INSERT INTO posts (titulo, fecha, imagen, categoria) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $titulo, $fecha, $imagen_path, $categoria);
        $stmt->execute();
        $stmt->close();
    } elseif ($accion === 'editar') {
        $id = intval($_POST['id']);
        if ($imagen_path) {
            $stmt = $conn->prepare("UPDATE posts SET titulo = ?, fecha = ?, imagen = ?, categoria = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $titulo, $fecha, $imagen_path, $categoria, $id);
        } else {
            $stmt = $conn->prepare("UPDATE posts SET titulo = ?, fecha = ?, categoria = ? WHERE id = ?");
            $stmt->bind_param("sssi", $titulo, $fecha, $categoria, $id);
        }
        $stmt->execute();
        $stmt->close();
    }

    header("Location: CRUD_page.php");
    exit;
}

$result = $conn->query("SELECT * FROM posts ORDER BY fecha DESC");
$posts = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mini Blog - Gestión de Posts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-4 sm:p-6">

<div class="container mx-auto max-w-7xl">
    <h1 class="text-3xl font-bold mb-6 text-center">Gestión de Posts</h1>

    <!-- Formulario -->
    <section class="mb-10 bg-white p-6 rounded shadow max-w-2xl mx-auto w-full">
        <h2 class="text-xl font-semibold mb-4 text-center">
            <?= $editarPost ? "Editar post #{$editarPost['id']}" : "Agregar/Editar nuevo post" ?>
        </h2>
        <form method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-4">
            <input type="hidden" name="accion" value="<?= $editarPost ? 'editar' : 'crear' ?>">
            <?php if ($editarPost): ?>
                <input type="hidden" name="id" value="<?= $editarPost['id'] ?>">
            <?php endif; ?>

            <label>
                <span class="block font-medium">Título:</span>
                <input name="titulo" class="w-full border px-3 py-2 rounded" required
                    value="<?= htmlspecialchars($editarPost['titulo'] ?? '') ?>">
            </label>

            <label>
                <span class="block font-medium">Fecha:</span>
                <input type="date" name="fecha" class="w-full border px-3 py-2 rounded" required
                    value="<?= htmlspecialchars($editarPost['fecha'] ?? '') ?>">
            </label>

            <label>
                <span class="block font-medium">Subir imagen (archivo):</span>
                <input type="file" name="imagen_file" class="w-full border px-3 py-2 rounded">
            </label>

            <label>
                <span class="block font-medium">O ingresar URL de imagen:</span>
                <input name="imagen_url" class="w-full border px-3 py-2 rounded"
                    placeholder="https://ejemplo.com/imagen.jpg"
                    value="<?= htmlspecialchars($editarPost['imagen'] ?? '') ?>">
            </label>

            <label>
                <span class="block font-medium">Categoría:</span>
                <input name="categoria" class="w-full border px-3 py-2 rounded"
                    value="<?= htmlspecialchars($editarPost['categoria'] ?? '') ?>">
            </label>

            <div class="flex flex-wrap gap-4 items-center justify-start">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    <?= $editarPost ? "Guardar Cambios" : "Guardar" ?>
                </button>
                <?php if ($editarPost): ?>
                    <a href="CRUD_page.php" class="text-gray-600 hover:underline">Cancelar edición</a>
                <?php endif; ?>
            </div>
        </form>
    </section>

    <!-- Botón para ir a index.php -->
<button
  onclick="window.location.href='index.php'"
  class="static bottom-4 left-4 bg-violet-500 hover:bg-violet-600 text-white font-semibold py-3 px-5 rounded shadow-lg"
  style="z-index: 1000;"
>
  Ir a catalogo de Posts
</button>
    <!-- Tabla de Posts -->
    <section>
        <h2 class="text-xl font-semibold mb-4">Posts existentes</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded shadow text-sm">
                <thead>
                    <tr class="bg-gray-200 text-left text-xs uppercase">
                        <th class="px-4 py-2 border">ID</th>
                        <th class="px-4 py-2 border">Título</th>
                        <th class="px-4 py-2 border">Fecha</th>
                        <th class="px-4 py-2 border">Imagen</th>
                        <th class="px-4 py-2 border">Categoría</th>
                        <th class="px-4 py-2 border">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $post): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="border px-4 py-2"><?= $post['id'] ?></td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($post['titulo']) ?></td>
                            <td class="border px-4 py-2"><?= $post['fecha'] ?></td>
                            <td class="border px-4 py-2">
                                <?php if ($post['imagen']): ?>
                                    <img src="<?= htmlspecialchars($post['imagen']) ?>" alt="Imagen" class="w-20 h-auto rounded">
                                <?php else: ?>
                                    <span class="text-gray-500 italic">Sin imagen</span>
                                <?php endif; ?>
                            </td>
                            <td class="border px-4 py-2"><?= htmlspecialchars($post['categoria']) ?></td>
                            <td class="border px-4 py-2">
                                <a href="CRUD_page.php?id=<?= $post['id'] ?>" class="text-blue-600 hover:underline mr-2">Editar</a>
                                <form method="POST" class="inline" onsubmit="return confirm('¿Eliminar este post?')">
                                    <input type="hidden" name="id" value="<?= $post['id'] ?>">
                                    <button type="submit" name="delete" class="text-red-600 hover:underline bg-transparent border-0 cursor-pointer p-0">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
<footer class="w-full border-t border-gray-300 py-3 px-6 flex justify-between items-center">
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

</body>
</html>
