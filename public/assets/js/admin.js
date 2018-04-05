function showStoreName(type)
{
    var type=type.value;
    if(type=='TDF Manager' || type=='Driver')
    {
        $("#storeName").hide();
        if(type=='Driver')
        {
          $('#driverRecord').show();
        }
        if(type=='TDF Manager')
        {
          $("#storeName").hide();
          $('#driverRecord').hide();
        }
    }
    else
    {
        $("#storeName").show();
        $('#driverRecord').hide();
    }
}
function addSubProduct(product_name){
  $('#product_family').val(product_name);
  $("#product_family").prop("readonly", true);
  $("#addProduct").modal('show');
}
