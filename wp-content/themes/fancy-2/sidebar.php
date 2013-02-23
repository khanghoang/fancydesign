<div class="wrapper-content">
	<div class="side-bar-wrapper">
        <div class="side-bar">
            <div class="side-bar-content">
            <ul>
            	<?php
					$randPosts = new WP_query();
					$randPosts->query("showposts=3&&orderby=rand&&cat=3");
					if($randPosts->have_posts()): while($randPosts->have_posts()) : $randPosts->the_post();
				?>
                
                <a href="<?php echo the_permalink(); ?>" title="<?php the_title(); ?>">
                    <li>
                        <div class="item">                                
							<span class="item-thumbs">
										<?php
											if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
												thumb_img($post->ID,'115','160','100',get_the_title());
											}
											else {?>
											<img class="item-thumbs" src="<?php echo bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo bloginfo('stylesheet_directory'); ?>/images/no-thumbnail.png&h=115&w=160&zc=1&q=100" alt=""/>
										<?php } ?>      
									<!--  <p class="item-name">Xem chi tiết</p>  -->
									<span class="blog-item-shadow"></span>
							 </span>
							 <div class="item-title">
								<span class="title">
								<?php
								$t = the_title_attribute(array('echo' => false));
								if(strlen($t) >= 25)
								{
									echo substr($t,0,25) . '...';
								}
								else
									echo the_title();
								?>
								</span>
							</div>
                        </div>
                    </li>
                </a>
                <?php endwhile;endif;?>
            </ul>

            </div>
            
       </div>
       <p id="view-portfolio">
            	<a href="<?php echo(get_page_link(get_page_by_title('Portfolio')->ID)) ?>" title="Xem toàn bộ thiết kế">
            		View portfolio
            	</a>
            </p>
		<?php 
        if( !function_exists('dynamic_sidebar') || !dynamic_sidebar()) :?>
        <?php 
        endif;
        ?>
    </div>
        