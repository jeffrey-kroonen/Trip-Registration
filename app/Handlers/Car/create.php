<?php

  require_once dirname(__DIR__, 3)."/config/initialize.php";

  if (!Guard::authenticated() || !Guard::role("administrator")) header("Location:/");

  $licenseplate = $_POST["licenseplate"];
  $user_id = (array_key_exists("user_id", $_POST)) ? (int)$_POST["user_id"] : NULL;

  if (!empty($licenseplate)) {
    
    $car = Car::find(["licenseplate" => $licenseplate]);
    
    if (!$car) {
      $car = new Car;
      $car->licenseplate = $licenseplate;
      $car->save();
      
      if (!is_null($user_id)) {
        $car = Car::find(["licenseplate" => $licenseplate]);
        $user = User::find($user_id);
        $user->car_id = $car->id;
        $user->save();
      }
      
      echo "success";
      
    } else{
      echo "exists";
    }
    
  } else {
    echo "empty";
  }