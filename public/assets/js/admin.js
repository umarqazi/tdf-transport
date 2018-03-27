function showStoreName(type)
{
    var type=type.value;
    if(type=='Admin' || type=='Driver')
    {
        $("#storeName").hide();
        if(type=='Driver')
        {
          $('#driverRecord').show();
        }
    }
    else
    {
        $("#storeName").show();
        $('#driverRecord').hide();
    }
}
