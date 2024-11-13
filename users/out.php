<?php
session_start();


if (isset($_COOKIE['remember_me'])) {
    setcookie('remember_me', '', time() - 3600, "/"); 
}

unset($_SESSION["id"]);  
session_destroy();

header('Location: ../view/index.php');
exit();