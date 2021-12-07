  <?php 
  $count = 1;
  ?>
  <div class="row">
  <?php
  if(!empty($posts)): foreach($posts as $post): 

    $id           = $post['blog_id'];
    $image_path   = $post['blog_image'];

    $prd_exist = UPLOAD_DIR.BLOG_IMG.$image_path;

    if(file_exists($prd_exist) && $image_path!="") 
    {
      $prd_preview = base_url().UPLOAD_DIR.BLOG_IMG.$image_path;
    } 
    else 
    {
      $prd_preview = base_url().UPLOAD_DIR.'default.png';
    }
    $title        = $this->crud->limit_character($post['title'],30); 
    $created_at   = date("M d, Y",strtotime($post['created_at'])); 
    $description  = $this->crud->limit_character($post['content'],250); 
    // $details_url  = base_url()."blog/details/".md5($id)."/";
    
    $str = strtolower($post['title_slug']);
    $details_url  = base_url()."blog/details/".$str;
        
    $dis_author   = $post['author'];
    $dis_cate = $this->crud->get_column_value_by_id("blog_category","name","id='".$post['blog_cate']."'");
    $dis_comments = $this->crud->total_record("blog_comment",array("blog_id" => $post['blog_id'],"isDelete" => 0, "status" => 'Y'));
  ?>
    <div class="blog-main-inner">
      <div class="row row-50 row-md-60 row-lg-80">
        <div class="col-12">
          <div class="row row-30">
            <div class="col-sm-12">
              <!-- Post Classic-->
              <article class="post post-classic box-md"><a class="post-classic-figure blog-listing" href="<?= $details_url ?>"><img src="<?= $prd_preview ?>" alt="" width="370" height="239"></a>
                <div class="post_info">
                  <small><b><?php echo $this->crud->limit_character($dis_cate,30);?> - <?= $created_at; ?></b></small>
                  <small><b><a href="<?php echo $details_url;?>"><i class="fa fa-comment" aria-hidden="true"></i> Comments <?php echo $dis_comments;?></b></a></small>
                 
                  <h5><b><a href="<?php echo $details_url;?>"><?= $title; ?></a></b></h5>
                  <p><?= strip_tags($description); ?></p>
                </div>
              </article>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
  $count++;
 ?> 
<?php endforeach; ?>
</div>
<?php else: ?>
  <div class="row">
    <div class="col-md-12 text-center">
      <h3><strong>No record found.</strong></h3>
    </div>
  </div>
<?php endif ?>

<div class="row text-center">
    <?= $this->ajax_pagination->create_links(); ?>
</div>