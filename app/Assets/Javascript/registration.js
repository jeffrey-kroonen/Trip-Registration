$(document).ready(() => {
  
  $(document).on("click", "#registration-form-trigger", function(e) {
    $(".registration-form-shell").load("/Registration/registration-form.php", function() {
      $('#registration-form-modal').modal('show');
    });
    
  });
  
  $(document).on("submit", "#registration-form", function(e) {
    e.preventDefault();
    
    $.ajax({
      type: "post",
      url: "/Handlers/Registration/create.php",
      data: $(this).serialize(),
      success: function(res) {
        $(".msg").hide();
        if (res == "no car") {
          $(".msg").html("Er is geen auto aan u toegekend.");
        } else if (res == "empty") {
          $(".msg").html("Niet alle velden zijn ingevuld.");    
        } else if (res == "success") {
          $('#registration-form-modal').modal('hide');
          setTimeout(function() {
            window.location.assign("/Registration");
          }, 500);
        }
        
        if (res !== "success") {
          $(".msg").fadeIn();
          $(".msg").addClass("alert alert-danger");
        }
        
      }
    });
    
  });
  
  $(document).on("click", ".delete-registration-trigger", function(e) {
    e.preventDefault();
    
    if (confirm("Weet u zeker dat u deze registratie wilt verwijderen?")) {
      $.ajax({
        type: "post",
        url: "/Handlers/Registration/delete.php",
        data: { id: $(this).data("id") },
        success: function(res) {
          $(".msg").hide();
          
         if (res == "empty") {
            $(".msg").html("Niks ontvangen.");    
          } else if (res == "not found") {
            $(".msg").html("Er is geen registratie gevonden.");
          } else if (res == "success") {
            $('#registration-form-modal').modal('hide');
            setTimeout(function() {
              location.reload();
            }, 500);
          }
          
          if (res !== "success") {
            $(".msg").fadeIn();
            $(".msg").addClass("alert alert-danger");
          }
        }
      });
    }
  });
  
});