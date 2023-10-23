<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    unset($_SESSION['username']);
    unset($_SESSION['user_id']);
    header("Location: /web-tour/index.php");
?>