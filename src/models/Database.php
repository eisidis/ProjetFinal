<?php
class Database
{
    protected $db;

    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=mysql;dbname=projetFinal;charset=utf8', 'root', 'pw');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function __destruct()
    {
        $this->db = NULL;
    }
}