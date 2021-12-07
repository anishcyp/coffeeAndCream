<?php 
if(!empty($posts))
{
    foreach($posts as $post)
    {
        $id             = $post['id'];
        $phone          = $post['phone'];
        $image_path     = $post['profile_image'];
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

       
        $str = ucwords($post['slug']);
        $details_url1  = base_url()."user/details/".$str."/";

        ?> 
        <li class="overlay-link-gallery">
            <div class="inner_link">
                <a href="<?= $details_url1 ?>" data-id="<?= md5($id) ?>" data-action="<?= $details_url1 ?>" id="flashing" class="title-main">
                    <img src="<?=$prd_preview;?>" alt="<?=$post['fname']." ".$post['lname']?>">
                    <div class="gallery-content">
                        <h5><?=$post['fname']?></h5>
                        <p><?= $city_name ?></p>
                        <!-- <p><?=ucfirst($services_name)?> </p> -->
                    </div>
                </a>
            </div>
        </li>
    <?php 
        // echo '<form name="frm" id="frm" method="post" action="">
        //         <input type="hidden" name="ids" id="ids" />
        //     </form>';
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