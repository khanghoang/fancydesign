<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.  The actual display of comments is
 * handled by a callback to twentyten_comment which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
?>

			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'twentyten' ); ?></p>
			</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>
			<h3 id="comments-title"><?php 
			printf( _n( '1 bình luận cho %2$s', '%1$s: (%2$s Bình Luận)', get_comments_number(), 'twentyten' ),
			get_the_title(), number_format_i18n( get_comments_number() ));
			?></h3>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'twentyten' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
			</div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

			<ol class="commentlist">
				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use twentyten_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define twentyten_comment() and that will be used instead.
					 * See twentyten_comment() in twentyten/functions.php for more.
					 */
					wp_list_comments( array( 'type'=>'comment','callback' => 'fancy_comment' ) );
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments', 'twentyten' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'twentyten' ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'twentyten' ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php 
/* ----------------------------------------------- COMMENT FORM ----------------------------------------------*/
?>
<?php if ('open' == $post->comment_status) : ?>

<div id="respond">

<h3><?php comment_form_title( 'Viết bình luận', 'Trả lời cho %s' ); ?></h3>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link('(ấn vào đây để hủy trả lời)'); ?></small>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

<form class="clearfix" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>
<p class="logged">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>
<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">&nbsp;&nbsp;&nbsp;(Log out)</a></p>
<?php else : ?>

<h3 id="star">(*) thông tin bắt buộc</h3>

<div class="left-comment">

<p><input type="text" name="author" id="author" value="<?php if ($req) echo "Vui lòng nhập tên (*)"; ?>" size="22" tabindex="1" />
</p>

<p><input type="text" name="email" id="email" value="<?php if ($req) echo "Địa chỉ mail (*)"; ?>" size="22" tabindex="2" />
</p>

<p><input type="text" name="url" id="url" value="Website" size="22" tabindex="3" /></p>

<p class="submit-comment"><input name="submit" type="submit" id="submit" tabindex="5" value="Gửi bình luận" /></p>

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

</div>

<p id="textarea"><textarea name="comment" id="comment" cols="34" rows="10" tabindex="4"></textarea></p>


<?php if ( $user_ID ) : ?>
<p id="admin-submit"><input name="submit" type="submit" id="submit" tabindex="5" value="Gửi bình luận" /></p>
<?php endif ?>


<?php comment_id_fields(); ?>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>
</div>
<?php endif; // if you delete this the sky will fall on your head ?>



</div><!-- #comments -->

