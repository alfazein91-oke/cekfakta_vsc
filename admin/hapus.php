
<?php
require_once '../config/database.php';
require_once '../includes/function.php';

wajibLogin();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    $stmt = $pdo->prepare(
        "DELETE FROM articles WHERE id = ?"
    );

    $stmt->execute([$id]);
}

header("Location: dashboard.php");
exit;
?>
