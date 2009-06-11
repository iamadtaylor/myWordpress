<?php
/*
PLUGIN NAME: Flickr Magazine layout
PLUGIN URI: http://www.iamadtaylor.com
DESCRIPTION: Displays your flickr stream in a magzine style layout. This is just a mash-up by myself full credit goes to Harvey Kanes article http://www.alistapart.com/articles/magazinelayout .
AUTHOR: Ad Taylor
AUTHOR URI: http://www.iamadtaylor.com
VERSION: 0.1 &beta;
*/

require_once dirname( __FILE__ ) . '/magazinelayout.class.php';

function flickrMagazineLayout($width = 725,$padding = 5,$pictureCount = 5) {
			// get pics
			$api_key = '246910ef25cd8d0ac4cc38d4031b0cfa'; // Your own API key.
			$user_id = 'adhoc01'; // Your numeric user ID.

			
			$params = array('method' => 'flickr.people.getPublicPhotos',
							'user_id' => '14506447@N03',
							'per_page' => 50);
			$photos = request($api_key,$params);


		 	//Define your template for outputting images
	 			 $template = "<img src=\"".plugins_url( 'flickrMagazineLayout/', __FILE__ )."image.php?size=[size]&file=[image]\" alt=\"\" />"; 
 		
 			 //create a new instance of the class
 			 $mag = new magazinelayout($width,$padding,$template);
			
			// Randomly select images
			$objLength =  sizeof($photos->photos->photo);
			$rarr = array();
			while ( count($rarr) < $pictureCount ) {
			    $x = mt_rand(1,$objLength);
			    if ( !in_array($x,$rarr) ) {$rarr[] = $x;}
			}
			
			$count = 0;
			foreach($photos->photos->photo as $p) {
				$count += 1;
				if (in_array($count,$rarr)) {
					//Add the images in any order
		 			 $mag->addImage(build_photo_url($p));
				}
				}
				 //display the output

 			 return $mag->getHtml();

			
	
}

function request($api_key,$params){
    $url = 'http://api.flickr.com/services/rest/?' .
           'api_key=' . $api_key ;
 
    foreach($params as $key => $val){
        $url .= '&' . urlencode($key) . '=' . urlencode($val);
    }
    $resp = simplexml_load_file($url);
    return  $resp;
}

function build_photo_url($p){
     return 'http://farm' . $p['farm'] . '.static.flickr.com/' . $p['server'] .  '/' . $p['id'] . '_' . $p['secret'] . '.jpg';
}
 



?>