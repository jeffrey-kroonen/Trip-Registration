<?php

  class Car implements TableInterface {
    
    public $id;
    public $licenseplate;

    public function __construct($init = NULL) 
    {
      if (is_array($init)) {
        foreach ($init as $column => $value) {
          $this->$column = $value ?? NULL;
        }
      }
    }    

    public static function find($mixed)
    {
      if (is_int($mixed)) {
        $query = "SELECT * FROM `cars` WHERE `cars`.`id` = ?";
        $params = [$mixed];
      } else if (is_array($mixed)) {
        $query = "SELECT * FROM `cars` WHERE `".implode("` = ? AND `", array_keys($mixed))."` = ?";
        $params = array_values($mixed);
      }
      
      $car = Database::find($query, $params);
      
      if ($car !== FALSE) {
       return new self($car); 
      }
    }
    
    public static function where(array $where) : array
    {
      $query = "SELECT * FROM `cars` WHERE `".implode("` = ? AND `", array_keys($where))."` = ?";
      $params = array_values($where);
      
      $car = array();
      
      if (isset($query) && isset($params)) {
        $dataSet = Database::findAll($query, $params);
        
        foreach ($dataSet as $car) {
          array_push($cars, new self($car));
        }
        
      }
      return $cars;
    }
    
    public static function all() : array
    {
      $cars = array();
      
      $dataSet = Database::findAll("SELECT * FROM `cars`");
      
      foreach ($dataSet as $car) {
        array_push($cars, new self($car));
      }
      
      return $cars;
    }
    
    public function save() : void
    {
      $table = "cars";
      $params = [
        "licenseplate" => $this->licenseplate,
      ];
      
      if (isset($this->id)) { 
        Database::update($table, $params, "WHERE id = ?", [$this->id]);
      } else {
        Database::insert($table, $params);
      }
      
    }
    
    public function delete() : void
    {
      try {
        Database::update("users", ["car_id" => NULL], "WHERE car_id = ?", [$this->id]);
        Database::delete("cars", ["id" => $this->id]);
      } catch (Exception $e) {
        echo "error";
      }
    }
    
    public function getUser()
    {
      $user = User::find(["car_id" => $this->id]);
      if ($user) {
        return $user;
      } else {
        return NULL;
      }
    }
    
  }
    