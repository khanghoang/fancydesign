<?php
    if(have_posts()) : while(have_posts()) : the_post(); ?>
    <div class="post" >
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
						redirect_uri=http://www.example.com/response">Facebook</a> | 
						<a href="#">Twitter</a> | 
						<a href="#">Likedln</a></span>
				</p>
			</div>			
		</div>
	</div>
    <?php endwhile; ?>
    <?php else : ?>
    <div class="post">
        <div class="post-inner-shadow"></div>
        <div class="post-content" style="margin-left:20px;">
             <h3><a href="#" style="font-size:16px;">Không tìm thấy kết quả phù hợp</a></h3>
        </div>
    </div>
    <?php endif; ?>