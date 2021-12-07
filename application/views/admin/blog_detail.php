<link href="<?php echo BACKEND; ?>assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo BACKEND; ?>assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<!-- Start content -->
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Blog Details</h4>
                        <ol class="breadcrumb p-0 m-0">
                            <li>
                                <a href="#">Blog</a>
                            </li>
                            <li class="active">
                                Blog Details
                            </li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="card-box table-responsive">              
                <div class="col-lg-12">
                    <p class="text-muted font-13 m-b-30">
                        <a href="<?php echo ADMIN_LINK; ?>manage-blog" class="btn btn-primary waves-effect waves-light pull-right">Back to list</a>
                    </p>
                    <div class="m-t-30">

                        <h3><?php echo $detail["title"]; ?>
                          </h3>
                        <p class="text-muted text-overflow"><i class="mdi mdi-calendar-text m-r-5"></i><?php echo date('D M, Y',strtotime($detail["created_at"])); ?></p>

                        <p class="m-t-20">
                           <?php echo $detail["content"]; ?>
                        </p>
                    </div> <!-- end m-t-30 -->

                    <div class="row">
                        <div class="col-sm-6">
                            <?php if(file_exists(UPLOAD_DIR.BLOG_IMG.$detail['blog_image']) && $detail['blog_image']!='')  {   ?>

                                <img src="<?php echo base_url(UPLOAD_DIR.BLOG_IMG.$detail['blog_image']); ?>" width="150px" />

                            <?php }   else{  ?>
                                <img src="<?php echo base_url(UPLOAD_DIR.'default.png'); ?>" width="150px" />

                            <?php }  ?>
                        </div>
                    </div>
                </div>  
            </div>    

            <div class="card-box table-responsive">     
                <div class="row">
                    <div class="col-sm-12 col-12">
                        <table id="datatable-scroller" class="table table-striped  table-colored table-info">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Message</th>
                                    <th>Is Approved ?</th>
                                    <th width="20%">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

                <p class="text-muted font-13 m-b-30">
                    <a href="<?php echo ADMIN_LINK; ?>manage-blog" class="btn btn-primary waves-effect waves-light pull-right">Back to list</a>
                </p>
            </div>         
        </div> <!-- container -->

    </div> <!-- content -->
<script src="<?php echo COMMON; ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo COMMON; ?>validation.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function () {

        $('#datatable-scroller').DataTable({
            "serverSide": true,
            "ordering": true,
            "ajax": {
                "url": "<?php echo ADMIN_LINK ?>BlogController/ajax_datatable_comment",
                "type": "POST",
                "data":  { blog_id : '<?php echo $detail["blog_id"] ?>'  },
            },            
            "scroller": {
                "loadingIndicator": true
            },
            "columnDefs": [
                {"targets": 2, "orderable": false },
                {"targets": 3, "orderable": false }
            ]

        });
    });
</script>
