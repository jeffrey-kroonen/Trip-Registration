<?php

  session_start();

  session_destroy();

  session_unset();

  setcookie(
        "user_id",
        "",
        time() - 3600,
        "/"
      );
      
      setcookie(
        "remembertoken",
        "",
        time() - 3600,
        "/"
      );

  header("Location:/");