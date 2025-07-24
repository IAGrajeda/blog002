<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Posts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-zinc-800 text-white font-sans">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">📝 Listado de Posts</h1>
        <a href="<?= site_url('logout') ?>" class="text-red-400 hover:underline float-right">Cerrar sesión</a>
        <a href="<?= site_url('admin/create') ?>"
            class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">+ Crear nuevo post</a>

        <?php if (!empty($posts) && is_array($posts)): ?>
            <div class="bg-gray-800 shadow rounded p-4">
                <table class="w-full table-auto">
                    <thead>
                        <tr class="bg-gray-800">
                            <th class="px-4 py-2 text-left">Título</th>
                            <th class="px-4 py-2 text-left">Fecha</th>
                            <th class="px-4 py-2 text-left">Categoría</th>
                            <th class="px-4 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($posts as $post): ?>
                            <tr class="border-t hover:bg-gray-700 hover:bg-opacity-75 hover:transition">
                                <td class="px-4 py-2"><?= esc($post['titulo']) ?></td>
                                <td class="px-4 py-2"><?= esc($post['fecha']) ?></td>
                                <td class="px-4 py-2"><?= esc($post['categoria']) ?></td>
                                <td class="px-4 py-2 text-center flex flex-col gap-2 md:flex-row items-center">
                                    <a href="<?= site_url('admin/edit/' . $post['id']) ?>"
                                        class="text-black bg-yellow-500 hover:bg-yellow-800 rounded-xl p-1 w-full md:w-1/3">Editar</a>
                                    <button onclick="abrirModal(<?= $post['id'] ?>)"
                                        class="text-white bg-red-600 hover:bg-red-800 rounded-xl p-1 w-full md:w-1/3">Eliminar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-gray-600">No hay posts registrados.</p>
        <?php endif; ?>
    </div>

    <!-- Modal -->
    <div id="modalEliminar" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-80 hidden z-50">
        <div class="bg-zinc-800 text-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h2 class="text-xl font-bold mb-4">¿Eliminar este post?</h2>
            <p class="mb-6">Esta acción no se puede deshacer.</p>
            <div class="flex justify-end gap-4">
                <button onclick="cerrarModal()"
                    class="px-4 py-2 bg-gray-500 rounded hover:bg-gray-600">Cancelar</button>
                <a id="btnConfirmarEliminar" href="#"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Eliminar</a>
            </div>
        </div>
    </div>
</body>

</html>




<script>
    function abrirModal(id) {
        const modal = document.getElementById('modalEliminar');
        const btn = document.getElementById('btnConfirmarEliminar');
        btn.href = '/blog002/public/admin/delete/' + id;
        modal.classList.remove('hidden');
    }

    function cerrarModal() {
        document.getElementById('modalEliminar').classList.add('hidden');
    }
</script>