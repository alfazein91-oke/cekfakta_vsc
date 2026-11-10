
<?php
require_once '../config/database.php';
require_once '../includes/function.php';

wajibLogin();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    die("Artikel tidak ditemukan.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $excerpt = trim($_POST['excerpt'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if ($title && $category && $content) {

        $stmt = $pdo->prepare(
            "UPDATE articles
             SET title=?, category=?, excerpt=?, content=?
             WHERE id=?"
        );

        $stmt->execute([
            $title, $category, $excerpt, $content, $id
        ]);

        header("Location: dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Artikel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">

<div class="max-w-3xl mx-auto bg-white p-8 rounded-xl">

    <h1 class="text-2xl font-bold mb-6">Edit Artikel</h1>

    <form method="POST">

        <label>Judul Artikel</label>
        <input type="text" name="title"
               value="<?= aman($article['title']) ?>"
               required class="w-full border p-3 rounded mb-4">

        <label>Kategori</label>
        <select name="category"
                class="w-full border p-3 rounded mb-4">

            <?php
            $categories = [
                'Edukasi Digital',
                'Berita Hoaks',
                'Literasi Media',
                'Tips'
            ];

            foreach ($categories as $cat):
            ?>

            <option value="<?= aman($cat) ?>"
                <?= $article['category'] === $cat ? 'selected' : '' ?>>
                <?= aman($cat) ?>
            </option>

            <?php endforeach; ?>

        </select>

        <label>Ringkasan</label>
        <textarea name="excerpt" rows="3"
                  class="w-full border p-3 rounded mb-4"><?= aman($article['excerpt']) ?></textarea>

        <label>Isi Artikel</label>
        <textarea name="content" rows="10" required
                  class="w-full border p-3 rounded mb-5"><?= aman($article['content']) ?></textarea>

        <button type="submit"
                class="bg-blue-700 text-white px-6 py-3 rounded">
            Update Artikel
        </button>

        <a href="dashboard.php" class="ml-3">
            Kembali
        </a>

    </form>

</div>

</body>
</html>
