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
