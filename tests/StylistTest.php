<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Customer.php";


    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Stylist::deleteAll();
          Customer::deleteAll();
        }

        function testGetName()
        {
          $name = "Jacobi Tyler";
          $test_stylist = new Stylist($name);

          $result = $test_stylist->getName();

          $this->assertEquals($name, $result);
        }

        function testSetName()
        {
          $name = "Malco Reynolds";
          $test_stylist = new Stylist($name);
          
          $new_name = "Malcolm Reynolds";
          $test_stylist->setName($new_name);

          $this->assertEquals($test_stylist->getName(),$new_name);
        }

        function testSave()
        {
          $name = "Trisha Rose";
          $test_stylist = new Stylist($name);

          $test_stylist->save();

          $result = Stylist::getAll();
          $this->assertEquals($test_stylist, $result[0]);
        }

        function testUpdate()
        {
          $name = "All Bundy";
          $test_stylist = new Stylist($name);
          $test_stylist->save();

          $test_stylist->setName("Al Bundy");
          $test_stylist->update();

          $this->assertEquals("Al Bundy", $test_stylist->getName());
        }

        function testGetCustomers()
        {
          $stylist_name = "Bon Jovi";
          $test_stylist = new Stylist ($stylist_name);
          $test_stylist->save();

          $stylist_id = $test_stylist->getId();

          $name_customer = "Jill Johnson";
          $test_customer = new Customer($name_customer, $stylist_id);
          $test_customer->save();

          $name_customer2 = "Jose Ramirez";
          $test_customer2 = new Customer($name_customer2, $stylist_id);
          $test_customer2->save();

          $result = $test_stylist->getCustomers();

          $this->assertEquals([$test_customer, $test_customer2], $result);
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

        function testGetId()
        {
          $name = "Robbie Dean";
          $test_stylist = new Stylist($name);
          $test_stylist->save();

          $result = $test_stylist->getId();

          $this->assertEquals(true, is_numeric($result));
        }

        function testDeleteAll()
        {
          $name = "Trisha Rose";
          $test_stylist = new Stylist($name);
          $test_stylist->save();
          $name2 = "Johnny Borealis";
          $test_stylist2 = new Stylist($name2);
          $test_stylist2->save();

          Stylist::deleteAll();
          $result = Stylist::getAll();

          $this->assertEquals([], $result);

        }

        function testFind()
        {
          $name = "Regina Spektor";
          $test_stylist = new Stylist($name);
          $test_stylist->save();
          $name2 = "Findle Medor";
          $test_stylist2 = new Stylist($name2);
          $test_stylist2->save();
          $id = $test_stylist2->getId();
          $result = Stylist::find($id);

          $this->assertEquals($test_stylist2, $result);
        }

        function testDelete()
        {
          $name = "Regina Spektor";
          $test_stylist = new Stylist($name);
          $test_stylist->save();
          $name2 = "Findle Medor";
          $test_stylist2 = new Stylist($name2);
          $test_stylist2->save();
          $id = $test_stylist->getId();
          $test_stylist->delete();
          $result = Stylist::getAll();
          // $result = array_pop($result);
          $this->assertEquals($test_stylist2, $result[0]);
        }
    }

  ?>