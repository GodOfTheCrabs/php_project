<?php

class UserToken extends Model {
    public static function add($data) {
        self::connect();
        $sql = 'INSERT INTO `tokens` (user_id, token, expiry) VALUES (:user_id, :token, :expiry) ON DUPLICATE KEY UPDATE token = VALUES(token), expiry = VALUES(expiry)';
        $stmt = self::$db->prepare($sql);
        $result =  $stmt->execute($data);
        if(!$result) {
            throw new Exception('add_user');
        }
    }

    public static function getUserIdByToken($token) {
        self::connect();
        $sql = 'SELECT `user_id` FROM `tokens` WHERE `token` = :token AND expiry > NOW()';
        $stmt = self::$db->prepare($sql);
        $stmt->execute([':token' => $token]);
        return $stmt->fetchColumn();
    }
    public static function edit($data) {
        
    }
}