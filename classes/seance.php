<?php

require_once "../config/database.php";
require_once "utilisateur.php";

class Seances{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function createSeance(){
        
    }
}
?>