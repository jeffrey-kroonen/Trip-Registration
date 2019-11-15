<?php

  $webtitle = "Beheer";

  $activetab = "management";

  $js = [
    "management",
  ];
 
  require_once dirname(__DIR__).'/Layout/header.php';

  if (!Guard::authenticated() || !Guard::role("administrator")) header("Location:/");

?>

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow border-bottom-danger">
          <div class="card-body">
            <div class="h3 font-weight-normal text-danger">Beheer</div>
              <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link active" href="#">Gebruikers</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Auto&apos;s</a>
                </li>
             </ul>
            <div id="content"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php

  require_once dirname(__DIR__).'/Layout/footer.php';

?>  