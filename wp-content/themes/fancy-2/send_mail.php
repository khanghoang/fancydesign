<?php

//Đây là hàm gửi mail
include_once("smtp.php");
//Test send mail

if(
	isset($_POST["author"]) &&
	isset($_POST["email"]) &&
	isset($_POST["url"]) &&
	isset($_POST["comment"])
){
	$author = $_POST["author"];
	$email = $_POST["email"];
	$url = $_POST["url"];
	$comment = $_POST["comment"];
	
	SendMail( $email , "congaquay75@gmail.com", '[Liên hệ với FancyDesign] ['.$url.']', $comment, $author);
	
	//thong bao gui mail thanh cong
	echo 'Success';
}
else{
	echo 'Fail';
}




?>