<?php

require __DIR__ . '/Enfant.php';
class Employe extends Enfant {

    private $email;
    

    public function __construct() {
        
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
}
?>