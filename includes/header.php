
<?php
if (!isset($judul)) {
    $judul = "CekFakta";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= aman($judul) ?> - CekFakta</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">

<header class="bg-white shadow">
    <div class="max-w-6xl mx-auto px-5 py-5 flex justify-between items-center">

        <a href="index.php"
           class="text-2xl font-bold text-blue-700">
            CekFakta.
        </a>

        <nav class="flex gap-5 text-sm font-medium">
            <a href="index.php" class="hover:text-blue-600">
                Beranda
            </a>

            <a href="kategori.php" class="hover:text-blue-600">
                Artikel
            </a>

            <a href="cek-hoaks.php" class="hover:text-blue-600">
                Cek Hoaks
            </a>

            <a href="admin/login.php" class="hover:text-blue-600">
                Admin
            </a>
        </nav>

    </div>
</header>

<main class="max-w-6xl mx-auto px-5 py-8">
