<?php 

include 'qrcode/qrlib.php';
$text="";
if(!empty($_GET)){
	foreach ($_GET as $key => $value) {
		$text.="\n".ucwords(str_replace("_"," ",$key)).": ".$value;
	}
}else
$text.="NO_DATA";
// $text = "Course Name :- ".(isset($_GET['c_title'])?$_GET['c_title']:'').''."\nCandidate Name :- ".(isset($_GET['name'])?$_GET['name']:'').' '."\nCertificate No. :- ".(isset($_GET['cno'])?$_GET['cno']:'');
QRcode::png($text);
// echo "<center><img src='".$file."'></center>";
?>