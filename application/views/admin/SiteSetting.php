<div class="content">
   <div class="container">
      <div class="row">
         <div class="col-xs-12">
            <div class="page-title-box">
               <h4 class="page-title">Site Setting</h4>
               <ol class="breadcrumb p-0 m-0">
                  
                  <li>
                     <a href="#">Setting </a>
                  </li>
                  <li class="active">
                     General setting
                  </li>
               </ol>
               <div class="clearfix"></div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-xs-12">
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
            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            <form action="<?php echo ADMIN_LINK; ?>sitesetting/store" id="form-setting" class="" role="form" method="POST"  enctype="multipart/form-data">
               <div class="panel panel-border panel-purple">
                  <div class="panel-heading">
                     <h3 class="panel-title">General Setting</h3>
                  </div>
                  <div class="panel-body">
                     <div class="form-group col-md-6">
                        <label for="exampleInputSiteName">Site Name</label>
                        <input type="text" name="site_name" class="form-control" id="site_name" 
                           value="<?php echo $siteSetting->site_name; ?>" placeholder="Site From Name">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputSiteName">Welcome Kit (Time in Days count)</label>
                        <input type="text" name="welcome_kit" class="form-control" id="welcome_kit" 
                           value="<?php echo $siteSetting->welcome_kit; ?>" placeholder="Welcome kit">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputSiteFromEmail">Site From Email</label>
                        <input type="text" name="site_from_email" class="form-control" id="site_from_email" 
                           value="<?php echo $siteSetting->site_from_email; ?>" placeholder="Site Email">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputSiteEmail">Site Email</label>
                        <input type="text" name="site_email" class="form-control" id="site_email" 
                           value="<?php echo $siteSetting->email; ?>" placeholder="Site Email">
                     </div>

                     <div class="form-group col-md-6">
                        <label for="exampleInputSiteAddress">Site Contact Inquiry Email</label>
                        <input type="text" name="contact_inquiry_email" class="form-control" id="contact_inquiry_email" 
                           value="<?php echo $siteSetting->contact_inquiry_email; ?>" placeholder="Site Contact Inquiry Email">
                     </div>
                     
                     <div class="form-group col-md-6">
                        <label for="exampleInputSiteEmail">Site Fax</label>
                        <input type="text" name="site_fax" class="form-control" id="site_fax" 
                           value="<?php echo $siteSetting->fax; ?>" placeholder="Site Fax">
                     </div>

                     <div class="form-group col-md-6">
                        <label for="exampleInputSitePhoneNo">Site Phone Number</label>
                        <input type="text" name="site_phone" class="form-control" id="site_phone" 
                           value="<?php echo $siteSetting->phone; ?>" placeholder="Site Phone Number">
                     </div>

                     <div class="form-group col-md-6">
                        <label for="exampleInputSiteAddress">Site Address</label>
                        <input type="text" name="site_address" class="form-control" id="site_address" 
                           value="<?php echo $siteSetting->address; ?>" placeholder="Site Address">
                     </div>
                     <div class="form-group col-md-6">
                        <label class="control-label">Site Logo</label>
                        <input type="file" class="filestyle" name="site_logo" id="site_logo" data-placeholder="No file">
                        <img class="img-responsive img-thumbnail" src="<?php echo base_url('public/front/images/logo/'.$siteSetting->site_logo.' ');?>" style=" height: 50px;">
                     </div>
                     <div class="form-group col-md-6">
                        <label class="control-label">Site Favicon</label>
                        <input type="file" class="filestyle" name="site_favicon" id="site_favicon" data-placeholder="No file">
                        <img class="img-responsive img-thumbnail" src="<?php echo base_url('public/front/images/logo/'.$siteSetting->site_favicon.' ');?>" style=" height: 50px;">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Meta Keyword</label>
                        <textarea class="form-control" name="meta_keyword" rows="3" placeholder="Description..."><?php echo $siteSetting->meta_keyword; ?></textarea>                             
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Meta Description</label>
                        <textarea class="form-control" name="meta_description" rows="3" placeholder="Description..."><?php echo $siteSetting->meta_description; ?></textarea>
                     </div>
                  </div>
               </div>
               <div class="panel panel-border panel-purple">
                  <div class="panel-heading">
                     <h3 class="panel-title">Social Setting</h3>
                  </div>
                  <div class="panel-body">
                     <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1"><button class="btn btn-primary btn-xs"><i class="fa fa-facebook"></i></button> Facebook Link 
                        </label>
                        <input type="text" name="fb_link" value="<?php echo $siteSetting->fb_link; ?>" class="form-control" id="fb_link" placeholder="Facebook Link">
                     </div>
                     <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1"><button class="btn btn-primary btn-xs"><i class="fa fa-instagram"></i></button> Instagram Link 
                        </label>
                        <input type="text" name="instagram_link" value="<?php echo $siteSetting->instagram_link; ?>" class="form-control" id="instagram_link" placeholder="Facebook Link">
                     </div>
                     <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1"><button class="btn btn-primary btn-xs"><i class="fa fa-twitter"></i></button> Twitter link 
                        </label>
                        <input type="text" name="twitter_link" value="<?php echo $siteSetting->twitter_link; ?>" class="form-control" id="twitter_link" placeholder="Twitter Link">
                     </div>
                     <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1"><button class="btn btn-primary btn-xs"><i class="fa fa-pinterest"></i></button> Pinterest Link 
                        </label>
                        <input type="text" name="pinterest_link" value="<?php echo $siteSetting->pinterest_link; ?>" class="form-control" id="pinterest_link" placeholder="pinterest Link">
                     </div>
                     <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1"><button class="btn btn-primary btn-xs"><i class="fa fa-google"></i></button> Googleplus Link 
                        </label>
                        <input type="text" name="google_plus_link" value="<?php echo $siteSetting->google_plus_link; ?>" class="form-control" id="google_plus_link" placeholder="Google plus Link">
                     </div>
                     <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1"><button class="btn btn-primary btn-xs"><i class="fa fa-youtube"></i></button> Youtube Link 
                        </label>
                        <input type="text" name="youtube_link" value="<?php echo $siteSetting->youtube_link; ?>" class="form-control" id="youtube_link" placeholder="Youtubr Link">
                     </div>
                  </div>
               </div>
               <?php /*
               <div class="panel panel-border panel-purple">
                  <div class="panel-heading">
                     <h3 class="panel-title">Location Information</h3>
                  </div>
                  <div class="panel-body">
                     <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Address</label>
                        <textarea  name="address" placeholder="Address" class="form-control" id="address"><?php echo $siteSetting->address; ?></textarea>
                     </div>
                     <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Map (embeded code)</label>
                        <textarea class="form-control" id="map_embeded" name="map_embeded" rows="3" placeholder="Map (embeded code)..."  ><?php echo $siteSetting->map_embeded; ?></textarea>
                     </div>
                     <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">latitude</label>
                        <input type="text" name="latitude" class="form-control" id="latitude" value="<?php echo $siteSetting->latitude; ?>" placeholder="latitude">
                     </div>
                     <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">longitude</label>
                        <input type="text" name="longitude" class="form-control" id="longitude" value="<?php echo $siteSetting->longitude; ?>" placeholder="Longitude">
                     </div>
                     <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Phone</label>
                        <input  name="phone" id="phone" placeholder="Phone" class="form-control" id="address" value="<?php echo $siteSetting->phone; ?>">
                     </div>
                     <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" name="email" class="form-control" id="email" value="<?php echo $siteSetting->email; ?>" placeholder="Email">
                     </div>
                  </div>
               </div>

               */ ?>

               <!-- <div class="panel panel-border panel-purple">
                  <div class="panel-heading">
                     <h3 class="panel-title">Footer About</h3>
                  </div>
                  <div class="panel-body">
                     <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">About Short Description</label>
                        <textarea class="form-control" name="about_description" rows="3" placeholder="Description..."><?php echo $siteSetting->about_description; ?></textarea>
                     </div>
                  </div>
               </div> -->

               <div class="panel panel-border panel-purple">
                  <div class="panel-heading">
                     <h3 class="panel-title">Gallery Massage Details</h3>
                  </div>
                  <div class="panel-body">
                     <div class="form-group col-md-12">
                        <label for="gallery_massage_details">Massage Details</label>
                        <input type="text" name="gallery_massage_details" class="form-control" id="gallery_massage_details"  value="<?php echo $siteSetting->gallery_massage_details; ?>" placeholder="Massage Details">
                     </div>                     
                  </div>
               </div>

               <button type="submit" class="btn btn-success waves-effect waves-light pull-right">Submit</button>
            </form>
         </div>
      </div>
   </div>
</div>
</div>
</div>
</div>
</div>
<script src="<?php echo BACKEND ?>assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo BACKEND ?>assets/plugins/parsleyjs/parsley.min.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
       $('form').parsley();
   });
   $(function () {
       $('#form-setting').parsley().on('field:validated', function () {
           var ok = $('.parsley-error').length === 0;
           $('.alert-info').toggleClass('hidden', !ok);
           $('.alert-warning').toggleClass('hidden', ok);
       }).on('form:submit', function () {
           return true; // Don't submit form for this demo
       });
   });
</script>
<!-- include summernote css/js -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script>
   $(document).ready(function() {
   
       $('#address1').summernote({
           toolbar:[
   
             ['style', ['bold', 'italic', 'underline']],              
             ['fontsize', ['fontsize']],
             
           ]
       });
     
       $('#address1').summernote();
   });
</script>