class Login{

  static init(){
    if(window.localStorage.getItem("token")){
      window.location = "index.html";
    }else{
      $('body').show();
    }
    var url = new URLSearchParams(window.location.search);
    if(url.has('token')){
      $("#change-password-token").val(url.get('token'));
      Login.show_reset_password_form();
    }
  }

  static show_register_form(){
    $("#login-form-container").addClass("d-none");
    $("#forgot-form-container").addClass("d-none");
    $("#password-form-container").addClass("d-none");
    $("#register-form-container").removeClass("d-none");
    $("#reset-form-container").addClass("d-none");
  }

  static show_forgot_form(){
    $("#login-form-container").addClass("d-none");
    $("#register-form-container").addClass("d-none");
    $("#password-form-container").addClass("d-none");
    $("#reset-form-container").addClass("d-none");
    $("#forgot-form-container").removeClass("d-none");
  }

  static show_login_form(){
    $("#login-form-container").removeClass("d-none");
    $("#register-form-container").addClass("d-none");
    $("#password-form-container").addClass("d-none");
    $("#forgot-form-container").addClass("d-none");
    $("#reset-form-container").addClass("d-none");
  }

  static show_reset_password_form(){
    $("#login-form-container").addClass("d-none");
    $("#register-form-container").addClass("d-none");
    $("#password-form-container").addClass("d-none");
    $("#forgot-form-container").addClass("d-none");
    $("#reset-form-container").removeClass("d-none");
  }

  static show_confirm_form(){
    $("#login-form-container").addClass("d-none");
    $("#register-form-container").addClass("d-none");
    $("#password-form-container").addClass("d-none");
    $("#forgot-form-container").addClass("d-none");
    $("#reset-form-container").removeClass("d-none");
  }

  static login(){
    $("#login-link").prop('disabled', true);
    RestClient.post("api/login", AUtils.jsonize_form("#login-form"), function(data){
      window.localStorage.setItem("token", data.token);
      window.location = "index.html";
    }, function(jqXHR, textStatus, errorThrow){
      $("#login-link").prop('disabled', false);
      toastr.error( jqXHR.responseJSON.message );
    });
  }

  static register(){
     var password = document.getElementById("register-password"),
      confirm_password = document.getElementById("register-repeat-password");

      $("#register-link").prop('disabled', true);
      if(password.value == confirm_password.value){
        RestClient.post("api/register",  AUtils.jsonize_form("#register-form"), function(data){
          $("#register-form-container").addClass("d-none");
          $("#form-alert").removeClass("d-none");
          $("#form-alert .alert").html(data.message);
          $("#confirm-form-container").removeClass("d-none");
        }, function(jqXHR, textStatus, errorThrow){
          $("#register-link").prop('disabled', false);
          toastr.error( jqXHR.responseJSON.message );
        });}
      else{
        $("#register-link").prop('disabled', false);
          confirm_password.setCustomValidity("Passwords don't match!");
         }
    }

  static confirm_token(){
    var token = document.getElementById("token");
    console.log(token.value);
    RestClient.get("api/confirm/"+token.value, function(data){
      console.log(data.token);
       window.localStorage.setItem("token", data.token);
       window.location = "index.html";
      }, function(jqXHR, textStatus, errorThrow){
        $("#confirm-link").prop('disabled', false);
        toastr.error( jqXHR.responseJSON.message );
      });
  }

  static forgot_password(){
    $("#forgot-link").prop('disabled', true);
    RestClient.post("api/forgot", AUtils.jsonize_form("#forgot-form"), function(data){
      console.log(data);
      $("#forgot-form-container").addClass("d-none");
      $("#form-alert").removeClass("d-none");
      $("#form-alert .alert").html("Recovery link on a way!");
    }, function(jqXHR, textStatus, errorThrow){
      $("#forgot-link").prop('disabled', false);
      $("#forgot-form-container").addClass("d-none");
      $("#form-alert").removeClass("d-none");
      $("#form-alert .alert").html(jqXHR.responseJSON.message);
    });
  }

  static reset_password(){
    $("#reset-link").prop('disabled', true);
    RestClient.post("api/reset", AUtils.jsonize_form("#reset-form"), function(data){
      window.localStorage.setItem("token", data.token);
      window.location = "index.html";
    }, function(jqXHR, textStatus, errorThrow){
      $("#reset-link").prop('disabled', false);
      toastr.error(jqXHR.responseJSON.message);
    });
  }
}
