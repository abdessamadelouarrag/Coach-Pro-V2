<?php 
require_once "../config/database.php";
require_once "utilisateur.php";

class Sportif extends Utilisateur{
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

    public function infosportif($iduser){
        $sql = "SELECT * from users where id_user = :iduser";

        $stmt =$this->pdo->prepare($sql);
        $stmt->execute([
            ':iduser' => $iduser,
        ]);

        return $stmt->fetch(pdo::FETCH_ASSOC);
    }
    
    public function getSportifIdByUserId($iduser) {
        $sql = "SELECT id_sportif FROM sportif WHERE id_user = :iduser";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':iduser' => $iduser]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            return $result['id_sportif'];
        }
        
        $sqlInsert = "INSERT INTO sportif (id_user) VALUES (:iduser)";
        $stmtInsert = $this->pdo->prepare($sqlInsert);
        $stmtInsert->execute([':iduser' => $iduser]);
        return $this->pdo->lastInsertId();
    }
}
?>