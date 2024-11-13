<?php

include '../functions.php';
include "../models/Model.php";
include "../models/Event.php";
include '../models/FollowedEvent.php';



$result = FollowedEvent::deleteFollowedEvent($_GET);

if($result) {
    header("Location: ../view/event.php?id=" . $_GET['event_id'] . "&mess=delete_followed_event");
}
else {
    header("Location: ../view/event.php?id=" . $_GET['event_id'] . "&error=delete_teacher");
}