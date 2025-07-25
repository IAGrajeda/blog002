<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Mi Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans">
    <div class="container mx-auto px-4 py-8 flex flex-col items-center gap-6">
        
        <?= view('component/header') ?>

        <h2 class="text-[80px] text-center">
            Insights & stories from the digital world
        </h2>

        <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-6 my-10">
            <?php foreach ($posts as $post): ?>
                <div class="bg-white rounded shadow p-4 hover:shadow-lg hover:bg-zinc-200 transition">
                    
                    <!-- Imagen del post -->
                    <?php if (!empty($post['imagen'])): ?>
                        <img src="<?= base_url('uploads/' . esc($post['imagen'])) ?>" alt="Imagen de <?= esc($post['titulo']) ?>" class="w-full h-48 object-cover rounded mb-4">
                    <?php endif; ?>

                    <h2 class="text-xl font-semibold mb-2"><?= esc($post['titulo']) ?></h2>
                    <p class="text-sm text-gray-500 mb-2"><?= esc($post['fecha']) ?> | <?= esc($post['categoria']) ?></p>
                    <p class="mb-4 text-gray-700">
                        <?php
                        $content = strip_tags($post['contenido']);
                        echo mb_strlen($content) > 100 ? esc(mb_substr($content, 0, 100)) . '...' : esc($content);
                        ?>
                    </p>
                    <?php if (!empty($post['Calificacion'])): ?>
                        <p class="text-sm text-gray-500 mb-4">Calificación: <?= esc($post['Calificacion']) ?></p>
                    <?php endif; ?>
                    
                    
                    <a href="#" class="text-blue-600 hover:underline">Leer más</a>
                </div>
            <?php endforeach; ?>
        </div>

        <button class="border border-black px-3 py-1 rounded-full font-semibold hover:bg-gray-200">
            See more articles
        </button>
    </div>

    <?= view('component/footer') ?>
</body>

</html>
