<?php

include '../functions.php';
include "../models/Model.php";
include '../models/User.php';
include '../models/UserToken.php';

session_start();

$rememberMe = isset($_POST['remember_me']);

$user = User::getUserByEmail($_POST['email']);
if ($user == null) {
    header("Location: ../view/login_form.php?error=email");
}
elseif(!password_verify($_POST['password'], $user['password'])) { 
    
    header("Location: ../view/login_form.php?error=password");
} 
else {
    if($rememberMe) {
        $token = bin2hex(random_bytes(32));
        $expiry = time() + (86400 * 30);
        $data['user_id'] = $user['id'];
        $data['token'] = $token;
        $data['expiry'] = date('Y-m-d H:i:s', $expiry);
        UserToken::add($data);
        setcookie('remember_me', $token, $expiry, "/");
    }
    $_SESSION['id'] = $user['id'];
    header('Location: ../view/index.php?mess=login');
}