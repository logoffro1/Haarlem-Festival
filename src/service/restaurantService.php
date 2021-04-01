<?php

include '../classes/autoloader.php';

class restaurantService {
    private database $db;
    private mysqli $conn;
    private helper $helper;
    private restaurantTypeController $restaurantTypeController;

    public function __construct() {
        $this->db = database::getInstance();

        $this->conn = $this->db->getConnection();

        $this->helper = new helper(); 

        $this->restaurantTypeController = new restaurantTypeController();
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


    /**
     * @param int - id of the selected restaurant
     * @return restaurant || null - restaurant class with the data from the query, or null if error/nothing is found
     */
    public function getRestaurant(int $restaurantId) : ?restaurant {
        $query = "SELECT * FROM Restaurants WHERE restaurant_id=? LIMIT 1";


        if($stmt = $this->conn->prepare($query)) {
            // Create bind params to prevent sql injection
            $stmt->bind_param("i", $id);
            $id = htmlspecialchars($restaurantId);

            // Execute query
            $stmt->execute();

            $result = $stmt->get_result();

            if($result->num_rows == 0){
                return null;
            }

            // Get the result
            $objectResult = $result->fetch_object();

            return new restaurant(
                (int)$objectResult->restaurant_id,
                $objectResult->name,
                $this->getCuisinesById((int)$objectResult->restaurant_id),
                $objectResult->address,
                $objectResult->biography,
                explode(",", $objectResult->images),
                (double)$objectResult->duration,
                (int)$objectResult->sessions,
                $objectResult->start_of_session,
                (int)$objectResult->seats,
                (int)$objectResult->stars,
                (double)$objectResult->price,
            );
        } else {
            // If connection could not be established throw an error
            throw new Exception('Something went  wrong. We could not retrieve the restaurant data. Please try again.');
        }

        return null;
    }

    /**
     * @param data - array of post data from the form
     */
    public function addRestaurant(array $data, int $page_id) : void // Todo add categories to insert statement
    {
        $sql = "INSERT INTO Restaurants (
            `page_id`,
            `name`,
            `address`,
            `biography`,
            `duration`,
            `sessions`,
            `start_of_session`,
            `seats`,
            `price`,
            `stars`
        ) VALUES (?,?,?,?,?,?,?,?,?,?)";

        // Get connection and prepare statement
        if($query = $this->conn->prepare($sql)) {
            // Create bind params to prevent sql injection
            $query->bind_param("isssdisidi",
                $page_id,
                $data['name'],
                $data['address'],
                $data['biography'],
                $data['duration'],
                $data['sessions'],
                $data['start_of_session'],
                $data['seats'],
                $data['price'],
                $data['stars']
            );

            // Execute query
            $query->execute();

            // For every new categorie add it to the db
            foreach ($data['insert_cuisine'] as $cuisine) {
                $this->insertNewCategories($query->insert_id, (int)$cuisine);
            }
        } else {
            throw new Exception('Could not add the restaurant. Please try again');
        }
    }

    public function deleteRestaurant(restaurant $restaurant)
    {
        $sql = "DELETE FROM Restaurants WHERE restaurant_id=?";

        // Get connection and prepare statement
        if($query = $this->conn->prepare($sql)) {
            // Create bind params to prevent sql injection
            $query->bind_param("i", 
                $id
            );

            $id = $restaurant->id;

            foreach ($restaurant->images as $image) {
                $isDeleted = $this->db->deleteImage($image);
            }

            // Execute query
            $query->execute();
        } else {
            // If connection cannot be established, throw an error
            throw new Exception('Could not connect to the database. Please try again');
        }
    }

    public function updateRestaurantImage($images, $restaurantId)
    {
        $sql = "UPDATE Restaurants 
                SET images=?
            WHERE restaurant_id = $restaurantId";

        // Get connection and prepare statement
        if($query = $this->conn->prepare($sql)) {
            // Create bind params to prevent sql injection
            $query->bind_param("s", 
                $images    
            );

            $query->execute();
        } else {
            // If connection cannot be established, throw an error
            throw new Exception('Could not update the image. Please try again');
        }
    }

    public function uploadImage(array $data)
    {
        $this->db->uploadImage($data['tmp_name'], $data['name']);
    }

    private function getCuisinesById(int $id){
        $cuisines = array();

        $query = "SELECT * FROM Restaurant_Categorie WHERE restaurant_id = '$id'";
        $result = $this->conn->query($query);

        if($result){
            while($row = $result->fetch_assoc()){

                $cuisines[] = $this->restaurantTypeController->getTypeById($row["restaurant_type_id"]);
            }
        }
        return $cuisines;
    }

    /**
     * Updates the restaurant data, takes new data and updated data
     * 
     * @param restaurant $restaurant - old data + id
     * @param array $data - data from form post
     */
    public function updateRestaurant(restaurant $restaurant, array $data) : void
    {
        $sql = "UPDATE Restaurants SET  
                    name=?,
                    address=?,
                    biography=?,
                    duration=?,
                    sessions=?,
                    start_of_session=?,
                    seats=?,
                    stars=?,
                    price=?          
                WHERE restaurant_id = $restaurant->id";
        
        // For every new categorie add it to the db
        foreach ($data['insert_cuisines'] as $cuisine) {
            $this->insertNewCategories($restaurant->id, $cuisine);
        }

        $this->deleteCategories($restaurant, $data);

        // Get connection and prepare statement
        if($query = $this->conn->prepare($sql)) {

            // Create bind params to prevent sql injection
            $query->bind_param("sssdisiid", 
                $data['name'],
                $data['address'],
                $data['biography'],
                $data['duration'],
                $data['sessions'],
                $data['start_of_session'],
                $data['seats'],
                $data['stars'],
                $data['price']
            );

            // Execute query
            $query->execute();
        } else {
            // If connection cannot be established, throw an error
            throw new Exception('Could not update the restaurant. Please try again');
        }
    }

    /**
     * insertNewCategories - Insert new categories to the db
     * 
     * @param restaurant $restaurant - active restaurant class on the page
     * @param int $cuisine - active active restaurant_categorie_id from the foreach
     */
    public function insertNewCategories(int $restaurantId, int $cuisine) : void
    {
        $insertCategoriesSql = "INSERT INTO Restaurant_Categorie (restaurant_id, restaurant_type_id) values ($restaurantId,?)";

        // Get connection and prepare statement
        if($query = $this->conn->prepare($insertCategoriesSql)) {

            // Create bind params to prevent sql injection
            $query->bind_param("i", 
                $cuisine,
            );

            // Execute query
            $query->execute();
        } else {
            // If connection cannot be established, throw an error
            throw new Exception('Could not update the restaurant. Please try again');
        }
    }

    /**
     * deleteCategories - Deletes categories that are present in the database, but were unchecked on the page
     * 
     * @param restaurant $restaurant - active restaurant class on the page
     * @param array $data - all post value data from the submti
     */
    public function deleteCategories(restaurant $restaurant, array $data) : void
    {
        $deleteCategoriesSql = "DELETE FROM Restaurant_Categorie
        WHERE restaurant_id = $restaurant->id
        AND (restaurant_type_id IN (?))";

        // Get connection and prepare statement
        if($query = $this->conn->prepare($deleteCategoriesSql)) {

            // Create bind params to prevent sql injection
            $query->bind_param("s", 
                $data['delete_cuisines'],
            );

            // Execute query
            $query->execute();
        } else {
            // If connection cannot be established, throw an error
            throw new Exception('Could not update the restaurant. Please try again');
        }
    }

    public function deleteRestaurantImages(restaurant $restaurant)
    {
        foreach ($restaurant->images as $image) {
            $isDeleted = $this->db->deleteImage($image);
        }
    }

    /**
     * Gets the bought reservation seats of a specfic restaurant based on restaurantId param
     * 
     * @param int restaurantId - id of a a specific restaurant
     * 
     * @return int amount of bought reservation seats
     */
    public function getBoughtTickets(int $restaurantId) : int
    {
        $query = "SELECT seats from Reservation_Cuisine WHERE restaurant_id = ?";
        $totalBoughtTickets = 0;

        if($stmt =  $this->conn->prepare($query)) {
            // Create bind params to prevent sql injection
            $stmt->bind_param("i", 
                $idParam
            );

            $idParam = $restaurantId;

            // Execute query
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();

            while($row = $result->fetch_assoc()) {
                // return user class
                $totalBoughtTickets += (int)$row["seats"];
            }
        }

        return $totalBoughtTickets;
    }
}
?>