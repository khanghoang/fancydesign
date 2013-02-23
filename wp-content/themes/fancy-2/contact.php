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
                    <h3 class="content-title"><a href="#">Liên hệ</a></h3>
				</div>
				
				<script type="text/javascript">
					function isValidEmailAddress(emailAddress) {
						var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
						return pattern.test(emailAddress);
					};

					$(function(){
						/* attach a submit handler to the form */
						  $("#commentform").submit(function(event) {
							/* stop form from submitting normally */
							event.preventDefault(); 
							
							var author = ($("input:[name='author']").val()=="Vui lòng nhập tên (*)"?"":$.trim($("input:[name='author']").val())),
								email  = ($("input:[name='email']").val()=="Địa chỉ mail (*)"?"":$.trim($("input:[name='email']").val())),
								url	   = ($("input:[name='email']").val()=="Chủ đề"?"":$.trim($("input:[name='title']").val())),
								comment= $.trim($("textarea#comment").val());

							if( isValidEmailAddress(email) && author != "" && comment != "" )
							{
								/* get some values from elements on the page: */
								$.post("<?php bloginfo("stylesheet_directory"); ?>/send_mail.php", { 'author': author,
														 'url': url,
														 'email': email,
														 'comment':comment
														  },
														 function(data) {
																$( "#result" ).empty().append( data );
																if(data.search("Success") > 1)
																{
																	$( "#result" ).empty().append( "Gửi thất bại! Bạn vui lòng thử lại." );
																	$( "#result" ).css('color','red');																	
																}
																else
																{

																	$("#commentform").empty();
																	$( "#result" ).css('margin-left',15);
																	$( ".info-ct" ).css('float','left');
																	$( ".info-ct" ).css('margin-left',50);
																	$( "#result" ).empty().append( "Gửi thành công! Cảm ơn bạn, tôi sẽ cố gắng hồi âm trong thời gian gần nhất." );
																}
															 });
							}
							else{
								var error = "";
								if( author == ""){
									error = error.concat( '<br/>* Chưa nhập tên.');
								}
								if( !isValidEmailAddress(email)){
									error = error.concat( '<br/>* Email không hợp lệ.');
								}
								if( comment == ""){
									error = error.concat( '<br/>* Email chưa có nội dung');
								}
								$( "#result" ).empty().append( error );
							}
						  });
					});
				</script>
				
					<div id="contact-title">
						<h3>Nếu bạn cần một thiết kế hay góp ý xin vui lòng liên hệ theo mẫu email bên dưới</h3>
						<h3 id="star">(*) thông tin bắt buộc và chính xác</h3>
					</div>			

					
                    
				<div id="contact-respond">
					<form action="/" id="commentform">						

					<div class="left-comment">

					<p><input type="text" name="author" id="author" value="Vui lòng nhập tên (*)" size="22" tabindex="1">
					</p>

					<p><input type="text" name="email" id="email" value="Địa chỉ mail (*)" size="22" tabindex="2">
					</p>

					<p><input type="text" name="title" id="title" value="Chủ đề" size="22" tabindex="3"></p>
					
					<p id="textarea"><textarea name="comment" id="comment" cols="34" rows="10" tabindex="4"></textarea></p>

					<p class="submit-comment"><button name="submit" type="submit" id="submit" tabindex="5">Gửi email</button></p>


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