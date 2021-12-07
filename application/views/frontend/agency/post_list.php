<?php
if(is_array($posts))
{
    foreach ($posts as $post) 
    {
        $country_name = $this->crud->get_column_value_by_id("country","name","country_id = '".$post['country_id']."'");

        $state_name = $this->crud->get_column_value_by_id("state","name","state_id = '".$post['state_id']."'");

        $image_path     = $post['image'];
        $prd_exist = UPLOAD_DIR.POST_IMG.$image_path;

        if(file_exists($prd_exist) && $image_path!="") 
        {
            $prd_preview = base_url().UPLOAD_DIR.POST_IMG.$image_path;
        } 
        else 
        {
            $prd_preview = base_url().UPLOAD_DIR.'default.png';
        }
            $str = strtolower($post['slug']);

            $details_url  = base_url()."post-and-ads/details/".$str."/";                    
        ?>
        <div class="col-md-4 col-lg-3 col-sm-6 post-adsbox">
            <div class="adsbox-inner">
				<div class="post-image">
					<div class="image-inner">
						<a href="<?= $details_url ?>">
                            <img src="<?= $prd_preview ?>">
                            <span>click to see</span>
                            <h4 style="font-size: unset;text-transform: capitalize;"><?= $state_name.': '.$post['title'] ?></h4>
                        </a>
					</div>
				</div>
            </div>
        </div>
        <?php
    }
}
?>