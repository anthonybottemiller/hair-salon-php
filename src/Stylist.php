<?php
    
    class Stylist
    {
      private $name;

      function __construct($name)

      {
        $this->name = $name;
      }

      function save()

      {
        $GLOBALS['DB']->exec("INSERT INTO tasks (name) Values ('{$this->name}';");
      }

      static function getAll()

      {
        $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");

        $stylists = array();
        foreach($returned_stylists as $stylist) {
          $name = $stylist['name'];
          $new_stylist = new Stylist($name);
          array_push($stylists, $new_stylist);
        }
        return $stylists;
      }
    }
?>