class Purchases{

static chart(){
  RestClient.get("api/admin/purchases/chart", function(chart_data){
    new Morris.Area({
      element: 'purchases-container',
      data: chart_data,
      xkey: 'mon',
      ykeys: ['cnt'],
      labels: ['Purchases']
    });
  });
}

}
