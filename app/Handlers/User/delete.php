<?php

  require_once dirname(__DIR__, 3)."/config/initialize.php";

  if (!Guard::authenticated() || !Guard::role("administrator")) header("Location:/");

  $id = isset($_POST["id"]) ? (int)$_POST["id"] : NULL;
  
  if (!empty($id)) {
    
    $user = User::find($id);
    
    if (!is_null($user)) {
      $user->delete();
      echo "success";
    } else {
      echo "not found";
    }
    
  } else {
    echo "empty";
  }