<?php
  
  require_once dirname(__DIR__, 3)."/config/initialize.php";

  if (!Guard::authenticated()) header("Location:/");

  $users = User::all();

?>

<div class="modal fade" id="car-form-modal" tabindex="-1" role="dialog" aria-labelledby="car-form-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    
    <form id="car-form">
    
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="car-form-title">Nieuwe auto</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="msg mt-2 mb-2"></div>

          <div class="form-group">
            <label for="licenseplate">Kenteken</label>
            <input type="text" name="licenseplate" id="licenseplate" class="form-control">
          </div>
          
          <div class="form-group">
            <label for="user_id">Toewijzen aan</label>
            <select name="user_id" id="user_id" class="form-control">
              <option value="" disabled selected>Selecteer een gebruiker..</option>
                <?php
                  foreach ($users as $user) {
                ?>
                  <option value="<?= $user->id; ?>"><?= $user->name; ?></option>
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