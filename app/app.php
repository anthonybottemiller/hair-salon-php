<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Customer.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
      'twig.path' => __DIR__.'/../views'
      ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();    

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

    $app->delete("/stylists", function () use ($app) {
      Stylist::deleteAll();
      return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
    });

    $app->get("/stylists/{id}/customers", function ($id) use ($app) {
      $stylist = Stylist::find($id);
      return $app['twig']->render('customers.html.twig', array('customers' => $stylist->getCustomers(), 'stylist' => $stylist));
    });

    $app->post("/stylists/{id}/customers", function ($id) use ($app) {
      $stylist = Stylist::find($id);
      $new_customer = new Customer($_POST['name'], $id);
      $new_customer->save();
      return $app['twig']->render('customers.html.twig', array('customers' => $stylist->getCustomers(), 'stylist' => $stylist));
    });


    return $app;

    ?>