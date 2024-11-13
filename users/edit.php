<?php

include '../functions.php';
include '../interfaces/Validate.php';
include "../models/Model.php";
include '../models/User.php';
include '../classes/ValidateUser.php';
include '../classes/Image.php';

$user = User::findOne($_GET);

try {
    $valid = new ValidateUser($_POST);
    $valid->validate();
    if($_POST['email'] == $user['email']) {
        User::edit($_POST);
    } else {
        User::checkEmail($_POST['email']);
        User::edit($_POST);
    }
    header('Location: ../view/profile.php?mess=user_edit');
} catch (Exception $e) {
    header("Location: ../users/edit_form.php?id=" . $user['id'] . "&error=" . $e->getMessage());
}