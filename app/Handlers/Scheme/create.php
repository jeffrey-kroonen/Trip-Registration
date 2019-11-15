<?php

  require_once dirname(__DIR__, 3)."/config/initialize.php";

  if (!Guard::authenticated()) header("Location:/");

  $user_id = (int)$_POST["user_id"];
  $from_address = $_POST["from_address"];
  $to_address = $_POST["to_address"];
  $distance = isset($_POST["distance"]) ? str_replace(",", ".", $_POST["distance"]) : NULL;
  $interval = $_POST["interval"] ?? NULL;

  if (!empty($user_id) && !empty($from_address) && !empty($to_address) && !empty($distance) && !empty($interval)) {
    
    $scheme = new Scheme;
    $scheme->user_id = $user_id;
    $scheme->from_address = $from_address;
    $scheme->to_address = $to_address;
    $scheme->distance = $distance;
    $scheme->interval = json_encode($interval,JSON_FORCE_OBJECT);
    $scheme->save();
    echo "success";
    
  } else {
    echo "empty";
  }