<?php
 
  class Registration implements TableInterface {
    
    public $id;
    public $date;
    public $from_address;
    public $to_address;
    public $distance;
    public $car_id;
    public $user_id;
    
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
        $query = "SELECT * FROM `registrations` WHERE `registrations`.`id` = ?";
        $params = [$mixed];
      } else if (is_array($mixed)) {
        $query = "SELECT * FROM `registrations` WHERE `".implode("` = ? AND `", array_keys($mixed))."` = ?";
        $params = array_values($mixed);
      }
      $registration = Database::find($query, $params);
      
      if ($registration !== FALSE) {
       return new self($registration); 
      }
    }
    
    public static function where(array $params) : array
    {
      $query = "SELECT * FROM `registrations` WHERE `".implode("` = ? AND `", array_keys($params))."` = ?";
      $query .= " ORDER BY `date` DESC";
      $params = array_values($params);
      
      $dataSet = Database::findAll($query, $params);
      
      $registrations = array();
      
      if ($dataSet !== FALSE) {
        foreach ($dataSet as $registration) {
          array_push($registrations, new self($registration));
        }
        
       return $registrations;
      }
    }
    
    public static function all() : array
    {
      $query = "SELECT * FROM `registrations`";
      $dataSet = Database::findAll($query);
      
      $registrations = array();
      
      if ($registrations !== FALSE) {
        foreach ($dataSet as $registration) {
          array_push($registrations, new self($registration));
        }
      }
      
      return $registrations;
      
    }
    
    public function save() : void
    { 
      $table = "registrations";
      $params = [
        "date" => $this->date,
        "from_address" => $this->from_address,
        "to_address" => $this->to_address,
        "distance" => $this->distance,
        "car_id" => $this->car_id,
        "user_id" => $this->user_id
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
        Database::delete("registrations", ["id" => $this->id]);
      }
    }
    
  }