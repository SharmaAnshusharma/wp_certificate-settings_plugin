<?php 

include 'qrcode/qrlib.php';
$text="";
if(!empty($_GET)){
	$text = $_GET['URL']."?crno=".$_GET['txt'];
}else
$text="NO_DATA";
// $text = "Course Name :- ".(isset($_GET['c_title'])?$_GET['c_title']:'').''."\nCandidate Name :- ".(isset($_GET['name'])?$_GET['name']:'').' '."\nCertificate No. :- ".(isset($_GET['cno'])?$_GET['cno']:'');
QRcode::png($text);
// echo "<center><img src='".$file."'></center>";

 
?> 