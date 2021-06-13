class Carts{

  static init(){
  $("#byuCart").validate({
   submitHandler: function(form, event) {
    event.preventDefault();
    var data = AUtils.jsonize_form($(form));
    console.log(data);
    if (data.id){
       Carts.update(data);
      }
     }
  });
  $("#addCart").validate({
     submitHandler: function(form, event) {
      event.preventDefault();
      var data = AUtils.jsonize_form($(form));
      console.log(data);
      Carts.purchase(data);
      }
  });
    Carts.getCarts();
  }

  static getCarts(){
    $("#cart-tables").DataTable({
       processing: true,
       bDestroy: true,
       responsive: true,
       pagingType: "simple",
       language: {
             "zeroRecords": "Nothing in cart",
             "info": "Showing page _PAGE_",
             "infoEmpty": "End of pages",
             "infoFiltered": ""
         },
       ajax: {
         url: "api/users/individual/cart",
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
                return '<div style="min-width:60px"><span class="badge">'+data+'</span><a class="pull-right" style="font-size: 15px; cursor: pointer;" onclick="Carts.preEdit('+data+')"><i class="fa fa-edit"></i></a></div>';
             }
           },
           { "data": "quantity" },
           { "data": "status" },
           { "data": "medicine_id" },
           { "data": "account_id" }
         ]
      });
     }

  static purchase(cart){
       RestClient.post("api/users/purchases", cart, function(data){
         toastr.success("Medicine purchased! Check Your email!");
         $("#cartModal").trigger("reset");
         $('#cartModal').modal("hide");
         Carts.getCarts();
       });
     }

  static update(cart){
       RestClient.put("api/users/cart/update/"+cart.id, cart, function(data){
         $("#byuCart").trigger("reset");
         $("#byuCart *[name='id']").val("");
         $('#byuModal').modal("hide");
       });
       RestClient.put("api/users/buy/cart", cart, function(data){
         Carts.getCarts();
         console.log(data);
       });
     }

  static preEdit(id){
      RestClient.get("api/users/cart/"+id, function(data){
         AUtils.json2form("#byuCart", data);
         $("#byuModal").modal("show");
       });
     }

  static getTotal(){
       RestClient.get("api/users/total/cart", function(data){
        document.getElementById('total').textContent = ''+data;
        });
      }
}
