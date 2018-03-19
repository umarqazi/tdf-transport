$('select').selectpicker();
$(function () {
	$('#datetimepicker5').datetimepicker();
	$('#datetimepicker6').datetimepicker();
});
function freeDelivery(check){
	if($('input[name="free"]').is(':checked'))
	{
		$('#delivery_charges').val('Free');
	}
	else
	{
		$('#delivery_charges').val('');
	}

};
function upload()
{
	var file_data = $('#pdfFile').prop('files')[0];
	var uploadPdf = new FormData();
	uploadPdf.append('pdf', file_data);
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	uploadPdf.append('_token', CSRF_TOKEN);
	$.ajax({
        url: APP_URL+"/uploadPdf",
        type:"POST",
        dataType: 'JSON',
        cache : false,
        contentType : false,
        processType : false,
        processData : false,
        data: uploadPdf,
        success: function(data) {
        	$('#showErrorPdf').html('');
        	$('#showPdftable').show();
        	$('#addPdfLink').html(data.name);
        	$('#dummyFile').val(data.name);
        	$('#pdfFile').val('');
        	document.getElementById("addPdfLink").href=APP_URL+"/assets/images/dummyImages/"+data.name;
        },
        error: function(xhr, status, error) {
        	$('#showErrorPdf').html(xhr.responseText);
		}
    });
}
$(".delete").click(function(){
    return confirm("Are you sure to delete this item?");
});
function showView(view)
{
	var viewValue=view.value;
	window.location.href = "/"+viewValue;
}
function downloadExcel()
{
	$("#searchForm").submit();
}
function searchResult()
{
	$('#searchResult').html('');
	var searchResult = new FormData();
	searchResult.append('customer_name', $("#customer").val());
	searchResult.append('order_id', $("#orderId").val());
	searchResult.append('date', $("#datetime").val());
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	searchResult.append('_token', CSRF_TOKEN);
	$.ajax({
        url: APP_URL+"/searchRecords",
        type:"POST",
        dataType: 'text',
        cache : false,
        contentType : false,
        processType : false,
        processData : false,
        data: searchResult,
        success: function(data) {
        	$('#searchResult').html(data);
        	$('#searchModal').modal('show');
        	$('#customer2').val($("#customer").val());
        	$('#orderId2').val($("#orderId").val());
        	$('#dateTime2').val($("#datetime").val());
        	// $('#showPdftable').show();
        	// $('#addPdfLink').html(data.name);
        	// $('#dummyFile').val(data.name);
        	// $('#pdfFile').val('');
        	// document.getElementById("addPdfLink").href=APP_URL+"/assets/images/dummyImages/"+data.name;
        },
        error: function(xhr, status, error) {
        	$('#showErrorPdf').html(xhr.responseText);
		}
    });
}
$(document).ready(function () {
    $(".validate-check").click(function () {
    	$("#validateForm").submit();
    });
});
jQuery(function() {
    // setTimeout() function will be fired after page is loaded
    // it will wait for 5 sec. and then will fire
    // $("#successMessage").hide() function
    setTimeout(function() {
        jQuery("#message").hide()
    }, 5000);
});