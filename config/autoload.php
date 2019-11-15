<?php

  spl_autoload_register(function ($mixed) {
    
    /** Classes */
    $pathToClass = dirname(__DIR__)."/source/".ucfirst($mixed)."/".ucfirst($mixed).".php";
    
    /** Interfaces */
    $pathToInterface = dirname(__DIR__)."/source/Interfaces/".ucfirst($mixed).".php";
    
    if (file_exists($pathToClass)) {
      require_once $pathToClass;
    } else if (file_exists($pathToInterface)) {
      require_once $pathToInterface;
    } else {
      echo "File of class or interface $mixed not found";
    }
    
  });