<?php

  $webtitle = "Login";
  
  $js = [
    "authentication"
  ];

  require_once dirname(__DIR__)."/Layout/header.php";

  if (Guard::authenticated()) header("Location:/");
  
  Guard::remembertoken();

?>

  <div class="container mt-5 mb-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow border-bottom-danger mb-2">
          <div class="card-body">
            <div class="h3 font-weight-normal text-danger">Login</div>
            <form id="authenticate-login">
              <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" class="form-control">
              </div>
              <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="password" name="password" id="password" class="form-control">
              </div>
              <div class="form-group">
                <i class="far fa-check-circle fa-lg text-danger-light remember-credentials" id="remember-check"></i>
                <label for="remeber-credentials" class="d-inline c-pointer remember-credentials">Blijf ingelogd</label>
                <input type="hidden" name="remember-me" value="0">
              </div>
              <button type="submit" class="btn btn-danger">Aanmelden</button>
            </form>
          </div>
        </div>
        <div class="msg"></div>
      </div>
    </div>
  </div>

<?php

  require_once dirname(__DIR__).'/Layout/footer.php';

?>  