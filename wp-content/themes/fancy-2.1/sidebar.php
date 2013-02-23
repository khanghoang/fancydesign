<div class="wrapper-content">
	<div class="side-bar-wrapper">
             
		<?php 
        if( !function_exists('dynamic_sidebar') || !dynamic_sidebar()) :?>
        <?php 
        endif;
        ?>

        <div class="side-bar">
	        <div class="side-bar-content">
        	<div class="item">
                <div class="item-title">
                    <span class="title">Stay updated</span>
                </div><!--end .title-item-->
	            <form action="/">
	            	<label for="subscribe">Subscribe via email</label>
	            	<p><input type="text" name="subscribe"></p>
	            	<ul class="inline">
	            		<li><a href="#">RSS  | </a></li>
	            		<li><a href="#">Twitter  | </a></li>
	            		<li><a href="#">Google+  | </a></li>
	            		<li><a href="#">Facebook</a></li>
	            	</ul>
	            </form>    
			</div>
			</div>
		</div>

		<div class="side-bar">
	        <div class="side-bar-content">
        	<div class="item">
                <div class="item-title">
                    <span class="title">Project</span>
                </div><!--end .title-item-->
	          	<ul>
            	<?php
				$randPosts = new WP_query();
				$randPosts->query("showposts=1&&orderby=rand&&cat=3");
				if($randPosts->have_posts()): while($randPosts->have_posts()) : $randPosts->the_post();?>
                <li class="item">
                	<?php if ( has_post_thumbnail()) : ?>
					   <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
					   <?php the_post_thumbnail(array(178,134)); ?>
					   </a>
					 <?php endif; ?>
					 <span class="blog-item-shadow"></span>
                </li>
                <?php endwhile;endif;?>
            </ul>    
			</div>
			</div>
		</div>
    </div>
        