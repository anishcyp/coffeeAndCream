<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    ?>
<html class="wide wow-animation desktop landscape rd-navbar-static-linked" lang="en">
    <head><meta charset="windows-1252">
        <?php $this->load->view(FRONTEND."include/include_css"); ?>
        
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
 -->   <style>
        .mul-select{
            width: 100%;
        }
    </style>
    </head>
    <body class="">
        <?php $this->load->view(FRONTEND."include/menu"); ?>
        
         <section class="breadcrumbs-custom">
        <div class="parallax-container" data-parallax-img="<?=FRONT_ASSETS?>images/roly-banner.webp"><div class="material-parallax parallax"><img src="<?=FRONT_ASSETS?>images/roly-banner.webp" alt=""></div>
          <div class="breadcrumbs-custom-body parallax-content context-dark custom-padding">
            <div class="container">
              <h2 class="text-transform-capitalize breadcrumbs-custom-title">My Diary</h2>
              <h5>My diary( bullet points 👉 choose time if necessary your free and dates.  Choose the places you like to tour. Mutilple location can be added by pressing the plus ➕icon or you can type in the city's you like your profile to show up instead of scrolling city by city. Don't forget to save.</h5>
            </div>
          </div>
        </div>
        <div class="breadcrumbs-custom-footer">
          <div class="container">
            <ul class="breadcrumbs-custom-path">
              <li><a href="<?= base_url('') ?>">Home</a></li>
              <li class="active">My Diary</li>
            </ul>
          </div>
        </div>
      </section>
      <section class="diary-list">
          <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Your diary includes:</h3>
                    <ul>
                        <li>Please select the dates that you want your adverts to be visible.</li>
                        <li>You can select multiple dates and change them at any time.</li>
                        <li>Choose the date and time you are free.</li>
                        <li>If you want to add multiple locations, you can select the + icon or simply type in the cities you
would like on your profile instead of scrolling down city by city.</li>
                        <li>Remember to save before moving to the next step.</li>
                        
                    </ul>
                </div>
            </div>
          </div>
      </section>
        
      <div class="edit-main-block diary-main-location">
        <div class="container">
          <div class="row">
            <?php $this->load->view(FRONTEND."include/frontend_sidebar");?>
            <div class="col-lg-9 col-md-12 col-12">
               <div class="common-blocks-detail">
                  <h4>My Diary</h4>
                    <form id="login-page-form" name="login-page-form" method="post" action="<?= base_url("diary-store") ?>" onsubmit="return form_submit();">
                        <div class="blocks-information">
                            <div class="filed">
                                <input type="hidden" name="deleted_row_ids" id="deleted_row_ids" value="">
                                
                                        
                            
                                <?php 
                                $auto_count=1;
                                $locationlists_count = !empty($locationlists) ? count($locationlists) : '0';

                                if($locationlists_count > 0)
                                {
                                    foreach ($locationlists as $locationlist)
                                    {
                                        $addon_id   = $locationlist->id;
                                        $from_date  = $locationlist->from_date;
                                        $to_date    = $locationlist->to_date;
                                        $start_time  = $locationlist->start_time;
                                        $end_time    = $locationlist->end_time;
                                        $country_id = $locationlist->country_id;
                                        $state_id   = $locationlist->state_id;
                                        $city_id    = $locationlist->city_id;
                                        ?>
                                        <input type="hidden" name="main_row_ids[]" data-id="<?php echo $addon_id ?>" value="<?php echo $addon_id ?>">

                                        <div class="row filed_class">
                                            <div class="form-group col-md-6">
                                                <label class="form-label-custom">From Date</label>
                                                <input type="date" class="form-control class_from_date" name="from_date[<?php echo $addon_id ?>][]" id="from_date[<?php echo $addon_id ?>][]" value="<?php echo $from_date; ?>">    
                                            </div>  

                                            <div class="form-group col-md-6">
                                                <label class="form-label-custom">To Date</label>
                                                <input type="date" class="form-control class_to_date" name="to_date[<?php echo $addon_id ?>][]" id="to_date[<?php echo $addon_id ?>][]" value="<?php echo $to_date; ?>">    
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="form-label-custom">Start Time</label>
                                                <input type="time" class="form-control class_start_time" id="start_time[<?php echo $addon_id ?>][]" name="start_time[<?php echo $addon_id ?>][]" value="<?php echo $start_time; ?>">    
                                            </div>  

                                            <div class="form-group col-md-6">
                                                <label class="form-label-custom">End Time</label>
                                                <input type="time" class="form-control class_end_time" id="end_time[<?php echo $addon_id ?>][]" name="end_time[<?php echo $addon_id ?>][]" value="<?php echo $end_time; ?>">   
                                            </div>


                                            <div class="form-group col-md-6">
                                                <label class="form-label-custom">Country</label>
                                                <select name="country_id[<?php echo $addon_id ?>][]" id="country_id<?php echo $addon_id ?>" class="form-control class_country_id" onchange="getStateDetails(this.value,this);">
                                                    <option value="">Please select option</option>
                                                    <?php
                                                    foreach($countrylists as $countrylist) 
                                                    {
                                                    ?>
                                                    <option <?php if($countrylist->country_id==$country_id){?> selected <?php } ?> value="<?=$countrylist->country_id?>"><?=$countrylist->name;?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="form-label-custom">State</label>
                                                <select name="state_id[<?php echo $addon_id ?>][]" id="state_id<?php echo $addon_id ?>" class="form-control class_state_id" onchange="getCityDetails(this.value,this);">
                                                    <option value="">Please select option</option>
                                                    <?php
                                                    foreach($statelists as $statelist) 
                                                    {
                                                    ?>
                                                    <option <?php if($statelist->state_id==$state_id){?> selected <?php } ?> value="<?=$statelist->state_id?>"><?=$statelist->name;?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label class="form-label-custom">Cites</label>
                                                    <select name="city_id[<?php echo $addon_id ?>][]" id="city_id<?php echo $addon_id ?>" class="form-control mul-select class_city_id"  multiple="true">
                                                    <?php 
                                                    $citylists = $this->crud->get_all_with_where('city','name','asc',array('status'=>'Y','isDelete'=>0,'country_id' => $country_id,'state_id'=>$state_id));
                                                    
                                                        foreach ($citylists as $citylist) 
                                                        {
                                                        $exp_city_val_ids = explode(',',$city_id);
                                                        ?>
                                                        <option <?php echo in_array($citylist->id, $exp_city_val_ids)? "selected" : ""; ?> value="<?=$citylist->id?>"><?=$citylist->name;?></option>
                                                        <?php 
                                                        }
                                                        ?>
                                                        
                                                    </select>
                                              </div>

                                            <!-- <div class="form-group col-md-12">
                                                <h5>City</h5>
                                                <ul class="list-check class_city_val" id="city_field_val<?php echo $addon_id ?>">
                                                    <?php 
                                                    $citylists = $this->crud->get_all_with_where('city','name','asc',array('status'=>'Y','isDelete'=>0,'country_id' => $country_id,'state_id'=>$state_id));
                                                    
                                                    foreach ($citylists as $citylist) 
                                                    {
                                                    $exp_city_val_ids = explode(',',$city_id);
                                                    ?>
                                                    <li>
                                                        <div class="checkbox-custom">
                                                            <label class="common-checkbox">
                                                            <?=$citylist->name?>
                                                            <input type="checkbox" class="checkbox-custom" name="city_id[<?php echo $addon_id ?>][]" 
                                                            <?php 
                                                            echo in_array($citylist->id, $exp_city_val_ids)? "checked" : "";
                                                            ?>
                                                            value="<?=$citylist->id?>"><span class="checkbox-custom-dummy"></span>
                                                            <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <?php 
                                                    }
                                                    ?>
                                                </ul>
                                            </div> -->
                                            
                                            <?php 
                                            if($auto_count==1)
                                            {
                                            ?>
                                            <button type="button" class="button button-lg button-shadow-2 button-primary button-zakaria mt-0 ml-3 add_button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            <?php
                                            } 
                                            else 
                                            {
                                            ?>
                                            <button type="button" data-delete-id="<?php echo $addon_id ?>" class="button button-lg button-shadow-2 button-primary button-zakaria mt-0 ml-3 remove_button"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                            <?php 
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        $auto_count++;
                                    }
                                }
                                else
                                {
                                ?>
                                <div class="row filed_class">
                                    <div class="form-group col-md-6">
                                                <label class="form-label-custom">From Date</label>
                                                <input type="date" class="form-control class_from_date" name="from_date[1][]" id="from_date1" >    
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="form-label-custom">To Date</label>
                                                <input type="date" class="form-control class_to_date" name="to_date[1][]" id="to_date1" >    
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label class="form-label-custom">Start Time</label>
                                                <input type="time" class="form-control class_start_time" id="start_time1" name="start_time[1][]" value="">    
                                            </div>  

                                            <div class="form-group col-md-6">
                                                <label class="form-label-custom">End Time</label>
                                                <input type="time" class="form-control class_end_time" id="end_time1" name="end_time[1][]" value="">   
                                            </div>

                                    <div class="form-group col-md-6">
                                        <label class="form-label-custom">Country</label>
                                        <select name="country_id[1][]" id="country_id1" class="form-control class_country_id" onchange="getStateDetails(this.value,this);">
                                            <option value="">Please select option</option>
                                            <?php
                                            foreach($countrylists as $countrylist) 
                                            {
                                            ?>
                                            <option value="<?=$countrylist->country_id?>"><?=$countrylist->name;?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label class="form-label-custom">State</label>
                                        <select name="state_id[1][]" id="state_id1" class="form-control class_state_id" onchange="getCityDetails(this.value,this);">
                                            <option value="">Please select option</option>
                                            
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label class="form-label-custom">Cites</label>
                                        <select name="city_id[1][]" id="city_id1" class="form-control mul-select class_city_id"  multiple="true">
                                            
                                        </select>
                                    </div>
                                    
                                    <button type="button" class="button button-lg button-shadow-2 button-primary button-zakaria mt-0 ml-3 add_button"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                                <?php 
                                }
                                ?>
                            </div>
                            
                            <div class="last-btn-blocks mt-3">
                                <button type="submit" name="submit" id="submit" value="formSave" class="button button-lg button-shadow-2 button-primary button-zakaria">Save Changes</button>
                            </div>
                        </div>
                    </form>
               </div>
            </div>
          </div>
      </div>

    </div>
                                    
<?php 
$demo = '<div class="row filed_class">';

$demo .= '<div class="form-group col-md-6">';
$demo .= '<label class="form-label-custom">From Date</label>';
$demo .= '<input type="date" class="form-control class_from_date" name="from_date[1][]" id="from_date1">';
$demo .= '</div>';
$demo .= ' <div class="form-group col-md-6">';
$demo .= '<label class="form-label-custom">To Date</label>';
$demo .= '<input type="date" class="form-control class_to_date" name="to_date[1][]" id="to_date1"> ';
$demo .= '</div> ';

$demo .= '<div class="form-group col-md-6">';
    $demo .= '<label class="form-label-custom">Start Time</label>';
    $demo .= '<input type="time" class="form-control class_start_time" name="start_time[1][]" id="start_time1">';
$demo .= '</div>';
$demo .= ' <div class="form-group col-md-6">';
        $demo .= '<label class="form-label-custom">End Time</label>';
        $demo .= '<input type="time" class="form-control class_end_time" name="end_time[1][]" id="end_time1"> ';
$demo .= '</div> ';

    $demo .= '<div class="form-group col-md-6">';
        $demo .= '<label class="form-label-custom">Country</label>';
        $demo .= '<select name="country_id[1][]" id="country_id1" class="form-control class_country_id" onchange="getStateDetails(this.value,this);">';
            $demo .= '<option value="">Please select option</option>';

                foreach($countrylists as $countrylist) 
                {
                    $dis_country_name = str_replace("'", '', $countrylist->name);
            $demo .= '<option value="'.$countrylist->country_id.'">'.$dis_country_name.'</option>';
                }

            $demo .= '</select>';
        $demo .= '</div>';

        $demo .= '<div class="form-group col-md-6">';
            $demo .= '<label class="form-label-custom">State</label>';
            $demo .= '<select name="state_id[1][]" id="state_id1" class="form-control class_state_id" onchange="getCityDetails(this.value,this);">';
                $demo .= '<option value="">Please select option</option>';
            $demo .= '</select>';
        $demo .= '</div>';

        $demo .= '<div class="form-group col-md-12">';
            $demo .= '<label class="form-label-custom">Cites</label>';
            $demo .= '<select name="city_id[1][]" id="city_id1" class="form-control mul-select class_city_id" multiple="true">';
                $demo .= '<option value="">Please select option</option>';
            $demo .= '</select>';
        $demo .= '</div>';

        // $demo .= '<div class="form-group col-md-12">';
        //     $demo .= '<h5>City</h5>';
        //     $demo .= '<ul class="list-check class_city_val" id="city_field_val1"></ul>';
        // $demo .= '</div>';
        
        $demo .= '<button type="button" class="button button-lg button-shadow-2 button-primary button-zakaria mt-0 ml-3 remove_button"><i class="fa fa-minus" aria-hidden="true"></i></button>';
    $demo .= '</div>';
?>

<!-- footer -->
<?php $this->load->view(FRONTEND."include/footer"); ?>
<?php $this->load->view(FRONTEND."include/include_js"); ?>

 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">

    function getStateDetails(county_id,all_details)
    {
        var tmp = $(all_details).attr("id");
        var res = tmp.split("country_id");
        var curr_pos = res[1];

        $.ajax({
            url: baseURL+'CommonController/getStateByCountry',
            type: "POST",
            data: "id="+county_id,
            success: function (data) {
                data = JSON.parse(data);
                var list = '<option value="">Please select option</option>';
                if( data != 'blank' )
                {
                    list = '<option value="">Select select option</option>';
                    $.each( data, function(index, item) {
                        list += '<option value="'+item.state_id+'">'+item.name+'</option>';
                    });
                }

                $("#state_id"+curr_pos).html(list);
                $("#city_id"+curr_pos).html("Please select state");
            },
        });
    }

    function getCityDetails(state_id,all_details)
    {
        var tmp = $(all_details).attr("id");
        var res = tmp.split("state_id");
        var curr_pos = res[1];
        $.ajax({
            url: baseURL+'CommonController/getCityByState',
            type: "POST",
            data: "id="+state_id,
            success: function (data) {
                data = JSON.parse(data);
                var list = "";
                if( data != 'blank' )
                {
                    $.each( data, function(index, item) {
                        list += '<option value="'+item.id+'">'+item.name+'</option>';
                    });
                }
                else
                {
                    
                    list = 'No city found for selected state';
                }
                $("#city_id"+curr_pos).html(list);
            },
        });
    }

    $(document).ready(function(){ 
        var addButton = $('.add_button'); 
        var wrapper = $('.filed'); 
        <?php 
        if($locationlists_count > 0)
        {
            if($auto_count!= 1)
            {
            ?>
            var cal = '<?php echo ($auto_count - 1)?>'; 
            <?php
            }
            else
            {
            ?>
            var cal = '<?php echo $auto_count; ?>'; 
            <?php
            }
        }
        else
        {
        ?>
        var cal = '<?php echo ($auto_count)?>'; 
        <?php 
        }
        ?>
        $(addButton).click(function(){ 
            var tmp1 = '<?php echo $demo; ?>';
            var auto_newval = parseInt(cal) + 1;
            var tmp1  = tmp1.replace(/country_id1/gi,"country_id"+(auto_newval));
            var tmp_name = "country_id[1][]";
            var tmp1  = tmp1.replace(tmp_name,"country_id["+(auto_newval)+"][]");

            var tmp1  = tmp1.replace(/state_id1/gi,"state_id"+(auto_newval));
            var tmp_name = "state_id[1][]";
            var tmp1  = tmp1.replace(tmp_name,"state_id["+(auto_newval)+"][]");

            var tmp1  = tmp1.replace(/city_id1/gi,"city_id"+(auto_newval));
            var tmp_name = "city_id[1][]";
            var tmp1  = tmp1.replace(tmp_name,"city_id["+(auto_newval)+"][]");
            // var tmp_name = "city_id[1][]";
            // var tmp1  = tmp1.replace(/city_id1/gi,"city_id"+(auto_newval));
            var tmp_name = "from_date[1][]";
            var tmp1  = tmp1.replace(tmp_name,"from_date["+(auto_newval)+"][]");
            var tmp_name = "to_date[1][]";
            var tmp1  = tmp1.replace(tmp_name,"to_date["+(auto_newval)+"][]");

            var tmp_name = "start_time[1][]";
            var tmp1  = tmp1.replace(tmp_name,"start_time["+(auto_newval)+"][]");
            var tmp_name = "end_time[1][]";
            var tmp1  = tmp1.replace(tmp_name,"end_time["+(auto_newval)+"][]");

            console.log(tmp1);
            $(wrapper).append(tmp1); 
            cal = parseInt(cal) + 1;
        });

        $(wrapper).on('click', '.remove_button', function(e){ 
            e.preventDefault();
            $(this).parent('div').remove(); 

            var id = $(this).attr('data-delete-id');
            var td = 'my_diary';
            console.log($(this));
            $('input[name="main_row_ids[]"][data-id="'+id+'"]').remove();
            var delete_ids = $('#deleted_row_ids').val();
                        //alert(delete_ids);.

            if(confirm("Are you sure you want to delete location?"))
            {

            }
            else
            {
                return false;
            }
            if(delete_ids != '') 
            {
                
                $('#deleted_row_ids').val(delete_ids+','+id);
            }
            else 
            {
                $('#deleted_row_ids').val(id);
                $.ajax({
                  url: baseURL+'CommonController/deleteLoctionData',
                  dataType: "JSON",
                  method:"POST",
                    data: {
                        "id": id,
                        "td": td,
                    },
                    success: function ()
                    {
                      $.notify({message: 'Record deleted successfully.'},{ type: 'success'});

                    }
              });                                                                                       
            }
        });
    });

    function form_submit() 
    {
        $("#submit").attr("readonly", true);
            
        var multi_val = true;
        $( ".filed_class" ).filter(function( index ) 
        {
            var country_id_field = $(this).find(".class_country_id").val();
            var state_id_field = $(this).find(".class_state_id").val();
            var city_id_field = $(this).find('.class_city_id').val();
            var from_date = $(this).find(".class_from_date").val();
            var to_date   = $(this).find(".class_to_date").val();
            var start_time = $(this).find(".class_start_time").val();
            var end_time   = $(this).find(".class_end_time").val();

            $(this).find(".class_country_id").css('border','1px solid #e1e1e1');
            $(this).find(".class_state_id").css('border','1px solid #e1e1e1');
            $(this).find(".class_city_id").css('border','1px solid #e1e1e1');
            $(this).find(".class_from_date").css('border','1px solid #e1e1e1');
            $(this).find(".class_to_date").css('border','1px solid #e1e1e1');
            $(this).find(".class_start_time").css('border','1px solid #e1e1e1');
            $(this).find(".class_end_time").css('border','1px solid #e1e1e1');

            // alert(index+"=="+country_id_field+"=="+state_id_field+"=="+city_id_field);

            if(country_id_field=="" || country_id_field==null)
            {
                $(this).find(".class_country_id").css('border','1px solid #ff3111');
                multi_val = false;
            }

            if(state_id_field=="" || state_id_field==null)
            {
                $(this).find(".class_state_id").css('border','1px solid #ff3111');
                multi_val = false;
            }

            if(city_id_field=="" || city_id_field==0 || city_id_field==null)
            {
                $(this).find(".class_city_id").css("border","1px solid #ff3111");
                multi_val = false;
            }

            if(from_date=="" || from_date==null)
            {
                $(this).find(".class_from_date").css('border','1px solid #ff3111');
                multi_val = false;
            }

            if(to_date=="" || to_date==null)
            {
                $(this).find(".class_to_date").css('border','1px solid #ff3111');
                multi_val = false;
            }

            if(start_time=="" || start_time==null)
            {
                $(this).find(".class_start_time").css('border','1px solid #ff3111');
                multi_val = false;
            }

            if(end_time=="" || end_time==null)
            {
                $(this).find(".class_end_time").css('border','1px solid #ff3111');
                multi_val = false;
            }
        });

        if(multi_val==false)
        {
            $("#submit").attr("readonly", false);
        }
        return multi_val;
    }


    $(window).load(function() {
      $(".mul-select").select2({
            placeholder: " -- Select Cites --", //placeholder
            tags: true,
            tokenSeparators: ['/',',',';'," "]
        });
    });
        


    $(document).on("click",".mul-select",function(){
        $(".mul-select").select2({
            placeholder: " -- Select Cites --", //placeholder
            tags: true,
            tokenSeparators: ['/',',',';'," "]
        });
    })
</script>
</body>
</html>