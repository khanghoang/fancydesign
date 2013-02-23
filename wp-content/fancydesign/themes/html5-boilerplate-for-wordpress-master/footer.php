    <div class="footer-wapper">
      <div class="footer-title">
        <ul>
          <li>ABOUT</li>
          <li>BLOG</li>
          <li>CONTACT</li>
        </ul>
      </div><!--end .footer-title-->   
        
        <div class="footer-content">
          <ul>
            <li>
              <p>
                <?php                
                $about_me_id= 216;
                $about_me = get_post( $about_me_id, OBJECT );
                echo $about_me->post_content;
                wp_reset_query();
                
                ?>
              </p>
            </li>
            <li class="blog">
                  <ul>
                  <?php 
                    query_posts('meta_key=post_views_count&orderby=meta_value_num&posts_per_page=5');
                    //If there are posts. checks to see if the current query has any results to loop over.
                    if (have_posts()) :
                        //loop through the posts and list each until done.
                        while (have_posts()) :
                            //Iterate the post index in The Loop.
                            the_post();
                            ?>
                            <li><a href="<?php the_permalink() ?>" title="Permanent Link to: <?php the_title_attribute(); ?>"><?php the_title(); ?></a> <?php echo '(' . get_PostViews(get_the_ID()) .')'; ?></li>
                    <?php
                        endwhile;
                    endif;
                    //Destroy the previous query. This is a MUST.
                    wp_reset_query();
                    ?>
                    </ul>
                </li>
              <li class="contact">
                <ul class="info-ct">
                  <li class="name"><p>Tùng Lâm</p></li>
                  <li class="mobile"><p>(+84) 9.34.09.19.89</p></li>            
                  <li class="email">
                    <a href="mailto:tunglam.tvtl@gmail.com" title="Gửi email cho tôi">tunglam.tvtl@gmail.com</a>
                  </li>
                </ul>
              </li>
            </ul>
        </div><!--end .footer-content-->
              
        <div class="footer">
          <div class="info-footer">
              <p>&copy <a href="<?php echo(get_page_link(get_page_by_title('Home')->ID)) ?> ">fancydesign.vn</a> <span>made by fancydesign</span></p>
                <ul id="menu-footer">
          <?php 
                        $my_pages = wp_list_pages('echo=0&title_li=&exclude_tree=216');
                        $var1 = '<a';
                        $var2 = '&nbsp;|&nbsp;<a';
                        $my_pages = str_replace($var1, $var2, $my_pages);
                        echo $my_pages;
                    ?>
              </ul>
            </div>
          <p id="back-to-top">Top</p>
        </div><!--end .footer-->  
        
    </div><!--end .footer-wapper-->
</div>

<div style="display:none">
    <div id="fancy_search">
        <span class="close"></span>

        <form action="<?php bloginfo('url');?>">
            <input type="text" name="s">
            <input type="submit" value="Search"/>
        </form>

        <div class="fancy-search-result">
            
        </div>
    </div>
</div>

 <!-- Javascript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery. fall back to local if necessary -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="<?php echo $GLOBALS["TEMPLATE_RELATIVE_URL"] ?>js/vendor/jquery-1.8.0.min.js"><\/script>')</script>


  <?php versioned_javascript($GLOBALS["TEMPLATE_RELATIVE_URL"]."html5-boilerplate/js/plugins.js") ?>
  <?php versioned_javascript($GLOBALS["TEMPLATE_RELATIVE_URL"]."html5-boilerplate/js/main.js") ?>
  <?php versioned_javascript($GLOBALS["TEMPLATE_RELATIVE_URL"]."js/jcarousellite_1.0.1.min.js") ?>
  <?php versioned_javascript($GLOBALS["TEMPLATE_RELATIVE_URL"]."js/jquery.easing.1.1.js") ?>
  <?php versioned_javascript($GLOBALS["TEMPLATE_RELATIVE_URL"]."js/jquery.fancybox/jquery.fancybox.pack.js") ?>
  
  <?php if ( is_singular() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );?>
    
  <script type="text/javascript">
    jQuery(document).ready(function($) {
      $("#products").jCarouselLite({
        vertical : true,
        visible : 3,
        auto : 3000,
        speed : 1000,
        circular : true
      });
          
      $(".more-products-content").jCarouselLite({
        visible : 4,
        auto : 3000,
        speed : 1000,
        circular : true
      });
    });
  </script>


  <!-- asynchronous google analytics: mathiasbynens.be/notes/async-analytics-snippet
       change the UA-XXXXX-X to be your site's ID -->
  <!-- WordPress.com does not allow Google Analytics code to be built into themes they host. 
       Add this section from HTML Boilerplate manually (html5-boilerplate/index.html), or use a Google Analytics WordPress Plugin-->
       
  <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
  <script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-XXXXX-X']);
    _gaq.push(['_trackPageview']);

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

  </script>
               
  <?php wp_footer(); ?>

</body>
</html>