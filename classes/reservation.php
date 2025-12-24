<?php

require_once "../config/database.php";

class Utilisateur {

    protected PDO $pdo;
    protected $id;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $password;
    protected $role;

    public function __construct($pdo, $nom, $prenom ,$email, $password, $role)
    {
        $this->pdo = $pdo;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getnom(){
        return $this->nom;
    }

    public function setnom($nom){
        $this->nom = $nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getPassword(){
        return $this->password;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getRole(){
        return $this->role;
    }

    public function setRole($role){
        $this->role = $role;
    }

    public function insertUser($nom, $prenom, $email, $password, $role){

        $sql = "INSERT INTO users (nom, prenom, email, mot_de_passe, role) VALUES (:nom, :prenom,:email, :password, :role)";
        $stmt = $this->pdo->prepare($sql);


        $insert =  $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':role' => $role
        ]);

        if (!$insert){
            return false;
        }

        $userId = $this->pdo->lastInsertId();


        if ($role === 'coach') {

            $sqlCoach = "INSERT INTO coach (user_id, discipline, experience, description)
                VALUES (:user_id, :discipline, :experience, :description)";

            $stmtCoach = $this->pdo->prepare($sqlCoach);
            $stmtCoach->execute([
                ':user_id' => $userId,
                ':discipline' => $_POST['discipline'],
                ':experience' => $_POST['experience'],
                ':description' => $_POST['description']
            ]);
        }
        return $userId;
    }

}

?>