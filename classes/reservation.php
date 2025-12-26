<?php

require_once "../config/database.php";

class Reservation
{

    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


    public function allresrvation($id_sportif)
    {
        $sql = "SELECT u.nom AS nom_coach, c.specialite, r.date_reservation, r.heure_debut, r.status, r.id_reservation
                FROM reservations r JOIN coaches c ON r.id_coach = c.id_coach 
                JOIN users u ON c.id_user = u.id_user where id_sportif = :idsportif";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':idsportif' => $id_sportif,
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function reservationcoach($idcoach){
        $sql = "SELECT * from reservations where id_coach = :idcoach";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":idcoach" => $idcoach,
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatestatus($idresrvation){
        $sql = "UPDATE reservations set status = 'accepter' where id_reservation = :idreservation";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":idreservation" => $idresrvation,
        ]);
    }

    public function refuserreservation($idresrvation){
        $sql = "UPDATE reservations set status = 'refuser' where id_reservation = :idreservation";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ":idreservation" => $idresrvation,
        ]);
    }
}