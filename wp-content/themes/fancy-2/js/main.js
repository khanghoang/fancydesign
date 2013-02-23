// JavaScript Document

//function cho phan chay sidebar
$(document).ready(function(){

	var sidebar = $(".side-bar-wrapper");
	var footerHeight = $(".footer-wapper").height();
	var headerHeight = $('.header').height() + 60; // 60 px margin top
	var wrapperHeight = $('.wrapper').height();

	$(window).scroll(function(event){
		$this = $(this);
		var top = $this.scrollTop();		

		// nếu cuộn tới footer thì bỏ fix
		if(top >= wrapperHeight - footerHeight - sidebar.height() - 40) // 40 px margin
		{
			// bỏ fix & thêm margin
			sidebar.removeClass('fix');

			var margin_top = wrapperHeight - footerHeight - sidebar.height() - 200;// 200 px margin
			if(margin_top > 0 )
				sidebar.css('margin-top', margin_top);
		
		// nếu cuộn vừa hết header
		} else if(top > headerHeight){
			sidebar
				.addClass('fix')
				.css('top', 20)
				.css('margin-top', 0 );
		
		// reset
		}else{
			sidebar
				.removeClass('fix')
				.css('top', 0)
				.css('margin-top', 0 );
		}
	});


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
});

//function cho phần comment
$(function(){
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
		if( $(this).val() == "" ) {
			if( $(this).is("input[name='author']"))
				$(this).val("Vui lòng nhập tên (*)");
			if( $(this).is("input[name='email']"))
				$(this).val("Địa chỉ mail (*)");
			if( $(this).is("input[name='url']"))
				$(this).val("Website");
				if( $(this).is("input[name='title']"))
				$(this).val("Chủ đề");
		}
	});
});


//jQuery cho cai filter
$(document).ready(function() {	
	var menu = $('.menu-gallery'),
		menu_item = menu.find('li'),
		gallery = $(".gallery-item");

	gallery.find('li').each(function(){
		$(this).attr("rel", $(this).attr("rel").replace(" ","")); 
	});


	if(!gallery.find('li').is(":animated")){

			menu.find('a').click(function(e) {
				// reset menu
				menu_item.removeClass('gallery-current');
				// active menu đc click
				$(this).parent('li').addClass('gallery-current');
				e.preventDefault();
				
				// remove class
				gallery.find('li').removeClass('first-item').removeClass('last-item');

				thisItem 	= $(this).attr('rel').replace(" ","");
				if(thisItem != "All") {
					// fix lỗi hiển thị không đúng khoảng cách
					var list_item = gallery.find('li[rel='+thisItem+']');

					for (var i = 1; i <= list_item.length; i++) {
						if(i%4 == 0)
							$(list_item[i-1]).addClass('last-item');
						if((i-1)%4 == 0)
							$(list_item[i-1]).addClass('first-item');
					};
					
					// hiển thị chậm rãi :D
					list_item.show(500);

					// ẩn từ từ
					gallery.find('li[rel!='+thisItem+']')
						.hide(500);
				} else {
					var list_item = gallery.find('li');
					for (var i = 1; i <= list_item.length; i++) {
						if(i%4 == 0)
							$(list_item[i-1]).addClass('last-item');
						if((i-1)%4 == 0)
							$(list_item[i-1]).addClass('first-item');
					};
					
					// hiển thị chậm rãi
					list_item.show(500);
				}
		})
	}
	gallery.find('li img').animate({'opacity' : 0.5}).hover(function() {
		$(this).animate({'opacity' : 1});
	}, function() {
		$(this).animate({'opacity' : 0.5});
	});
});


//********* đăng ký jQuery fancybox, xem hình trang single *********

// $(document).ready(function() {
// 	$('div#the-content a').attr('rel', 'group');
// 	if($("a[rel=group]").length > 0){
// 		$("a[rel=group]").fancybox({
// 			'centerOnScroll'		:	false,
// 		});
// 	}
// });

//********* end đăng ký jQuery fancybox, xem hình trang single *********


//********* đăng ký jQuery fix kich co hinh trong single *********
$(function() {
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
	
});
//*********end đăng ký jQuery fix kich co hinh trong single *********



//********* Back to top *********
$(document).ready(function(){
	
	//$('.footer').append('<p id="back-to-top">Top</p>');
	
	$('#back-to-top').click(function(){
		$('html, body').animate({scrollTop:0}, 500);
	});
});
//********* end Back to top *********


function isValidEmailAddress(emailAddress) {
	var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
	return pattern.test(emailAddress);
};