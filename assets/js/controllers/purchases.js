class Purchases{

  static init(){
    $("#addPurchases").validate({
    submitHandler: function(form, event) {
      event.preventDefault();
      var data = AUtils.jsonize_form($(form));
      console.log(data);
      if (data.id){
         Purchases.update(data);
      }else{
         Purchases.add(data);
       }
      }
     });

    Purchases.getAll();
  }


  static getAll(){
    $("#purchases-tables").DataTable({
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
        url: "api/admin/purchases",
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
                return '<div style="min-width:60px"><span class="badge">'+data+'</span><a class="pull-right admin-stuff" style="font-size: 15px; cursor: pointer;" onclick="Purchases.preEdit('+data+')"><i class="fa fa-edit"></i></a></div>';
            }
            },
            { "data": "city" },
            { "data": "zip" },
            { "data": "phone_number" },
            { "data": "date" },
            { "data": "email" },
            { "data": "name" },
            { "data": "quantity" }
        ]
     });
  }

  static preEdit(id){
   RestClient.get("api/admin/purchases/individual/"+id, function(data){
      AUtils.json2form("#addPurchases", data);
      $("#purchasesModal").modal("show");
    });
  }
  static update(purchases){
    RestClient.put("api/admin/purchases/"+purchases.id, purchases, function(data){
      toastr.success("Purchase has been deleted");
      $("#addPurchases").trigger("reset");
      $('#purchasesModal').modal("hide");
      Purchases.getAll();
    });
  }

static chart(){
  RestClient.get("api/admin/purchases/chart", function(chart_data){
    Morris.Line({
        element: 'purchases-container',
        data: chart_data,
        xkey: 'mont',
        ykeys: ['cn'],
        labels: ['Purchases']
      });
  });
}

}
