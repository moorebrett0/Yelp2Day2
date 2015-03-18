<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Resturant.php";
    require_once "src/Cuisine.php";

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
             $this->assertEquals($test_resturant, $result[0]);
         }

         function test_getAll()
         {
             //Arrange
             $name = "Red Robin";
             $id = null;
             $cuisine_id = 1;
             $rating = 1;
             $review = "I like the bird";
             $test_resturant = new Resturant($name, $id, $cuisine_id, $rating, $review);

             $name2 = "McDonalds";
             $id = null;
             $cuisine_id2 = 1;
             $rating2 = -3;
             $review2 = "no way";
             $test_resturant2 = new Resturant($name2, $id, $cuisine_id2, $rating2, $review2);


             //Act
             $test_resturant->save();
             $test_resturant2->save();
             $result = Resturant::getAll();

             //Assert
             $this->assertEquals([$test_resturant, $test_resturant2], $result);
         }







      }








 ?>
