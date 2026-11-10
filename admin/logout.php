
<?php
require_once '../includes/function.php';

$_SESSION = [];

session_destroy();

header("Location: login.php");
exit;
?>
