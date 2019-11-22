<?php

  require_once dirname(__DIR__, 2).'/config/initialize.php';

  if (!Guard::authenticated() || !Guard::role("administrator")) header("Location:/");

  $users = User::all();

?>

  <?php
    if (!empty($users)) {
  ?>

  <div class="table-responsive">
    <table class="table table-hover table-striped">
      <thead>
        <tr>
          <th></th>
          <th>Naam</th>
          <th>rol</th>
          <th>Auto</th>
          <th>Aangemaakt op</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if (!empty($users)) {
            foreach ($users as $user) {
        ?>
          <tr>
            <th>
              <a href="/Management/User/?id=<?= $user->id; ?>" class="text-muted mr-3"><i class="fas fa-ellipsis-v"></i></a>
              <?php if ($_SESSION["user_id"] != $user->id) { ?>
              <a href="#" data-id="<?= $user->id; ?>" class="text-muted delete-user-trigger mr-3"><i class="fas fa-trash"></i></a>
              <?php } ?>
              <a href="/Handlers/Registration/export.php?id=<?= $user->id; ?>" class="text-success" title="Exporteer registraties naar csv"><i class="fas fa-file-excel"></i></a>
            </th>
            <td><?= $user->name; ?></td>
            <td><?= $user->role; ?></td>
            <td><?= (is_object($user->getCar())) ? $user->getCar()->licenseplate : ""; ?></td>
            <td><?= date("d/m/y", strtotime($user->created_at)); ?></td>
          </tr>
        <?php
            }
          }
        ?>
      </tbody>
    </table>
  </div>

  <button class="btn btn-danger btn-sm" id="user-form-trigger"><i class="fas fa-user"></i> Nieuw</button>
  <div class="user-form-shell"></div>

  <?php
//       echo $pagination->getLinks();
    }
  ?>

<?php

  require_once dirname(__DIR__)."/Layout/footer.php";

?>  