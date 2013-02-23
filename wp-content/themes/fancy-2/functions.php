<?php
	ob_start();
	add_theme_support('post-thumbnails'); //Dể dùng được thumnali, hổ trợ từ wp 2.9 trở lên
	
	function get_featured_img($post_id){
		$img_id = get_post_thumbnail_id($post_id); // lấy id của hình
		$images=wp_get_attachment_image_src( $img_id, false, false ); // lấy link hình featured
		return $images[0]; // 0: link hình ; 1: width ; 2: height
	}
	
	//Dùng hàm này để burn ra thẻ img thumbnail với các tham số truyền vào
	function thumb_img($post_id,$h,$w,$q,$alt){
		echo '<img align="middle" src="';
		echo bloginfo('template_url');
		echo '/timthumb.php?src='.get_featured_img($post_id).'&amp;h='.$h.'&amp;w='.$w.'&amp;q='.$q.'" alt="'.$alt.'" />';
	}
?>


<?php 
	//Hàm dùng dể rename file khi upload
	function fd_modify_uploaded_file_names($image_name) {

            $image_name['name'] =  'www.fancydesign.vn-' . $image_name['name'];

    return $image_name;

	}
	add_filter('wp_handle_upload_prefilter', 'fd_modify_uploaded_file_names', 1, 1);
?>

<?php
	if(function_exists('register_sidebar')) {
		register_sidebar(array('name' => 'sidebar',
							   'before_title' => '<div class="item">
                    <div class="item-title">
                        <span class="title">',
							   'after_title'  => '</span>
                    </div><!--end .title-item-->',
							   'before_widget' => '<div class="side-bar">
    	<div class="side-bar-inner-shadow"></div>
        <div class="side-bar-content">',
							   'after_widget'  => '</div></div></div><!--end .side-bar-content-->',
							   'before_content' => '<span class="item-name">',
							   'after_content' => '</span>',
		));
	};
?>

<?php 
if ( ! function_exists( 'fancy_comment' ) ) :
	function fancy_comment($comment, $args, $depth){
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<div id="comment-<?php comment_ID(); ?>" class="clearfix">
				<div class="comment-author-vcard">
					<div class="avatar-shadow"></div>
					<?php echo get_avatar($comment, $size="100") ?>
			   </div>
			   <div class="commentBody">
					<div class="comment-content">
						<h3 class="comment-author"><strong><?php printf(__('%s'), get_comment_author() ); ?></strong> | <?php echo comment_date('l, F jS, Y g:i a');?></h3>
						<p class="comment-text"><?php comment_text(); ?></p>
						<p class="reply">
							<?php edit_comment_link(__('(Edit)',' ','')); ?>
							<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args[max_depth]))) ?>
						</p>
						<div class="waiting-approve">
							<?php if($comment->comment_approved == '0') : ?>
							<em><?php echo "Bình luận của bạn đang được duyệt"; ?></em>
							<?php endif; ?>
						</div>
					</div>
			   </div>
	<?php
	}
endif;
?>