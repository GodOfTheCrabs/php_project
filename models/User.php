<?php

class User extends Model  {
   
    use TraitTableUser;
    public static function addFile() {
        $img = new Image($_FILES['photo'], 30000000, ['png', 'jpg']);
        $img->uploadFile('../img/users_photo/');
        return $img->fileName;
    }
    public static function add($data){
        self::connect();
        self::checkEmail($data['email']);
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $data['photo'] = self::addFile();
        } else {
            $data['photo'] = null;
        }
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `phone`, `password`, `gender`, `city`, `photo`) 
        VALUES (:first_name, :last_name, :email, :phone, :password, :gender, :city, :photo)"; 

        $stmt = self::$db->prepare($sql);
        $result =  $stmt->execute($data);
        if(!$result) {
            throw new Exception('add_user');
        }
    }

    public static function editPhoto($data) {
        $sql = "SELECT `photo` FROM `users` WHERE `id` = :id";
        $stmt = self::$db->prepare($sql);
        $stmt->execute(['id' => $data['id']]);
        $oldPhoto = $stmt->fetchColumn();
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] != UPLOAD_ERR_NO_FILE) {
            
            $data['photo'] = self::addFile();

            if ($oldPhoto && file_exists("../img/users_photo/" . $oldPhoto)) {
                unlink("../img/users_photo/" . $oldPhoto);
            }
        } else {
            $data['photo'] = $oldPhoto;
        }
        return $data['photo'];
    }
    public static function edit($data) {
        self::connect();
            
        $data['photo'] = self::editPhoto($data);
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE `users` SET `first_name`= :first_name,`last_name`= :last_name,`email`= :email, `phone` = :phone, `password`= :password, `gender`= :gender, `city`= :city, `photo`= :photo WHERE `id` = :id";
        $stmt = self::$db->prepare($sql);
        $result = $stmt->execute($data);
        if(!$result) throw new Exception('user_edit');
    }
    public static function checkEmail($email) {
        self::connect();
        $sql = 'SELECT COUNT(*) FROM `users` WHERE `email` = :email';
        $stmt = self::$db->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        
        $count = $stmt->fetchColumn();
        
        if ($count > 0) {
            throw new Exception('same_email');
        }
    }

    public static function deletePhoto($data) {
        self::connect();
        $sql = "SELECT `photo` FROM `users` WHERE `id` = :id";
        $stmt = self::$db->prepare($sql);
        $stmt->execute($data);
        $photo = $stmt->fetchColumn();
        if($photo && file_exists('../img/users_photo/' . $photo)) {
            unlink("../img/users_photo/" . $photo );
        }
    }

    public static function getUserByEmail($email) {
        self::connect();
        $sql = "SELECT * FROM `users` WHERE `email` = :email";
        $stmt = self::$db->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function addToken($token, $expiry, $user_id) {
        self::connect();
        $sql = "UPDATE `users` SET `token` = :token, `expiry` = :expiry, WHERE `id` = :id";
        $stmt = self::$db->prepare($sql);
        $stmt->execute([$token, date('Y-m-d H:i:s', $expiry), $user_id]);

        setcookie('remember_me', $token, $expiry, "/"); 
    }
    
}