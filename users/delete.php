<?php

include '../functions.php';
include "../models/Model.php";
include '../models/User.php';

User::deletePhoto($_GET);
$result = User::delete($_GET);

if($result) {
    header("Location: index.php?mess=delete_user");
}
else {
    header("Location: index.php?error=delete_user");
}