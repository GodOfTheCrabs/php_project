<?php

include '../functions.php';
include "../models/Model.php";
include '../models/Event.php';

$result = Event::delete($_GET);

if($result) {
    header("Location: index.php?mess=delete_event");
}
else {
    header("Location: index.php?error=delete_event");
}