$(document).ready(function(){

  // Initialize select2
  $("#selUser").select2();

  // Read selected option
  $('#but_read').click(function(){
    var username = $('#selUser option:selected').text();
    var userid = $('#selUser').val();

    $('#result').html("id : " + userid + ", name : " + username);

  });
});
function getTours(option){
  var driver_id=option.value;
  if(driver_id!=''){
    window.location.href = APP_URL+"/planDriverTour/"+driver_id;
  }else{
    $("#showTour").hide();
  }
}
function showDeliveries(time){
  var user_id = $('#selUser option:selected').val();
  $("#time_slot").val(time);
  $("#deliveries").modal("show");
}
