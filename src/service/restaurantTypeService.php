<?php

include '../classes/autoloader.php';

class restaurantTypeService {
    private database $db;
    private mysqli $conn;

    public function __construct() {
        $this->db = database::getInstance();

        $this->conn = $this->db->getConnection();
    }

    public function getRestaurantTypes(){

        $typesList = array();

        $query = "SELECT * FROM Restaurant_Type";
        $result = $this->conn->query($query);

        if($result){
            while($row = $result->fetch_assoc()){
                $restaurantType = new restaurantType($row["restaurant_type_id"],$row["name"]);
                $typesList[] = $restaurantType;
            }
            
        }
        return $typesList;
    }
    public function getTypeById(int $id){
        $query = "SELECT * FROM Restaurant_Type WHERE restaurant_type_id = '$id'";
        $result = $this->conn->query($query);

        if($result){
                $row = $result->fetch_assoc();
                return new restaurantType($row["restaurant_type_id"],$row["name"]);      
        }
    }
}
?>