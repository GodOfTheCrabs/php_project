<?php

include '../functions.php';
include '../models/Model.php';
include '../models/Event.php';

$count = (int)$_POST['count'];
for ($i=0; $i < $count; $i++) { 
    $event = Event::generateFakeData();
    Event::add($event);
}

header("Location: index.php");