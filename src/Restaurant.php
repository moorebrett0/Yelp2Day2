<?php

        class Restaurant
        {

          private $name;
          private $cuisine_id;
          private $id;
          private $rating;
          private $review;

          //constructor for restaurant class

            function __construct($name, $id = null, $cuisine_id, $rating = 0, $review = "")
            {
              $this->name = $name;
              $this->cuisine_id = $cuisine_id;
              $this->id = $id;
              $this->rating = $rating;
              $this->review = $review;
            }
        //getters and setters for private properties

            function setName($new_name)
            {
              $this->name = (string) $new_name;
            }

            function getName()
            {
              return $this->name;
            }

            function setCuisineId($new_cuisine_id)
            {
              $this->cuisine_id = (int) $new_cuisine_id;
            }

            function getCuisineId()
            {
              return $this->cuisine_id;
            }

            function setId($new_id)
            {
              $this->id = $new_id;
            }

            function getId()
            {
              return $this->id;
            }

            function setRating($new_rating)
            {
              $this->rating = (int) $new_rating;
            }

            function getRating()
            {
              return $this->rating;
            }

            function setReview($new_review)
            {
              $this->review = (string) $new_review;
            }

            function getReview()
            {
              return $this->review;
            }

        // methods to interact with database

            function save()
            {
              $statement = $GLOBALS['DB']->query("INSERT INTO restaurant (name, cuisine_id, rating, review) VALUES ('{$this->getName()}', {$this->getCuisineId()}, {$this->getRating()}, '{$this->getReview()}') RETURNING id;");
              $result = $statement->fetch(PDO::FETCH_ASSOC);
              $this->setId($result['id']);
            }

        
            static function getAll()
            {
              $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurant;");
              $restaurants = array();
              foreach($returned_restaurants as $single){
                  $name = $single['name'];
                  $id = $single['id'];
                  $cuisine_id = $single['cuisine_id'];
                  $review = $single['review'];
                  $rating = $single['rating'];
                  $new_restaurant = new Restaurant($name, $id, $cuisine_id, $rating, $review);
                  array_push($restaurants, $new_restaurant);
              }
               return $restaurants;
            }

            static function deleteAll()
            {
              $GLOBALS['DB']->exec("DELETE FROM restaurant *);");
            }





    }


















?>
