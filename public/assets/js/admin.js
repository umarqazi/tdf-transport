function showStoreName(type)
{
    var type=type.value;
    if(type=='Manager TDF' || type=='Chauffeur-livreur')
    {
        $("#storeName").hide();
        if(type=='Chauffeur-livreur')
        {
          $('#driverRecord').show();
        }
        if(type=='Manager TDF')
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
});