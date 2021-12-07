<div class="content">
    <div class="container">

        <div class="row">
            <div class="col-xs-12">
                <div class="page-title-box">
                    <h4 class="page-title">Gallery Details </h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li>
                            <a href="#">Manage User</a>
                        </li>
                        <li class="active">
                           Gallery Details
                        </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 btn-check">
                <label>Gallery Photos</label>
                <div class="radio">
                    <input type="radio" name="gallery" id="gallery" <?php echo ($info['Verifygallery'] == "1" ? 'checked="checked"': ''); ?> value="1">
                    <label for="yes">Verified</label>
                </div>
                <div class="radio">
                    <input type="radio" name="gallery" id="gallery" <?php echo ($info['Verifygallery'] == "0" ? 'checked="checked"': ''); ?> value="0">
                    <label for="no">Unverified</label>
                </div>                    
            </div>
            <div class="col-sm-12">                                                   
                <div class="card-box table-responsive">
                  <a href="<?php echo ADMIN_LINK; ?>manage-user" class="btn btn-primary waves-effect waves-light pull-right">Back</a>
                    <div class="clearfix"></div>
                    <hr>
                    <table id="datatable-scroller" class="table table-bordered table-striped  table-colored table-info">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Files</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div> 

</div>



</div><!-- /.modal -->
<!-- Jquery validation -->
<script src="<?php echo COMMON; ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo COMMON; ?>validation.js" type="text/javascript"></script>

<script type="text/javascript">


    $(document).on("click",".btn-check",function(){

       var checkRadio = $('input[name="gallery"]:checked').val();

       if(confirm("Are you sure you want to change?"))
        {

        }
        else
        {
            return false;
        }

       var id = <?php echo $id ?>;
            $.ajax({
                url: '<?php echo ADMIN_LINK ?>ManageCustomers/Verifygallery',
                type: "POST",
                data: {"id": id,
                        "gallery_verify": checkRadio },
                success:function(data) {

                }
            });
    });


    $(document).ready(function () {

        $('#datatable-scroller').DataTable({
            "serverSide": true,
            "ordering": true,
            "ajax": {
                "url": "<?php echo ADMIN_LINK ?>ManageLocation/ajax_gallery_datatable",
                "type": "POST",
                "data": {"id": '<?php echo $gallery['user_id']; ?>',},
            },            
            "scroller": {
                "loadingIndicator": true
            },
            "columnDefs": [
                {"targets": 0, "orderable": false },
                {"targets": 3, "orderable": false }
            ],
            "order": [[0, 'desc']],
        });


        $(document).on('change', '.changeStatusMe', function() {
            var id = $(this).data('id');
            if($(this).prop('checked')){
                $.ajax({
                    url: '<?php echo ADMIN_LINK ?>manage-user/gallery1',
                    type: "POST",
                    data: { id : id },
                    success:function(data) {

                    }
                });
            }
        });
    });
</script>