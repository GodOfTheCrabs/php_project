<?php

include '../functions.php';
include "../models/Model.php";
include '../models/Event.php';
include '../classes/ValidateAdmin.php';

try {
    $valid = new ValidateAdmin($_POST);
    $valid->empty()->minStr( ['title', 'event_description'], 10);
    Event::add($_POST);
    header('Location: index.php?mess=add_event');
} catch (Exception $e) {
    header("Location: index.php?error=" . $e->getMessage());
}