
<?php
require_once 'config/database.php';
require_once 'includes/function.php';

$kategori = $_GET['kategori'] ?? '';

if ($kategori !== '') {
    $stmt = $pdo->prepare(
        "SELECT * FROM articles
         WHERE category = ?
         ORDER BY created_at DESC"
    );
    $stmt->execute([$kategori]);
} else {
    $stmt = $pdo->query(
        "SELECT * FROM articles ORDER BY created_at DESC"
    );
}

$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

$judul = "Artikel";
include 'includes/header.php';
?>

<h1 class="text-3xl font-bold mb-6">
    Kumpulan Artikel
</h1>

<div class="flex flex-wrap gap-3 mb-8">

<?php
$categories = [
    'Edukasi Digital',
    'Berita Hoaks',
    'Literasi Media',
    'Tips'
];
?>

<a href="kategori.php"
   class="bg-gray-200 px-4 py-2 rounded-lg">
    Semua
</a>

<?php foreach ($categories as $cat): ?>

<a href="?kategori=<?= urlencode($cat) ?>"
   class="bg-blue-100 text-blue-700 px-4 py-2 rounded-lg">
    <?= aman($cat) ?>
</a>

<?php endforeach; ?>

</div>

<div class="grid md:grid-cols-3 gap-6">

<?php foreach ($articles as $article): ?>

<div class="bg-white p-5 rounded-xl shadow-sm border">

    <p class="text-blue-600 text-sm">
        <?= aman($article['category']) ?>
    </p>

    <h2 class="font-bold text-xl my-3">
        <?= aman($article['title']) ?>
    </h2>

    <p class="text-gray-600 text-sm">
        <?= aman($article['excerpt']) ?>
    </p>

    <a href="artikel.php?id=<?= $article['id'] ?>"
       class="text-blue-700 inline-block mt-4 font-semibold">
        Baca Selengkapnya →
    </a>

</div>

<?php endforeach; ?>

</div>

<?php include 'includes/footer.php'; ?>
