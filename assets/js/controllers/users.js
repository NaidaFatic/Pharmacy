class Users{

  static init(){
    $("#updateUsers").validate({
    submitHandler: function(form, event) {
      event.preventDefault();
      var data = AUtils.jsonize_form($(form));
      console.log(data);
      if (data.id){
         Users.update(data);
      }
      }
     });

    Users.getAll();
  }


  static getAll(){
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
        console.log(settings);
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
          console.log(resp);
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
          console.log(d);
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

  static preEdit(id){
   RestClient.get("api/admin/accounts/"+id, function(data){
   console.log(data);
      AUtils.json2form("#updateUsers", data);
      $("#userModal").modal("show");
    });
  }
  static update(account){
    RestClient.put("api/admin/accounts/"+account.id, account, function(data){
      toastr.success("User has been updated");
      $("#updateUsers").trigger("reset");
      $("#updateUsers *[name='id']").val("");
      $('#userModal').modal("hide");
      Users.getAll();
      console.log(data);
    });
  }


}
