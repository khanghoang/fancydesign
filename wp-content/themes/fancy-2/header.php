<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>charset=<?php bloginfo('charset'); ?>" />
<meta name="distribution" content="global" />
<meta name="geo.position" content="10.475602; 106.403980" />
<meta name="geo.posion" content="VN-Hanoi" />
<meta name="robots" content="index, follow" />
<?php
$post_obj = $wp_query->get_queried_object();
/*var_dump($post_obj);*/
/*$the_id = $GLOBALS['post']->ID;*/
$the_id = $post_obj->ID;
$post = get_post($the_id, OBJECT);
$keywords = get_post_meta($the_id, 'keywords', true);
$description = get_post_meta($the_id, 'description', true);
$title = get_post_meta($the_id, 'title', true);
?>
<title>

<?php
if($title){
 echo $title;
}
else{
 echo $post->post_title." | FancyDesign";
}
?>
</title>
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
<link rel="icon" href="<?php echo bloginfo('stylesheet_directory'); ?>/images/logo-title.png" type="image/png" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />

<meta name="description" content="<?php
if($description){
 echo $description;
}
else{
 echo 'Defauft';
}
?>">

<meta name="keywords" content="
<?php
if($keywords){
 echo $keywords;
}
else{
 echo 'Defauft';
}
?>">

<script type="text/javascript" src="<?php echo bloginfo('stylesheet_directory'); ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo bloginfo('stylesheet_directory'); ?>/js/jcarousellite_1.0.1.min.js"></script>
<script type="text/javascript" src="<?php echo bloginfo('stylesheet_directory'); ?>/js/jquery.easing.1.1.js"></script>
<script type="text/javascript" src="<?php echo bloginfo('stylesheet_directory'); ?>/js/jquery.SocialCounter.js"></script>
<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>
<!-- ************************* jQuery xem hình trang single ************************* -->
<!-- FancyBox CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo bloginfo('stylesheet_directory'); ?>/js/jquery.fancybox/jquery.fancybox.css" media="screen" />
<!-- Fancybox plugin -->
<script type="text/javascript" src="<?php echo bloginfo('stylesheet_directory'); ?>/js/jquery.fancybox/jquery.fancybox.pack.js"></script>
<!-- ************************* end jQuery xem hình trang single ************************* -->


<?php wp_enqueue_script("jquery"); ?>

<script type="text/javascript">
	$(function() {
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

</head>

<body>
<div class="wrapper clearfix">
	<div class="header">
    	<div class="logo">
			<a href="<?php echo(get_page_link(get_page_by_title('Home')->ID)) ?> ">
				<img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/logo.png" />
			</a>
        </div>
        <div class="menu">
            <ul>
                <?php 
                    $my_pages = wp_list_pages('echo=0&title_li=&exclude_tree=218&exclude_tree=216');
                    $var1 = '<a';
                    $var2 = '<span><a';
                    $var3 = '</a';
                    $var4 = '</a></span';
                    $my_pages = str_replace($var1, $var2, $my_pages);
                    $my_pages = str_replace($var3, $var4, $my_pages);
                    echo $my_pages;
                ?>
            </ul>
			
			<div class="social-counter">
				<ul>
					<li>
						<a href="https://plus.google.com/u/0/109515217848822081926/posts" title="Thêm tôi trong Google+" target="_blank">
							<img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/icon-google.png" />
						</a>
					</li>
					<li>
						<a href="https://twitter.com/#!/wmic75" title="Thêm tôi trong Twitter" target="_blank">
							<img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/icon-twitter.png" />
						</a>
					</li>
					<li>
						<a href="http://www.facebook.com/tunglam.tvtl" title="Thêm tôi trong Facebook" target="_blank">
							<img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/icon-facebook.png" />
						</a>
					</li>
					<li>
						<a href="<?php bloginfo('atom_url'); ?>" title="Xem RSS" target="_blank">
							<img src="<?php echo bloginfo('stylesheet_directory'); ?>/images/icon-rss.png" />
						</a>
					</li>
					
					<li>
						<?php get_search_form(); ?>
					</li>
				</ul>
			</div>
        </div>
    </div>
   