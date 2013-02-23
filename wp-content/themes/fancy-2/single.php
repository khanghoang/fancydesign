<?php get_header(); ?>
<?php get_sidebar(); ?>
<div class="main-content">
    <?php
    if(have_posts()) : while(have_posts()) : the_post(); ?>
    <div class="post <?php echo is_single() ? 'is-single' : '' ; ?>">
        <div class="post-content">
            <div class="content">
                <div class="top">
                    <h3>BLOG <strong>| <?php the_title(); ?></strong></h3>
    				<span class="post-info"><?php the_time('d/m/y'); ?> | type: <?php the_category(' ');?> | <a href="<?php comments_link(); ?>"><?php comments_number('Chưa có bình luận','1 bình luận','% bình luận'); ?></a></span>
                </div>

                <div class="the-content">
                    <p class="blog_image">
                    <?php
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                        the_post_thumbnail( array(350,678) );
                        // thumb_img($post->ID,'350','678','100',get_the_title());
                    }
                    else {?>
                            <!-- <img class="item-thumbs" src="<?php echo bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo bloginfo('stylesheet_directory'); ?>/images/no-thumbnail.png&h=350&w=678&zc=1&q=100" alt=""/> -->
                    <?php }?>
                    <span class="blog_single_shadow"></span>
                    </p>

				    <?php the_content();?>
				</div>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
    <?php else : ?>
        <p>sorry, no post to display</p>
    <?php endif; 
	wp_reset_query();
	?>
    
   	<div class="more-products">
        <p class="more-products-title">Các sản phẩm khác:</p>
        <div class="more-products-content clearfix">	
        	<ul>
            	 <?php 
				$relative_Products = new WP_query();
				$relative_Products->query("cat=3");
				if($relative_Products->have_posts()) : while($relative_Products->have_posts()) : $relative_Products->the_post();
				?>
            	<li>
                    <a href="<?php echo the_permalink(); ?>">
                        <?php
							if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
								thumb_img($post->ID,'105','150','100',get_the_title());
							}
							else {?>
							<img class="item-thumbs" src="<?php echo bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo bloginfo('stylesheet_directory'); ?>/images/no-thumbnail.png&h=105&w=150&zc=1&q=100" alt=""/>
						<?php } ?>  
                        <p><?php the_title(); ?></p>    
                    </a>
                    <span class="more-product-shadow"></span>
                </li>

                <?php endwhile; endif; 	wp_reset_query();?>
            </ul>
        </div><!--end .more-products-->
    </div><!--end .wapper-more-products-->

    <div class="comment-template">
    <?php comments_template(); ?>
    </div>
</div>

<?php get_footer(); ?>