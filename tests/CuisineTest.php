<?php

        /**
        * @backupGlobals disabled
        * @backupStaticAttributes disabled
        */

        require_once "src/Resturant.php";
        require_once "src/Cuisine.php";

        $DB = new PDO('pgsql:host=localhost;dbname=yelp2_test');

        class CuisineTest extends PHPUnit_Framework_TestCase
        {
            protected function tearDown()
            {
                Cuisine::deleteAll();
                Resturant::deleteAll();
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




        }

 ?>
