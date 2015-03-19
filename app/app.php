<?php
            require_once __DIR__."/../vendor/autoload.php";
            require_once __DIR__."/../src/Restaurant.php";
            require_once __DIR__."/../src/Cuisine.php";

            $app = new Silex\Application();
            $app['debug'] = true;

            $DB = new PDO('pgsql:host=localhost;dbname=yelp2');

            $app->register(new Silex\Provider\TwigServiceProvider(), array(
                'twig.path' => __DIR__. '/../views'
            ));

            use Symfony\Component\HttpFoundation\Request;
            Request::enableHttpMethodParameterOverride();

////////////////////////////////////////////////////////////

            //establish our route methods in index.twig

            $app->get("/", function() use ($app) {

                return $app['twig']->render('index.twig', array('cuisines' => Cuisine::getAll()));
            });

            $app->post("/", function() use ($app){

                $cuisine = new Cuisine($_POST['type']);
                $cuisine->save();

                return $app['twig']->render('index.twig', array('cuisines' => Cuisine::getAll()));
            });

            $app->post("/delete_cuisines", function() use($app){

                Cuisine::deleteAll();
                return $app['twig']->render('index.twig', array('cuisines' => Cuisine::getAll()));
            });

            // //establish our routes and methods for cuisine twig pages

            $app->get("/cuisines/{id}", function($id) use ($app) {

                $cuisine = Cuisine::find($id);



                return $app['twig']->render('cuisine.twig', array('cuisines'=> $cuisine, 'restaurants' => $cuisine->getRestaurant()));
            });

            $app->post("/restaurant_add", function() use ($app) {

                $cuisine_id = $_POST['cuisine_id'];
                $restaurant = new Restaurant($_POST['name'], $id = null, $cuisine_id, $_POST['rating'], $_POST['review']);
                $restaurant->save();
                $cuisine = Cuisine::find($cuisine_id);
                return $app['twig']->render('cuisine.twig', array('cuisines' => $cuisine, 'restaurants'=> $cuisine->getRestaurant()));
            });

            $app->post("/delete_restaurants", function() use($app){

                $cuisine_id = $_POST['cuisine_id'];
                $cuisine = Cuisine::find($cuisine_id);
                $cuisine->deleteRestaurants();

                return $app['twig']->render('delete_restaurants.twig');
            });

            $app->get("/cuisines/{id}/edit", function($id) use($app){
                $cuisine = Cuisine::find($id);
                return $app['twig']->render('cuisine_edit.twig', array('cuisines' => $cuisine));
            });

            $app->patch("/cuisines/{id}", function($id) use ($app) {
                $type = $_POST['type'];
                $cuisine = Cuisine::find($id);
                $cuisine->update($type);
                return $app['twig']->render('cuisine.twig', array('cuisines' => $cuisine, 'restaurants' => $cuisine->getRestaurant()));
            });



            $app->delete("/cuisines/{id}", function($id) use ($app) {

                $cuisine = Cuisine::find($id);
                $cuisine->delete();
                return $app['twig']->render('index.twig', array('cuisines' => Cuisine::getAll()));
            });


            return $app;

 ?>
