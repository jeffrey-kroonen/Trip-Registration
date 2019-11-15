$(document).ready(function() {
  
  if ($("#content").length) {
    if (window.location.href.includes("Management") && $("#content").html().length < 1) {
       $("#content").load("/Management/users.php", function() {
         sidebarTrigger()
       });
    }
  }
      
  $(document).on("click", ".nav-link", function() {
    let value = $(this).html();
    
    $(".nav-link").removeClass("active");
    $(this).addClass("active");
      
    if (value.includes("Gebruiker")) {
      $("#content").load("/Management/users.php", function() {
        sidebarTrigger()
      });
    } else if (value.includes("Auto")) {
      $("#content").load("/Management/cars.php", function() {
        sidebarTrigger()
      });
    }
    
  });
  
  $(document).on("click", "#user-form-trigger", function(e) {
    $(".user-form-shell").load("/Management/User/user-form.php", function() {
      $('#user-form-modal').modal('show');
    });
    
  });  
  
  $(document).on("submit", "#user-form", function(e) {
    e.preventDefault();
    
    $.ajax({
      type: "post",
      url: "/Handlers/User/create.php",
      data: $(this).serialize(),
      success: function(res) {
        $(".msg").hide();
         if (res == "empty") {
          $(".msg").html("Niet alle velden zijn ingevuld.");    
        } else if (res == "exists") {
          $(".msg").html("Een gebruiker met dit e-mail adres bestaat al.");    
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
    
  });
  
  $(document).on("keyup change", ".edit-user-control", function(e) {
    
    e.preventDefault();
      
      $.ajax({
        type: "post",
        url: "/Handlers/User/update.php",
        data: $("#edit-user-form").serialize(),
        success: function(res) {
          console.log(res);
          $(".msg").hide();
          if (res == "empty") {
            $(".msg").html("Niet alle velden zijn ingevuld.");
          } else if (res == "success") {
            //
          }

          if (res == "empty") {
            $(".msg").fadeIn();
            $(".msg").addClass("alert alert-danger");
          }
        }
      });
    
  });
  
  $(document).on("click", ".delete-user-trigger", function(e) {
    e.preventDefault();
    
    if (confirm("Weet u zeker dat u deze gebruiker wilt verwijderen?\nIndien u de gebruiker verwijderd, worden ook de bijbehorende registraties verwijderd.")) {
      $.ajax({
        type: "post",
        url: "/Handlers/User/delete.php",
        data: { id: $(this).data("id") },
        success: function(res) {
          console.log(res);
          $(".msg").hide();
          
         if (res == "empty") {
            $(".msg").html("Niks ontvangen.");    
          } else if (res == "not found") {
            $(".msg").html("Er is geen auto gevonden.");
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
  
  $(document).on("click", "#car-form-trigger", function(e) {
    $(".car-form-shell").load("/Management/Car/car-form.php", function() {
      $('#car-form-modal').modal('show');
    });
    
  });
  
  $(document).on("submit", "#car-form", function(e) {
    e.preventDefault();
    
    $.ajax({
      type: "post",
      url: "/Handlers/Car/create.php",
      data: $(this).serialize(),
      success: function(res) {
        console.log(res);
        $(".msg").hide();
         if (res == "empty") {
          $(".msg").html("Niet alle velden zijn ingevuld.");    
        } else if (res == "exists") {
          $(".msg").html("De auto bestaat al.");    
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
    
  });
  
  $(document).on("keyup change", ".edit-car-control", function(e) {
    
    e.preventDefault();
      
      $.ajax({
        type: "post",
        url: "/Handlers/Car/update.php",
        data: $("#edit-car-form").serialize(),
        success: function(res) {
          console.log(res);
          $(".msg").hide();
          if (res == "empty") {
            $(".msg").html("Niet alle velden zijn ingevuld.");
          } else if (res == "success") {
            //
          }

          if (res == "empty") {
            $(".msg").fadeIn();
            $(".msg").addClass("alert alert-danger");
          }
        }
      });
    
  });
  
  $(document).on("click", ".delete-car-trigger", function(e) {
    e.preventDefault();
    
    if (confirm("Weet u zeker dat u deze auto wilt verwijderen?")) {
      $.ajax({
        type: "post",
        url: "/Handlers/Car/delete.php",
        data: { id: $(this).data("id") },
        success: function(res) {
          console.log(res);
          $(".msg").hide();
          
         if (res == "empty") {
            $(".msg").html("Niks ontvangen.");    
          } else if (res == "not found") {
            $(".msg").html("Er is geen auto gevonden.");
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