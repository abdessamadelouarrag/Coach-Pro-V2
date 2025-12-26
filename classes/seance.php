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
            $sql = "SELECT * FROM seances where id_coach = :idcoach and status = 'libre'";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ":idcoach" => $id_coach,
            ]);

            return $stmt->fetchAll(pdo::FETCH_ASSOC);
        }

        public function deletseances($id_seance)
        {
            $sql = "DELETE FROM seances where id_seances = :idseance";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ":idseance" => $id_seance,
            ]);
        }

        public function toreserve($idseance)
        {
            $sql = "UPDATE seances set status = 'reserver' where id_seances = :idseances";

            $stmt = $this->pdo->prepare($sql);

            return $stmt->execute([
                ":idseances" => $idseance,
            ]);
        }

        public function reserveSeanceSimple($date, $heureDebut, $heureFin, $coachId, $userId)
        {
            $sqlCheckRole = "SELECT role FROM users WHERE id_user = :userId";
            $stmtCheckRole = $this->pdo->prepare($sqlCheckRole);
            $stmtCheckRole->execute([':userId' => $userId]);
            $userRole = $stmtCheckRole->fetch(PDO::FETCH_ASSOC);

            if (!$userRole || $userRole['role'] !== 'sportif') {
                return false;
            }

            $sqlGetSportif = "SELECT id_sportif FROM sportif WHERE id_user = :userId";
            $stmtGetSportif = $this->pdo->prepare($sqlGetSportif);
            $stmtGetSportif->execute([':userId' => $userId]);
            $sportif = $stmtGetSportif->fetch(PDO::FETCH_ASSOC);

            if (!$sportif) {
                $sqlCreateSportif = "INSERT INTO sportif (id_user) VALUES (:userId)";
                $stmtCreateSportif = $this->pdo->prepare($sqlCreateSportif);
                $stmtCreateSportif->execute([':userId' => $userId]);
                $sportifId = $this->pdo->lastInsertId();
            } else {
                $sportifId = $sportif['id_sportif'];
            }

            $sql1 = "INSERT INTO reservations 
                    (date_reservation, heure_debut, heure_fin, id_coach, id_sportif, status)
                    VALUES (:date, :hdebut, :hfin, :coach, :sportif, 'en_attente')";

            $stmt1 = $this->pdo->prepare($sql1);
            $ok1 = $stmt1->execute([
                ':date'    => $date,
                ':hdebut'  => $heureDebut,
                ':hfin'    => $heureFin,
                ':coach'   => $coachId,
                ':sportif' => $sportifId
            ]);

            if (!$ok1) return false;

            // Update seance status
            $sql2 = "UPDATE seances SET status = 'reserver' WHERE date_seance = :date
                    AND heure_debut = :hdebut AND heure_fin = :hfin AND id_coach = :coach AND status = 'libre'";

            $stmt2 = $this->pdo->prepare($sql2);
            return $stmt2->execute([
                ':date'   => $date,
                ':hdebut' => $heureDebut,
                ':hfin'   => $heureFin,
                ':coach'  => $coachId
            ]);
        }

        public function deleteseances($reservation){
            $sql = "DELETE FROM reservations where id_reservation = :reservation";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([
                ":reservation" => $reservation,
            ]);
        }
    }
