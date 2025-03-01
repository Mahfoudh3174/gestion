<?php
 class Enfant{
    private $id;
    private $nom ;
    private $prenom;
    private $adresse;
    private $tel; 

    public function __construct(){}

    public function getId(){
        return $this->id;
    }
    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function getTel() {
        return $this->tel;
    }



    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    public function setTel($tel) {
        $this->tel = $tel;
    }


    public function setId($id) {
        $this->id = $id;
    }
}
?>