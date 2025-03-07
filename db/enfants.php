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
        // Prepare the SQL query to insert the data
        $sql = "INSERT INTO enfants (nom, prenom, adresse, tel) VALUES ( ?, ?, ?, ?)";

        global $conn;  // Assuming $conn is your mysqli connection

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind the parameters for the query
            $stmt->bind_param("ssss", $nom, $prenom, $adresse, $tel);

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

        // Prepare SQL query to check if the child already exists based on nom, prenom, and tel
        $sql = "SELECT * FROM enfants WHERE nom=? AND prenom=? AND tel=?";
        
        if ($stmt = $conn->prepare($sql)) {
            // Bind the parameters
            $stmt->bind_param("sss", $nom, $prenom, $tel);

            // Execute the query
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();

            // Check if a row was found
            if ($result->num_rows > 0) {
                return true;
            }
        }
        return false;  // No match found or password mismatch
    }


    public function getEnfants() {
        $sql = "SELECT * FROM enfants";
        global $conn;  // Assuming $conn is your mysqli connection
        $result = $conn->query($sql);
        return $result;
    }
    public function deleteEnfant($id) {
        $sql = "DELETE FROM enfants WHERE id = ?";
        global $conn;  // Assuming $conn is your mysqli connection
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                return true;
            }
        }
        return false;
    }
 
    public function findEnfant($id) {
        $sql = "SELECT * FROM enfants WHERE id = ?";
        global $conn;  // Assuming $conn is your mysqli connection
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                return $result;
            }
        }
        return null;
    }

    public function updateEnfant(Enfant $enfant)
    {
        global $conn;  
         $nom= $enfant->getNom();
         $prenom= $enfant->getPrenom();
         $adresse = $enfant->getAdresse();
         $tel = $enfant->getTel();
         $id= $enfant->getId();
        // Prepare SQL query (update only if values are provided)
        $sql = "UPDATE enfants SET nom = ?, prenom = ?, adresse = ?, tel = ? WHERE id = ?";
        
        // Check if password is set
        
    
        // Prepare and execute query
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $nom, $prenom, $adresse, $tel, $id);
        
        $success = $stmt->execute();
        
        $stmt->close();
        $conn->close();
    
        return $success;
    }

}
 


?>
