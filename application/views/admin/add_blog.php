<link href="<?php echo BACKEND; ?>assets/plugins/summernote/summernote.css" rel="stylesheet" />
<link href="<?php echo BACKEND; ?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">  
<div class="content">
    <div class="container">

        <?php $this->load->view(ADMIN.'bread_cum'); ?>
      
        <div class="card-box table-responsive">              
            
            <!-- Start :  validation message -->
            <?php $this->load->view(ADMIN."includes/msg"); ?>
            <!-- End :  validation message -->

            <div class="col-lg-12">
                <form id="myForm" name="myForm" action="<?php echo ADMIN_LINK; ?>BlogController/StoreBlogs" method="POST" enctype="multipart/form-data">
                
                  <input type="hidden" name="type" id="type" value="<?php echo $type;?>">
                  <?php if(isset($edit)): ?>
                  <input type="hidden" name="editid" value="<?php echo $editid;?>">
                  <?php endif ?>

                  <div class="row">
                      <div class="col-sm-4">                            
                        <div class="form-group">
                           <label>Blog Category <code>*</code></label>
                           <select class="form-control" name="blog_cate" id="blog_cate">
                                <option value="">Select Category</option>
                                <?php foreach ($blogcate_lists as $blogcate_list) {
                                $sel = ($blogcate_list->id==$edit['blog_cate']) ? 'selected' : '';
                                ?>
                                <option <?php echo $sel ?> value="<?php echo $blogcate_list->id; ?>"><?php echo $blogcate_list->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                      </div>
                      <div class="col-sm-4">                            
                        <div class="form-group">
                           <label>Blog Title <code>*</code></label>
                           <input type="text" id="title" name="title" class="form-control" placeholder="Blog Title" value="<?= isset($edit['title'])?$edit['title']:set_value('title') ?>" >
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <label>Service Type </label>
                        <div class="radio">
                          <input type="radio" name="service" <?php echo ($edit['service_type'] == "1" ? 'checked="checked"': ''); ?> id="entertainment_services" value="1" required="">
                          <label for="entertainment_services">Entertainment Services (.com)</label>
                        </div>
                        <div class="radio">
                       
                          <input type="radio" name="service" <?php echo ($edit['service_type'] == "2" ? 'checked="checked"': ''); ?> id="escort_services" value="2">
                          <label for="escort_services"> Escort Services (.ie)</label>
                        </div>                    
                      </div>
                      <div class="col-sm-12"> 
                        <div class="form-group">
                            <label>Description <code>*</code></label>
                            <textarea name="content" id="content" class="summernote"><?= isset($edit['content'])?$edit['content']:set_value('content') ?></textarea>
                            <div class="cont_error"></div>
                        </div>
                      </div>  
                      <div class="col-sm-6">                              
                          <div class="form-group">
                              <label class="control-label">Blog Date <code>*</code></label>
                              <input type="text" name="blog_date" class="form-control datepicker" value="<?= isset($edit['blog_date'])?date("m/d/Y",strtotime($edit['blog_date'])):set_value('blog_date') ?>">
                          </div>
                      </div>
                      <div class="col-sm-6">    
                        <div class="form-group">
                           <label>Author Name <code>*</code></label>
                           <input type="text" id="author" name="author" class="form-control" placeholder="Author Name" value="<?= isset($edit['author'])?$edit['author']:set_value('author') ?>" >
                        </div>                                            
                      </div>

                      <div class="col-sm-6">    
                        <div class="form-group">
                           <label>Meta Description<code>*</code></label>
                           <input type="text" id="meta_des" name="meta_des" class="form-control" placeholder="Meta Description" value="<?= isset($edit['meta_des'])?$edit['meta_des']:set_value('meta_des') ?>" >
                        </div>                                            
                      </div>

                      <div class="col-sm-6">                              
                          <div class="form-group">
                              <label class="control-label">Upload Image</label>
                              <input type="file" name="blog_image" id="blog_image" class="filestyle"  accept="image/*">
                          </div>
                          <?php if(isset($edit)): ?>
                          <input type="hidden" name="old_blog_image" value="<?php echo $edit['blog_image'];?>">
                          <?php endif ?>
                      </div>
                      <?php if(isset($edit)): ?>
                        <div class="col-sm-6"> 
                          <div class="form-group">
                            <label class="control-label">Uploaded Image</label><br>
                            <img src="<?= base_url(UPLOAD_DIR.BLOG_IMG.$edit['blog_image']); ?>" width="150px">
                          </div>
                        </div>
                      <?php endif ?>

                      <?php
                      $status = "";
                      if(isset($edit)): 
                        $status = ($edit['status']=='Y') ? 'checked' : '';
                      endif ?>
                      <div class="col-sm-12">
                        <div class="form-group">
                          <div>
                              <label for="field-2" class="control-label">Status</label>
                          </div>
                          <br>
                          <input <?= $status ?> type="checkbox" id="isActive" name="isActive"  switch="bool"/>
                          <label for="isActive" data-on-label="Yes" data-off-label="No"></label>
                        </div>
                      </div> 
                      <div class="form-group col-md-12">
                          <label for="exampleInputEmail1">&nbsp;</label>
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
<script src="<?php echo BACKEND ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo COMMON; ?>/jquery.validate.js" type="text/javascript"></script>

<script>
  jQuery(document).ready(function(){
    $('.summernote').summernote({
        height: 240,                 // set editor height
        minHeight: null,             // set minimum height of editor
        maxHeight: null,             // set maximum height of editor
        focus: false                 // set focus to editable area after initializing summernote
    });
  });

  $.fn.datepicker.defaults.autoclose = true;
  $('.datepicker').datepicker({ 
    //startDate: 'today',
    todayHighlight: true,
    autoClose: true,
  });
</script>
<script type="text/javascript">
    $('#myForm').validate({ 
      ignore: [],
      rules:{
        blog_cate :{required : true,},
        title :{required : true,},
        content :{required : true,},
        blog_date :{required : true,},
        author :{required : true,},
      },
      messages:{
        blog_cate :{ required : "Category is required" },
        title :{ required : "Title is required" },
        content :{ required : "Description is required" },
        blog_date :{ required : "Blog date is required" },
        author :{ required : "Author is required" },
      },
      errorPlacement: function(error, element) {
        if(element.attr("name") == "content") 
        {
          error.insertAfter(".cont_error");
        }
        else
        {
          error.insertAfter(element);
        }
      }
    });
</script>