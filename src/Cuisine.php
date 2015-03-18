<?php

    Class Cuisine
    {
        private $type;
        private $id;

    // constructor for cuisine instances

        function __construct($type, $id = null)
        {
         $this->type = $type;
         $this->id = $id;
        }

    // getters and setters for private properties

        function setType($new_type)
        {
         $this->type = $new_type;

        }

        function getType()
        {
         return $this->type;
        }

        function setTypeId($new_id)
        {
         $this->id = $new_id;
        }

        function getTypeId()
        {
         return $this->id;
        }

    // methods to interact with databse

        function save()
        {
             $statement = $GLOBALS['DB']->query("INSERT INTO cuisine (type) VALUES ('{$this->getType}') RETURNING id;");
             $result = $statement->fetch(PDO::FETCH_ASSOC);
             $this->setTypeId($result['id']);
        }


        static function getAll()
        {
             $returned_type = $GLOBALS['DB']->query("SELECT * FROM cuisine;");
             $cuisine = array();
             foreach($returned_type as $food) {
                 $type = $food['type'];
                 $id = $food['id'];
                 $new_type = new Cuisine($type, $id);
                 array_push($returned_type, $new_type);
         }
          return $cuisine;
        }
        static function deleteAll()
        {
                $GLOBALS['DB']->exec("DELETE FROM cuisine *;");
        }
    }



?>
