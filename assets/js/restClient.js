class RestClient{

  static request(endpoint, method, body, success, error){
    $.ajax({
      url:endpoint,
      type: method,
      data: body,
      beforeSend: function(xhr){
        if(localStorage.getItem("token")){
          xhr.setRequestHeader('Authentication', localStorage.getItem("token"));
        }
      },
      success: function(data){
        success(data);
      },
      error: function(jqXHR, textStatus, errorThrow){
        if(error){
          error(jqXHR, textStatus, errorThrow);
        }else{
          toastr.error(jqXHR.responseJSON.message);
        }
      }
    });
  }

  static post(endpoint, body, success, error){
    this.request(endpoint, "POST", body, success, error);
  }

  static get(endpoint, success, error){
  this.request(endpoint, "GET", null, success, error);
  }

  static put(endpoint, body, success, error){ $.ajax({
      url:endpoint,
      type: "PUT",
      data: JSON.stringify(body),
      contentType: "application/json",
      beforeSend: function(xhr){
        if(localStorage.getItem("token")){
          xhr.setRequestHeader('Authentication', localStorage.getItem("token"));
        }
      },
      success: function(data){
        success(data);
      },
      error: function(jqXHR, textStatus, errorThrow){
        if(error){
          error(jqXHR, textStatus, errorThrow);
        }else{
          toastr.error(jqXHR.responseJSON.message);
        }
      }
    });
  }

  static delete(endpoint, body, success, error){
    this.request(endpoint, "DELETE", body, success, error);
  }

}
