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
						wp_reset_query();
						
						$about_me_id= 216;
						$about_me = get_post( $about_me_id, OBJECT );
						echo $about_me->post_content;
						
						
						?>
                    </p>
                </li>
            	<li class="blog">
                	<ul>
                	<?php 

						// Reset Query
						wp_reset_query();

						// Lay what i do ở trong csdl ra
					
						if(function_exists("wp_get_post_by_view")){	
							try {
								$posts = wp_get_post_by_view();

								//lay thu gia tri trong posts
								//var_dump($posts);

								foreach($posts as $post){
									$p = get_post($post['post_id'], OBJECT );
									echo '<a href="'.$p->guid.'"><li>'.$p->post_title . "</li></a>";
								}
							} catch (Exception $e) {
								print_r("Không lấy được biến $posts");
							}
							
						}
					?>
                    </ul>
                </li>
            	<li class="contact">
					<ul class="info-ct">
                   		<li class="name">
                            <p>Tùng Lâm</p>
                        </li>
						<li class="mobile">
                            <p>(+84) 9.34.09.19.89</p>
                        </li>
                        <a href="mailto:tunglam.tvtl@gmail.com" title="Gửi email cho tôi">
                            <li class="email">
                                    <p>tunglam.tvtl@gmail.com</p>
                            </li>
                        </a>
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
<script type="text/javascript" src="<?php echo bloginfo('stylesheet_directory'); ?>/js/main.js"></script>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</body>
</html>