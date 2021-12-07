<link href="<?php echo BACKEND; ?>assets/plugins/summernote/summernote.css" rel="stylesheet" />

   
<div class="content">
    <div class="container">

        <div class="row">
            <div class="col-xs-12">
                <div class="page-title-box">
                    <h4 class="page-title">Manage hen stag accommodation </h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li>
                            <a href="#"> Manage hen stag accommodation </a>
                        </li>
                        <li class="active">
                            Update Manage hen stag accommodation
                        </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
      
        <div class="card-box table-responsive">              
            
            <!-- Start :  validation message -->
            <?php if(validation_errors()){ ?>
            <div class="alert alert-danger alert-dismissable">
               <?php  echo validation_errors(); ?>
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            </div>
            <?php } ?>
            <?php $success = $this->session->flashdata('success');
               if($success){?>
            <div class="alert alert-success alert-dismissable">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
               <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php } ?>
     

            <div class="col-lg-12">
                <form action="<?php echo ADMIN_LINK; ?>HenStagController/store" method="POST"  enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="<?= $result['id'] ?>">
                    <!-- <input type="hidden" name="type" id="type" value="<?= $page ?>"> -->
                    <div class="row">
                    <!-- <h3>> Header section</h3>
                        <div class="col-sm-12">                            
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="header_descr" id="header_descr" class="summernote"><?= $result['header_descr'] ?></textarea>
                            </div>
                        </div>  -->

                        <h3><span class="mdi mdi-forward"></span> First section</h3>
                        <div class="col-sm-12">                            
                            <div class="form-group">
                                <label>Title :</label>
                                <input type="text" id="title" name="title" class="form-control-view" placeholder=" Title" value="<?= $result['title'] ?>" >
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="descr" id="descr" class="summernote"><?= $result['descr'] ?></textarea>
                            </div>
                        </div> 

                        <h3><span class="mdi mdi-forward"></span> Second section</h3>
                        <div class="col-sm-12">                            
                            <div class="form-group">
                                <label>Title :</label>
                                <input type="text" id="second_title" name="second_title" class="form-control-view" placeholder=" Title" value="<?= $result['second_title'] ?>" >
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="second_descr" id="second_descr" class="summernote"><?= $result['second_descr'] ?></textarea>
                            </div>
                        </div>  

                        <h3><span class="mdi mdi-forward"></span> Third section</h3>
                        <div class="col-sm-12">                            
                            <div class="form-group">
                                <label>Title :</label>
                                <input type="text" id="third_title" name="third_title" class="form-control-view" placeholder=" Title" value="<?= $result['third_title'] ?>" >
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="third_descr" id="third_descr" class="summernote"><?= $result['third_descr'] ?></textarea>
                            </div>
                        </div>  

                        <h3><span class="mdi mdi-forward"></span> Footer Section</h3>
                        <div class="col-sm-12">                            
                            <div class="form-group">
                                <label>Title :</label>
                                <input type="text" id="footer_title" name="footer_title" class="form-control-view" placeholder=" Title" value="<?= $result['footer_title'] ?>" >
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="footer_descr" id="footer_descr" class="summernote1"><?= $result['footer_descr'] ?></textarea>
                            </div>
                        </div>
                    
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">&nbsp;</label>
                            <!-- <button type="submit" class="btn btn-primary">Submit</button>  -->
                            <button type="submit" class="btn btn-primary">Submit</button> 
                        </div>                       
                    </div>
                </form>
            </div>                   
        </div>     
    </div> 
</div> 

<script src="<?php echo BACKEND ?>assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
<script src="<?php echo BACKEND; ?>assets/plugins/summernote/summernote.min.js"></script>
<script>
    jQuery(document).ready(function(){

        $('.summernote').summernote({
            height: 100,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false                 // set focus to editable area after initializing summernote
        });

        $('.summernote1').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false                 // set focus to editable area after initializing summernote
        });
       
    });

   
</script>
