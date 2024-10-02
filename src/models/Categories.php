<?php
require_once 'Database.php';

class Categories extends Database
{
    public $id;
    public $name;


    public function getAll()
    {
        $query = "SELECT * FROM `pamq_categories`";
        $queryExecute = $this->db->query($query);
        return $queryExecute->fetchAll(PDO::FETCH_OBJ);
    }
}
