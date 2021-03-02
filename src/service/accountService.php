<?php 
    include '../classes/autoloader.php';

    class accountService  {
        protected database $db;
        protected mysqli $conn;

        public function __construct() {
            $this->db = database::getInstance();

            $this->conn = $this->db->getConnection();
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
            $query = "SELECT * FROM cmsUsers WHERE email=?";

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Escpage email data
            $emailEscaped = htmlspecialchars($email);

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
            } else {
                // If password invalid return null
                return null;
            }
        }
        /*
        * createUser - creates one cmsUser class
        *
        * @param $result - result of the query
        * @param string $password - inputted password
        *
        * @return cmsUser - logged in user
        */
        private function createUser($result, $password) : cmsUser
        {
            // Check rows in the $results
            while($row = $result) {
                // return user class
                return new cmsUser(
                    (int)$row["id"], 
                    $row["email"], 
                    $password, 
                );
            }
        }

        /*
        * addUser - adds user to the database
        *
        * @param user $user - new user
        */
        public function addUser(cmsUser $user) : void
        {
            // Build query
            $sql = "INSERT INTO php1Users (name, email, password) VALUES (?,?,?)";

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
                $name = $user->getName();
                $email = $user->getEmail();
                $password = $user->getPassword();

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
            $query = "SELECT * FROM cmsUsers WHERE email = ?";

            // Get connection and prepare statement
            $stmt = self::getConnection()->prepare($query);

            // Create bind params to prevent sql injection
            $stmt->bind_param("s", $userEmail);

            // Execute query
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();
           
            // Return number of occurences
            return $result->num_rows;
        }
    }

    
?>