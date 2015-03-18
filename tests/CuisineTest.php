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




        }

 ?>
