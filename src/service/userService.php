<?php
    class userService {
        private database $db;
        private mysqli $conn;
        private helper $helper;
        
        public function __construct() {
            $this->db = database::getInstance();

            $this->conn = $this->db->getConnection();

            $this->helper = new helper();
        }

        /**
         * @param cmsUser - logged in user
         * @return array cmsUser - list of cmsUsers expect the logged in user
         * @return null if nothing is found
         */
        public function getUsers(cmsUser $user) : array {
            $query = "SELECT * FROM cms_users WHERE users_id <> $user->id"; // No user input, so binding would be redundant

            if ($result = $this->conn->query($query)) {
                return $this->createAccountList($result);
            } else {
                // If connection could not be established throw an error
                throw new Exception('Something went  wrong. We could not retrieve the users. Please try again.');
            }

            return null;
        }

        /**
         * @param cmsUserId - id of the selected account
         * @return array artists - list of artist without their songs, because it will not be shown in the list
         */
        public function getUser(int $cmsUserId) : ?cmsUser {
            $query = "SELECT * FROM cms_users WHERE users_id=? LIMIT 1";


            if($stmt =  $this->conn->prepare($query)) {
                // Create bind params to prevent sql injection
                $stmt->bind_param("i", $id);
                $id = htmlspecialchars($cmsUserId);

                // Execute query
                $stmt->execute();
    
                // Get the result
                $result = $stmt->get_result();
    
                $account = $this->createAccountList($result);

                if(empty($account)){
                    return null;
                }

                return $account[0];
            } else {
                // If connection could not be established throw an error
                throw new Exception('Something went  wrong. We could not retrieve the users. Please try again.');
            }

            return null;
        }

         /**
        * updateUser - updates specific user data
        *
        * @param string $email - new email value from post 
        * @param string $name - new name value from post
        * @param int $id - current active user id
        */
        public function updateUser(string $email, string $name, int $id) : void
        {
            // Build query
            $sql = "UPDATE cms_users SET name=?, email=? WHERE users_id=?";

            // Get connection / preapre statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param(
                    "ssi",
                    $nameParam,
                    $emailParam,
                    $idParam
                );

                $nameParam = htmlspecialchars($name);
                $emailParam = htmlspecialchars($email);
                $idParam = intval(htmlspecialchars($id));

                // Execute query
                $query->execute();
            } else {
                // If connection cannot be established, throw an error
                throw new Exception("Something went wrong. We could not update the account. Please try again.");
            }
        }

        /**
        * deleteUser - deletes specific user from database, based on id
        *
        * @param int $id - current active user id
        */
        public function deleteUser(int $id)
        {
            // Build query
            $sql = "DELETE FROM cms_users WHERE users_id=?";

            // Get connection / preapre statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param(
                    "i",
                    $id
                );
                
                // Execute query
                $query->execute();
            } else {
                // If connection cannot be established, throw an error
                throw new Exception("Something went wrong. We could not update the account. Please try again.");
            }
        }

        /**
         * @param result - result of account query
         * @return array cmsUser - list of accounts without their passwords encrypted
         */
        public function createAccountList($result) : array
        {
            $accountList = array();
                
            while($row = $result->fetch_assoc()) {
                $account = new cmsUser(
                    (int)$row["users_id"], 
                    $row["name"], 
                    $row["email"], 
                    $row["password"], 
                );

                $accountList[] = $account;
            }

            return $accountList;
        }
    }
?>