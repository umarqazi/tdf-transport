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
    $("#showTour").show();
  }else{
    $("#showTour").hide();
  }
}
$('.checkboxDiv input:checkbox').click(function(){
    var $inputs = $('.checkboxDiv input:checkbox');
    if($(this).is(':checked')){  // <-- check if clicked box is currently checked
       $inputs.not(this).prop('disabled',true); // <-- disable all but checked checkbox
    }else{  //<-- if checkbox was unchecked
       $inputs.prop('disabled',false); // <-- enable all checkboxes
    }
});
function showDeliveries(time){
  var user_id = $('#selUser option:selected').val();
  $("#driver_id").val(user_id);
  $("#time_slot").val(time);
  $("#deliveries").modal("show");
}
