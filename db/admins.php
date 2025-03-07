<?php
require __DIR__ . '/../connect.php';

class ManageAdmin{

    public function isAdmin($email, $password): bool {
        


        global $conn;
   
        // $sql="SELECT password FROM admin WHERE email='$email'";
        // $result = $conn->query($sql);

        // if ($result->num_rows > 0) {
        //     $storedHash = $result->fetch_assoc()['password'];
        //     if (password_verify($password, $storedHash)) {
        //         return true;
        //     }
        // }
        // return false;
// ' OR '1'='1' UNION SELECT null --

        $stmt=$conn->prepare( "SELECT password FROM admin WHERE email = ?");
        //$stmt=mysqli_prepare($conn, "SELECT password FROM admin WHERE email = ?");
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

}

?>