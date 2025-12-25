<?php

require_once "../config/database.php";
require_once "utilisateur.php";

class Seances
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function createDispo($date, $heure_debut, $heure_fin, $idcoach)
    {
        $sql = "INSERT INTO seances (date_seance, heure_debut, heure_fin, id_coach)
                VALUES (:date, :heure_debut, :heure_fin, :idcoach)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ":date" => $date,
            ":heure_debut" =>  $heure_debut,
            ":heure_fin" => $heure_fin,
            ":idcoach" => $idcoach,
        ]);
    }

    public function fetchseances($id_coach)
    {
        $sql = "SELECT * FROM seances where id_coach = :idcoach";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":idcoach" => $id_coach,
        ]);

        return $stmt->fetchAll(pdo::FETCH_ASSOC);
    }

    public function deletseances($id_seance){
        $sql = "DELETE FROM seances where id_seances = :idseance";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":idseance" => $id_seance,
        ]);
    }
}
