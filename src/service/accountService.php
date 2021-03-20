<?php 
    include '../classes/autoloader.php';

    class accountService  {
        private database $db;
        private mysqli $conn;
        private helper $helper;
        public function __construct() {
            $this->db = database::getInstance();

            $this->conn = $this->db->getConnection();

            $this->helper = new helper();
        }

        /*
        * getAccountByCredentials - checks account credentials in the database and return it if correct
        *
        * @param string $email - string to check for emails
        * @param string $password - inputted password
        *
        * @return user || null - logged in user
        */
        public function getAccountByCredentials(string $email, string $password) : ?cmsUser
        {
            // Build query
            $query = "SELECT * FROM cms_users WHERE email=? AND isActive=1 LIMIT 1";

            // Escpage email data
            $emailEscaped = htmlspecialchars($email);

            if($stmt =  $this->conn->prepare($query)) {
                // Create bind params to prevent sql injection
                $stmt->bind_param("s", $emailEscaped);
    
                // Execute query
                $stmt->execute();
    
                // Get the result
                $result = $stmt->get_result();
    
                // If email cannot be found return null
                if($result->num_rows == 0){
                    return null;
                }

                // Fetch data
                $fetchedResults = $result->fetch_assoc();
    
                // Check if inputted password is equal to the hashed password in the database
                $verifiedPassword = password_verify($password, $fetchedResults["password"]);
    
                // If passwordss are equal
                if (password_verify($password, $fetchedResults["password"])) {
                    // Create user
                    return $this->createUser($fetchedResults, $password);
                }
            }
            
            // If password invalid return null
            return null;
        }

        /*
        * createUser - creates one cmsUser class
        *
        * @param $result - result of the query
        * @param string $password - inputted password
        *
        * @return cmsUser - logged in user
        */
        private function createUser($result, $password) : ?cmsUser
        {
            // Check rows in the $results
            while($row = $result) {
                // return user class
                return new cmsUser(
                    (int)$row["users_id"], 
                    $row["name"], 
                    $row["email"], 
                    $password, 
                );
            }

            return null;
        }

        /*
        * addUser - adds user to the database
        *
        * @param user $user - new user
        */
        public function addUser(cmsUser $user) : void
        {
            // Build query
            $sql = "INSERT INTO cms_users (name, email, password) VALUES (?,?,?)";

            // Get connection
            $connection =  $this->conn;

            // preapre statement
            if($query = $connection->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param(
                    "sss",
                    $name,
                    $email,
                    $password,
                );
                
                // Add values to params
                $name = $user->name;
                $email = $user->email;
                $password = $user->password;

                // Execute query
                $query->execute();
            } else {
                // If connection cannot be established, throw an error
                throw new Exception("Cannot add a new user. please try again.");
            }
        }

        /*
        * getUsersCountByEmail - checks if email already exists in the database
        *
        * @param string $userEmail - string to check for emails
        * @return int $result - number of occurences
        */
        public function getUsersCountByEmail(string $userEmail) : int
        {
            // Build query
            $query = "SELECT * FROM cms_users WHERE email = ?";

            // Get connection and prepare statement
            if($stmt = $this->conn->prepare($query)) {
                // Create bind params to prevent sql injection
                $stmt->bind_param("s", $userEmail);
    
                // Execute query
                $stmt->execute();
    
                // Get the result
                $result = $stmt->get_result();
               
                // Return number of occurences
                return $result->num_rows;
            } else {
                // If connection cannot be established, throw an error
                throw new Exception("Something went wrong. We could not get your account. Please try again.");
            }
        }

        /**
        * activateAccount - activates user's account
        *
        * @param string $email - email of the account that needs to be activated
        */
        public function activateAccount(string $email) : void
        {
            // Build query
            $sql = "UPDATE cms_users SET isActive=1 WHERE email=?";

            // Get connection / preapre statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param(
                    "s",
                    $emailParam
                );
                
                // Add values to params
                $emailParam = $email;

                // Execute query
                $query->execute();
            } else {
                // If connection cannot be established, throw an error
                throw new Exception("Something went wrong. We could not activate your account. Please try again.");
            }
        }

        /**
        * changeUserPassword - updates password of the logged in user
        *
        * @param string $email - email of the user
        * @param string $passowrd - new password of the user
        */
        public function changeUserPassword(string $email, string $password) : void
        {
            // Build query
            $sql = "UPDATE cms_users SET password=? WHERE email=?";

            // Get connection and prepare statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param("ss", $passwordParam, $emailParam);

                // Add values to params
                $passwordParam = $this->helper->encryptPassword($password);
                $emailParam = $email;
                
                // Execute query
                $query->execute();
            } else {
                // If connection cannot be established, throw an error
                throw new Exception('Could not reset the password. Please try again');
            }
        }
    }

    
?>