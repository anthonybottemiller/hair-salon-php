<?php
    class Customer
    {
      private $name;

      function __construct($name)
      {
        $this->name = $name;
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