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
            <!--<a href="#" rel="All"><li>All</li></a>
            <a href="#" rel="Brand"><li>Brand</li></a>
            <a href="#" rel="Logo"><li>Logo</li></a>
            <a href="#" rel="Print"><li>Print</li></a>-->
        
    </ul><!--end .menu-gallery-->
    
    <ul class="gallery-item">
        <?php 
        $products = new WP_query();
		/*$params=array(
			'cat' => '16',
			'post_type' => 'post',
			'meta_key'=>'index',
			'orderby' => 'meta_value',
            'order' => 'ASC'
		);
		*/
		
		/*$params=array(
			'cat' => '16',
			'post_type' => 'post',
			
			'order'=>'ASC',
			
			'meta_key'=>'index',
			'meta_key' => 'index',
			'meta_value' => 0,
			'meta_compare' => '>=',
			'type' => 'NUMERIC'
		);*/
		$params=array(
			'cat' => '3');
		
		$counter = 1;
        $products->query($params);
        if($products->have_posts()) : while($products->have_posts()) : $products->the_post();
        ?>
        <li 

        <?php if($counter%4 == 0){ 
        	echo 'class="last-item"';
        }

        if (($counter-1)%4 == 0) {
        	echo 'class="first-item"';
        }?> 

        rel="<?php 
						foreach((get_the_category()) as $category) {
							if ($category->category_parent != 0) {
								echo  $category->name;
							}
						}
					?>">
            <a href="<?php echo the_permalink(); ?>">
                <?php
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                        thumb_img($post->ID,'150','200','100',get_the_title());
                    }
                    else {?>
                    <img class="item-thumbs" src="<?php echo bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo bloginfo('stylesheet_directory'); ?>/images/no-thumbnail.png&h=150&w=200&zc=1&q=100" alt=""/>
                <?php } ?>  
				<p><?php the_title(); ?></p> 
				    
            </a>
            <div class="gallery-item-shadow"></div>
        </li>
        	<?php $counter++;?>
            <?php endwhile;?>
            <?php else : ?>
                <p>sorry, no post to display</p>
        <?php endif; ?>
    </ul><!--end .gallery-item-->
</div><!--end .wrapper-gallery-->
<?php get_footer(); ?>