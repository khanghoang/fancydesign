<?php
/*
	Plugin Name: Extract link
  	Plugin URI:
  	Description: Extract link
  	Version: 1.0
 	Author: Triệu Khang
  	Author URI: http://trieukhang.com/
*/


function my_scripts_method() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_option('siteurl') . '/wp-content/plugins/'.'extract-link/js.js');
    wp_enqueue_script( 'jquery' );
}    
 
add_action('wp_enqueue_scripts', 'my_scripts_method');  

function nii_extract_url(){
	
	$url = plugins_url(plugin_basename(dirname(__FILE__))) .'/';

	$t = '
		<div style="margin:50px; padding:10px; width:460px">
	<script type="text/javascript">
		 $(document).ready(function()
		{
		
		$("#contentbox").keyup(function()
		{
		var content=$(this).val();
		var urlRegex = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
		
		var url= content.match(urlRegex);
		
		
		if(url.length>0)
		{
		
		$("#linkbox").slideDown("show");
		$("#linkbox").html("<img />");
		$.get("'.$url.'urlget.php?url="+url,function(response)
		{
		var title=(/<title>(.*?)<\/title>/m).exec(response)[1];
		var logo=(/src="(.*?)"/m).exec(response)[1];
		
		
		$("#linkbox").html("<div><b>"+title+"</b><br/>"+url)
		
		});
		
		}
		return false();
		});
		
		});
		</script>
		<style>
		body
		{
		font-family:Arial, Helvetica, sans-serif;
		font-size:12px;
		}
		#contentbox
		{
		width:458px; height:50px;
		border:solid 2px #dedede;
		font-family:Arial, Helvetica, sans-serif;
		font-size:14px;
		margin-bottom:6px;
		}
		.img
		{
		float:left; width:150px; margin-right:10px;
		text-align:center;
		}
		#linkbox
		{
		border:solid 2px #dedede; min-height:50px; padding:15px;
		display:none;
		}
		</style>
    <div style="height:25px">
    <div style="float:left"><b>Facebook Box</b><br />Eg: 9lessons programmin blog http://www.9lessons.info</div>
    </div>
    <textarea id="contentbox"></textarea>
    <div id="linkbox">
</div>
	';
	return $t;
}
?>