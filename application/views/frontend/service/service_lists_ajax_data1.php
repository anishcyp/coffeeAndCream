<!--  Near located user profile   -->
<?php 
if(!empty($posts1))
{
    foreach($posts1 as $post)
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

        //$details_url  = base_url()."service/details/".md5($id)."/";
        // $details_url  = base_url()."user/details/".md5($id)."/";
        // $str = ucwords($post['fname'].'-'.$post['lname']);
        // $details_url1  = base_url()."user/details/".str_replace(' ', '', $str)."/";

        $str = ucwords($post['slug']);
        $details_url1  = base_url()."user/details/".$str."/"
        ?> 
        <!-- <li class="overlay-link-gallery">
            <div class="inner_link">
                <a href="javascript:void(0)">
                    <img src="<?=$prd_preview;?>" alt="<?=$post['fname']." ".$post['lname']?>">
                    <div class="gallery-content">
                        <h4><?=$post['fname']." ".$post['lname']?></h4>
                        <p><?= $city_name ?></p>
                    </div>
                </a>
                <div class="overlay-blocks-open">
                    <div class="overlay-blocks-open-inner">
                        <a href="javascript:void(0)" data-id="<?= md5($id) ?>" data-action="<?= $details_url1 ?>" id="flashing" class="title-main">Are you looking for somebody right now? Look for the flashing icon.</a>
                        <a href="tel:+<?=$phone;?>" class="pulse call-icon-main"><i class="fas fa-phone-alt"></i></a>
                    </div>
                </div>
            </div>
        </li> -->
        <li class="overlay-link-gallery">
            <div class="inner_link">
                <a href="<?= $details_url1 ?>">
                    <img src="<?=$prd_preview;?>" alt="<?=$post['fname']." ".$post['lname']?>">
                    <div class="gallery-content">
                        <h4><?=$post['fname']." ".$post['lname']?></h4>
                        <p><?= $city_name ?></p>
                        <!--<p><?= ucfirst($services_name) ?></p>-->
                    </div>
                </a>
                <div class="overlay-blocks-open">
                    <div class="overlay-blocks-open-inner">
                        <a href="<?= $details_url1 ?>" data-id="<?= md5($id) ?>" data-action="<?= $details_url1 ?>" id="flashing" class="title-main">Are you looking for somebody right now? Look for the flashing icon.</a>
                        <a href="tel:+<?=$phone;?>" class="pulse call-icon-main"><i class="fas fa-phone-alt"></i></a>
                    </div>
                </div>
            </div>
        </li>
        <?php 
    
        // echo '<form name="frm" id="frm" method="post" action="">
        //         <input type="hidden" name="ids" id="ids" />
        //         </form>';
    }
}

?>

