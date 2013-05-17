<?php
/*
phpGSB - PHP Google Safe Browsing Implementation
Released under New BSD License (see LICENSE)
Copyright (c) 2010-2012, Sam Cleaver (Beaver6813, Beaver6813.com)
All rights reserved.

*/
require("phpgsb.class.php");
require("api_keys.php");

$phpgsb = new phpGSB($dbname,$dbuser,$dbpass);
$phpgsb->apikey = $google_api_key;
$phpgsb->usinglists = array('googpub-phish-shavar','goog-malware-shavar');
//Should return false (not phishing or malware)
var_dump($phpgsb->doLookup('http://www.google.com'));
//Should return true, malicious URL
var_dump($phpgsb->doLookup('http://www.gumblar.cn'));
$phpgsb->close();

?>