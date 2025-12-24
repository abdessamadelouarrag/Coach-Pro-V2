<?php 
require_once "../config/database.php";
require_once "utilisateur.php";

class Sportif{
    private PDO $pdo;
    protected $iduser;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insertSportif()
    {
        $sql = "INSERT INTO sportif (id_user)
                VALUES (:id_user)";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id_user' => $this->iduser,
        ]);
    }
}


// $sportifnew = new sportif("samir ss", "samir@gmail.com", "azerty33");
// echo $sportifnew->getName();
// echo "<br>";
// echo $sportifnew->getEmail();
// echo "<br>";
// echo $sportifnew->getPassword();

?>