class Purchases{

  static init(){
    Purchases.getAll();
  }

  static getAll(){
    $("#purchases-tables").DataTable({
      processing: true,
      bDestroy: true,
      responsive: true,
      pagingType: "simple",
      language: {
            "zeroRecords": "No purchases",
            "info": "Showing page _PAGE_",
            "infoEmpty": "End of pages",
            "infoFiltered": ""
        },
      ajax: {
        url: "api/users/purchases/individual",
        type: "GET",
        beforeSend: function(xhr){
        xhr.setRequestHeader('Authentication', localStorage.getItem("token"));},
        dataSrc:  function(resp){
          console.log(resp);
          return resp;
        },
        data: function( d ) {
          delete d.start;
          delete d.length;
          delete d.columns;
          delete d.draw;
        }
       },
        columns:[
            { "data": "id",
              "render": function ( data, type, row, meta ) {
                return data;
            }
            },
            { "data": "city" },
            { "data": "zip" },
            { "data": "phone_number" },
            { "data": "date" },
            { "data": "name" },
            { "data": "quantity" }
        ]
     });
  }


}
