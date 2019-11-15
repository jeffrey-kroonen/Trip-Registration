$(document).ready(() => {
  
  $(document).on("click", "#scheme-form-trigger", function(e) {
    $(".scheme-form-shell").load("/Registration/Scheme/scheme-form.php", function() {
      $('#scheme-form-modal').modal('show');
    });
    
  });
  
  $(document).on("submit", "#scheme-form", function(e) {
    e.preventDefault();
    
    $.ajax({
      type: "post",
      url: "/Handlers/Scheme/create.php",
      data: $(this).serialize(),
      success: function(res) {
        $(".msg").hide();
          
       if (res == "empty") {
          $(".msg").html("Niet alle velden zijn ingevuld.");    
        }  else if (res == "success") {
          $('#scheme-form-modal').modal('hide');
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
    
  });
  
  $(document).on("click", ".delete-scheme-trigger", function(e) {
    e.preventDefault();
    
    if (confirm("Weet u zeker dat u dit schema wilt verwijderen?")) {
      $.ajax({
        type: "post",
        url: "/Handlers/Scheme/delete.php",
        data: { id: $(this).data("id") },
        success: function(res) {
          console.log(res);
          $(".msg").hide();
          
         if (res == "empty") {
            $(".msg").html("Niks ontvangen.");    
          } else if (res == "not found") {
            $(".msg").html("Er is geen schema gevonden.");
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