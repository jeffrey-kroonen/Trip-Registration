<?php

  require_once dirname(__DIR__, 3)."/config/initialize.php";

  if (!Guard::authenticated() || !Guard::role("administrator")) header("Location:/");

  $name = $_POST["name"];
  $email = $_POST["email"];
  $role = $_POST["role"];
  $car_id = (array_key_exists("car_id", $_POST)) ? (int)$_POST["car_id"] : NULL;

  if (!empty($name) && !empty($email) && !empty($role)) {
    
    $user = User::find(["email" => $email]);
    
    if (!$user) {
      $user = new User;
      $user->name = $name;
      $user->email = $email;
      $user->role = $role;
      $user->car_id = $car_id;
      $user->save();
      
      echo "success";
      
    } else{
      echo "exists";
    }
    
  } else {
    echo "empty";
  }