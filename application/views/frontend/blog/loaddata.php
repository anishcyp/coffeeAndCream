<?php 
foreach($posts as $post){
?>
	<div class="blog-divs blog-div">
		<h5><?=$this->crud->limit_character($post['title'],30)?></h5>
		<?=$this->crud->limit_character(strip_tags($post['content']),150)?>
		<div><a href="<?=base_url()."blog/details/".md5($post['blog_id'])."/"?>" class="btn_1 small">Read More</a></div>
		<hr>
	</div>
<?php
}
?>