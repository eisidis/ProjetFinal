<?php
require_once 'Database.php';

class User extends Database
{
    public $id;
    public $username;
    public $password;
    public $email;
    public $phone;


    public function getAllUser()
    {
        $query = "SELECT * FROM `pamq_users`";
        $queryExecute = $this->db->query($query);
        return $queryExecute->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * get user by email
     * @param string $email - email of the user to get
     * @return object|bool - user or false
     */
    public function getUserByEmail()
    {
        $query = "SELECT * FROM `pamq_users` WHERE `email` = :email";
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryExecute->execute();
        return $queryExecute->fetch(PDO::FETCH_OBJ);
    }

    public function getUserByUsername()
    {
        $query = "SELECT * FROM `pamq_users` WHERE `username` = :username";
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':username', $this->username, PDO::PARAM_STR);
        $queryExecute->execute();
        return $queryExecute->fetch(PDO::FETCH_OBJ);
    }

    public function getUserById()
    {
        $query = "SELECT * FROM `pamq_users` WHERE `id` = :id";
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryExecute->execute();
        return $queryExecute->fetch(PDO::FETCH_OBJ);
    }

    public function register()
    {
        $query = "INSERT INTO `pamq_users`(`username`,`password`, `email`, `phone`) 
                    VALUES (:username, :password, :email, :phone);";

        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':username', $this->username, PDO::PARAM_STR);
        $queryExecute->bindValue(':password', $this->password, PDO::PARAM_STR);
        $queryExecute->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryExecute->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        return $queryExecute->execute();
    }

    // Deletes the user by id
    public function delete()
    {
        $query = "DELETE FROM `pamq_users` WHERE `id` = :id;";
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryExecute->execute();
    }

    // If an input is not filled then retrieve the information from the database
    public function modify()
    {
        $query = "SELECT * FROM `pamq_users` WHERE `id` = :id";
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryExecute->execute();
        $dataUser =  $queryExecute->fetch(PDO::FETCH_OBJ);

        $query = "UPDATE `pamq_users` SET `email`= :email, `password` = :password, `phone` = :phone WHERE `id` = :id;";
        $queryExecute = $this->db->prepare($query);
        $queryExecute->bindValue(':email', (empty($_POST['newEmail']) ? $dataUser->email : $this->email), PDO::PARAM_STR);
        $queryExecute->bindValue(':password', (empty($_POST['newPassword']) ? $dataUser->password : $this->password), PDO::PARAM_STR);
        $queryExecute->bindValue(':phone', (empty($_POST['newPhone']) ? $dataUser->phone : $this->phone), PDO::PARAM_STR);
        $queryExecute->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryExecute->execute();
        var_dump($dataUser);
    }
}
