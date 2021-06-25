class Carts{

  static init(){
    Carts.getCarts();
  }

  static getCarts(){
    $("#cart-tables").DataTable({
       processing: true,
       bDestroy: true,
       responsive: true,
       pagingType: "simple",
       language: {
             "zeroRecords": "Nothing found - sorry",
             "info": "Showing page _PAGE_",
             "infoEmpty": "End of pages",
             "infoFiltered": ""
         },
       ajax: {
         url: "api/admin/cart",
         type: "GET",
         beforeSend: function(xhr){
         xhr.setRequestHeader('Authentication', localStorage.getItem("token"));},
         dataSrc:  function(resp){
           console.log(resp);
           console.log("SHOW?");
           return resp;
         },
         data: function( d ) {
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
                return data;
             }
           },
           { "data": "name" },
           { "data": "email" },
           { "data": "quantity" },
           { "data": "status" }
         ]
      });
     }

}
