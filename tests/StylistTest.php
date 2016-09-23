<?php

    require_once "src/Stylist.php";


    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {

        function testSave()
        {
          $name = "Trisha Rose";
          $test_stylist = new Stylist($name);

          $test_stylist->save();

          $result = Stylist::getAll();
          $this->assertEquals($test_stylist, $result[0]);
        }

    }

  ?>