<?php

        /**
        * @backupGlobals disabled
        * @backupStaticAttributes disabled
        */

        require_once "src/Restaurant.php";
        require_once "src/Cuisine.php";

        $DB = new PDO('pgsql:host=localhost;dbname=yelp2_test');

        class CuisineTest extends PHPUnit_Framework_TestCase
        {
            protected function tearDown()
            {
                Cuisine::deleteAll();
                Restaurant::deleteAll();
            }

            function test_getType()
            {
                //Arrange
                $type = "Italian";
                $id = null;
                $test_Cuisine = new Cuisine($type, $id);

                //Act
                $result = $test_Cuisine->getType();

                //Assert
                $this->assertEquals($type, $result);
            }

            function test_save()
            {
                //Arrange
                $type = "AMERICAN";
                $id = null;
                $test_Cuisine = new Cuisine($type, $id);

                //Act
                $test_Cuisine->save();
                $result = Cuisine::getAll();

                //Assert
                $this->assertEquals($test_Cuisine, $result[0]);
            }

            function test_getAll()
            {
                //Arrange
                $type = "AMERICAN";
                $id = null;
                $test_Cuisine = new Cuisine($type, $id);
                $type2 = "Sicilian";
                $test_Cuisine2 = new Cuisine($type, $id);

                //Act
                $test_Cuisine->save();
                $test_Cuisine2->save();

                $result = Cuisine::getAll();

                //Assert
                $this->assertEquals([$test_Cuisine, $test_Cuisine2], $result);
            }

            function test_deleteAll()
            {
                //Arrange
                $type = "AMERICAN";
                $id = null;
                $test_Cuisine = new Cuisine($type, $id);
                $type2 = "Sicilian";
                $test_Cuisine2 = new Cuisine($type, $id);

                //Act
                $test_Cuisine->save();
                $test_Cuisine2->save();

                Cuisine::deleteAll();
                $result = Cuisine::getAll();

                //Assert
                $this->assertEquals([], $result);
            }

            function test_find()
            {
                //Arrange
                $type = "french";
                $id = 1;
                $type2 = "german";
                $id2 = 2;

                $test_cuisine = new Cuisine($type, $id);
                $test_cuisine->save();
                $test_cuisine2 = new Cuisine($type2, $id2);
                $test_cuisine2->save();

                //Act
                $result = Cuisine::find($test_cuisine2->getTypeId());

                //Assert
                $this->assertEquals($test_cuisine2, $result);
            }

            function testGetResurant()
            {
                $type = "mexican";
                $id = null;
                $test_cuisine = new Cuisine($type, $id);
                $test_cuisine->save();

                $test_cuisine_id = $test_cuisine->getTypeId();

                $name = "puerto vallarta";
                $review = "taco tuesday rocks!";
                $rating = 5;

                $test_restaurant = new Restaurant($name, $id, $test_cuisine_id, $rating, $review);
                $test_restaurant->save();

                $name2 = "jose tacos";
                $review2 = "had the runs for 4 days.";
                $rating2 = 1;
                $test_restaurant2 = new Restaurant($name2, $id, $test_cuisine_id, $rating2, $review2);
                $test_restaurant2->save();

                //act
                $result = $test_cuisine->getRestaurant();

                //assert
                $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
            }

            function test_deleteCuisineRestaurants()
            {
                //Arange
                $type = "Mexican";
                $id = null;
                $test_cuisine = new Cuisine($type, $id);
                $test_cuisine->save();

                $name = "Freddie Muchacho";
                $cuisine_id = $test_cuisine->getTypeId();
                $test_restaurant = new Restaurant($name, $id, $cuisine_id);
                $test_restaurant->save();

                //Act
                $test_cuisine->delete();

                //Assert
                $this->assertEquals([], Restaurant::getAll());
            }


            function test_update()
            {
                //Arrange
                $type = "Irish";
                $id = null;
                $test_cuisine = new Cuisine($type, $id);

                $new_type = "Scandinavian";

                //Act
                $test_cuisine->update($new_type);

                //Assert
                $this->assertEquals("Scandinavian", $test_cuisine->getType());
            }
        }

 ?>
