<?php
// Set your cookie before redirecting to the login page
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';

setcookie("redirect","", time()-3600);
$current_page = strtolower($protocol).'://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$expire=time() + (86400 * 30);
setcookie("redirect", $current_page, $expire, "/");

?>