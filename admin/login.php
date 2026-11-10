
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once '../config/database.php';
require_once '../includes/function.php';

if (adminLogin()) {
    header("Location: dashboard.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare(
        "SELECT * FROM admins WHERE username = ?"
    );

    $stmt->execute([$username]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin && password_verify($password, $admin['password'])) {

        session_regenerate_id(true);

        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];

        header("Location: dashboard.php");
        exit;

    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - CekFakta</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="bg-white p-8 rounded-xl shadow-md w-full max-w-md">

    <h1 class="text-2xl font-bold text-center text-blue-700">
        CekFakta Admin
    </h1>

    <p class="text-center text-gray-500 mt-2 mb-6">
        Silakan login untuk mengelola artikel.
    </p>

    <?php if ($error): ?>
        <p class="bg-red-100 text-red-600 p-3 rounded mb-4">
            <?= aman($error) ?>
        </p>
    <?php endif; ?>

    <form method="POST">

        <input type="text" name="username"
               placeholder="Username"
               required
               class="w-full border p-3 rounded mb-4">

        <input type="password" name="password"
               placeholder="Password"
               required
               class="w-full border p-3 rounded mb-5">

        <button type="submit"
                class="w-full bg-blue-700 text-white p-3 rounded-lg">
            Login
        </button>

    </form>

    <a href="../index.php"
       class="block text-center text-blue-600 mt-5">
        Kembali ke Website
    </a>

</div>

</body>
</html>
