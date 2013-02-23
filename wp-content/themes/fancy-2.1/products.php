<?php
/* 
Template Name: Products
*/
?>
<?php get_header(); ?>
<div class="wrapper-content" style="margin: 0">
    <h2 class="product-content-title">Portfolio</h2>

<div class="wrapper-gallery">
    <ul class="menu-gallery">
        <li class="gallery-current"><a href="#" rel="All">All</a></li>
        <?php
        $children = get_categories("title_li=&echo=0&depth=-1&child_of=3&orderby=id");

        foreach($children as $category) { 
        	echo '<li><a href="#" rel="'.$category->cat_name . '">'.$category->cat_name . '</a></li>'; 
        }  
        ?>
    </ul><!--end .menu-gallery-->
    
    <ul class="gallery-item">
        <?php 
        $products = new WP_query();
		$params=array(
			'cat' => '3');		
		$counter = 1;
        $products->query($params);
        if($products->have_posts()) : while($products->have_posts()) : $products->the_post();?>
        <li 

        <?php if($counter%4 == 0){ 
        	// echo 'class="last-item"';
        }

        if (($counter-1)%4 == 0) {
        	// echo 'class="first-item"';
        }?> 

        rel="<?php 
				foreach((get_the_category()) as $category) {
					if ($category->category_parent != 0) {
						echo  $category->name;
					}
				}
			?>">
            <a href="<?php echo the_permalink(); ?>">
                <div class="gallery-item-shadow"></div>

                <?php
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                        // the_post_thumbnail(array(200, 150));
                        thumb_img($post->ID,'200','150','100',get_the_title());
                        // 
                    }
                    else {
                        thumb_img($post->ID,'200','150','100',get_the_title());
                    }
                ?>  
				<p><?php the_title(); ?></p> 
				    
            </a>
        </li>
        	<?php $counter++;?>
            <?php endwhile;?>
            <?php else : ?>
                <p>sorry, no post to display</p>
        <?php endif; ?>
    </ul><!--end .gallery-item-->
</div><!--end .wrapper-gallery-->
<?php get_footer(); ?>