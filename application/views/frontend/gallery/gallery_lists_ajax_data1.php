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

        $str = strtolower($post['slug']);
        $details_url1  = base_url()."user/details/".$str."/";
        ?> 
        <li class="overlay-link-gallery">
            <a href="<?= $details_url1 ?>" data-id="<?= md5($id) ?>" data-action="<?= $details_url1 ?>" id="flashing">
                <img src="<?=$prd_preview;?>" alt="<?=$post['fname']." ".$post['lname']?>">
                <div class="gallery-content">
                    <h4><?=$post['fname']." ".$post['lname']?></h4>
                    <p><?= $city_name ?></p>
                    <p><?=ucfirst($post['gender'])?> Stripper</p>
                </div>
            </a>
            <div class="overlay-blocks-open">
                <div class="overlay-blocks-open-inner">
                    <a href="<?= $details_url1 ?>" data-id="<?= md5($id) ?>" data-action="<?= $details_url1 ?>" id="flashing" class="title-main">Are you looking for somebody right now? Look for the flashing icon.</a>
                    <a href="tel:+<?=$phone;?>" class="pulse call-icon-main"><i class="fas fa-phone-alt"></i></a>
                </div>
            </div>
        </li>
        <?php 
    }
} 

?>