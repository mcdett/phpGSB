<?php
/*
phpGSB - PHP Google Safe Browsing Implementation
Released under New BSD License (see LICENSE)
Copyright (c) 2010-2012, Sam Cleaver (Beaver6813, Beaver6813.com)
All rights reserved.

*/
require("phpgsb.class.php");
require("api_keys.php");

$count_to_echo = 100;
$count = 0;

$phpgsb = new phpGSB($dbname,$dbuser,$dbpass);
$phpgsb->apikey = $google_api_key;
$phpgsb->usinglists = array('googpub-phish-shavar','goog-malware-shavar');

$file = $argv[1];
$handle = fopen("$file", "r");
if(!$handle)
	{
	echo 'Could not establish a read handle to: '.$file.' or no file options was passed as option'."\n";
	exit(1);
	}

while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
	{
	$url_to_test = rtrim($data[0], ".");
	$count++;
	//echo $url_to_test."\n";
	if($phpgsb->doLookup($url_to_test))
		{
		echo "URL: ".$url_to_test." returned as malicious\n";
		} else
		{
		echo "URL: ".$url_to_test." returned as OK\n";
		}
	if($count >= $count_to_echo)
		{
		echo $count." URLs have been processed\n";
		$count = 1;
		}
	}

/*
//Should return false (not phishing or malware)
var_dump($phpgsb->doLookup('http://www.google.com'));
//Should return true, malicious URL
var_dump($phpgsb->doLookup('http://www.gumblar.cn'));
*/
$phpgsb->close();

?>