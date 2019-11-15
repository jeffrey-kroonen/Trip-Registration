<div class="bg-light border-right" id="sidebar-wrapper">
  <div class="sidebar-heading font-weight-bold text-light"><?= APPNAME ?> </div>
  <div class="list-group list-group-flush">
    <a href="/" class="list-group-item list-group-item-action bg-light <?= $activetab == "dashboard" ? "active" : ""; ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="/Registration" class="list-group-item list-group-item-action bg-light <?= $activetab == "registration" ? "active" : ""; ?>"><i class="fas fa-road"></i> Registratie</a>
    <a href="/Registration/Scheme" class="list-group-item list-group-item-action bg-light <?= $activetab == "scheme" ? "active" : ""; ?>"><i class="fas fa-list-ul"></i> Schema</a>
    <?php if (Guard::role("administrator")) { ?>
    <a href="/Management" class="list-group-item list-group-item-action bg-light <?= $activetab == "management" ? "active" : ""; ?>"><i class="fas fa-ethernet"></i> Beheer</a>
    <?php } ?>
    <a href="/Handlers/Authentication/logout.php" class="list-group-item list-group-item-action bg-light"><i class="fas fa-user-alt-slash"></i> Logout</a>
  </div>
</div>