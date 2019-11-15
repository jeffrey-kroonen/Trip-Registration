<?php
  
  require_once dirname(__DIR__, 3)."/config/initialize.php";

  if (!Guard::authenticated()) header("Location:/");

  $days = Scheme::$days;

?>

<div class="modal fade" id="scheme-form-modal" tabindex="-1" role="dialog" aria-labelledby="scheme-form-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    
    <form id="scheme-form">
    
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="scheme-form-title">Nieuw schema</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="msg mt-2 mb-2"></div>
          <input type="hidden" name="user_id" value="<?= $_SESSION['user_id']; ?>">
          <div class="form-group">
            <label for="from_address">Van</label>
            <input type="text" name="from_address" id="from_address" class="form-control">
          </div>
          <div class="form-group">
            <label for="to_address">Naar</label>
            <input type="text" name="to_address" id="to_address" class="form-control">
          </div>
          <div class="form-group">
            <label for="distance">Afstand (km)</label>
            <input type="text" name="distance" id="distance" class="form-control">
          </div>
          <label for="date">Dagen</label>
          <div class="form-group">
            <?php
              foreach ($days as $key => $day) {
            ?>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="<?= $key; ?>" value="<?= $key; ?>" name="interval[]">
              <label class="form-check-label" for="<?= $key; ?>"><?= $day; ?></label>
            </div>
            <?php
              }
            ?>
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