<?php 
/*
	Template Name: Blog
*/
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
<div class="main-content">
    <h3 class="content-title">Blog</h3>

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
	<div class="post" >
		<div class="post-content">
			 <a href="<?php the_permalink(); ?>">
            	<span class="item-thumbs">
            	<?php
					if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
						the_post_thumbnail( array(150,150) ); 
					}
					else {?>
					<img class="item-thumbs" src="<?php echo bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo bloginfo('stylesheet_directory'); ?>/images/no-thumbnail.png&h=150&w=150&zc=1&q=100" alt=""/>
				<?php } ?>
				</span>
            </a>
			<div class="content">
				<h3><a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h3>
				<span class="post-info"><?php the_time('F j, Y'); ?> | <a href="<?php comments_link(); ?>"><?php comments_number('Chưa có bình luận','1 bình luận','% bình luận'); ?></a></span>
				<div id="the-content">
				<?php	
						echo  the_content(" ");
				?>
				</div>
				<span class="reading"><a href="<?php the_permalink(); ?>" >Xem tiếp...</a></span>
			</div>
		</div>
	</div>
	<?php
	endwhile;
	
	?>
	<?php else : ?>
		<div class="post">
        <div class="post-content" style="margin-left:20px;">
             <h3><a href="#" style="font-size:16px;">Không tìm thấy kết quả phù hợp</a></h3>
        </div>
    </div>
	<?php endif; ?>
    
<?php 
	wp_reset_query();
	
	$count = $post_counter / $post_per_page ;
	if((wp_count_posts()->publish) % $post_per_page > 0)
		$count++;
?>
    <div class="page">
    	
        <ul>
			<?php
				echo  
					'<a href="?paged=1">
						<li>
							<span>Đầu</span>
						</li></a>';
			?>
            <?php previous_posts_link('<li id="page-prev">
                    <span></span>
                </li>'); ?>
                
            <?php 
			if($count >= 3){
				$i = round(($count + 1) / 2);
				for($i = $i - 1 ; $i <= round(($count + 3)/2); $i++){
					echo '
						<a href="?paged='.$i.'">
							<li>
								<span>'.$i.'</span>
							</li></a> ';
						
					}
			}else{
				for($i = 1; $i <= $count ; $i++){
					echo '
						<a href="?paged='.$i.'">
							<li>
								<span>'.$i.'</span>
							</li></a> ';
						
					}
			}
            ?>
            <?php next_posts_link(' <li id="page-next">
                    <span></span>
                </li>'); ?>   
            <?php
				echo  
				'<a href="?paged='.round($count).'">
					<li>
						<span>Cuối</span>
					</li></a>';
			?>
        </ul>

    </div><!--end .page-->
</div>
</div>
<?php $wp_query = null; $wp_query = $temp;?>
<?php get_footer(); ?>