<div class="col-lg-4 col-xl-3">
  <div class="widget search_blog">
      <div class="form-group">
        <input type="text" name="search" id="search" class="form-control" placeholder="Search..">
        <span><input type="submit" value="Search" onclick="get_search_blog();"></span>
        <div id="suggesstion-box"></div>
      </div>
  </div>
  <div class="aside row row-30 row-md-50 justify-content-md-between">
    <div class="aside-item col-sm-12 col-lg-12">
      <h6 class="aside-title">Latest Blogs</h6>
      <div class="row row-20 row-lg-30 gutters-10">
        <?php
        $params['start']        = "0";
        $params['Limit']        = "5";
        $params['ShortOrder']   = array("blog_id","desc");
        $recent_blog    = $this->crud->get_data("blog",array("isDelete"=>"0","status"=>'Y',"service_type"=>1),$params);
        foreach ($recent_blog as $key => $value)
        {
        $rtitle = $this->crud->limit_character($value['title'],25);
        $rcreated_at = date("M d, Y",strtotime($value['created_at']));
        $rimage_path = $value['blog_image'];
        $rec_img_exist  = UPLOAD_DIR.BLOG_IMG.$rimage_path;
        if(file_exists($rec_img_exist) && $rimage_path!="")
        {
        $rec_img_preview = base_url().UPLOAD_DIR.BLOG_IMG.$rimage_path;
        }
        else
        {
        $rec_img_preview = base_url().UPLOAD_DIR.'default.png';
        }

        $str = strtolower($value['title_slug']);
        $rec_post_url  = base_url()."blog/details/".$str;
        $dis_rcate = $this->crud->get_column_value_by_id("blog_category","name","id='".$value['blog_cate']."'");
        ?>
        <div class="col-12 col-lg-12 latest-post-box">
          <!-- Post Minimal-->
          <article class="post post-minimal">
          <div class="unit unit-spacing-sm flex-column flex-lg-row align-items-lg-center">
            <div class="alignleft">
            <div class="unit-left">
              <a class="post-minimal-figure" href="<?php echo $rec_post_url;?>"><img src="<?php echo $rec_img_preview;?>" alt="" width="106" height="104"></a>
            </div>
            </div>
            <div class="title-block">
                <p class="post-minimal-title"><?=$dis_rcate;?> <br> <?php echo $rcreated_at;?></p>
                <div class="post-minimal-time">
                    <h6><a href="<?php echo $rec_post_url;?>" title=""><?php echo $rtitle;?></a></h6>
                </div>
            </div>
          </div>
          </article>
        </div>
        <?php
        }
         ?>
        <br><br>
        <div class="aside-item col-sm-6 col-md-5 col-lg-12">
          <h6 class="aside-title">Categories</h6>
          <ul class="list-categories">
            <?php
            $params1['Select']   = array("name","slug","id");
            $params1['ShortOrder']   = array("blog_id","desc");
            $cate_lists    = $this->crud->get_data("blog_category",array("isDelete"=>"0","status"=>'Y',"service_type"=>2),$params1);
            foreach ($cate_lists as $key => $value)
            {
            $total_cate_blog = $this->crud->total_record("blog",array("blog_cate" => $value['id'],"isDelete" => 0, "status" => 'Y',"service_type"=>1));
            ?>
            <li><a href="<?=base_url("blog/category/".$value['slug'])?>"><?= $this->crud->limit_character($value['name'],25)?> <span>(<?=$total_cate_blog;?>)</span></a></li>
            <?php
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>