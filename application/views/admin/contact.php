<div class="content">
    <div class="container">

        <div class="row">
            <div class="col-xs-12">
                <div class="page-title-box">
                    <h4 class="page-title">Contact </h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li class="active">
                          Contact
                        </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">                
                <div class="card-box table-responsive">
                                        
                    <div class="clearfix"></div>

                    <table id="datatable-scroller" class="table table-bordered table-striped  table-colored table-info">
                        <thead>
                        <tr>
                            <!-- <th>Id</th> -->
                            <th>Department</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div> 

</div> 

<div id="addpopUpmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>                
                <h4 class="modal-title ">Message</h4>                
            </div><br>
            <p id="message">

            </p>

        </div>
    </div>
</div>

<script type="text/javascript">

    $('.modal').on('hidden.bs.modal', function(){
        // $(this).find('form')[0].reset();
        $("#type").val('add');
        $("#editid").val();
    });


    $(document).ready(function () {

        $('#datatable-scroller').DataTable({
            "serverSide": true,
            "ordering": true,
            "ajax": {
                "url": "<?php echo ADMIN_LINK ?>ContactController/ajax_contact_datatable",
                "type": "POST"
            },            
            "scroller": {
                "loadingIndicator": true
            },
            "columnDefs": [
                // {"targets": 4, "orderable": false },
                {"targets": 3, "orderable": false }
            ],
            "order": [[0, 'desc']],

        });
      
    });

    $(document).on("click",".rowview",function(){
          
        $('#addpopUpmodal').modal('show');  
        var id = $(this).attr("data-id");      
        var field = $(this).attr("data-i");             
        var table = $(this).attr("data-td"); 
         
                 
        $.ajax(
        {
            url: '<?php echo APP_URL ?>CommonController/getEditRecord',
            dataType: "JSON",
            method:"POST",
            data: {
                "id": id,
                "td": table,
                "i": field,
            },
            success: function (response)
            { 
                $("#type").val('edit');
                // console.log(response.message);
                $("#message").text(response.message);
            }
        });
                  
    });
</script>


