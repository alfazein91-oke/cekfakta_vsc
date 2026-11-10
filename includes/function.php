
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function aman($data) {
    return htmlspecialchars(
        $data ?? '',
        ENT_QUOTES,
        'UTF-8'
    );
}

function adminLogin() {
    return isset($_SESSION['admin_id']);
}

function wajibLogin() {
    if (!adminLogin()) {
        header("Location: login.php");
        exit;
    }
}
?>
