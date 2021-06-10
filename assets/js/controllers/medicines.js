class Medicines{

  static init(){
    $("#addMedicines").validate({
    submitHandler: function(form, event) {
      event.preventDefault();
      var data = AUtils.jsonize_form($(form));
      console.log(data);
      if (data.id){
         Medicines.update(data);
      }else{
         Medicines.add(data);
       }
      }
     });

    AUtils.admin_required();
    Medicines.getAll();
  }

  static chart(){
    RestClient.get("api/admin/medicines/chart", function(chart_data){
      new Morris.Area({
        element: 'medicines-container',
        data: chart_data,
        xkey: 'mon',
        ykeys: ['cnt'],
        labels: ['Medicines']
      });

    });
  }

  static getAll(){
    $("#medicine-tables").DataTable({
      processing: true,
      serverSide: true,
      bDestroy: true,
      responsive: true,
      pagingType: "simple",
      preDrawCallback: function(settings){
      /*  if ( settings.jqXHR){
        settings._iRecordsTotal = settings.jqXHR.getResponseHeader('total-records');
          settings._iRecordsDisplay = settings.jqXHR.getResponseHeader('total-records');
      }*/
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
        url: "api/medicines",
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
               return '<div style="min-width:60px"><span class="badge">'+data+'</span><a class="pull-right admin-stuff" style="font-size: 15px; cursor: pointer;" onclick="Medicines.preEdit('+data+')"><i class="fa fa-edit"></i></a></div>';
            }
            },
            { "data": "name" },
            { "data": "company_name" },
            { "data": "price" },
            { "data": "description" },
            { "data": "added_at" },
            { "data": "quantity" }
        ]
     });
  }



  static add(medicine){
    RestClient.post("api/admin/medicines", medicine, function(data){
      toastr.success("Medicine added");
      console.log(data);
      $("#addMedicines").trigger("reset");
      $('#medicineModal').modal("hide");
      Medicines.getAll();
    });
  }

  static update(medicine){
    RestClient.put("api/admin/medicines/"+medicine.id, medicine, function(data){
      toastr.success("Medicine has been updated");
      $("#addMedicines").trigger("reset");
      $("#addMedicines *[name='id']").val("");
      $('#medicineModal').modal("hide");
      Medicines.getAll();
      console.log(data);
    });
  }

  static preEdit(id){
   RestClient.get("api/users/medicines/"+id, function(data){
      AUtils.json2form("#addMedicines", data);
      $("#medicineModal").modal("show");
    });
  }

  static chartCompany(){
    RestClient.get("api/admin/medicines/chart/company", function(chart_data){
      new Morris.Donut({
        element: 'company-container',
        data: chart_data
      });

    });
  }

}
