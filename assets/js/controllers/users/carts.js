class Carts{

  static init(){
    Carts.getTotal();
  $("#byuCart").validate({
   submitHandler: function(form, event) {
    event.preventDefault();
    var data = AUtils.jsonize_form($(form));
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
           { "data": "name" },
           { "data": "price" }
         ]
      });
     }

  static purchase(cart){
      RestClient.put("api/users/buy/cart", cart, function(data){
       Carts.getCarts();
       console.log(data);
      });
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
       Carts.getCarts();
     }

  static preEdit(id){
      RestClient.get("api/users/cart/"+id, function(data){
         AUtils.json2form("#byuCart", data);
         $("#byuModal").modal("show");
       });
     }
  static delete(id){
    var form = AUtils.jsonize_form("#byuCart");
      RestClient.put("api/users/cart/"+form.id, form, function(data){
        toastr.success("Medicine deleted!");
        $("#byuModal").trigger("reset");
        $('#byuModal').modal("hide");
    });
    Carts.getCarts();
  }

  static getTotal(){
       RestClient.get("api/users/total/cart", function(data){
        document.getElementById('total').textContent = ''+data;
        document.getElementById('totalForm').value = ''+data+' KM';
        });
      }
}
