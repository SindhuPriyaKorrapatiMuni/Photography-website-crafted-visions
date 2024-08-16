<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$session_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
?>
