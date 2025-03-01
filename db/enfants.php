<?php

require __DIR__ . '/../connect.php'; // Database connection

class ManageEnfant {

    // Method to add a new child (enfant)
    public function ajouterEnfant(Enfant $en) {
        // Sécuriser les données avant insertion
        $nom = $en->getNom();
        $prenom = $en->getPrenom();
        $adresse = $en->getAdresse();
        $tel = $en->getTel();
        $password = $en->getPassword();  // This should already be hashed
        $passwordHash = password_hash($password, PASSWORD_DEFAULT); // Sécurisation du mot de passe
        // Prepare the SQL query to insert the data
        $sql = "INSERT INTO enfants (nom, prenom, adresse, tel, password) VALUES (?, ?, ?, ?, ?)";

        global $conn;  // Assuming $conn is your mysqli connection

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind the parameters for the query
            $stmt->bind_param("sssss", $nom, $prenom, $adresse, $tel, $passwordHash);

            // Execute the query and check for success
            if ($stmt->execute()) {
                return true;  // Successfully inserted
            }
        }
        return false;  // Failed to insert
    }

    // Method to check if a child already exists in the database
    public function isExiste(Enfant $en): bool {
        global $conn;
        $nom = $en->getNom();
        $prenom = $en->getPrenom();
        $tel = $en->getTel();
        $password = $en->getPassword();  // This should be a plain password for comparison

        // Prepare SQL query to check if the child already exists based on nom, prenom, and tel
        $sql = "SELECT password FROM enfants WHERE nom=? AND prenom=? AND tel=?";
        
        if ($stmt = $conn->prepare($sql)) {
            // Bind the parameters
            $stmt->bind_param("sss", $nom, $prenom, $tel);
            
            // Execute the query and check for results
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $storedHash = $result->fetch_assoc()['password'];  // Fetch the stored hashed password
                // Check if the input password matches the stored hashed password
                if (password_verify($password, $storedHash)) {
                    return true;  // The child exists (password matches)
                }
            }
        }
        return false;  // No match found or password mismatch
    }
    public function isAdmin($email, $password): bool {
        
        global $conn;
        $stmt=$conn->prepare( "SELECT password FROM admin WHERE email = ?");
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
    
    public function login($tel, $password) {
        global $conn;
        $stmt=$conn->prepare( "SELECT password FROM enfants WHERE tel = ?");
        $stmt->bind_param("s", $tel);
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

}
 


?>
