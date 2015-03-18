<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";

    $DB = new PDO('pgsql:host=localhost;dbname=yelp2_test');

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {

         protected function tearDown()
         {
             Restaurant::deleteAll();
         }

         function test_save()
         {
             //Arrange
             $name = "Red Robin";
             $id = null;
             $cuisine_id = 1;
             $rating = 1;
             $review = "I like the bird";
             $test_restaurant = new Restaurant($name, $id, $cuisine_id, $rating, $review);


             //Act
             $test_restaurant->save();
             $result = Restaurant::getAll();

             //Assert
             $this->assertEquals($test_restaurant, $result[0]);
         }

         function test_getAll()
         {
             //Arrange
             $name = "Red Robin";
             $id = null;
             $cuisine_id = 1;
             $rating = 1;
             $review = "I like the bird";
             $test_restaurant = new Restaurant($name, $id, $cuisine_id, $rating, $review);

             $name2 = "McDonalds";
             $id = null;
             $cuisine_id2 = 1;
             $rating2 = -3;
             $review2 = "no way";
             $test_restaurant2 = new Restaurant($name2, $id, $cuisine_id2, $rating2, $review2);


             //Act
             $test_restaurant->save();
             $test_restaurant2->save();
             $result = Restaurant::getAll();

             //Assert
             $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
         }



         function test_deleteAll()
        {
            //Arrange
            $type = "Holkla";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name = "Big burger";
            $cuisine_id = $test_cuisine->getTypeId();
            $test_restaurant = new Restaurant($name, $id, $cuisine_id);
            $test_restaurant->save();

            $name2 = "little pasta";
            $test_restaurant2 = new Restaurant($name2, $id, $cuisine_id);
            $test_restaurant2->save();


            //Act
            Restaurant::deleteAll();

            //Assert
            $result = Restaurant::getAll();
            $this->assertEquals([], $result);
        }

        function test_getId()
        {
            //Arrange
            $type = "chinese";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();


            $name = "panda house";

            $cuisine_id = $test_cuisine->getTypeId();
            $test_restaurant = new Restaurant($name, $id, $cuisine_id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getId();

            //Assert
            $this->assertEquals(1, is_numeric($result));
        }

        function test_getCuisineId()
        {
            //Arrange
            $type = "japanese";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();


            $name = "sushi house";
            $cuisine_id = $test_cuisine->getTypeId();
            $test_restaurant = new Restaurant($name, $id, $cuisine_id);
            $test_restaurant->save();

            //Act
            $result = $test_restaurant->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }



        function test_sort()
        {
            // Arrange
            $type = "Brazilian";
            $id = null;
            $test_cuisine = new Cuisine($type, $id);
            $test_cuisine->save();

            $name1 = "Meat house";
            $name2 = "Bikini House";
            $name3 = "Buenos Aires Bomber";
            $cuisine_id = $test_cuisine->getTypeId();


            $test_restaurant1 = new Restaurant($name1, $id, $cuisine_id);
            $test_restaurant1->save();
            $test_restaurant2 = new Restaurant($name2, $id, $cuisine_id);
            $test_restaurant2->save();
            $test_restaurant3 = new Restaurant($name3, $id, $cuisine_id);
            $test_restaurant3->save();

            // Act
            $result = Restaurant::getAll();

            // Assert
            $this->assertEquals([$test_restaurant1, $test_restaurant2, $test_restaurant3], $result);

        }






      }








 ?>
