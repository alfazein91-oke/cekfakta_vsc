
<?php
require_once 'config/database.php';

$username = "admin";
$password = password_hash(
    "admin123",
    PASSWORD_DEFAULT
);

$stmt = $pdo->prepare(
    "INSERT INTO admins (username, password)
     VALUES (?, ?)"
);

try {
    $stmt->execute([$username, $password]);

    echo "Admin berhasil dibuat!";

} catch (PDOException $e) {
    echo "Admin gagal dibuat. Username mungkin sudah digunakan.";
}
?>
