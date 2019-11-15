<?php

  require_once dirname(__DIR__, 3)."/config/initialize.php";

  if (!Guard::authenticated()) header("Location:/");

  $from_address = $_POST["from_address"];
  $to_address = $_POST["to_address"];
  $distance = $_POST["distance"];
  $date = $_POST["date"];
  
  if (!empty($from_address) && !empty($to_address) && !empty($distance) && !empty($date)) {
    
    $user = User::find($_SESSION["user_id"]);
    
    if (!is_null($user) && !is_null($user->car_id)) {
      
      $registration = new Registration;
      $registration->date = date("Y-m-d", strtotime($date));
      $registration->from_address = $from_address;
      $registration->to_address = $to_address;
      $registration->distance = str_replace(",",".", $distance);
      $registration->car_id = $user->car_id;
      $registration->user_id = $user->id;
      $registration->save();
      echo "success";
      
    } else {
      echo "no car";
    }
    
  } else {
    echo "empty";
  }