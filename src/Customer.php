<?php
    class Customer
    {
      private $name;
      private $stylist_id;

      function __construct($name, $stylist_id = null)
      {
        $this->name = $name;
        $this->stylist_id = $stylist_id;
      }

      function getName()
      {
        return $this->name;
      }

      function setName($new_name)
      {
        $this->name = (string) ($new_name);
      }
    }
?>