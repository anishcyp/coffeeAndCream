<?php 
if(!empty($posts))
{
    foreach($posts as $post)
    {
        $ribbon         = $post['call_type'];
        $id             = $post['id'];
        $phone          = $post['phone'];
        $image_path     = $post['profile_image'];

        if($ribbon == '1')
        {
            $service = 'Entertainment';
        }
        else if($ribbon == '2')
        {
            $service = 'Escort';
        }
        else 
        {
            $service = 'Entertainment Escort';
            $class1 = 'duo';
            $class2 = 'duos';
        }

        $country_name = $this->crud->get_column_value_by_id("country","name","country_id = '".$post['country_id']."'");

        $state_name = $this->crud->get_column_value_by_id("state","name","state_id = '".$post['state_id']."'");

        $city_name = $this->crud->get_column_value_by_id("city","name","id = '".$post['city_id']."'");

        $prd_exist = UPLOAD_DIR.USER_PROFILE_IMG.$image_path;

        if(file_exists($prd_exist) && $image_path!="") 
        {
            $prd_preview = base_url().UPLOAD_DIR.USER_PROFILE_IMG.$image_path;
        } 
        else 
        {
            $prd_preview = base_url().UPLOAD_DIR.'default.png';
        }

        // $details_url  = base_url()."agencies/".md5($id)."/";
        $str = strtolower($post['slug']);
        $details_url  = base_url()."agency/details/".$str."/";
        
        ?> 
        <div class="col-lg-3 col-sm-6 col-md-6">
            <div class="agencies-box">
                <div class="image-box">
                    <a href="<?= $details_url ?>"><img style="width: 285px; height: 82px;" src="<?= $prd_preview ?>" alt="<?= $post['agency_name'] ?>"></a>
                </div>
                <div class="agencies-content">
                    <a href="<?= $details_url ?>" class="title-block" style="color: black;">
                        <?php $description  = $this->crud->limit_character($post['Introduction'],60); ?>
                        <!-- <h5><?= $post['agency_name'] ?></h5> -->
                        <p><?php echo strip_tags($description) ?></p>
                    </a>
                    <div class="full-width-btn">
                        <a href="<?= $details_url ?>"><i class="fas fa-building"></i> <?= $post['agency_name'] ?></a>
                    </div>
                    <?php
                    $a_name = strtolower($post['agency_name']);
                    
                    $entert_url  = base_url()."agency/details/".$str."/entertainment";
                    $escort_url  = base_url()."agency/details/".$str."/escorts";
                    ?>
                    <div class="button-group row">
                    <?php
                        
                        $stripper_c = $this->crud->getFromSQL("SELECT count(c.id) as countdata FROM `tbl_customer` `c` INNER JOIN `apply_job` `r` ON `r`.`user_id` = `c`.`id` WHERE `c`.`is_delete` = 0 AND `c`.`status` = 'Y' AND `c`.`purchase_plan` = 1 AND `c`.`is_verified` = 1 AND `c`.`user_role` = 1 AND `r`.`agency_id` = '".$post['id']."' AND `isDelete` = 0 AND `apply_req` = 2");


                        $escort_c = $this->crud->getFromSQL("SELECT count(c.id) as countdata FROM `tbl_customer` `c` INNER JOIN `agency_req` `r` ON `r`.`user_id` = `c`.`id` WHERE `c`.`is_delete` = 0 AND `c`.`status` = 'Y' AND `c`.`purchase_plan` = 1 AND `c`.`is_verified` = 1 AND `c`.`user_role` = 2 AND `r`.`agency_id` = ".$post['id']." AND `isDelete` = 0 AND `request` = 2");                      

                    ?>
                    <div class="col-6">
                            <a href="<?= $entert_url ?>" class="btn"><i class="fa fa-female"></i>  <?php if($stripper_c[0]->countdata){ echo "(".$stripper_c[0]->countdata.")"; } ?>   ENTERTAINMENT</a>
                    </div>
                        <div class="col-6">
                            <a href="<?= $escort_url ?>" class="btn"><i class="fas fa-phone-alt"></i> <?php if($escort_c[0]->countdata){ echo "(".$escort_c[0]->countdata.")"; } ?> CALL NOW!</a>
                        </div>
                    </div>
                </div>
            </div>
                <div class="ribbon red">
                    <span>VIP</span>
                </div>
        </div>        
    <?php 
    }
} 
else
{
?>
    <div class="block-no-record">
        <div class="col-md-12 text-center">
            <h3 class="text-center"><strong class="text-center">No record found.</strong></h3>
        </div>
    </div>
<?php
}
?>