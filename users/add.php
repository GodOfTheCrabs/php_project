<?php
session_start();

include '../functions.php';
include "../interfaces/Validate.php";
include "../models/Model.php";
include '../models/User.php';
include '../classes/Image.php';
include '../classes/ValidateUser.php';

try {
    $valid = new ValidateUser($_POST);
    $valid->validate();
    unset($_SESSION['register_data']);
    User::add($_POST);
    header('Location: index.php?mess=register_user');
} catch (Exception $e) {
    $_SESSION['register_data'] = $_POST;

    if ($e->getMessage() == 'min_length_password') {
        unset($_SESSION['register_data']['password']);
    }
    if ($e->getMessage() == 'same_email') {
        unset($_SESSION['register_data']['email']);
    }

    header("Location: form_add.php?error=" . $e->getMessage());
}