// JavaScript Document
$(document).ready(function()
	{
	
	$("#contentbox").keyup(function()
	{
	var content=$(this).val();
	var urlRegex = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
	
	var url= content.match(urlRegex);
	
	
	if(url.length>0)
	{
	
	$("#linkbox").slideDown('show');
	$("#linkbox").html("<img src='link_loader.gif'>");
	$.get("urlget.php?url="+url,function(response)
	{
	var title=(/<title>(.*?)<\/title>/m).exec(response)[1];
	var logo=(/src='(.*?)'/m).exec(response)[1];
	
	
	$("#linkbox").html("<img src='"+logo+"' class='img'/><div><b>"+title+"</b><br/>"+url)
	
	});
	
	}
	return false();
	});
	
});