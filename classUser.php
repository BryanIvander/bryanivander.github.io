<?php
class Users {
    private $db; 

    public function __construct($db) {
        $this->db = $db;
    }

   //Register
    public function registerUser($nrp, $password) {
       
        $garam = $this->bikinGaram();

      
        $hashedPassword = $this->hashPassword($password, $garam);

      
        $query = "INSERT INTO users (nrp, password, salt) VALUES (?, ?, ?)";
        $nextStep = $this->db->prepare($query);
        $nextStep->bind_param("sss", $nrp, $hashedPassword, $garam);

        if ($nextStep->execute()) {
            return true;
        } else {
            return false;
        }
    }

    //Login untuk index.php nanti
    public function authenticateUser($nrp, $password) {
       
        $query = "SELECT nrp, password, salt FROM users WHERE nrp = ?";
        $nextStep = $this->db->prepare($query);
        $nextStep->bind_param("s", $nrp);
        $nextStep->execute();
        $result = $nextStep->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $hashedPassword = $this->hashPassword($password, $user['salt']);

            if ($hashedPassword === $user['password']) {
                return true;
            }
        }
        return false;
    }

    
    private function bikinGaram() {
        return bin2hex(random_bytes(16));
    }

    
    private function hashPassword($password, $garam) {
        return hash('sha256', $password . $garam);
    }
}
?>






