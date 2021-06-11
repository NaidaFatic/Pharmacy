class Users{

  static init(){
    $("#updateUser").validate({
    submitHandler: function(form) {
      var data = AUtils.jsonize_form($(form));
      if (data.id){
         Users.update(data);
      }
      }
     });

    Users.getUsers();
  }

  static getUsers(){
      $("#user-tables").DataTable({
        processing: true,
        serverSide: true,
        bDestroy: true,
        responsive: true,
        pagingType: "simple",
        preDrawCallback: function(settings){
          if(settings.aoData.length < settings._iDisplayLength){
            settings._iRecordsTotal=0;
            settings._iRecordsDisplay=0;
          }else{
            settings._iRecordsTotal=100;
            settings._iRecordsDisplay=100;
          }
          },
        language: {
              "zeroRecords": "Nothing found - sorry",
              "info": "Showing page _PAGE_",
              "infoEmpty": "End of pages",
              "infoFiltered": ""
          },
        ajax: {
          url: "api/admin/accounts",
          type: "GET",
          beforeSend: function(xhr){
          xhr.setRequestHeader('Authentication', localStorage.getItem("token"));},
          dataSrc:  function(resp){
            return resp;
          },
          data: function( d ) {
            d.offset=d.start;
            d.limit=d.length;
            d.search=d.search.value;
            d.order = encodeURIComponent((d.order[0].dir == 'asc' ? "-" : "+")+d.columns[d.order[0].column].data);

            delete d.start;
            delete d.length;
            delete d.columns;
            delete d.draw;
          }
         },
          columns:[
              { "data": "id",
                "render": function ( data, type, row, meta ) {
                 return '<div style="min-width:60px"><span class="badge">'+data+'</span><a class="pull-right admin-stuff" style="font-size: 15px; cursor: pointer;" onclick="Users.preEdit('+data+')"><i class="fa fa-edit"></i></a></div>';
              }
              },
              { "data": "email" },
              { "data": "role" },
              { "data": "status" },
              { "data": "user_id" }
          ]
       });


    }
    static update(user){
      RestClient.put("api/admin/accounts/"+user.id, user, function(data){

        console.log(data);
        toastr.success("Account has been updated");
        $("#updateUser").trigger("reset");
        $("#updateUser *[name='id']").val("");
        $('#userModal').modal("hide");
        Users.getUsers();
        console.log(data);
      });
    }

    static preEdit(id){
     RestClient.get("api/admin/accounts/"+id, function(data){
        AUtils.json2form("#updateUser", data);
        $("#userModal").modal("show");
      });
    }

}
