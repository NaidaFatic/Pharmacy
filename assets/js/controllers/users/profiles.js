class Profiles{

  static init(){
    Profiles.getAll();
  }

  static getAll(){
    var user_info=AUtils.parse_jwt(window.localStorage.getItem("token"));
    RestClient.get("api/users/"+user_info.uid, function(data){
     document.getElementById('id').value = ''+data.id;
     document.getElementById('name').value = ''+data.name;
     document.getElementById('surname').value = ''+data.surname;
     });
  }

  static fullName(){
    var user_info=AUtils.parse_jwt(window.localStorage.getItem("token"));
    RestClient.get("api/users/"+user_info.uid, function(data){
     document.getElementById('fullName').textContent = ''+data.name+' '+data.surname;
     });
  }


}
