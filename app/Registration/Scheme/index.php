<?php

  $webtitle = "Schema";

  $activetab = "scheme";

  $js = [
    "scheme"
  ];

  require_once dirname(__DIR__, 2).'/Layout/header.php';

  if (!Guard::authenticated()) header("Location:/");

  $schemes = Scheme::where(["user_id" => $_SESSION["user_id"]]);

?>
  
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="d-flex justify-content-between mb-2">
          <div class="h3 font-weight-normal text-danger">Schema</div>
          <button class="btn btn-danger btn-sm mt-2" id="scheme-form-trigger"><i class="fas fa-list-ul"></i> Nieuw</button>
        </div>
        <?php
          if (!empty($schemes)) {
            
            $chunks = array_chunk($schemes, 3);
            
            foreach ($chunks as $chunk) {
        ?>
        
        <div class="row mb-4">
          
          <?php
            foreach ($chunk as $scheme) {
          ?>
          <div class="col-md-4">
            <a href="#" data-id="<?= $scheme->id ?>" class="text-muted float-left delete-scheme-trigger m-2"><i class="fas fa-trash"></i></a>
            <div class="card shadow border-bottom-danger">
              <table class="table table-bordered mb-0">
                <tbody>
                <tr>
                  <th>Van</th>
                  <td><?= $scheme->from_address; ?></td>
                </tr>
                <tr>
                  <th>Naar</th>
                  <td><?= $scheme->to_address; ?></td>
                </tr>
                <tr>
                  <th>Afstand</th>
                  <td><?= $scheme->distance; ?></td>
                </tr>
                <tr>
                  <th>Dagen</th>
                  <td><?= $scheme->getDays(); ?></td>
                </tr>
                </tbody>
              </table>
            </div>
          </div>
          <?php
            }
          ?>
        </div>
        <?php
            }
          } else {
        ?>
        <p>Er zijn nog geen schema's aangemaakt.</p>
        <?php
          }
        ?>
      </div>
    </div>
  </div>

  <div class="scheme-form-shell"></div>

<?php

  require_once dirname(__DIR__, 2).'/Layout/footer.php';

?>  