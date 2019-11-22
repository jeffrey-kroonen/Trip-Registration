<?php

  require_once dirname(__DIR__, 3)."/config/initialize.php";

  if (!Guard::authenticated() || !Guard::role("administrator")) header("Location:/");

  /** user id */
  $id = isset($_GET["id"]) ? (int)$_GET["id"] : null;

  if (!is_null($id)) {
    
    $user = User::find($id);
    
    if ($user) {
      
      $export = new Export;
      $export->registrations($user->id);
      
    } else {
      echo "does not exist";
    }
    
  } else {
    echo "empty";
  }