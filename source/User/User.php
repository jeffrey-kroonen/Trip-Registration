<?php

  class User implements TableInterface {
    
    public $id;
    public $name;
    public $email;
    private $password;
    public $remembertoken;
    public $role;
    public $car_id;
    public $authenticated;
    
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
        $query = "SELECT * FROM `users` WHERE `users`.`id` = ?";
        $params = [$mixed];
      } else if (is_array($mixed)) {
        $query = "SELECT * FROM `users` WHERE `".implode("` = ? AND `", array_keys($mixed))."` = ?";
        $params = array_values($mixed);
      }
      
      if (isset($query) && isset($params)) {
        $user = Database::find($query, $params);
      
        if ($user !== FALSE) {
         return new self($user); 
        }
      }
    }
    
    public static function where(array $where) : array
    {
      $query = "SELECT * FROM `users` WHERE `".implode("` = ? AND `", array_keys($where))."` = ?";
      $params = array_values($where);
      
      $users = array();
      
      if (isset($query) && isset($params)) {
        $dataSet = Database::findAll($query, $params);
        
        foreach ($dataSet as $user) {
          array_push($users, new self($user));
        }
        
      }
      return $users;
    }
    
    public static function all() : array
    {
      $users = array();
      
      $dataSet = Database::findAll("SELECT * FROM `users`");
      
      foreach ($dataSet as $user) {
        array_push($users, new self($user));
      }
      
      return $users;
    }
    
    public function getCar()
    {
      if (!empty($this->car_id)) {
        return Car::find($this->car_id);
      } else {
        return NULL;
      }
    }
    
    public function save() : void
    {
      $table = "users";
      $params = [
        "name" => $this->name,
        "email" => $this->email,
        "password" => $this->password,
        "remembertoken" => $this->remembertoken ?? NULL,
        "role" => $this->role ?? NULL,
        "car_id" => $this->car_id ?? NULL
      ];
      
      if (isset($this->id)) { 
        Database::update($table, $params, "WHERE id = ?", [$this->id]);
      } else {
        $this->password = $this->generatePassword();
        /** Send notification to user with new password */
        
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $params["password"] = $this->password;
        
        Database::insert($table, $params);
      }
      
    }
    
    public function delete() : void
    {
      try {
        
        $registrations = Registration::where(["user_id" => $this->id]);
        
        foreach ($registrations as $registration) {
          $registration->delete();
        }
        
        Database::delete("users", ["id" => $this->id]);        
        
      } catch (Exception $e) {
        echo "error";
      }
    }
    
    private function generatePassword() : string
    {
      $string = crypt(uniqid(), "5h4HGF534!@d");
      return substr($string, 0, 8);
    }
    
    public function verify($password) : bool
    {
      if (password_verify($password, $this->password)) {
        return TRUE;
      }  else {
        return FALSE;
      }
    }
    
    public function setRemembertoken() : void
    {
      $cryptString = sha1($this->id.$this->email);
      $uid = uniqid();
      
      $this->remembertoken = $uid.$cryptString;
      
      setcookie(
        "user_id",
        $this->id,
        time() + (10 * 365 * 24 * 60 * 60),
        "/"
      );
      
      setcookie(
        "remembertoken",
        $this->remembertoken,
        time() + (10 * 365 * 24 * 60 * 60),
        "/"
      );
    }
    
    public function login() : void
    {
      session_regenerate_id();
      $_SESSION["user_id"] = $this->id;
      $_SESSION["name"] = $this->name;
      $_SESSION["email"] = $this->email;
      $_SESSION["role"] = $this->role;
      $_SESSION["car_id"] = $this->car_id;
      $_SESSION["authenticated"] = "TRUE";
    }
    
    
  }