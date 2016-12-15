<?php
date_default_timezone_set('Asia/Jakarta');

if(!isset($_GET['index_file'])){
	exit("index_file not set = 1 - 32");
}
if(empty($_GET['index_file'])){
	exit("index_file empty = 1 - 32");
}

$INDEXFILES= $_GET['index_file'] - 1;

$allfile= glob("KWKU/*.txt");

		if(empty($allfile)){
			exit("ZONK");
		}

$sfile= $allfile[$INDEXFILES];

$arraysku= array_unique(array_filter(explode("\n", file_get_contents($sfile))));

$DATES= date('c');

$html='<HTML><head><title>WELCOME TO THE BEST OF EBOOK LIBRARY</title></head><body><a href="/sitemaps.xml">Sitemaps</a><br>';

$sitemaps = '<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="/css-sitemap-single.xsl"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

foreach($arraysku as $items){
	$clean_title= preg_replace('![^a-z0-9]+!i', ' ', $items);
	$slug= trim(str_replace(' ','-', $clean_title), '-');
	
		$html .= '<a href="/Storage/'.$slug.'.pdf">'.$clean_title.'</a><br>';
		
		$sitemaps .= '<url>
			<loc>http://'.$_SERVER['SERVER_NAME'].'/Storage/'.$slug.'.pdf</loc>
			<lastmod>'.$DATES.'</lastmod>
			<changefreq>weekly</changefreq>
			<priority>1</priority>
			</url>';
}

$html .='<a href="/Storage/">View All Files</a></body></HTML>';

$sitemaps .= '</urlset>';

$ff= fopen("index.html", "w");
fwrite($ff, $html);
fclose($ff);

$ffs= fopen("sitemaps.xml", "w");
fwrite($ffs, $sitemaps);
fclose($ffs);

		//remove all file
			foreach($allfile as $files){
				if(@unlink($files)){
					echo "sukses remove ".$files."<br>";
				}
			}

?>