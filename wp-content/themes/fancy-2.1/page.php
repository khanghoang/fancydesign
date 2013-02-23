<?php get_header(); ?>
<?php get_sidebar(); ?>
<div class="main-content">
<?php 
    if(have_posts()) : while(have_posts()) : the_post(); 
		wp_reset_query();
        ?>
        <div class="post <?php if(is_page()) echo 'is-page'; ?>">
            <div class="post-content">
                <div class="content">
                    <div class="the-content">
                    <h3 class="content-title"><?php the_title(); ?></h3>
                    <p><?php the_content(""); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile;?>
        <?php else : ?>
            <div class="post">
                <div class="post-content" style="margin-left:20px;">
                     <h3><a href="#" style="font-size:16px;">Không tìm thấy kết quả phù hợp</a></h3>
                </div>
            </div>
    <?php endif; ?>
</div>
<?php get_footer(); ?>