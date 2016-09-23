<?php
    
    class Stylist
    {
      private $name;

      function __construct($name)
      {
        $this->name = $name;
      }

      function save
      {
        $GLOBALS['DB']->exec("INSERT INTO tasks (name) Values ('{$this->name}';");
      }

      static function getAll
      
      {
        
      }
    }
?>