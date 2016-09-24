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

      function testSave()
      {
        $name = "Toby Red";
        $test_customer = new Customer($name);

        $test_customer->save();

        $result = Customer::getAll();
        $this->assertEquals($test_customer, array_pop($result));

      }

      function testGetAll()
      {
        $name = "Fox Roy";
        $name2 = "Scrappy Flynn";
        $test_customer = new Customer($name);
        $test_customer2 = new Customer($name2);
        $test_customer->save();
        $test_customer2->save();

        $results = Customer::getAll();

        $this->assertEquals([$test_customer, $test_customer2], $results);
      }

      function testDeleteAll()
      {
        $name = "Fox Roy";
        $name2 = "Scrappy Flynn";
        $test_customer = new Customer($name);
        $test_customer2 = new Customer($name2);
        $test_customer->save();
        $test_customer2->save();

        Customer::deleteAll();

        $results = Customer::getAll();
        $this-assertEquals([],$results);
      }
    }
?>