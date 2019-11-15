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

  $car = Car::find($id);
  $users = User::all();

  $ownedBy = $car->getUser();

  if ($car) {

?>

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow border-bottom-danger">
          <div class="card-body">
            <div class="h3 font-weight-normal text-danger">Auto</div>
            
            <form id="edit-car-form">
              <input type="hidden" name="id" value="<?= $car->id; ?>">
              <div class="form-group">  
                <label for="licenseplate">Kenteken</label>
                <input type="text" name="licenseplate" id="licenseplate" class="form-control edit-car-control" value="<?= $car->licenseplate; ?>">
              </div>
              <div class="form-group">  
                <label for="car_id">Toegekend aan</label>
                <select name="user_id" id="user_id" class="form-control edit-car-control">
                  <option value="" disabled <?= (is_null($ownedBy)) ? "selected" : ""; ?>>Selecteer een gebruiker..</option>
                  <?php
                    foreach ($users as $user) {
                  ?>
                    <option value="<?= $user->id; ?>" <?= ((!is_null($ownedBy)) && ($user->car_id == $ownedBy->car_id)) ? "selected" : ""; ?>><?= $user->name; ?></option>
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
              
  }
              
  require_once dirname(__DIR__, 2).'/Layout/footer.php';

?>  