<?php
if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE'])){
		header('HTTP/1.1 304 Not Modified');
        die();
	}
?>	