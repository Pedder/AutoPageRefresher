<?php
/*	
 *	Auto Page Refresher
 *	
 *	Copyright (c) 2013 Peter Poetsch
 *	www.b-content.com
 *
 *	Dual licensed under the MIT and GPL licenses.
 *	http://en.wikipedia.org/wiki/MIT_License
 *	http://en.wikipedia.org/wiki/GNU_General_Public_License
 */


$url = 'http://pedder.de'; // please change the URL you




if(isset($_GET['check'])){
	//just send the current save date
	header('Last-Modified: '.gmdate('D, d M Y H:i:s', getlastmod()).' GMT');
	exit; 
}
	// check URL if available
 	$urldata = parse_url($url);
	$domain = $urldata['host'];
	$ip =  gethostbyname($domain);
	if($ip==$domain){
		echo '<h1>Domain "'.$domain.'" does not exits.</h1><p>URL could not be parse '.$ip.'</p>';
		exit;	
	}
	// get the content
	$c =  file_get_contents($url);


    $thispage = parse_url($_SERVER['SCRIPT_URI']);

	$cc = '<script src="'.$thispage['scheme'].'://'.$thispage['host'].
		substr($thispage['path'],0,strrpos($thispage['path'],'/')).'/page.js"></script>';

	//insert 
	$c = str_replace('<head>', '<head><base href="'.$url.'">'.$cc, $c);

	// print the result page
	echo $c;


?>