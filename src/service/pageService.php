<?php
    include '../classes/autoloader.php';

    class pageService {
        private database $db;
        private mysqli $conn;

        public function __construct() {
            $this->db = database::getInstance();

            $this->conn = $this->db->getConnection();
        }

        /*
        * getEventPageContent - gets page content of general pages
        *
        * @param int $id - number of page id in the database 
        * @return stdClass $result - (json) object with page content
        */
        public function getPage(int $id) : ?stdClass
        {
            // Build query
            $query = "SELECT content FROM pages WHERE page_id=?";

            // Get connection and prepare statement
            if($stmt = $this->conn->prepare($query)) {
                // Create bind params to prevent sql injection
                $stmt->bind_param("i", $id);
                
                // Execute query
                $stmt->execute();

                $result = $stmt->get_result();

                if($result->num_rows == 0){
                    return null;
                }

                // Get the result
                $objectResult = $result->fetch_object();
                
                return $objectResult;
            } else {
                // If connection cannot be established, throw an error
                throw new Exception("Something went wrong. We could not get the page content. Please try again.");
            }
        }

        /** 
        * updatePage - updates page content of general pages, based on id
        *
        * @param string (json) $data - POST value encoded to json string  
        * @param array ($_FILES) $files - FILES value for uploading images  
        * @param int $id - number of page id in the database 
        */
        public function updatePage(string $data, array $files, int $page_id) : void
        {
            $sql = "UPDATE pages SET content=? WHERE page_id=?";

            // Get connection and prepare statement
            if($query = $this->conn->prepare($sql)) {
                // Create bind params to prevent sql injection
                $query->bind_param("si", 
                    $data,
                    $page_id
                );

                // Update with tmp name from $_FILES
                foreach ($files as $file) {
                    $this->db->uploadImage($file['tmp_name'], $file['name']);
                }
                
                $query->execute();
            } else {
                // If connection cannot be established, throw an error
                throw new Exception('Could not connect to the database. Please try again');
            }
        }

        /** 
        * updatePage - updates page content of general pages, based on id
        *
        * @param string (json) $data - POST value encoded to json string, minus the to be deleted image value
        * @param string $fileName - Value of to be delete image  
        * @param int $id - number of page id in the database 
        */
        public function deleteImage(string $data, string $fileName, int $pageId)
        {
            if($this->db->deleteImage($fileName)){
                $this->updatePage($data, array(), $pageId);
            } else {
                // If image caanot be deleted, throw an error
                throw new Exception('Could not delete the image. Please try again');
            }
        }
    }

?>