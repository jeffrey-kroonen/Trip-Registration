<?php

  $webtitle = "Beheer";

  $activetab = "management";

  $js = [
    "management",
    "registration"
  ];

  require_once dirname(__DIR__, 2).'/Layout/header.php';

  if (!Guard::authenticated() || !Guard::role("administrator")) header("Location:/");
  
  if (isset($_GET["id"])) {
    $id = (int)$_GET["id"];
  } else {
    header("Location:/");
  }

  $user = User::find($id);
  $cars = Car::all();

  if ($user) {

?>

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow border-bottom-danger">
          <div class="card-body">
            <div class="h3 font-weight-normal text-danger"><?= $user->name; ?></div>
            
            <form id="edit-user-form">
              <input type="hidden" name="id" value="<?= $user->id; ?>">
              <div class="form-group">  
                <label for="name">Naam</label>
                <input type="text" name="name" id="name" class="form-control edit-user-control" value="<?= $user->name; ?>">
              </div>
              <div class="form-group">  
                <label for="email">E-mail adres</label>
                <input type="email" name="email" id="email" class="form-control edit-user-control" value="<?= $user->email; ?>">
              </div>
              <div class="form-group">  
                <label for="role">Rol</label>
                <select name="role" id="role" class="form-control edit-user-control">
                  <option value="user" <?= $user->role == "user" ? "selected" : ""; ?>>Gebruiker</option>
                  <option value="administrator" <?= $user->role == "administrator" ? "selected" : ""; ?>>Administrator</option>
                </select>
              </div>
              <div class="form-group">  
                <label for="car_id">Auto</label>
                <select name="car_id" id="car_id" class="form-control edit-user-control">
                  <option value="" disabled <?= (is_null($user->car_id)) ? "selected" : ""; ?>>Selecteer een auto..</option>
                  <?php
                    foreach ($cars as $car) {
                  ?>
                    <option value="<?= $car->id; ?>" <?= ($car->id == $user->car_id) ? "selected" : ""; ?>><?= $car->licenseplate; ?></option>
                  <?php
                    }
                  ?>
                </select>
              </div>
            </form>
            
          </div>
        </div>
        
        <div class="msg mt-5"></div>
        
      </div>
    </div>
  </div>


<?php
  
  require_once "list-registrations.php";
              
  }
              
  require_once dirname(__DIR__, 2).'/Layout/footer.php';

?>  