<link href="<?php echo BACKEND; ?>assets/plugins/summernote/summernote.css" rel="stylesheet" />

   
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title-box">
                    <h4 class="page-title">Send Mail</h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li>
                            <a href="#"> Send Mail </a>
                        </li>
                        <li class="active">
                            Send Mail
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
                <form action="<?php echo ADMIN_LINK; ?>ManageCustomers/mail_sending" method="POST"  enctype="multipart/form-data" id="myForm">
                    <div class="row">
                        <div class="col-sm-12">                            
                            <div class="form-group">
                                <label>To Mail :</label>
                                <!-- <input type="text" id="email" name="email" class="form-control-view" placeholder="Email" value=" "> -->
                                <select multiple="true" name="email[]" id="email" class="form-control select2">
                                <?php if(isset($email) && $email != ""){ 
                                    $emails = explode(",",$email);
                                    foreach($emails as $em){ ?>
                                        <option value="<?= $em; ?>" selected ><?= $em; ?></option>
                                    <?php } ?> 
                                <?php } ?>
                             </select>
                            </div>
                            <div class="form-group">
                                <label>Subject :</label>
                                <input type="text" id="subject" name="subject" class="form-control-view" placeholder="subject" value="<?php echo isset($subject) ? $subject : ""; ?> ">
                            </div>
                            <div class="form-group">
                                <label>Massage :</label>
                                <textarea name="descr" id="descr" class="summernote"><?php echo isset($massage) ? $massage : ""; ?></textarea>
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
<script src="<?php echo COMMON; ?>/jquery.validate.js" type="text/javascript"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script>
    jQuery(document).ready(function(){

        $('.summernote').summernote({
            height: 240,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false                 // set focus to editable area after initializing summernote
        });
       
    });

    $('#myForm').validate({ 
      ignore: [],
      rules:{
        "email[]":{required : true},
        subject:{required : true},
        descr:{required : true},
       
      },
      messages:{
        "email[]":{required:"Please enter your email."},
        subject:{required:"Please enter your subject."},
        descr:{required:"Please enter message"},        
      },
    });

    $('#email').select2({
        placeholder: "To Email",
        tags: true,
        tokenSeparators: [",", " "]
    });

   
</script>
