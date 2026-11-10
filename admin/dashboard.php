
<?php
require_once '../config/database.php';
require_once '../includes/function.php';

wajibLogin();

$stmt = $pdo->query(
    "SELECT * FROM articles ORDER BY created_at DESC"
);

$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-6xl mx-auto p-6">

    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-3xl font-bold text-blue-700">
                Dashboard CekFakta
            </h1>

            <p class="text-gray-500">
                Selamat datang, <?= aman($_SESSION['admin_username']) ?>
            </p>
        </div>

        <a href="logout.php"
           class="bg-red-600 text-white px-4 py-2 rounded-lg">
            Logout
        </a>

    </div>

    <a href="tambah.php"
       class="inline-block bg-blue-700 text-white px-5 py-3 rounded-lg mb-6">
        + Tambah Artikel
    </a>

    <div class="bg-white rounded-xl shadow-sm overflow-x-auto">

        <table class="w-full text-left">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-4">Judul</th>
                    <th class="p-4">Kategori</th>
                    <th class="p-4">Tanggal</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php foreach ($articles as $article): ?>

            <tr class="border-t">

                <td class="p-4">
                    <?= aman($article['title']) ?>
                </td>

                <td class="p-4">
                    <?= aman($article['category']) ?>
                </td>

                <td class="p-4">
                    <?= date('d-m-Y', strtotime($article['created_at'])) ?>
                </td>

                <td class="p-4 whitespace-nowrap">

                    <a href="edit.php?id=<?= $article['id'] ?>"
                       class="text-blue-600">
                        Edit
                    </a>

                    |

                    <a href="hapus.php?id=<?= $article['id'] ?>"
                       onclick="return confirm('Yakin ingin menghapus artikel?')"
                       class="text-red-600">
                        Hapus
                    </a>

                </td>

            </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

    <a href="../index.php"
       class="inline-block mt-6 text-blue-700">
        ← Lihat Website
    </a>

</div>

</body>
</html>
