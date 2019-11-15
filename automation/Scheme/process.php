<?php

  require_once dirname(__DIR__, 2)."/config/initialize.php";

  $schemes = Scheme::all();
  
  $toDay = strtolower(date("l"));

  foreach ($schemes as $scheme) {
    
    $user = User::find($scheme->user_id);
    
    $interval = json_decode($scheme->interval, true);
    
    foreach ($interval as $day) {
      $day = strtolower($day);
      
      if ($toDay == $day) {
        
        $registration = new Registration;
        $registration->date = date("Y-m-d");
        $registration->from_address = $scheme->from_address;
        $registration->to_address = $scheme->to_address;
        $registration->distance = $scheme->distance;
        $registration->car_id = $user->car_id;
        $registration->user_id = $user->id;
        $registration->save();
        
      }
      
    }
    
  }