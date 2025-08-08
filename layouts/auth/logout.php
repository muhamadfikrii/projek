<?php 
    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();

    if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
  setcookie('id', '', time() - 3600, '/'); 
  setcookie('key', '', time() - 3600, '/');
}

    header( "Location: /projek/layouts/auth/login.php");
    exit;
?>