<?php
/* 
Template Name: Homepage
*/
?>



<?php get_header(); ?>

        <div class="rightbar">
            <div class="slider-wrapper theme-default">
                <?php if (function_exists('nivoslider4wp_show')) { nivoslider4wp_show(); } ?>
                <div class="home-slider-shadow"></div>
            </div>
        </div>
<?php get_footer(); ?>
