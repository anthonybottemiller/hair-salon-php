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
      protected function tearDown()
      {
        Customer::deleteAll();
      }

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

      function testGetId()
      {
        $name = "Miranda Lawson";
        $test_customer = new Customer($name);
        $test_customer->save();

        $result = $test_customer->getId();

        $this->assertEquals(true, is_numeric($result));
      }

      function testGetStylistId()
      {
        $name = "Melvin Spinacker";
        $stylist_id = 1;
        $test_customer = new Customer($name, $stylist_id);

        $result = $test_customer->getStylistId();

        $this->assertEquals(true, is_numeric($result));
      }

      function testSetStylistId()
      {
        $name = "Gabriel Gimmel";
        $stylist_id = 2;
        $test_customer = new Customer($name, $stylist_id);

        $test_customer->setStylistId(1);

        $this->assertEquals(1, $test_customer->getStylistId());
      }

      function testSave()
      {
        $name = "Toby Red";
        $test_customer = new Customer($name);

        $test_customer->save();

        $result = Customer::getAll();
        $this->assertEquals($test_customer, $result[0]);

      }

      function testUpdate()
      {
        $name = "Lazarus Long";
        $test_customer = new Customer($name);
        $test_customer->save();

        $test_customer->setStylistId(1);
        $test_customer->update();

        $this->assertEquals(1, $test_customer->getStylistId());
      }

      function testFind()
      {
        $name = "Miranda Lawson";
        $test_customer = new Customer($name);
        $test_customer->save();
        $name2 = "Keeble Neebler";
        $test_customer2 = new Customer($name2);
        $test_customer2->save();

        $id = $test_customer2->getId();
        $result = Customer::find($id);

        $this->assertEquals($test_customer2, $result);
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
        $this->assertEquals([],$results);
      }

      function testDelete()
      {
        $name = "Mole Colley";
        $test_customer = new Customer($name);
        $test_customer->save();
        $name2 = "Blarn Stone";
        $test_customer2 = new Customer($name2);
        $test_customer2->save();
        $id = $test_customer->getId();
        $test_customer->delete();
        $result = Customer::getAll();
        // $result = array_pop($result);
        $this->assertEquals($test_customer2, $result[0]);
      }

    }
?>