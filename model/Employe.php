<?php

require 'model/Enfant.php';
class Employe extends Enfant {
    private $id;
    private $nom;
    private $prenom;
    private $adresse;
    private $tel;
    private $email;
    private $password;

    public function __construct($id, $nom, $prenom, $adresse, $tel, $email, $password) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->tel = $tel;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }
}

?>