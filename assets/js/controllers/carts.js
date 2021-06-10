class Carts{

  static init(){
    Carts.getPurchases();
  }

  static getPurchases(){
    $("#cart-tables").DataTable({
         ajax: {
           url: "api/admin/cart",
           type: "GET",
           beforeSend: function(xhr){
           xhr.setRequestHeader('Authentication', localStorage.getItem("token"));},
           dataSrc: "",
           data: function( d ) {
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
