<footer class="footer text-right">2006 to
    <?=date("Y");?> © <?=$site_name;?>.
</footer>
<script type="text/javascript">
	function isConfirm(){
		var c = confirm("Are you sure to delete?");
		if(!c) { return false; }
	}
</script>

<script type="text/javascript">
	$(document).on('change','.changeStatusMe',function(){

	    var mode = $(this).prop('checked');
	    console.log(mode);
	    //var status = $(this).attr("data-status");             
	    var status = mode == true ? 'Y' : 'N';
	    var id = $(this).attr("data-id");             
	    var field = $(this).attr("data-i");             
	    var table = $(this).attr("data-td");             
	    $.ajax({
	        url: baseURL + 'CommonController/changeStatus',
	        dataType: "JSON",
	        method:"POST",
	        data: {
	            "id": id,
	            "status": status,
	            "td": table,
	            "i": field,
	        },
	        success: function (response)
	        { 
	            swal("You have successfully status changed!");
	            /*$("#msg").show();
	            $("#msg").html('You have successfully status changed.');
	            $("#msg").addClass('alert alert-success');*/

	            $("#preloader-ajax , #status").hide();
	            //$('#posts').DataTable().ajax.reload();
	        }
	    });

	});
</script>