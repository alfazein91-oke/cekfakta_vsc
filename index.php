
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'config/database.php';
require_once 'includes/function.php';

$judul = "Beranda";

$q = $_GET['q'] ?? '';

if ($q !== '') {
    $stmt = $pdo->prepare(
        "SELECT * FROM articles
         WHERE title LIKE ?
         ORDER BY created_at DESC"
    );
    $stmt->execute(["%$q%"]);
} else {
    $stmt = $pdo->query(
        "SELECT * FROM articles
         ORDER BY created_at DESC"
    );
}

$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'includes/header.php';
?>

<section class="bg-blue-700 text-white rounded-2xl p-10 mb-10">
    <h1 class="text-3xl md:text-4xl font-bold mb-4">
        Kenali Hoaks, Sebarkan Fakta!
    </h1>

    <p class="text-blue-100 mb-6">
        Tingkatkan literasi digital dan jadilah pengguna
        internet yang cerdas dalam menerima informasi.
    </p>

    <a href="cek-hoaks.php"
       class="inline-block bg-white text-blue-700 px-6 py-3 rounded-lg font-semibold">
        Periksa Berita
    </a>
</section>

<h2 class="text-2xl font-bold mb-5">
    Artikel Terbaru
</h2>

<form method="GET" class="mb-8 flex gap-2">
    <input type="text" name="q"
           value="<?= aman($q) ?>"
           placeholder="Cari artikel..."
           class="w-full border rounded-lg p-3">

    <button class="bg-blue-700 text-white px-5 rounded-lg">
        Cari
    </button>
</form>

<div class="grid md:grid-cols-3 gap-6">

<?php if (count($articles) > 0): ?>

    <?php foreach ($articles as $article): ?>

    <article class="bg-white rounded-xl shadow-sm border p-5">

        <span class="text-sm text-blue-600 font-semibold">
            <?= aman($article['category']) ?>
        </span>

        <h3 class="text-xl font-bold mt-3 mb-3">
            <?= aman($article['title']) ?>
        </h3>

        <p class="text-gray-600 text-sm mb-4">
            <?= aman($article['excerpt']) ?>
        </p>

        <a href="artikel.php?id=<?= $article['id'] ?>"
           class="text-blue-700 font-semibold hover:underline">
            Baca Selengkapnya →
        </a>

    </article>

    <?php endforeach; ?>

<?php else: ?>

    <p class="text-gray-500">
        Artikel tidak ditemukan.
    </p>

<?php endif; ?>

</div>

<?php include 'includes/footer.php'; ?>
