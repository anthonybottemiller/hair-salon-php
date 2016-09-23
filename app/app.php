<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
      'twig.path' => __DIR__.'/../views'
      ));

    $app->get("/", function () use ($app) {
      return $app['twig']->render('index.html.twig');
    });

    $app->get("/stylists", function () use ($app) {
      return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->post("/stylists", function () use ($app) {
      $new_stylist = new Stylist($_POST['name']);
      $new_stylist->save();
      return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
    });


    return $app;

    ?>