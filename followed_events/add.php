<?php

include '../functions.php';
include "../models/Model.php";
include "../models/Event.php";
include '../models/FollowedEvent.php';

$data['event_id'] = $_GET['event_id'];
$followed_event = FollowedEvent::findOneEvent($data);
try {

    if ($followed_event) {
        throw new Exception("following_event");
    }

    FollowedEvent::add($_GET);
    header('Location: ../view/event.php?id=' . $_GET['event_id'] . '&mess=add_followed_event');
} catch (Exception $e) {
    header("Location: ../view/event.php?id=" . $_GET['event_id'] . "&error=" . $e->getMessage());
}