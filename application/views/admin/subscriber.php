<div class="content">
    <div class="container">

        <div class="row">
            <div class="col-xs-12">
                <div class="page-title-box">
                    <h4 class="page-title">Subscriber </h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li class="active">
                          Subscriber
                        </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">                
                <div class="card-box table-responsive">
                    
                    <!-- <button class="btn btn-primary waves-effect waves-light pull-right" data-toggle="modal" data-target="#addpopUpmodal">Add Relationship</button> -->
                    
                    <div class="clearfix"></div>
                    <!-- <hr> -->

                    <table id="datatable-scroller" class="table table-bordered table-striped  table-colored table-info">
                        <thead>
                        <tr>
                            <!-- <th>Id</th> -->
                            <th width="50%">Email</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </div> 

</div> 


<script type="text/javascript">


    $(document).ready(function () {

        $('#datatable-scroller').DataTable({
            "serverSide": true,
            "ordering": true,
            "ajax": {
                "url": "<?php echo ADMIN_LINK ?>SubscriberController/ajax_subscriber_datatable",
                "type": "POST"
            },            
            "scroller": {
                "loadingIndicator": true
            },
            "columnDefs": [
                // {"targets": 4, "orderable": false },
                // {"targets": 5, "orderable": false }
            ],
            "order": [[0, 'desc']],

        });
      
    });

</script>


