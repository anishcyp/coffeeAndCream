<link href="<?php echo BACKEND; ?>assets/plugins/summernote/summernote.css" rel="stylesheet" />

   
<div class="content">
    <div class="container">

        <div class="row">
            <div class="col-xs-12">
                <div class="page-title-box">
                    <h4 class="page-title">Update Description Contact</h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li>
                            <a href="#"> Contact </a>
                        </li>
                        <li class="active">
                            Update Description Contact
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
                <form action="<?php echo ADMIN_LINK; ?>ContactController/store" method="POST"  enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="<?= $result['id'] ?>">
                    <!-- <input type="hidden" name="type" id="type" value="<?= $page ?>"> -->
                  <div class="row">
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
                       
                      <div class="form-group col-md-12">
                          <label for="exampleInputEmail1">&nbsp;</label>
                          <!-- <button type="submit" class="btn btn-primary">Submit</button>  -->
                          <button type="submit" class="btn btn-primary">Submit</button> 
                      </div>                       
                  </div>

                </form>
            </div>                   
            
        </div>     

                    <!-- Timing -->

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
                <form action="<?php echo ADMIN_LINK; ?>ContactController/store" method="POST"  enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="<?= $time['id'] ?>">
                    <!-- <input type="hidden" name="type" id="type" value="<?= $page ?>"> -->
                  <div class="row">
                      <div class="col-sm-12">                            
                          <div class="form-group">
                             <label>Title :</label>
                             <input type="text" id="title" name="title" class="form-control-view" placeholder=" Title" value="<?= $time['title'] ?>" >
                          </div>
                          <div class="form-group">
                              <label>Description</label>
                              <textarea name="descr" id="descr" class="summernote"><?= $time['descr'] ?></textarea>
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
            height: 240,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false                 // set focus to editable area after initializing summernote
        });
       
    });

   
</script>
