<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";


    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        function testGetName()
        {
          $name = "Jacobi Tyler";
          $test_stylist = new Stylist($name);

          $result = $test_stylist->getName();

          $this->assertEquals($name, $result);
        }

        function testSave()
        {
          $name = "Trisha Rose";
          $test_stylist = new Stylist($name);

          $test_stylist->save();

          $result = Stylist::getAll();
          $this->assertEquals($test_stylist, $result[0]);
        }

        function testGetAll()
        {
          $name = "Trisha Rose";
          $test_stylist = new Stylist($name);
          $test_stylist->save();
          $name2 = "Johnny Borealis";
          $test_stylist2 = new Stylist($name2);
          $test_stylist2->save();

          $result = Stylist::getAll();

          $this->assertEquals([$test_stylist, $test_stylist2], $result);

        }
    }

  ?>