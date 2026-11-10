
<?php
require_once '../config/database.php';
require_once '../includes/function.php';

wajibLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $excerpt = trim($_POST['excerpt'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if ($title && $category && $content) {

        $stmt = $pdo->prepare(
            "INSERT INTO articles
            (title, category, excerpt, content)
            VALUES (?, ?, ?, ?)"
        );

        $stmt->execute([
            $title,
            $category,
            $excerpt,
            $content
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
    <title>Tambah Artikel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">

<div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow">

    <h1 class="text-2xl font-bold mb-6">
        Tambah Artikel Baru
    </h1>

    <form method="POST">

        <label>Judul Artikel</label>
        <input type="text" name="title" required
               class="w-full border p-3 rounded mb-4">

        <label>Kategori</label>
        <select name="category" required
                class="w-full border p-3 rounded mb-4">

            <option value="Edukasi Digital">Edukasi Digital</option>
            <option value="Berita Hoaks">Berita Hoaks</option>
            <option value="Literasi Media">Literasi Media</option>
            <option value="Tips">Tips</option>

        </select>

        <label>Ringkasan Artikel</label>
        <textarea name="excerpt" rows="3"
                  class="w-full border p-3 rounded mb-4"></textarea>

        <label>Isi Artikel</label>
        <textarea name="content" rows="10" required
                  class="w-full border p-3 rounded mb-5"></textarea>

        <button type="submit"
                class="bg-blue-700 text-white px-6 py-3 rounded">
            Simpan Artikel
        </button>

        <a href="dashboard.php"
           class="ml-3 text-gray-600">
            Kembali
        </a>

    </form>

</div>

</body>
</html>
