<?php

  require_once dirname(__DIR__, 3)."/config/initialize.php";

  $email = $_POST["email"] ?? NULL;
  $password = $_POST["password"] ?? NULL;

  if (empty($email) || empty($password)) {
    echo "empty";
    exit;
  }

  $user = User::find(["email" => $email]);

  if (!is_object($user)) {
    echo "not found";
    exit;
  }

  if ($user->verify($password)) {
    if ($_POST["remember-me"] == 1) {
      $user->setRemembertoken();
      $user->save();
    }

    $user->login();
    echo "success"; 
  } else {
    echo "error";
  }
  exit;