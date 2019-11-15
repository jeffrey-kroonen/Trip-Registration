<?php
  
  require_once dirname(__DIR__, 3)."/config/initialize.php";

  if (!Guard::authenticated()) header("Location:/");

  $cars = Car::all();

?>

<div class="modal fade" id="user-form-modal" tabindex="-1" role="dialog" aria-labelledby="user-form-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    
    <form id="user-form">
    
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="user-form-title">Nieuwe gebruiker</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="msg mt-2 mb-2"></div>

          <div class="form-group">
            <label for="name">Naam</label>
            <input type="text" name="name" id="name" class="form-control">
          </div>
          
          <div class="form-group">
            <label for="email">E-mail adres</label>
            <input type="email" name="email" id="email" class="form-control">
          </div>
          
          <div class="form-group">
            <label for="role">Rol</label>
            <select name="role" id="role" class="form-control">
              <option value="user" selected>Gebruiker</option>
              <option value="administrator">Administrator</option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="car_id">Auto</label>
            <select name="car_id" id="car_id" class="form-control">
              <option value="" disabled selected>Selecteer een auto..</option>
              <?php
                foreach ($cars as $car) {
              ?>
                <option value="<?= $car->id; ?>"><?= $car->licenseplate; ?></option>
              <?php
                }
              ?>
            </select>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Sluiten</button>
          <button type="submmit" class="btn btn-danger">Invoeren</button>
        </div>
      </div>
      
    </form>
      
  </div>
</div>