<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar post</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-zinc-800 text-white font-sans">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">✏️ Editar post</h1>

        <form action="<?= site_url('admin/update/' . $post['id']) ?>" method="post" enctype="multipart/form-data"
            class="bg-gray-800 p-6 rounded shadow-md space-y-4">
            <div>
                <label class="block font-medium">Título:</label>
                <input type="text" name="titulo" value="<?= esc($post['titulo']) ?>" required
                    class="w-full bg-zinc-800 border border-gray-300 px-4 py-2 rounded" />
            </div>

            <div>
                <label class="block font-medium">Fecha:</label>
                <input type="date" name="fecha" value="<?= esc($post['fecha']) ?>" required
                    class="w-full bg-zinc-800 border border-gray-300 px-4 py-2 rounded" />
            </div>

            <div>
                <label class="block font-medium">Imagen (nombre o ruta):</label>
                <?php if (!empty($post['imagen'])): ?>
                    <img src="<?= base_url('uploads/' . $post['imagen']) ?>" alt="Imagen actual" class="w-32 mb-2">
                <?php endif; ?>
                <input type="file" name="imagen" value="<?= esc($post['imagen']) ?>"
                    class="w-full bg-zinc-800 border border-gray-300 px-4 py-2 rounded" />
            </div>

            <div>
                <label class="block font-medium">Categoría:</label>
                <input type="text" name="categoria" value="<?= esc($post['categoria']) ?>"
                    class="w-full bg-zinc-800 border border-gray-300 px-4 py-2 rounded" />
            </div>

            <div>
                <label class="block font-medium">Contenido:</label>
                <textarea name="contenido" rows="5"
                    class="w-full bg-zinc-800 border border-gray-300 px-4 py-2 rounded"><?= esc($post['contenido']) ?></textarea>
            </div>

            <div class="flex justify-between items-center">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Actualizar</button>
                <a href="<?= site_url('admin') ?>" class="text-blue-500 hover:underline">← Volver</a>
            </div>
        </form>
    </div>
</body>

</html>