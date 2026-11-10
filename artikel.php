
<?php
require_once 'config/database.php';
require_once 'includes/function.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$stmt = $pdo->prepare(
    "SELECT * FROM articles WHERE id = ?"
);
$stmt->execute([$id]);

$article = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    http_response_code(404);
}

$judul = $article ? $article['title'] : "Artikel Tidak Ditemukan";

include 'includes/header.php';
?>

<?php if ($article): ?>

<article class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-sm">

    <span class="text-blue-600 font-semibold">
        <?= aman($article['category']) ?>
    </span>

    <h1 class="text-3xl font-bold mt-4 mb-4">
        <?= aman($article['title']) ?>
    </h1>

    <p class="text-gray-400 text-sm mb-8">
        Dipublikasikan:
        <?= date('d-m-Y', strtotime($article['created_at'])) ?>
    </p>

    <div class="text-gray-700 leading-8 whitespace-pre-line">
        <?= aman($article['content']) ?>
    </div>

    <a href="index.php"
       class="inline-block mt-8 text-blue-700 font-semibold">
        ← Kembali ke Beranda
    </a>

</article>

<?php else: ?>

<p class="text-center text-red-600">
    Artikel tidak ditemukan.
</p>

<?php endif; ?>

<?php include 'includes/footer.php'; ?>
