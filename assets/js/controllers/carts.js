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
                 return '<div style="min-width:60px"><span class="badge">'+data+'</span><a class="pull-right admin-stuff" style="font-size: 15px; cursor: pointer;" onclick="Medicines.preEdit('+data+')"><i class="fa fa-edit"></i></a></div>';
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
