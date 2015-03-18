<?php

    Class Cuisine
    {
        private $type;
        private $id;

    // constructor for cuisine instances

        function __construct($type, $id = null)
        {
         $this->type = $type;
         $this->id = $id;
        }

    // getters and setters for private properties

        function setType($new_type)
        {
         $this->type = $new_type;

        }

        function getType()
        {
         return $this->type;
        }

        function setTypeId($new_id)
        {
         $this->id = $new_id;
        }

        function getTypeId()
        {
         return $this->id;
        }

    // methods to interact with databse


        function save()
        {
             $statement = $GLOBALS['DB']->query("INSERT INTO cuisine (type) VALUES ('{$this->getType()}') RETURNING id;");
             $result = $statement->fetch(PDO::FETCH_ASSOC);
             $this->setTypeId($result['id']);
        }

        function getRestaurant()
        {
            $restaurants = array();
            $returned_name = $GLOBALS['DB']->query("SELECT * FROM restaurant WHERE cuisine_id = {$this->getTypeId()};");
            foreach($returned_name as $place) {
                $name = $place['name'];
                $id = $place['id'];
                $cuisine_id = $place['cuisine_id'];
                $rating = $place['rating'];
                $review = $place['review'];
                $new_restaurant = new Restaurant($name, $id, $cuisine_id, $rating, $review);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

        function update($new_type)
        {
            $GLOBALS['DB']->exec("UPDATE cuisine SET type = '{$new_type}' WHERE id = {$this->getTypeId()};");
            $this->setType($new_type);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM cuisine WHERE id = {$this->getTypeId()};");
            $GLOBALS['DB']->exec("DELETE FROM restaurant WHERE cuisine_id = {$this->getTypeId()};");
        }

        static function find($search_id)
        {
           $found_cuisine = null;
           $cuisine = Cuisine::getAll();
           foreach($cuisine as $food) {
               $type_id = $food->getTypeId();
               if ($type_id == $search_id) {
                   $found_cuisine = $food;
               }
           }
           return $found_cuisine;
        }

        static function getAll()
        {
             $returned_type = $GLOBALS['DB']->query("SELECT * FROM cuisine;");
             $cuisine = array();
             foreach($returned_type as $food) {
                 $type = $food['type'];
                 $id = $food['id'];
                 $new_type = new Cuisine($type, $id);
                 array_push($cuisine, $new_type);
             }

             return $cuisine;
        }

        static function deleteAll()
        {
                $GLOBALS['DB']->exec("DELETE FROM cuisine *;");
        }
    }



?>
