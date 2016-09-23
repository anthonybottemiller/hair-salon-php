<?php

    require_once "src/Stylist.php";


    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {

        function testGetStylistId()
        {
          $name = "Trisha Rose";
          $test_stylist = new Stylist($name);

          $result = $test_stylist->getId;

          $this->assertEquals(true, is_numeric($result));
        }

    }

  ?>