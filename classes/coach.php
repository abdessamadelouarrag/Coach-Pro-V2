<?php
require_once "../config/database.php";
require_once "utilisateur.php";

class Coacha{
    private PDO $pdo;
    protected $iduser;
    protected $disipline;
    protected $experience;
    protected $description;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getiduser(){
        $this->iduser;
    }

    public function setiduser($iduser){
        $this->iduser = $iduser;
    }

    public function getspecialite(){
        $this->disipline;
    }

    public function setspecialite($discipline){
        $this->disipline = $discipline;
    }

    public function getexperience(){
        $this->experience;
    }

    public function setexperience($experience){
        $this->experience = $experience;
    }

    public function getdescription(){
        $this->description;
    }

    public function setdescription($description){
        $this->description = $description;
    }

    public function insertCoach()
    {
        $sql = "INSERT INTO coaches (id_user, specialite, experiences, bio)
                VALUES (:user_id, :specialite, :experiences, :bio)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':user_id' => $this->iduser,
            ':specialite' => $this->disipline,
            ':experiences' => $this->experience,
            ':bio' => $this->description
        ]);

        return $stmt->fetch(pdo::FETCH_ASSOC);
    }
}


?>