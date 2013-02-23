

<?php get_header(); ?>
<?php get_sidebar(); ?>
<ul class="main-content">
    <h3 class="content-title"><?php single_cat_title(''); ?></h3>

    <?php
  
  $post_per_page = 10;
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  
  $post_counter = 0;
  if(have_posts()) : while(have_posts()) : the_post();
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
          <img width="240px" height="170px" class="item-thumbs" src="<?php echo bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php echo bloginfo('stylesheet_directory'); ?>/images/no-thumbnail.png&h=170&w=240&zc=1&q=100" alt=""/>
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
          <span>
            <strong>Share: </strong>
            <a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>">Facebook</a> | 
            <a target="_blank" href="http://twitter.com/share?text=<?php the_title();?>&url=<?php the_permalink();?>">Twitter</a> |
            <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink();?>&title=<?php the_title();?>">Likedln</a>
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
                    <?php next_posts_link('>'); ?>
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