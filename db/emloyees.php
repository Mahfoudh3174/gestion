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
        
        $nom= $em->getNom();
        $prenom= $em->getPrenom();
        $adresse = $em->getAdresse();
        $tel = $em->getTel();


       

        $sql = "INSERT INTO employes (nom, prenom, adresse,tel,email) VALUES (?,?, ?, ?, ?)";

        global $conn;  // Assuming $conn is your mysqli connection

        // Prepare the statement
        if ($stmt = $conn->prepare($sql)) {
            // Bind the parameters for the query
            $stmt->bind_param("sssss", $nom, $prenom, $adresse,$tel, $email);

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

    public function deleteEmploye($id) {
        $sql = "DELETE FROM employes WHERE id = ?";
        global $conn;  // Assuming $conn is your mysqli connection
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                return true;
            }
        }
        return false;
    }

    public function findEmploye($id) {
        $sql = "SELECT * FROM employes WHERE id = ?";
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
    public function updateEmploye(Employe $employe)
{
    global $conn;  
     $nom= $employe->getNom();
     $prenom= $employe->getPrenom();
     $adresse = $employe->getAdresse();
     $tel = $employe->getTel();
     $email = $employe->getEmail();
     $id= $employe->getId();
    // Prepare SQL query (update only if values are provided)
    $sql = "UPDATE employes SET nom = ?, prenom = ?, adresse = ?, tel = ?, email = ? WHERE id = ?";
    
    // Check if password is set
    

    // Prepare and execute query
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $nom, $prenom, $adresse, $tel, $email, $id);
    
    $success = $stmt->execute();
    
    $stmt->close();
    $conn->close();

    return $success;
}

}
?>