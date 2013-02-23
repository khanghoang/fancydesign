jQuery(document).ready(function($) {

	// fancy search
	$('#main_search_form').on('submit', function (e) {
		e.preventDefault();
		
		var value = $(this).find('input[name=s]').val();

		$.fancybox.open($('#fancy_search'), {
			padding: 0,
			autoSize: false,
			width: 600,
			height: 600
		});

		console.log(value);

		$('#fancy_search form input[name=s]').val(value);

		$('#fancy_search form').on('submit', function (e) {
			e.preventDefault();

			$this = $(this);
			var query = $this.children('input[name=s]').val();

			console.log(query);
			$.get($this.attr('action'), {s:query}, function(data){
				console.log(data);

				$this.next('.fancy-search-result').html(data);
			});
		});

	});	


	//function cho phần comment
	$("#author").focus(function() {
		if( $(this).val() == "Vui lòng nhập tên (*)" )
			$(this).val("");
	});
	$("#email").focus(function() {
		if( $(this).val() == "Địa chỉ mail (*)" )
			$(this).val("");
	});
	$("#url").focus(function() {
		if( $(this).val() == "Website" )
			$(this).val("");
	});
	$("#title").focus(function() {
		if( $(this).val() == "Chủ đề" )
			$(this).val("");
	});
	$("input").blur(function(){
		var $this = $(this);
		if( $this.val() == "" ) {
			if( $this.is("input[name='author']"))
				$this.val("Vui lòng nhập tên (*)");
			if( $this.is("input[name='email']"))
				$this.val("Địa chỉ mail (*)");
			if( $this.is("input[name='url']"))
				$this.val("Website");
				if( $this.is("input[name='title']"))
				$this.val("Chủ đề");
		}
	});


	//jQuery cho cai filter
	var menu = $('.menu-gallery'),
		menu_item = menu.find('li'),
		gallery = $(".gallery-item");

	gallery.find('li').each(function(){
		$(this).attr("rel", $(this).attr("rel").replace(" ","")); 
	});

	var	list_item = gallery.find('li').clone(true);

	if(!gallery.find('li').is(":animated")){
			menu.find('a').click(function(e) {
				if($(this).parent('li').hasClass('gallery-current')){

					e.preventDefault();	
					return;
				}
				// reset menu
				menu_item.removeClass('gallery-current');
				// active menu đc click 
				$(this).parent('li').addClass('gallery-current');
				e.preventDefault();
				
				// empty item
				gallery.find('li').remove();

				thisItem = $(this).attr('rel').replace(" ","");
				
				if(thisItem != "All") {

					list_item.filter('li[rel='+thisItem+']').prependTo(gallery);
				} else {
					
					list_item.prependTo(gallery);
				}

				var child = gallery.children('li');
				child.find('img').hide();
				child.find('p').hide();

				child.each(function(index, elem){
					setTimeout(function() {
						$(elem).find('img').show(300);
					}, index * 150 * 0.5);
				});

				child.find('p').fadeIn('slow');
				
				// child.first().show("slow", function showNext() {
				// 	$(this).next("li").show("slow", showNext);
				// });
			
		});
	};

	gallery.find('li img').animate({'opacity' : 0.5}).hover(function() {
		$(this).animate({'opacity' : 1});
	}, function() {
		$(this).animate({'opacity' : 0.5});
	});


	//********* đăng ký jQuery fix kich co hinh trong single *********
	maxwidth = $(".content").width();
	
	$images = $(".content img");
	$images.each(function(){
		var imgwidth = $(this).width();
		
		if( imgwidth < maxwidth ) //Neu width cua hinh nho hon thi canh giua
		{
			var marginleft = (maxwidth - imgwidth) / 2;
			$(this).css('margin-left',marginleft);
		}
		else //Neu width cua hinh lon hon thi fix cho bang voi maxwidth
		{
			$(this).attr('width',maxwidth);
			$(this).attr('height','');
		}
		
		$('.content').find('img').load(function(){
			 if (this.complete){
				$(this).parent().each(function(){
					if($(this).is("a")){
						content = $(this).contents();
						$(this).replaceWith(content);
					}
				});
			 }
		});
		
	});
	
	$('#the-content').find('img').each(function(){
		alt = $(this).attr("alt");
		$(this).attr("alt", alt.replace("fancydesign.vn-", ''));
	});


	/********* Back to top *********/
	$('#back-to-top').click(function(){
		$('html, body').animate({scrollTop:0}, 500);
	});


	// contact
	// 				
	/* attach a submit handler to the form */						
  	$("#commentform").submit(function(event) {
	/* stop form from submitting normally */
	event.preventDefault(); 

	$this = $(this);
	var result = $('#result');
	
	var author = ($("input[name='author']").val()=="Vui lòng nhập tên (*)"?"":$.trim($("input[name='author']").val())),
		email  = ($("input[name='email']").val()=="Địa chỉ mail (*)"?"":$.trim($("input[name='email']").val())),
		url	   = ($("input[name='email']").val()=="Chủ đề"?"":$.trim($("input[name='title']").val())),
		comment= $.trim($("textarea#comment").val());

	if( isValidEmailAddress(email) && author != "" && comment != "" )
	{
		/* get some values from elements on the page: */
		$.post($this.attr('action'), { 'author': author,
								 'url': url,
								 'email': email,
								 'comment':comment
								  },
								 function(data) {
										result.empty().append( data );
										if(data.search("Success") > 1)
										{
											result.empty().append( "Gửi thất bại! Bạn vui lòng thử lại." );
											result.css('color','red');																	
										}
										else
										{

											$this.empty();
											result.css('margin-left',15);
											$( ".info-ct" ).css('float','left');
											$( ".info-ct" ).css('margin-left',50);
											result.empty().append( "Gửi thành công! Cảm ơn bạn, tôi sẽ cố gắng hồi âm trong thời gian gần nhất." );
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
		result.empty().append( error );
	}
  });
});

function isValidEmailAddress(emailAddress) {
	var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
	return pattern.test(emailAddress);
};