<?php

  class Export {
    
    private $delimeter;
    
    public function __construct() 
    {
      $this->delimeter = ";";
    }
    
    public function registrations(int $id)
    {
      $registrations = Registration::where(["user_id" => $id]);
      
      $fpath = dirname(__DIR__, 2)."/app/Documents/Exports/".date("m d Y H-i").".csv";
      
      $file = fopen($fpath, "w");
      
      $attributes = array_keys(get_object_vars($registrations[0]));
      $headers = array();
      
      foreach ($attributes as $attribute) {
        if (strpos($attribute, "user") !== false) {
          array_push($headers, "username");
        } else if (strpos($attribute, "car") !== false) {
          array_push($headers, "licenseplate");
        } else {
          array_push($headers, $attribute);
        }
      }
      
     
      fputcsv($file, $headers, $this->delimeter);
      
      foreach ($registrations as $registration) {
        
        foreach ($registration as $attribute => $value) {
          if (strpos($attribute, "user") !== false) {
            $registration->user_id = User::find($value)->name;
          } else if (strpos($attribute, "car") !== false) {
            $registration->car_id = Car::find($value)->licenseplate;
          } 
        }
        
        fputcsv($file, (array) $registration, $this->delimeter);
      }
      
      fclose($file);
      
      
      if (file_exists($fpath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($fpath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fpath));
        readfile($fpath);
      };
      
      unlink($fpath);
      
    }
    
  }