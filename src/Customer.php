<?php
    class Customer
    { 
      private $id;
      private $name;
      private $stylist_id;

      function __construct($name, $id = null, $stylist_id = null)
      {
        $this->id =  $id;
        $this->name = (string) $name;
        $this->stylist_id = (int) $stylist_id;
      }

      function getName()
      {
        return $this->name;
      }

      function setName($new_name)
      {
        $this->name = (string) ($new_name);
      }

      function save()
      {
        $GLOBALS['DB']->exec("INSERT INTO customers (name) VALUES ('{$this->name}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
      }

      function getAll()
      {
        $returned_customers = $GLOBALS['DB']->query("SELECT * FROM customers;");

        $customers = array();
        foreach ($returned_customers as $customer) {
          $name = $customer['name'];
          $id = $customer['id'];
          $stylist_id = $customer['stylist_id'];
          $new_customer = new Customer($name, $id, $stylist_id);
          array_push($customers, $new_customer);
        }
        return $customers;
      }

      function deleteAll()
      {
        $GLOBALS['DB']->exec("DELETE FROM customers;");
      }
    }
?>