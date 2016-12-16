<?php
error_reporting(0);
@ini_set('display_errors', 0);
date_default_timezone_set('Asia/Jakarta');

$allfile= glob("KWKU/*.txt");

		if(empty($allfile)){
			exit("ZONK");
		}

$sfile= $allfile[array_rand($allfile)];

$arraysku= array_unique(array_filter(explode("\n", file_get_contents($sfile))));

$html='<HTML><head><title>WELCOME TO THE BEST OF EBOOK LIBRARY</title></head><body>';

foreach($arraysku as $items){
	$clean_title= preg_replace('![^a-z0-9]+!i', ' ', $items);
	$slug= trim(str_replace(' ','-', $clean_title), '-');
	
		$html .= '<a href="/Storage/'.$slug.'.pdf">'.$clean_title.'</a><br>';
}

$html .='</body></HTML>';

echo $html;
?>
