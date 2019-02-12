<?php

include('password.php');

class User extends Password {

    private $_pdo;

    function __construct($pdo){
        parent::__construct();
        $this->_pdo = $pdo;
    }

    private function get_user_hash($username){
        try {
            $stmt = $this->_pdo->prepare('SELECT * FROM members WHERE username = :username AND active="Yes" ');
            $stmt->execute(array('username' => $username));
            return $stmt->fetch();
        } catch(PDOException $e) {
            echo '<p class="bg-danger">'.$e->getMessage().'</p>';
        }
    }

    public function isValidUsername($username) {
        if (strlen($username) < 3) return false;
        if (strlen($username) > 17) return false;
        if (!ctype_alnum($username)) return false;
        return true;
    }

    public function login($username,$password) {
        if (!$this->isValidUsername($username)) return false;
        if (strlen($password) < 3) return false;
        $row = $this->get_user_hash($username);
        if($this->password_verify($password,$row['password']) == 1) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['memberID'] = $row['memberID'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['type'] = $row['type'];  // for user type 1 : admin , 2 : customer
            return true;
        }
    }

    public function logout() {
        session_destroy();
    }

    public function is_logged_in() {
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            return true;
        }
    }

    function checkUser($userData = array()) {
        if(!empty($userData)) {
            // Check whether user data already exists in database
            $prevQuery = "SELECT * FROM " . $this->members
                . " WHERE oauth_provider = '"   . $userData['oauth_provider']
                . "' AND oauth_uid = '"         . $userData['oauth_uid']
                . "'";
            $prevResult = $this->db->query($prevQuery);
            if($prevResult->num_rows > 0){
                // Update user data if already exists
                $query = "UPDATE " . $this->members
                    . " SET first_name = '"         . $userData['first_name']
                    . "', last_name = '"            . $userData['last_name']
                    . "', email = '"                . $userData['email']
                    . " WHERE oauth_provider = '"   . $userData['oauth_provider']
                    . "' AND oauth_uid = '"         . $userData['oauth_uid']
                    . "'";
                $update = $this->db->query($query);
            } else {
                // Insert user data
                $query = "INSERT INTO " . $this->members
                    . " SET oauth_provider = '" . $userData['oauth_provider']
                    . "', oauth_uid = '"    . $userData['oauth_uid']
                    . "', first_name = '"   . $userData['first_name']
                    . "', last_name = '"    . $userData['last_name']
                    . "', email = '"        . $userData['email'];
                $insert = $this->db->query($query);
            }

            // Get user data from the database
            $result = $this->db->query($prevQuery);
            $userData = $result->fetch_assoc();
        }

        // Return user data
        return $userData;
    }
    
}

?>
