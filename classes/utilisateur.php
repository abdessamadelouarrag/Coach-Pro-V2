<?php

class Utilisateur{
    private PDO $pdo;
    protected $id;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $password;
    protected $role;
    
    
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
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


    public function insertUser()
    {
        $sql = "INSERT INTO users (nom, prenom, email, mot_de_passe, role)
                VALUES (:nom, :prenom, :email, :mot_de_passe, :role)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $this->nom,
            ':prenom' => $this->prenom,
            ':email' => $this->email,
            ':mot_de_passe' => password_hash($this->password, PASSWORD_DEFAULT),
            ':role' => $this->role
        ]);

        return $this->pdo->lastInsertId();
    }

    public function login(){

        $sql = "SELECT * FROM users WHERE email = :email";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute(
            [':email' => $this->email]
        );

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return false;
        }
        if (!password_verify($this->password, $user['mot_de_passe'])) {
            return false;
        }

        return $user;
    }
}

// $email1 = new Utilisateur("nom", "prenom", "abde@gmail.com", "azerty1234", "role");
// echo "email is :" . $email1->getEmail();
// echo "<br>";
// echo "password is :" . $email1->getPassword();