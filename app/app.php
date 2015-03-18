<?php
            require_once __DIR__."/../vendor/autoload.php";
            require_once __DIR__."/../src/Restaurant.php";
            require_once __DIR__."/../src/Cuisine.php";

            $app = new Silex\Application();

            $DB = new PDO('pgsql:host=localhost;dbname=yelp2');

            $app->register(new Silex\Provider\TwigServiceProvider(), array(
                'twig.path' => __DIR__. '/../views'
            ));

            use Symfony\Component\HttpFoundation\Request;
            Request::enableHttpMethodParameterOverride();

            //establish our route methods in index.twig

            $app->get("/", function() use ($app) {

                return $app['twig']->render('index.twig', array('cuisine' => Cuisine::getAll()));
            });

            $app->post("/cuisine", function() use ($app){

                $cuisine = new Cuisine($_POST);

                return $app['twig']->render('index.twig');
            });

            $app->delete("/cuisine/{$id}", function($id) use ($app){

                $cuisine = Cuisine::find($id);
                $cuisine->delete();
                return $app['twig']->render('index.twig', array('categories' => Cuisine::getAll()));
            });

            //establish our routes and methods for cuisine twig pages

            $app->get("/cuisines", function() use ($app) {

                return $app['twig']->render('cuisines.twig', array('cuisines' => Cuisine::getAll()));
            });

            $app->post("/cuisines", function() use ($app) {

                $cuisine = new Cuisine($_POST['type']);
                $cuisine->save();
                return $app['twig']->render('cuisines.twig', array('cuisines' => Cuisine::getAll()));
            });

            //establish our routes and methods for restaurant twig pages

            $app->get("/restaurants", function() use ($app) {
                return $app['twig']->render('restaurants.twig', array('restaurants' => Restaurant::getAll()));
            });

            $app->post("/restaurants", function() use ($app) {
                $restaurant = new Restaurant($_POST['name'], $_POST['rating'], $_POST['review']);
                $restaurant->save();
                return $app['twig']->render('restaurants.twig', array('restaurants' => Restaurant::getAll()));
            });

            //establish route to edit twig pages

            $app->get("/cuisines/{id}/edit", function($id) use ($app) {

                $cuisine = Cuisine::find($id);
                return $app['twig']->render('cuisine_edit.html.twig', array('cuisine' => $cuisine));
            });

            $app->patch("/cuisines/{id}", function($id) use($app){
                $type = $_POST['type'];
                $cuisine = Cuisine::find($id);
                $cuisine->update($type);
                return $app['twig']->render('cuisine.twig', array('cuisines => $cuisine', 'restaurants' => $cuisine->getRestaurants()));
            });



            return $app;

 ?>
