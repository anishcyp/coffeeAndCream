<link href="<?php echo BACKEND; ?>assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>

<link href="<?php echo BACKEND; ?>assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css" rel="stylesheet" />

    <!-- Start content -->

    <div class="content">

        <div class="container">

            <div class="row">

                <div class="col-xs-12">

                    <div class="page-title-box">

                        <h4 class="page-title">Blog list</h4>

                        <ol class="breadcrumb p-0 m-0">

                            <li>

                                <a href="javascript:void(0);">Blog</a>

                            </li>

                            <li class="active">

                                Listing

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

                        <a href="<?php echo ADMIN_LINK.'manage-blog/add'; ?>" class="btn btn-primary waves-effect waves-light pull-right" > Add Blog</a>

                        <div class="clearfix"></div>
                        <hr>
                        <table id="datatable-scroller" class="table table-bordered table-striped  table-colored table-info">
                        <thead>
                        <tr>
                            <th width="20%">Image</th>
                            <th width="15%">Category</th>
                            <th width="10%">Title</th>
                            <th width="20%">Message</th>
                            <th width="15%">Status</th>
                            <th width="20%">Action</th>
                        </tr>
                        </thead>
                    </table>
                    </div>
                </div>
            </div>
        </div> 
    </div> 


<script src="<?php echo COMMON; ?>/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo COMMON; ?>validation.js" type="text/javascript"></script>

<script type="text/javascript">



$(document).ready(function () {

    $('#datatable-scroller').DataTable({

        "serverSide": true,

        "ordering": true,

        "ajax": {

            "url": "<?php echo ADMIN_LINK ?>BlogController/ajax_datatable",

            "type": "POST"

        },            

        "scroller": {

            "loadingIndicator": true

        },

        "columnDefs": [

            {"targets": 4, "orderable": false },

            {"targets": 5, "orderable": false }

        ]

    });

});
</script>