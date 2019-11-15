$(document).ready(() => {

  /** Authenticate user **/
  $(document).on("submit", "#authenticate-login", (e) => {
    e.preventDefault();
    
    $.ajax({
      type: "post",
      url: "/Handlers/Authentication/login.php",
      data: $(e.currentTarget).serialize(),
      success: (res) => {
        console.log(res);
        $(".msg").hide();
        if (res == "empty") {
          $(".msg").html("Niet alle velden zijn ingevuld.");
        } else if (res == "not found") {
          $(".msg").html("Het email adres is niet bekend.");
        } else if (res == "success") {
          window.location.assign("/");
        } else if (res == "error") {
          $(".msg").html("Het ingevoerde wachtwoord is onjuist.");
        }
        if (res !== "success") {
          $(".msg").fadeIn();
          $(".msg").addClass("alert alert-danger");
        }
      }
    });
    
  });
  
  $(document).on("click", ".remember-credentials", function(e) {
    e.preventDefault();
    let rememberToken = $("input[name='remember-me']")
    
    if (rememberToken.val() == "1") {
      rememberToken.val("0");
      $("#remember-check").removeClass("text-danger");
      $("#remember-check").addClass("text-danger-light");
      
    } else if (rememberToken.val() == "0") {
      rememberToken.val("1");
      $("#remember-check").addClass("text-danger");
      $("#remember-check").removeClass("text-danger-light");
    }
    
    
  });
  
});