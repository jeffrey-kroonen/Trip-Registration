<?php

  require_once dirname(__DIR__, 3).'/config/initialize.php';

  if (!Guard::authenticated() || !Guard::role("administrator")) header("Location:/");

  if (isset($user)) {
    $registrations = Registration::where(["user_id" => $user->id]);
  }

  if (!empty($registrations)) {
    
  $currentPage = $_GET["p"] ?? 1;

  $perPage = 10; 
   
  $pagination = new Pagination([
    "url" => "/Management/User/?id=".$user->id,
    "dataSet" => $registrations,
    "perPage" => $perPage,
    "currentPage" => $currentPage
  ]);

  $rows = $pagination->getSubsets();

?>

  <div class="container-fluid mt-5 mb-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow border-bottom-danger">
          <div class="card-body">
            <div class="h3 font-weight-normal text-danger">Registraties</div>
            
              <div class="table-responsive">
                <table class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Van</th>
                      <th>Naar</th>
                      <th>Afstand (km)</th>
                      <th>Datum</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($rows as $registration) {
                    ?>
                      <tr>
                        <th><a href="#" data-id="<?= $registration->id ?>" class="text-muted delete-registration-trigger"><i class="fas fa-trash"></i></a></th>
                        <td><?= $registration->from_address; ?></td>
                        <td><?= $registration->to_address; ?></td>
                        <td><?= $registration->distance; ?></td>
                        <td><?= date("d/m/y", strtotime($registration->date)); ?></td>
                      </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            
              <div class="d-flex justify-content-between align-items-center">
              <?= $pagination->getLinks(); ?>
            
              
                <a href="/Handlers/Registration/export.php?id=<?= $user->id; ?>" class="btn btn-success btn-sm"><i class="fas fa-file-excel"></i> Exporteren</a>
              </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
    
  }

?>