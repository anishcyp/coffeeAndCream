<div class="content">
    <div class="container">
        
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title-box">
                    <h4 class="page-title">Agency list</h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li>
                            <a href="<?= base_url(ADMIN.'dashboard'); ?>">Dashboard</a>
                        </li>
                        <li>
                            Agency list
                        </li>
                        
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- end row -->


        <div class="row">
            <div class="col-sm-12">
                <div class="card-box table-responsive">
                    <?php $success = $this->session->flashdata('success');
                    if($success){?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                    <?php } ?>
                    <?php $error = $this->session->flashdata('error');
                    if($error){?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                    <?php } ?>
                    <div class="clearfix"></div>
                    <hr>

                    <table id="datatable-scroller" class="table table-bordered table-striped  table-colored table-info">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Agency logo</th>
                            <th>details</th>
                            <!-- <th>City</th> -->
                            <th>User Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div> <!-- container -->

</div> 


<script type="text/javascript">

    $(document).ready(function () {

        $('#datatable-scroller').DataTable({
            "serverSide": true,
            "ordering": true,
            "ajax": {
                "url": "<?php echo ADMIN_LINK ?>ManageAgency/ajax_datatable",
                "type": "POST"
            },            
            "scroller": {
                "loadingIndicator": true
            },
            "columnDefs": [
                {"targets": 4, "orderable": false },
                {"targets": 5, "orderable": false },
            ],
            "order": [[0, 'desc']],
        });
      
    });

    $(document).on('change','.changeStatus1',function(){
        
        var mode = $(this).prop('checked');
        console.log(mode);
        //var status = $(this).attr("data-status");             
        var status = mode == true ? 'Y' : 'N';
        var id = $(this).attr("data-id");             
        var field = $(this).attr("data-i");             
        var table = $(this).attr("data-td");         
        $.ajax({
            url: '../CommonController/changeStatusAgency',
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
                swal("Status changed successfully");
                $("#preloader-ajax , #status").hide();
            }
        });

    });


</script>


