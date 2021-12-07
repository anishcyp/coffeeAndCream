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

    // echo $state_id; exit;

    foreach($posts as $post)
    {
        if($state_id!="" && $state_id!=0)
        {

            $id     = '1';
            $slug   = $post['slug'];
            $name   = strtolower($post['name']);
            $details_url  = base_url()."agencies/".$country_slug."/".$s_slug."/".$slug;
            $location_count = $this->crud->getFromSQL("select count(id) as total_user from tbl_customer where purchase_plan=1 and user_role=4 and agency_status='Y' and agency_user=1 and is_delete=0 and id IN (select user_id from location where country_id='".$country_id."' AND state_id='".$state_id."' AND find_in_set(".$id.", city_id))");

            // echo $this->db->last_query();

        }
        else if($country_id!="" && $country_id!=0)
        {
            $id     = $post['state_id'];
            $slug   = $post['slug'];
            $name   = strtolower($post['name']);

            $details_url  = base_url()."agencies/".$country_slug."/".$slug;

            $location_count = $this->crud->getFromSQL("select count(id) as total_user from tbl_customer where purchase_plan=1 and user_role=4 and agency_status='Y' and agency_user=1 and is_delete=0 and id IN (select user_id from location where country_id='".$country_id."' AND state_id='".$id."')");
        }
        else
        {
            $id     = $post['country_id'];
            $slug   = $post['slug'];
            $name   = strtolower($post['name']);

            $details_url  = base_url()."agencies/".$slug;
            $location_count = $this->crud->getFromSQL("select count(id) as total_user from tbl_customer where purchase_plan=1 and user_role=4 and agency_status='Y' and agency_user=1 and is_delete=0 and id IN (select user_id from location where country_id='".$id."')");
            // echo $this->db->last_query(); exit();

        }
        ?>
            <li><a href="<?=isset($details_url) ? $details_url : '';?>"><?php echo $name; ?> <?php if($location_count[0]->total_user){ echo "(".$location_count[0]->total_user.")"; } ?></a></li>
        <?php 
    }
} 
else
{
?>
    <!-- <div class="block-no-record">
        <div class="col-md-12 text-center">
            <h5 class="text-center"><strong class="text-center">Location details not found.</strong></h5>
        </div>
    </div> -->
<?php
}
?>