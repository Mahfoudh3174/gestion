<?php

require __DIR__ . '/../connect.php'; // Database connection
class ManageEmploye{
    public function __construct(){}


    public function login($email, $password) {
        global $conn;
        $stmt=$conn->prepare( "SELECT password FROM employes WHERE email = ? ");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $storedHash = $result->fetch_assoc()['password'];  // Fetch the stored hashed password
            // Check if the input password matches the stored hashed password
            if (password_verify($password, $storedHash)) {
                return true;
            }
        }
        return false;
    }
    public function isExiste(Employe $em){
        $email = $em->getEmail();
        $sql = "SELECT * FROM employes WHERE email = ?";
        global $conn;  // Assuming $conn is your mysqli connection
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                return true;
            }
        }
        return false;
    }
    public function addEmploye(Employe $em){
        $email = $em->getEmail();
        $password = $em->getPassword();
        $nom= $em->getNom();
        $prenom= $em->getPrenom();
        $adresse = $em->getAdresse();
        $tel = $em->getTel();


        $passwordHash = password_hash($password, PASSWORD_DEFAULT); // Sécurisation du mot de passe

        $sql = "INSERT INTO employes (nom, prenom, adresse,tel,email, password) VALUES (?, ?,?, ?, ?, ?)";

        global $conn;  // Assuming $conn is your mysqli connection

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind the parameters for the query
            $stmt->bind_param("ssssss", $nom, $prenom, $adresse,$tel, $email, $passwordHash);

            // Execute the query and check for success
            if ($stmt->execute()) {
                return true;
            }
        }
        return false;
    }

    public function getEmployes() {
        $sql = "SELECT * FROM employes";
        global $conn;  // Assuming $conn is your mysqli connection
        $result = $conn->query($sql);
        return $result;
    }
}
?>