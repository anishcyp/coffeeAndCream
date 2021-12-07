<?php 
if(!empty($posts))
{
    if($country_id!="" && $country_id!=0)
    {
        $country_slug = $this->crud->get_column_value_by_id("country","slug","country_id = '".$country_id."'");
    }

    if($state_id!="" && $state_id!=0)
    {
        $s_slug = $this->crud->get_column_value_by_id("state","slug","state_id = '".$state_id."'");
    }

    foreach($posts as $post)
    {
    
        if($state_id!="" && $state_id!=0)
        {

            $id     = $post['id'];
            $slug   = $post['slug'];
            $name   = strtolower($post['name']);

            $details_url  = base_url()."gallery/".$type."/".$country_slug."/".$s_slug."/".$slug;
            
            $location_count = $this->crud->getFromSQL("select count(id) as total_user from tbl_customer where gender = '".$type."' and purchase_plan=1 and is_delete=0 and id IN (select user_id from location where country_id='".$country_id."' AND state_id='".$state_id."' AND find_in_set(".$id.", city_id))");

        }
        else if($country_id!="" && $country_id!=0)
        {
            $id     = $post['state_id'];
            $slug   = $post['slug'];
            $name   = strtolower($post['name']);

            $details_url  = base_url()."gallery/".$type."/".$country_slug."/".$slug;  

            $location_count = $this->crud->getFromSQL("select count(id) as total_user from tbl_customer where gender = '".$type."' and purchase_plan=1 and is_delete=0 and id IN (select user_id from location where country_id='".$country_id."' AND state_id='".$id."')");
            //echo $this->db->last_query();
        }
        else
        {
            $id     = $post['country_id'];
            $slug   = $post['slug'];
            $name   = strtolower($post['name']);

            $details_url  = base_url()."gallery/".$type."/".$slug;

            $location_count = $this->crud->getFromSQL("select count(id) as total_user from tbl_customer where gender = '".$type."' and purchase_plan=1 and is_delete=0 and id IN (select user_id from location where country_id='".$id."')");
            // echo $this->db->last_query();

        }
        ?>
        <li><a href="<?=$details_url;?>" class="button button-lg button-shadow-2 button-primary button-zakaria"><?php echo $name; ?> <?php if($location_count[0]->total_user){ echo "(".$location_count[0]->total_user.")"; } ?></a></li>
        <?php
    }
} 
else
{
?>
    <div class="block-no-record">
        <div class="col-md-12 text-center">
            <h5 class="text-center"><strong class="text-center">Location details not found.</strong></h5>
        </div>
    </div>
<?php
}
?>