<?php
require_once 'Database.php';

class Announcement extends Database {
    public $id;
    public $title;
    public $image;
    public $id_pamq_categories;
    public $id_pamq_users;
    public $description;

    public function registerAnnouncement()
    {
        $query = "INSERT INTO `pamq_announcement`(`title`, `id_pamq_categories`,`image`, `description`,`id_pamq_users`) 
                VALUES (:title, :id_pamq_categories, :image, :description, :id_pamq_users);";

        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':title', $this->title, PDO::PARAM_STR);
        $queryExecute->bindValue(':id_pamq_categories', $this->id_pamq_categories, PDO::PARAM_STR);
        $queryExecute->bindValue(':image', $this->image, PDO::PARAM_STR);
        $queryExecute->bindValue(':description', $this->description, PDO::PARAM_STR);
        $queryExecute->bindValue(':id_pamq_users', $this->id_pamq_users, PDO::PARAM_STR);
        return $queryExecute->execute();
    }
}