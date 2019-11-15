<?php

  class Guard {
    
    private static $roles = [
      "user",
      "administrator"
    ];
    
    public static function authenticated() : bool
    {
      if (isset($_SESSION["authenticated"]) && $_SESSION["authenticated"] === "TRUE") {
        return TRUE;
      } else {
        return FALSE;
      }
    }
    
    public static function role(string $preferredRole) : bool
    {
      
      if (!isset($_SESSION["role"])) {
        return FALSE;
      }
      
      if (in_array($preferredRole, static::$roles)) {
        if ($_SESSION["role"] === $preferredRole) {
          return TRUE;
        } else {
          return FALSE;
        }
      } else {
        die("Defined role doesn't exists."); 
      }
    }
    
    public static function remembertoken()
    {
      if (isset($_COOKIE["user_id"]) && isset($_COOKIE["remembertoken"])) {
        
        $user = User::find((int)$_COOKIE["user_id"]);
        
        if (!is_null($user)) {
          if ($user->remembertoken == $_COOKIE["remembertoken"] && !static::authenticated()) {
            $user->login();
            header("Location:/");
          }
        }
      }
    }
    
  }