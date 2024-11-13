<?php

class FollowedEvent extends Event {
    public static function add($data) {
        self::connect();
        $sql = 'INSERT INTO `followed_events`(`user_id`, `event_id`) VALUES (:user_id,:event_id)';
        $stmt = self::$db->prepare($sql);
        $result = $stmt->execute($data);
        if(!$result) {
            throw new Exception('add_followed_event');
        }
    }
    public static function deleteFollowedEvent($data) {
        self::connect();
        $sql = "DELETE FROM `followed_events` WHERE `event_id` = :event_id AND `user_id` = :user_id" ;
        $stmt = self::$db->prepare($sql);
        return $stmt->execute($data);
    }

    public static function findOneEvent($data) {
        self::connect();
        $sql = "SELECT * FROM `followed_events` WHERE `event_id` = :event_id";
        $stmt = self::$db->prepare($sql);
        $stmt->execute($data);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}