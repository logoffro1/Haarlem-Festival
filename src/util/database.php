<?php
include '../config/config.php';

class database {
    private mysqli $conn;
    private static $database;

    private function __construct(){
        $this->conn = $this->dbConnect();
    }

    /** 
     * Static method to create an object instance once. 
     * After that it will reuse it for all other requests.
     * 
     * @return database
    */
    public static function getInstance() : database
    {
        if(is_null(self::$database)){
            self::$database = new database();
        }

        return self::$database;
    }

    // Get connection to the database
    public function getConnection() : mysqli {
        return $this->conn;
    }

    // Close connection of the database
    public function closeConnection() : void {
        $this->conn->close();
    }

    /**
     * Create connection to the database, throw error if connection cannot be made
     * 
     * @return mysqli
    */
    private function dbConnect() : mysqli {
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DB);
        
        if(!$conn){
            throw new DomainException("Could not make a connection to the database");
        }

        return $conn;
    }

    /**
     * Disable the cloning of this singleton class.
     * 
     * @return void
     */
    final public function __clone()
    {
        throw new Exception('Cannot clone a singleton.');
    }
}

?>