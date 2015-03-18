<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Resturant.php";
//    require_once "src/Cuisine.php";

    $DB = new PDO('pgsql:host=localhost;dbname=yelp2_test');

    class ResturantTest extends PHPUnit_Framework_TestCase
    {

         protected function tearDown()
         {
             Resturant::deleteAll();
         }

         function test_save()
         {
             //Arrange
             $name = "Red Robin";
             $id = null;
             $cuisine_id = 1;
             $rating = 1;
             $review = "I like the bird";
             $test_resturant = new Resturant($name, $id, $cuisine_id, $rating, $review);


             //Act
             $test_resturant->save();
             $result = Resturant::getAll();

             //Assert
             $this->assertEquals($test_resturant, $test_resturant);
         }






      }








 ?>
