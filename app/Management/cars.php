<?php

  require_once dirname(__DIR__, 2).'/config/initialize.php';

  if (!Guard::authenticated() || !Guard::role("administrator")) header("Location:/");

  $cars = Car::all();

?>

  <?php
    if (!empty($cars)) {
  ?>

  <div class="table-responsive">
    <table class="table table-hover table-striped">
      <thead>
        <tr>
          <th></th>
          <th>Kenteken</th>
          <th>Toegekend aan</th>
          <th>Aangemaakt op</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if (!empty($cars)) {
            foreach ($cars as $car) {
        ?>
          <tr>
            <th>
              <a href="/Management/Car/?id=<?= $car->id; ?>" class="text-muted mr-3"><i class="fas fa-ellipsis-v"></i></a>
              <a href="#" data-id="<?= $car->id; ?>" class="text-muted delete-car-trigger"><i class="fas fa-trash"></i></a>
            </th>
            <td><?= $car->licenseplate; ?></td>
            <td><?= (is_object($car->getUser())) ? $car->getUser()->name : ""; ?></td>
            <td><?= date("d/m/y", strtotime($car->created_at)); ?></td>
          </tr>
        <?php
            }
          }
        ?>
      </tbody>
    </table>
  </div>

  <button class="btn btn-danger btn-sm" id="car-form-trigger"><i class="fas fa-car"></i> Nieuw</button>
  <div class="car-form-shell"></div>

  <?php
//       echo $pagination->getLinks();
    }
  ?>


<?php

  require_once dirname(__DIR__)."/Layout/footer.php";

?>  