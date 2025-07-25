<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white h-screen flex items-center justify-center">
    <form action="/blog002/public/login" method="post" class="bg-gray-800 p-6 rounded shadow w-full max-w-sm space-y-4">
        <h2 class="text-2xl font-bold">🔐 Iniciar sesión</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="text-red-500"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div>
            <label class="block">Usuario:</label>
            <input type="text" name="usuario" required class="w-full px-3 py-2 rounded bg-gray-700 text-white">
        </div>

        <div>
            <label class="block">Contraseña:</label>
            <input type="password" name="clave" required class="w-full px-3 py-2 rounded bg-gray-700 text-white">
        </div>

        <button type="submit" class="bg-blue-600 px-4 py-2 rounded hover:bg-blue-700 w-full">Entrar</button>
    </form>
</body>
</html>