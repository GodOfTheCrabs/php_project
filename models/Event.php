<?php

require_once '../vendor/autoload.php';

class Event extends Model {
    use TraitTableEvent;

    public static function generateFakeData() {
        $faker = Faker\Factory::create();
        $categories = ['Допомога цивільним', 'Допомога військовим', 'Допомога дітям', 'Донати', 'Сбори речей', 'Робоча сила'];
        $images = ['1.jpg', '2.jpeg', '3.jpg', 'dron.jpg'];
        $random_category = rand(0, 5);
        $random_image = rand(0, 3);
        $fake_title = $faker->sentence($nbwords = 6, $variableNbWords = true);
        $fake_description = $faker->text($maxNbChars = 400);
        return $fake_date = [
            'title' => $fake_title,
            'event_description' => $fake_description,
            'category' => $categories[$random_category],
            'image' => $images[$random_image],
        ];
    }

    public static function add($data){
        self::connect();
        $sql = "INSERT INTO `events`(`title`, `event_description`, `category`, `image`) 
        VALUES (:title, :event_description, :category, :image)"; 

        $stmt = self::$db->prepare($sql);
        $result =  $stmt->execute($data);
        if(!$result) {
            throw new Exception('add_event');
        }
    }

    public static function edit($data) {
        self::connect();
        $sql = "UPDATE `events` SET `title`= :title,`event_description`= :event_description,`category`= :category,`image`= :image WHERE `id` = :id";
        $stmt = self::$db->prepare($sql);
        $result = $stmt->execute($data);
        if(!$result) throw new Exception('edit_event');
    }
}