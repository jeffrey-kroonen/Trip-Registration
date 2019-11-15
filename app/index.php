<?php

  $webtitle = "Dashboard";

  $activetab = "dashboard";

  require_once dirname(__FILE__).'/Layout/header.php';

  if (!Guard::authenticated()) header("Location:Authentication/");

?>

  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow border-bottom-danger">
          <div class="card-body">
            <div class="h3 font-weight-normal text-danger">Dashboard</div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php

  require_once dirname(__FILE__).'/Layout/footer.php';

?>  