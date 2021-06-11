class Carts{

  static init(){
    Carts.getPurchases();
  }

  static getPurchases(){
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
           { "data": "quantity" },
           { "data": "status" },
           { "data": "medicine_id" },
           { "data": "account_id" }
         ]
      });
     }

}
