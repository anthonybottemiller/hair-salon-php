<?php
    
    class Stylist
    {
      private $name;
      private $id;

      function __construct($name, $id = null)
      {
        $this->name = $name;
        $this->id = $id;
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
        $GLOBALS["DB"]->exec("INSERT INTO stylists (name) VALUES ('{$this->name}');");
        $this->id =$GLOBALS['DB']->lastInsertId();
      }

      function update()
      {
        $GLOBALS['DB']->exec("UPDATE stylists SET name='{$this->getName()}' WHERE id='{$this->getId()}';");
      }


      function getId()
      {
        return $this->id;
      }

      

      static function find($search_id)
      {
        $found_stylist = null;
        $stylists = Stylist::getAll();
        foreach ($stylists as $stylist) {
          $stylist_id = $stylist->getId();
          if ($stylist_id == $search_id) {
              $found_stylist = $stylist;
          }
        }
        return $found_stylist;
      }

      static function getAll()
      {
        $returned_stylists = $GLOBALS["DB"]->query("SELECT * FROM stylists;");

        $stylists = array();
        foreach($returned_stylists as $stylist) {
          $name = $stylist['name'];
          $id = $stylist['id'];
          $new_stylist = new Stylist($name, $id);
          array_push($stylists, $new_stylist);
        }

        return $stylists;
      }

      function delete()
      {
        $id = $this->getId();
        $GLOBALS['DB']->exec("DELETE FROM stylists  WHERE id={$id};");
      }

      static function deleteAll()
      {
        $GLOBALS["DB"]->exec("DELETE FROM stylists;");
      }

    }
?>