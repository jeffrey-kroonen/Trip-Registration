<?php

  require_once dirname(__DIR__, 2).'/config/initialize.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= APPNAME." | ".$webtitle = $webtitle ?? "" ; ?></title>
  <!-- CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="/app/Assets/Css/bootstrap-extended.css">
  <link rel="stylesheet" href="/app/Assets/Css/custom.css">
  <link rel="stylesheet" href="/app/Assets/Css/sidebar.css">
  <!-- JavaScript -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/ca4ffad8e6.js" crossorigin="anonymous"></script>
  <?php
    if (isset($js)) {
      foreach ($js as $script) {
      ?>
        <script src="/app/Assets/Javascript/<?= $script; ?>.js"></script>
      <?php 
      }
    }
  ?>
</head>
<body>
  
  <div class="d-flex" id="wrapper">
    
    <?php 
      if (Guard::authenticated()) {
        require_once dirname(__DIR__)."/Layout/sidebar.php";
      }
    ?>
    
    <div id="page-content-wrapper">
    
      <?php
        if (Guard::authenticated()) {
      ?>
          <button class="btn btn-danger btn-sm m-2" id="menu-toggle"><i class="fas fa-bars"></i></button>
      <?php
        }
      ?>