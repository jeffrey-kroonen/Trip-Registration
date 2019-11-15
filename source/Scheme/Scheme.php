<?php

  class Scheme implements TableInterface {
    
    public $id;
    public $user_id;
    public $from_address;
    public $to_address;
    public $distance;
    public $interval;
    
    public static $days = [
                    "monday" => "maandag",
                    "tuesday" => "dinsdag",
                    "wednesday" => "woensdag",
                    "thursday" => "donderdag",
                    "friday" => "vrijdag"
                  ];
    
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
        $query = "SELECT * FROM `schemes` WHERE `schemes`.`id` = ?";
        $params = [$mixed];
      } else if (is_array($mixed)) {
        $query = "SELECT * FROM `schemes` WHERE `".implode("` = ? AND `", array_keys($mixed))."` = ?";
        $params = array_values($mixed);
      }
      $schemes = Database::find($query, $params);
      
      if ($schemes !== FALSE) {
       return new self($schemes); 
      }
    }
    
    public static function where(array $params) : array
    {
      $schemes = array();
      
      $query = "SELECT * FROM `schemes` WHERE `".implode("` = ? AND `", array_keys($params))."` = ?";
      $params = array_values($params);
      
      $dataSet = Database::findAll($query, $params);
      
      if ($dataSet !== FALSE) {
        foreach ($dataSet as $scheme) {
          array_push($schemes, new self($scheme));
        }
      }
      return $schemes;
    }
    
    public static function all() : array
    {
      $query = "SELECT * FROM `schemes`";
      $dataSet = Database::findAll($query);
      
      $schemes = array();
      
      if ($dataSet !== FALSE) {
        foreach ($dataSet as $scheme) {
          array_push($schemes, new self($scheme));
        }
      }
      
      return $schemes;
      
    }
    
    public function save() : void
    {
      $table = "schemes";
      $params = [
        "user_id" => $this->user_id,
        "from_address" => $this->from_address,
        "to_address" => $this->to_address,
        "distance" => $this->distance,
        "interval" => $this->interval
      ];
      
      if (isset($this->id)) { 
        Database::update($table, $params, "WHERE id = ?", [$this->id]);
      } else {
        Database::insert($table, $params);
      }
    }
    
    public function delete() : void
    {
      if (isset($this->id)) {
        Database::delete("schemes", ["id" => $this->id]);
      }
    }
    
    public function getDays() : string
    {
      $array = json_decode($this->interval, true);
      
      $return = "";
      
      foreach ($array as $day) {
        $return .= static::$days[$day].", ";
      }
      
      return substr($return, 0, -2);
      
    }
    
  }