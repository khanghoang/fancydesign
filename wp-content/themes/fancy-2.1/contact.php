<?php 
/*
	Template Name: Contact
*/
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
        <div class="main-content">
        <div class="post <?php if(is_page()) echo 'is-page'; ?>">
            <div class="post-content">
                <div class="content contact-info">
                    <h3 class="content-title">Liên hệ</h3>
				</div>
				
					<div id="contact-title">
						<h3>Nếu bạn cần một thiết kế hay góp ý xin vui lòng liên hệ theo mẫu email bên dưới</h3>
						<h3 id="star">(*) thông tin bắt buộc và chính xác</h3>
					</div>			

					
                    
				<div id="contact-respond">
					<form action="<?php bloginfo("stylesheet_directory"); ?>/send_mail.php" id="commentform">						

					<div class="left-comment">

					<p><input type="text" name="author" id="author" value="Vui lòng nhập tên (*)" size="22" tabindex="1">
					</p>

					<p><input type="text" name="email" id="email" value="Địa chỉ mail (*)" size="22" tabindex="2">
					</p>

					<p><input type="text" name="title" id="title" value="Chủ đề" size="22" tabindex="3"></p>
					
					<p id="textarea"><textarea name="comment" id="comment" cols="34" rows="10" tabindex="4"></textarea></p>

					<p class="submit-comment"><input name="submit" type="submit" id="submit" tabindex="5" value="Gửi email"/></p>


					</div>

					</form>

				</div>
				<ul class="info-ct">
                   		<li class="name">
                            <p id="abc">Tùng Lâm</p>
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
				<div id="result"></div>
            </div>
        </div>
</div>
<?php get_footer(); ?>