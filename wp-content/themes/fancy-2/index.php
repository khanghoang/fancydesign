

<?php get_header(); ?>
<?php get_sidebar(); ?>
<ul class="main-content">
    <h3 class="content-title"><a href="#">Blog</a></h3>

    <?php
	
	$post_per_page = 10;
	$temp = $wp_query;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	$wp_query= null;
	$wp_query = new WP_Query();
	$wp_query->query('cat=12&showposts='.$post_per_page.'&paged='.$paged);
	$post_counter = 0;
	if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post();
    $post_counter++; 
	?>
	<li class="post" >
		<div class="post-content">
			 <a class="clearfix post-thumbs" href="<?php the_permalink(); ?>">
            	<span class="item-thumbs">
            	<?php
					if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
						the_post_thumbnail( array(240,170) ); 
					}
					else {?>
					<img class="item-thumbs" src="<?php echo bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo bloginfo('stylesheet_directory'); ?>/images/no-thumbnail.png&h=170&w=240&zc=1&q=100" alt=""/>
				<?php } ?>
				<span class="blog-image-shadow"></span>
				</span>
            </a>
			<div class="excerpt">
				<h3 class="post-title"><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3>
				<span class="post-info"><?php the_time('d/m/y'); ?> | type: <?php the_category(' ');?> | <a href="<?php comments_link(); ?>"><?php comments_number('Chưa có bình luận','1 bình luận','% bình luận'); ?></a></span>
				<div class="the-content">
				<?php	
					the_content(" ");
				?>
				</div>
				
				<p class="share">
					<a class="reading" href="<?php the_permalink(); ?>" >Read more...</a>
					<span><strong>Share: </strong>
						<a href="https://www.facebook.com/dialog/feed?app_id=123050457758183&amp;
						link=https://developers.facebook.com/docs/reference/dialogs/&amp;
						picture=http://fbrell.com/f8.jpg&amp;name=Facebook%20Dialogs&amp;
						caption=Reference%20Documentation&amp;
						description=Using%20Dialogs%20to%20interact%20with%20users&amp;
						redirect_uri=<?php the_permalink();?>">Facebook</a> | 
						
						<a href="https://twitter.com/share" data-url="<?php the_permalink();?>" class="twitter-share-button" data-count="none" data-lang="en" data-text="<?php the_title();?>">Twitter</a>
						<span style="display: none">
							<script type="IN/Share" data-url="<?php the_permalink();?>"></script>
						</span>
						 | <a href="javascript:void(0)" onclick="$(this).siblings('span').find('.IN-widget a').parent().click();">Likedln</a>
					</span>
				</p>
			</div>			
		</div>
	</li>
	<?php
	endwhile;
	
	?>
	<?php else : ?>
		<li class="post">
	        <div class="post-content" style="margin-left:20px;">
	             <h3><a href="#" style="font-size:16px;">Không tìm thấy kết quả phù hợp</a></h3>
	        </div>
	    </li>
	<?php endif; ?>
    
<?php 
	wp_reset_query();
	
	$count = $post_counter / $post_per_page ;
	if((wp_count_posts()->publish) % $post_per_page > 0)
		$count++;
?>
    
        <ul class="paging">
			<li><a href="?page=1">Đầu</a></li>

            <?php previous_posts_link('<li class="page-prev"></li>'); ?>
                
            <?php 
			if($count >= 3){
				$i = round(($count + 1) / 2);
				for($i = $i - 1 ; $i <= round(($count + 3)/2); $i++){
					
					echo "<li><a href='?page=$i'>$i</a></li>";						
				}
			}else{
				for($i = 1; $i <= $count ; $i++){
				
					echo "<li><a href='?page=$i'>$i</a></li>";						
				}
			}
            ?>
            <li class="page-next">
                    <?php next_posts_link('Next'); ?>
            </li>
            <?php
				echo  
				'<li><a href="?page='.round($count).'">
						Cuối
					</a></li>';
			?>
        </ul><!--end .page-->
</ul>
</div>
<?php $wp_query = null; $wp_query = $temp;?>
<?php get_footer(); ?>