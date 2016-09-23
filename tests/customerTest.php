<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Customer.php";


    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CustomerTest extends PHPUnit_Framework_TestCase
    {
      function testGetName()
      {
        $name = "Sherry Wilson";
        $test_customer = new Customer($name);

        $result = $test_customer->getName();

        $this->assertEquals($name, $result);
      } 
      
      function testSetName()
      {
        $name = "Taylor Hunting";
        $test_customer = new Customer($name);

        $new_name = "Taylor Witchard";
        $test_customer->setName($new_name);

        $this->assertEquals($test_customer->getName(), $new_name);
      }

    }