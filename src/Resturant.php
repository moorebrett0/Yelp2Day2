<?php

          class Resturant {

              private $name;
              private $cuisine_id;
              private $id;
              private $rating;
              private $review;


              function __construct($name, $id = null, $cuisine_id, $rating, $review)
              {
                  $this->name = $name;
                  $this->cuisine_id = $cuisine_id;
                  $this->id = $id;
                  $this->rating = $rating;
                  $this->review = $review;
              }

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

// working methods

              function save()
              {
                  $statement = $GLOBALS['DB']->query("INSERT INTO resturant (name, cuisine_id, rating, review) VALUES ('{$this->getName()}', {$this->getCuisineId()}, {$this->getRating()}, '{$this->getReview()}') RETURNING id;");
                  $result = $statement->fetch(PDO::FETCH_ASSOC);
                  $this->setId($result['id']);
              }

              static function getAll()
              {
                  $returned_resturants = $GLOBALS['DB']->query("SELECT * FROM resturant;");
                  $resturants = array();
                  foreach($returned_resturants as $single){
                      $name = $single['name'];
                      $id = $single['id'];
                      $cuisine_id = $single['cuisine_id'];
                      $review = $single['review'];
                      $rating = $single['rating'];
                      $new_resturant = new Resturant($name, $id, $cuisine_id, $rating, $review);
                      array_push($resturants, $new_resturant);
                  }
                   return $resturants;
              }

              static function deleteAll()
              {
                  $GLOBALS['DB']->exec("DELETE FROM resturant *;");
              }



          }


















 ?>
