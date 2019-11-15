<?php

  require_once dirname(__DIR__, 3)."/config/initialize.php";

  if (!Guard::authenticated() || !Guard::role("administrator")) header("Location:/");

  $id = (int)$_POST["id"];

  if (!empty($id)) {
    
    $car = Car::find($id);
    
    if (!is_null($car)) {
      $car->delete();
      echo "success";
    } else {
      echo "not found";
    }
    
  } else {
    echo "empty";
  }