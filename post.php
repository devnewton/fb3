<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
$c = curl_init();
curl_setopt($c, CURLOPT_URL, "http://devnewton.bci.im/projects/b3/eventedit");
curl_setopt($c, CURLOPT_HEADER, false);
curl_setopt($c, CURLOPT_POST, true);
curl_setopt($c, CURLOPT_POSTFIELDS, array("csrf" => "none", "clr" => "##", "w" => "", "g" => "", "cclr" => $_SERVER["HTTP_USER_AGENT"], "submit" => "Apply These Changes", "c" => $_POST["message"]));
curl_exec($c);
curl_close($c);
?>
