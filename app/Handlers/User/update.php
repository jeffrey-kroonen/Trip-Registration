<?php

  require_once dirname(__DIR__, 3)."/config/initialize.php";

  if (!Guard::authenticated() || !Guard::role("administrator")) header("Location:/");

  $id = (int)$_POST["id"];
  $name = $_POST["name"];
  $email = $_POST["email"];
  $role = $_POST["role"];
  $car_id = isset($_POST["car_id"]) ? (int)$_POST["car_id"] : NULL;

  if (!empty($name) && !empty($email) && !empty($role)) {
    
    if (!is_null($car_id)) {
      $users = User::where(["car_id" => $car_id]);
    
      foreach ($users as $user) {
        Database::update("users", ["car_id" => NULL], "WHERE id = ?", [$user->id]);
      }
    }
    
    $user = User::find($id);
        
    if ($user) {
      $user->name = $name;
      $user->email = $email;
      $user->role = $role;
      $user->car_id = $car_id;
      $user->save();
    }
    
  } else {
    echo "empty";
  }