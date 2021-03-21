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
        $query = "SELECT * FROM restaurants WHERE restaurant_id=? LIMIT 1";


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
    public function addRestaurant($data, int $page_id) : void // Todo add categories to insert statement
    {
        $sql = "INSERT INTO restaurants (
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
        ) VALUES (1?????????)";

        // Get connection and prepare statement
        if($query = $this->conn->prepare($sql)) {

            // Create bind params to prevent sql injection
            $query->bind_param("sssdisidi",
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
        } else {
            // If connection cannot be established, throw an error
            throw new Exception('Could not update the restaurant. Please try again');
        }
    }
    public function addRestaurantImage(array $data)
    {
        $sql = "UPDATE restaurants 
                SET image=?
            WHERE restaurant_id = $artist->id";

        // Get connection and prepare statement
        if($query = $this->conn->prepare($sql)) {
            // Create bind params to prevent sql injection
            $imageName = $data['name'] ?? null;

            $query->bind_param("s", 
                $imageName    
            );

            if($this->db->uploadImage($data['tmp_name'], $data['name'])){
                // Execute query
                $query->execute();
            }
            $this->helper->refresh();
        } else {
            // If connection cannot be established, throw an error
            throw new Exception('Could not update the image. Please try again');
        }
    }

    private function getCuisinesById(int $id){
        $cuisines = array();

        $query = "SELECT * FROM Restaurant_Categorie WHERE restaurant_id = '$id'";
        $result = $this->conn->query($query);

        if($result)
            while($row = $result->fetch_assoc()){

                $cuisines[] = $this->restaurantTypeController->getTypeById($row["restaurant_type_id"]);
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
        $sql = "UPDATE restaurants SET  
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
            $this->insertNewCategories($restaurant, $cuisine);
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
    public function insertNewCategories(restaurant $restaurant, int $cuisine) : void
    {
        $insertCategoriesSql = "INSERT INTO restaurant_categorie (restaurant_id, restaurant_type_id) values ($restaurant->id,?)";

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
        $deleteCategoriesSql = "DELETE FROM restaurant_categorie
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
}
?>