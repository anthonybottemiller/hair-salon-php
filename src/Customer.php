<?php
    class Customer
    { 
      private $id;
      private $name;
      private $stylist_id;

      function __construct($name, $stylist_id = null, $id = null)
      {
        $this->id =  $id;
        $this->name = (string) $name;
        $this->stylist_id = (int) $stylist_id;
      }

      function getName()
      {
        return $this->name;
      }

      function getId()
      {
        return $this->id;
      }

      function getStylistId()
      {
        return $this->stylist_id;
      }

      function setStylistId($stylist_id)
      {
        $this->stylist_id = $stylist_id;
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


      function delete()
      {
        $id = $this->getId();
        $GLOBALS['DB']->exec("DELETE FROM customers  WHERE id={$id};");
      }

      function getAll()
      {
        $returned_customers = $GLOBALS['DB']->query("SELECT * FROM customers;");

        $customers = array();
        foreach ($returned_customers as $customer) {
          $name = $customer['name'];
          $id = $customer['id'];
          $stylist_id = $customer['stylist_id'];
          $new_customer = new Customer($name, $stylist_id, $id);
          array_push($customers, $new_customer);
        }
        return $customers;
      }

      static function find($search_id)
      {
        $found_customer = null;
        $customers = Customer::getAll();
        foreach ($customers as $customer) {
          $customer_id = $customer->getId();
          if ($customer_id == $search_id) {
              $found_customer = $customer;
          }
        }
        return $found_customer;
      }

      function deleteAll()
      {
        $GLOBALS['DB']->exec("DELETE FROM customers;");
      }
    }
?>