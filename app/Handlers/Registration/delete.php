<?php

  require_once dirname(__DIR__, 3)."/config/initialize.php";

  if (!Guard::authenticated()) header("Location:/");

  $id = (int)$_POST["id"];
  
  if (!empty($id)) {
    
    $registration = Registration::find($id);
    
    if (!is_null($registration)) {
      $registration->delete();
      echo "success";
    } else {
      echo "not found";
    }
    
  } else {
    echo "empty";
  }