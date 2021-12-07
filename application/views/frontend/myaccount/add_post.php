<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
    <head><meta charset="windows-1252">
        <?php $this->load->view(FRONTEND."include/include_css"); ?>
        <link href="<?php echo COMMON; ?>dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    </head>
    <body class="">
        <?php $this->load->view(FRONTEND."include/menu"); ?>

    <!-- Call rates Here -->

    <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/roly-banner.webp"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/roly-banner.webp" alt=""></div>
          <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
            <div class="container">
              <h2 class="text-transform-capitalize breadcrumbs-custom-title">ADD POSTS</h2>
              <h5 class="breadcrumbs-custom-text">
              </h5>
            </div>
          </div>
        </div>
        <div class="breadcrumbs-custom-footer">
          <div class="container">
            <ul class="breadcrumbs-custom-path">
              <li><a href="<?= base_url('') ?>">Home</a></li>
              <li class="active">ADD POST</li>
            </ul>
          </div>
        </div>
      </section>

      <div class="edit-main-block">
        <div class="container">
          <div class="row">
            <?php $this->load->view(FRONTEND."include/frontend_sidebar");?>
            <div class="col-lg-9 col-md-12 col-12">
                <div class="common-blocks-detail">
                 <h4>Post a Job</h4>
                   <form role="form" action="<?= base_url("insertrecord-post/"); ?>" id="form-addModels" name="form-addModels" method="post"  role="form" enctype="multipart/form-data">
                    <div class="modal-body">  
                    <div class="blocks-information"> 
                        
                        <div class="form-group">
                            <label class="form-label-custom">Select Services <code>Required</code></label>  
                            <select name="service_id" id="service_id" class="form-control">
                                <option>Select Category</option>  
                                <?php foreach ($entertainment as $entr) {
                                    $select =  $profile['service_id'] == $ent->slug ? 'selected' : '';
                                    if (!empty($entr->slug) && $entr->slug == $profile['service_id']) {
                                        $selected = 'selected="selected"';
                                    } else {
                                        $selected = '';
                                    }
                                    ?>
                                    <option <?php echo $selected; ?> value="<?php echo $entr->slug; ?>"><?php echo $entr->name; ?></option>
                                <?php } ?>
                            </select> 
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label-custom">Short title for your job<code>Required</code></label>  
                                <input type="text" name="title" value="<?= $profile['title'] ?>" id="title" class="form-control" placeholder="Short title for your job" />  
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label-custom">Phone number<code>Required</code></label>  
                                <input type="text" name="phone_no" value="<?= $profile['phone_no'] ?>" id="phone_no" class="form-control" placeholder="Phone number" />  
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label-custom">Country<code>Required</code></label>
                                <select class="form-control" name="country_id" id="country_id" onchange="getStateListbyCountry1(this.value)">
                                  <option value="">Select Country</option>
                                  <?php foreach ($countrylists as $countrylist) {
                                      $country_select = ($countrylist->country_id==$profile['country_id']) ? 'selected' : '';
                                      ?>
                                  <option <?php echo $country_select; ?> value="<?php echo $countrylist->country_id; ?>"><?php echo $countrylist->name; ?></option>
                                  <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label-custom">Select State<code>Required</code></label>
                                <select class="form-control" name="state_id" id="state_id">
                                    <option value="">Select State</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label-custom">Company Logo<code>optional</code></label>
                                <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
                            </div>
                            <input type="hidden" id="old_profile_image" name="old_profile_image" value="<?= $profile['image']; ?>">
                            <div class="form-group col-md-6">
                                <?php if(file_exists(UPLOAD_DIR.POST_IMG.$profile['image']) && $profile['image']!='')  { ?>
                                    <img style="width: 119px;height: auto;" src="<?php echo base_url(UPLOAD_DIR.POST_IMG.$profile['image']) ?>">  
                                <?php } else{ ?>
                                <?php }  ?> 
                            </div>
                        </div>
                        <div class="form-group" style="text-align: left;">
                            <label class="form-label-custom">Work system<code>Required</code></label>
                            <textarea name="work_system" placeholder="Example : Dancing on stage 3-4 times per night" id="summernote" class="form-control" ><?= $profile['work_system'] ?></textarea>
                        </div>
                        <div class="form-group" style="text-align: left;">
                            <label class="form-label-custom">Working Hours<code>Required</code></label>
                            <textarea name="work_hours" placeholder="Example : From 23.00 - to 05.00" id="work_hours" class="form-control"><?= $profile['work_hours'] ?></textarea>
                        </div>
                        <div class="form-group" style="text-align: left;">
                            <label class="form-label-custom">Earnings<code>Required</code></label>
                            <textarea name="earnings" placeholder="Example : The dancer has a fixed salary of HRK 9000 ( ~ 1200 euros ) / month for 40 hours work.." id="earnings" class="form-control"><?= $profile['earnings'] ?></textarea>
                        </div>
                        <div class="form-group" style="text-align: left;">
                            <label class="form-label-custom">Requirement<code>Required</code></label>
                            <textarea name="requirements" placeholder="Example : Short dresses, sexy, stylish.." id="requirements" class="form-control"><?= $profile['requirements'] ?></textarea>
                        </div>
                        <div class="form-group" style="text-align: left;">
                            <label class="form-label-custom">Possible Earnings<code>optional</code></label>
                            <textarea name="possible_earnings" placeholder="Example : € 2500 - € 3000 per month.." id="possible_earnings" class="form-control"><?= $profile['possible_earnings'] ?></textarea>
                        </div>
                        <div class="form-group" style="text-align: left;">
                            <label class="form-label-custom">Requirements And Selection<code>Required</code></label>
                            <textarea name="selection" placeholder="Example : Minimum 18 years old.." id="selection" class="form-control"><?= $profile['selection'] ?></textarea>
                        </div>
                        <div class="form-group" style="text-align: left;">
                            <label class="form-label-custom">Length Of Contract<code>optional</code></label>
                            <textarea name="contract" placeholder="Example : The contract is from 1 up to 12 months.." id="contract" class="form-control"><?= $profile['contract'] ?></textarea>
                        </div>
                        <div class="form-group" style="text-align: left;">
                            <label class="form-label-custom">More Info Your Agency<code>Required</code></label>
                            <textarea name="more_info" placeholder="More information your agency" id="more_info" class="form-control"><?= $profile['more_info'] ?></textarea>
                        </div>
                        <div class="form-group" style="text-align: left;">
                            <label class="form-label-custom">When Can I Start ?<code>optional</code></label>
                            <textarea name="when_can_i_start" placeholder="Example : You need to apply first by filling out the application.." id="when_can_i_start" class="form-control"><?= $profile['when_can_i_start'] ?></textarea>
                        </div>
                        <div class="form-group" style="text-align: left;">
                            <label class="form-label-custom">Accommodation<code>optional</code></label>
                            <textarea name="accommodation" placeholder="Example : The club provides to the dancers accommodation" id="accommodation" class="form-control"><?= $profile['accommodation'] ?></textarea>
                        </div><div class="form-group" style="text-align: left;">
                            <label class="form-label-custom">Transport<code>optional</code></label>
                            <textarea name="transport" placeholder="Example : The transport to Copenhagen is paid by the dancer" id="transport" class="form-control"><?= $profile['transport'] ?></textarea>
                        </div>

                        <?php 
                        if($profile['id'] != "")
                        {
                          $mode = 'edit';
                        }
                        else
                        {
                          $mode = "add";
                        }

                        ?>
                        
                        <input type="hidden" id="type" name="type" value="<?= $mode ?>">
                        <input type="hidden" id="editid" name="editid" value="<?= $profile['id'] ?>">
                        
                    </div>
                  </div>  
                    <div class="last-btn-blocks">
                        <button type="submit" name="submit" id="submit" value="formSave" class="button button-lg button-shadow-2 button-primary button-zakaria">Submit</button>
                    </div>
                  </form>   
               </div>
            </div>
          </div>
      </div>
    </div>
<!-- footer -->
<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>>
<script type="text/javascript">

$('#summernote').summernote({
    placeholder: 'Example : Dancing on stage 3-4 times per night',
    tabsize: 2,
    height: 100,
});

$('#work_hours').summernote({
    placeholder: 'Example : From 23.00 - to 05.00',
    tabsize: 2,
    height: 100,
});

$('#earnings').summernote({
    placeholder: 'Example : The dancer has a fixed salary of HRK 9000 ( ~ 1200 euros ) / month for 40 hours work..',
    tabsize: 2,
    height: 100,
});

$('#requirements').summernote({
    placeholder: 'Example : Short dresses, sexy, stylish..',
    tabsize: 2,
    height: 100,
});

$('#possible_earnings').summernote({
    placeholder: 'Example : € 2500 - € 3000 per month..',
    tabsize: 2,
    height: 100,
});

$('#selection').summernote({
    placeholder: 'Example : Minimum 18 years old..',
    tabsize: 2,
    height: 100,
});

$('#contract').summernote({
    placeholder: 'Example : The contract is from 1 up to 12 months..',
    tabsize: 2,
    height: 100,
});

$('#more_info').summernote({
    placeholder: 'More information your agency',
    tabsize: 2,
    height: 100,
});

$('#when_can_i_start').summernote({
    placeholder: 'Example : You need to apply first by filling out the application..',
    tabsize: 2,
    height: 100,
});

$('#accommodation').summernote({
    placeholder: 'Example : The club provides to the dancers accommodation',
    tabsize: 2,
    height: 100,
});

$('#transport').summernote({
    placeholder: 'Example : The transport to Copenhagen is paid by the dancer',
    tabsize: 2,
    height: 100,
});

$('#form-addModels').on('submit', function(e) {
  
  if($('#more_info').summernote('isEmpty')) 
  {
    alert('More information is required')
    e.preventDefault();
  }
  else if($('#requirements').summernote('isEmpty'))
  {
    alert('Requirements is required')
    e.preventDefault();
  }
  else if($('#earnings').summernote('isEmpty'))
  {
    alert('Earnings is required')
    e.preventDefault();
  }
  else if($('#work_hours').summernote('isEmpty'))
  {
    alert('Working hours is required')
    e.preventDefault();
  }
  else if($('#summernote').summernote('isEmpty'))
  {
    alert('Work system is required')
    e.preventDefault();
  }
  else if($('#selection').summernote('isEmpty'))
  {
    alert('Requirements And Selection is required')
    e.preventDefault();
  }
})



$('#form-addModels').validate({ // initialize the plugin
    rules:{
    services_id :{ required : true },
    title :{ required : true },
    phone_no :{ required : true , number:true},
    work_system : { required : true },
    work_hours : { required : true },
    earnings  : { required : true },
    requirements : { required : true },
    selection : { required : true },
    more_info : { required : true },
    country_id : { required : true },
    state_id : { required : true },
    
    },
    messages:{
        services_id :{ required : "Select service is required" },
    title :{ required : "Title is required" },
    phone_no :{required : "Phone number is required", number: "Please enter numbers Only"},
    work_system : { required : "Work system is required"},
    work_hours : { required : "Working hours is required" },
    earnings : { required : "Earnings is required" },
    requirements : { required : "Requirements is required" },
    selection : { required : "Selection is required" },
    more_info : { required : "More info is required" },
    country_id : { required : "Country is required" },
    state_id : { required : "State is required" },
    },
    
});

 

function getStateListbyCountry1(country_id, state_id = "")
{
    var id = country_id;
    
    $.ajax({
        url: baseURL+'CommonController/getStateByCountry',
        type: "POST",
        data: "id="+id,
        success: function (data) {
            data = JSON.parse(data);
            var list = '<option value="">No state found</option>';
            if( data != 'blank' )
            {
                list = '<option value="">Select State</option>';
                $.each( data, function(index, item) {
                  //alert(item.state_id);
                    list += '<option value="'+item.state_id+'"';
                    if(item.state_id == state_id){
                        list += 'selected';
                    }
                    list += '>'+item.name+'</option>';
                });
            }

            $("#state_id").html(list);
            // if(state_id!="")
            // {
            //     $('#state_id option[value='+state_id+']').attr('selected','selected');
            // }
        }
    });
}



<?php 
    $country_id = isset($profile['country_id']) && $profile['country_id'] > 0 ? $profile['country_id'] : "";
    $state_id = isset($profile['state_id']) && $profile['state_id'] > 0 ? $profile['state_id'] : "";
    $city_id = isset($profile['city_id']) && $profile['city_id'] > 0 ? $profile['city_id'] : "";

    if($state_id > 0 && $country_id > 0){ ?>
        getStateListbyCountry1(<?= $country_id ?>, <?= $state_id ?>);
    <?php } ?>
    

function check_is_add_or_edit() 
{
  if($("#type").val()=="add" && $("#page_image").val()=="") 
  {
      return true;
  } 
  else 
  {
      return false;
  }
}

</script>
</body>
</html>