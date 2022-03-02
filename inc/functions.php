<?php
require_once 'config.php';
include_once('Language/en.php');

$global_var = new global_var(getenv('APP_ENV'),getenv('ENC_KEY'));

function genTranxRef($length)
{
$token = "";
$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
$codeAlphabet.= "0123456789";
$max = strlen($codeAlphabet);



for ($i=0; $i < $length; $i++) {
$tokens .= $codeAlphabet[rand(0, $max-1)];
}

return $tokens;
}

function getCurrentPage(){
	$current_uri = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
	return $current_uri;
}

function getCurrentPageUrl(){
	$query_string = $_SERVER['QUERY_STRING'];

	$url = SITE_URL.getCurrentPage();
	if($query_string != ""){
		$url .= "?".$query_string;
	}
	return $url;
}

function initials($str) {
    $ret = '';
    foreach (explode(' ', $str) as $word)
        $ret .= strtoupper($word[0]);
    return $ret;
}


function obfuscate_email($email)
{
    $em   = explode("@",$email);
    $name = implode('@', array_slice($em, 0, count($em)-1));
    $len  = floor(strlen($name)/2);

    return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);   
}

function curl_get($body,$url,$request,$token)
{
    try {
    $payload = json_encode($body);

    $authorization = "Authorization: Bearer ".$token; 
    //attaching encoded string 
    if($request == "post")
    {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    }elseif($request == "get")
    {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);   

    }
    // Set the content type to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json',$authorization,'Accept-Encoding: gzip,deflate,sdch'));

    // Return response instead of outputting
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the POST request
    $result = curl_exec($ch);

}
catch(Exception $e)
{
    curl_close($ch);
    login();
}
    // Close cURL resource
    curl_close($ch);
    return json_decode($result);

}

function redirect($url) {

    echo "<script language=\"JavaScript\">\n";
    echo "<!-- hide from old browser\n\n";

    echo "window.location = \"" . $url . "\";\n";

    echo "-->\n";
    echo "</script>\n";

    return true;
}

?>