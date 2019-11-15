<?php

  $webtitle = "Registratie";

  $activetab = "registration";

  $js = [
    "registration"
  ];

  require_once dirname(__DIR__).'/Layout/header.php';

  if (!Guard::authenticated()) header("Location:/");

  $currentPage = $_GET["p"] ?? 1;

  $perPage = 10;

  $user = User::find($_SESSION["user_id"]);
  $registrations = Registration::where(["user_id" => $user->id]);

  $pagination = new Pagination([
    "url" => "/Registration",
    "dataSet" => $registrations,
    "perPage" => $perPage,
    "currentPage" => $currentPage
  ]);

  $rows = $pagination->getSubsets();
?>

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow border-bottom-danger">
          <div class="card-body">
            <div class="h3 font-weight-normal text-danger">Registratie</div>
            
              <?php 
                if (!empty($registrations)) {
              ?>
              
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
                      if (!empty($registrations)) {
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
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            
              <?php
                  echo $pagination->getLinks();
                }
              ?>
            
            <button class="btn btn-danger btn-sm" id="registration-form-trigger"><i class="fas fa-road"></i> Nieuw</button>
            <div class="registration-form-shell"></div>
          
          </div>
        </div>
      </div>
    </div>
  </div>

<?php

  require_once dirname(__DIR__).'/Layout/footer.php';

?>  