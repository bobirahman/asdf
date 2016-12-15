<?php
date_default_timezone_set('Asia/Jakarta');
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

header("Content-Type: text/plain");
echo "User-Agent: *\n";
echo "Allow: /\n";
echo "Sitemap: http://".$_SERVER['SERVER_NAME']."/sitemaps.xml";
?>