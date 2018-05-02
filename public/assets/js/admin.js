function showStoreName(type)
{
    var type=type.value;
    if(type=='Manager TDF' || type=='Chauffeur-livreur')
    {
        $("#storeName").hide();
        $("#companyName").hide();
        if(type=='Chauffeur-livreur')
        {
          $('#driverRecord').show();
        }
        if(type=='Manager TDF')
        {
          $("#storeName").hide();
          $("#companyName").hide();
          $('#driverRecord').hide();
        }
    }
    else
    {
        $("#storeName").show();
        $("#companyName").show();
        $('#driverRecord').hide();
    }
}
function addSubProduct(product_name){
  $('#product_family').val(product_name);
  $("#product_family").prop("readonly", true);
  $("#addProduct").modal('show');
}

$(document).ready(function () {
    $(".delete_store").click(function(){
        return confirm("Êtes-vous sûr de vouloir supprimer ce magasin?");
    });
    $(".delete_company").click(function(){
        return confirm("Êtes-vous sûr de vouloir supprimer cette société?");
    });
    $(".delete_product").click(function(){
        return confirm("Êtes-vous sûr de vouloir supprimer ce produit?");
    });
    $(".delete_user").click(function(){
        return confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur?");
    });
    $('#file-upload').change(function() {
        var i = $(this).prev('label').clone();
        var file = $('#file-upload')[0].files[0].name;
        $('#fileName').text(file);
    });
});
$('.close').on('click', function () {
  var currentLocation = window.location;
  var alteredURL = removeParam("id");
 window.location.href=alteredURL;
});
function removeParam(key) {
  var string = document.location + '';
    var rtn = string.split("?")[0],
        param,
        params_arr = [],
        queryString = (string.indexOf("?") !== -1) ? string.split("?")[1] : "";
    if (queryString !== "") {
        params_arr = queryString.split("&");
        for (var i = params_arr.length - 1; i >= 0; i -= 1) {
            param = params_arr[i].split("=")[0];
            if (param === key) {
                params_arr.splice(i, 1);
            }
        }
        rtn = rtn;
    }
    return rtn;
}

function getStores(option){

    var id=option.value;

    $.ajax({
        url: APP_URL+"/getCompanyStores",
        type:"GET",
        dataType: 'text',
        data: { id : id},
        success: function(data) {
            $('#store_dropdown').children('option').remove();
            $('#store_dropdown').append(data);
        },
    });
}
function viewDelivery(url){
    window.location = url;
}

$('select').selectpicker();
$(function () {
    $('#datetimepicker4').datetimepicker({
        format: 'DD/MM/Y'
    });
});
function getProduct(option){
    var id=option.value;
    $.ajax({
        url: APP_URL+"/getProductType",
        type:"GET",
        dataType: 'text',
        data: { id : id},
        success: function(data) {
            $('#products').html(data);
        },
    });
}
