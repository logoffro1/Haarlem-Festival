<?php

include '../classes/autoloader.php';

class restaurantService {
    private database $db;
    private mysqli $conn;

    public function __construct() {
        $this->db = database::getInstance();

        $this->conn = $this->db->getConnection();
    }

    public function getRestaurants()
    {

        $restaurants = array();

        $query = "SELECT * FROM Restaurants";
        $result = $this->conn->query($query);

        if($result){

            while($row = $result->fetch_assoc()){
                $restaurant = new restaurant(
                    $row["restaurant_id"],
                    $row["name"],
                    $this->getCuisinesById($row["restaurant_id"]),
                    $row["address"],
                    $row["biography"],
                    explode(",",$row["images"]),
                    (double)$row["duration"],
                    $row["sessions"],
                    $row["start_of_session"],
                    $row["seats"],
                    $row["stars"],
                    $row["price"]
                );
                $restaurants[] = $restaurant;
            }
            
        }
        return $restaurants;
    }
    public function getRestaurantById(int $id){
        $query = "SELECT * FROM Restaurants WHERE restaurant_id = '$id'";
        $result = $this->conn->query($query);

        if($result){
            $row = $result->fetch_assoc();
            return new restaurant(
                $row["restaurant_id"],
                $row["name"],
                $this->getCuisinesById($row["restaurant_id"]),
                $row["address"],
                $row["biography"],
                explode(",",$row["images"]),
                (double)$row["duration"],
                $row["sessions"],
                $row["start_of_session"],
                $row["seats"],
                $row["stars"],
                $row["price"]
            );
        }
    }
    private function getCuisinesById(int $id){
        $cuisinesController = new restaurantTypeController();
        $cuisines = array();

        $query = "SELECT * FROM Restaurant_Categorie WHERE restaurant_id = '$id'";
        $result = $this->conn->query($query);

        if($result)
            while($row = $result->fetch_assoc()){

                $cuisines[] = $cuisinesController->getTypeById($row["restaurant_type_id"]);
            }

        return $cuisines;
        }

}
?>