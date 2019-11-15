<?php

  require_once dirname(__DIR__, 3)."/config/initialize.php";

  if (!Guard::authenticated() || !Guard::role("administrator")) header("Location:/");
  
  $id = isset($_POST["id"]) ? (int)$_POST["id"] : NULL;
  $user_id = isset($_POST["user_id"]) ? (int)$_POST["user_id"] : NULL;
  $licenseplate = $_POST["licenseplate"] ?? NULL;

  if (!empty($id) && !empty($licenseplate)) {
    
    if (!is_null($user_id)) {
      $users = User::where(["car_id" => $id]);
      
      foreach ($users as $user) {
        Database::update("users", ["car_id" => NULL], "WHERE id = ?", [$user->id]); 
      }
      
      Database::update("users", ["car_id" => $id], "WHERE id = ?", [$user_id]);
    }
    
    $car = Car::find($id);
        
    if ($car) {
      $car->licenseplate = $licenseplate;
      $car->save();
    }
    
  } else {
    echo "empty";
  }