<?php

/**
 * flickrScriptMain 
 *
 * Retrieve a set of images from flickr and cache them locally. 
 *
 * 
 * @access public
 * @returns boolean true = successful, false = some error occured
 */

function flickrScriptMain()
{
	require_once dirname( __FILE__ ) . '/flickrInclude.php';
	require_once dirname( __FILE__ ) . '/../../../wp-config.php';

	$strApiKeyValue = get_option( FLICKR_API_KEY );
	$strUserIdValue = get_option( FLICKR_USER_ID );
	$strFileLocation = get_option( FLICKR_FILE_LOCATION );
	$strSizeChoice = get_option( FLICKR_SIZE_CHOICE );

	// start: check that all returned values have been set

	if ( !isset( $strApiKeyValue, $strUserIdValue ) )
	{
		echo 'Key values have not been set. 
			  Please visit the admin control pannel and enter the required values.';

		return false;
	}

	$arrParamsGetPhotoCount = array(
		'api_key'	=> $strApiKeyValue,
		'method'	=> 'flickr.people.getInfo',
		'user_id'	=> $strUserIdValue,
		'format'	=> 'php_serial',
	);

	$arrRspObjGetPhotoCount = getResponseObject( $arrParamsGetPhotoCount );
	
	if ( !is_array( $arrRspObjGetPhotoCount ) || empty( $arrRspObjGetPhotoCount['stat'] ) || 
         'ok'!=$arrRspObjGetPhotoCount['stat'] )
	{
		echo 'Oops, there seems to be a fault with the Flickr site';
		return false;
	}

	// start: determine how many public photos are available

	$intTotalNumPublicPhotos =0;
	
	if ( isset( $arrRspObjGetPhotoCount['person']['photos']['count']['_content'] ) )
	{
		$intTotalNumPublicPhotos = $arrRspObjGetPhotoCount['person']['photos']['count']['_content'];
	}
	
	if ( $intTotalNumPublicPhotos < 1 )
	{
		echo 'Oops, there seems to be no Flickr photos in your account.';
		return false;
	}

	// end: determine how many public photos are available

	// start: get all public photo general information to supply photo id's

	$arrParamsGetPublicPhotos = array(
		'api_key'	=> $strApiKeyValue,
		'method'	=> 'flickr.people.getPublicPhotos',
		'user_id'	=> $strUserIdValue,
		'format'	=> 'php_serial',
		'per_page'  => $intTotalNumPublicPhotos,
	);
	
	$arrRspObjGetPublicPhotos = getResponseObject( $arrParamsGetPublicPhotos );
	
	// end: get all public photo general information to supply photo id's
	
	$arrAllPhotoIds = array();

	if ( empty( $arrRspObjGetPublicPhotos['stat'] ) || 'ok' != $arrRspObjGetPublicPhotos['stat'] )
	{
		echo 'Oops, there seems to be a problem accessing the Flickr photos.';
		return false;
	}

	foreach ( $arrRspObjGetPublicPhotos['photos']['photo'] as $value )
	{
		array_push( $arrAllPhotoIds, $value['id'] );
	}

	$arrPhotoInfo = array();

	$bolWriteToFile = true;
	foreach ( $arrAllPhotoIds as $value )
	{
		// start: get all public photo specfic information to supply location urls and photo titles
		
		$arrParamsGetInfo = array(

			'api_key'  => $strApiKeyValue,
			'method'   => 'flickr.photos.getInfo',
			'photo_id' =>  $value,
			'format'   => 'php_serial',

		);

		// start: get all public photo size information to supply thumbnail details

		$arrParamsGetSize = array(

			'api_key'  => $strApiKeyValue,
			'method'   => 'flickr.photos.getSizes',
			'photo_id' => $value,
			'format'   => 'php_serial',

		);

		$arrRspObjGetInfo = getResponseObject( $arrParamsGetInfo );

		if ( empty( $arrRspObjGetInfo['stat'] ) || 'ok' != $arrRspObjGetInfo['stat'] )
		{
			$bolWriteToFile = false;
			echo 'Oops, there seems to be a problem accessing the Flickr information.';
			continue;
		}

		foreach( $arrRspObjGetInfo['photo']['urls']['url'] as $value )
		{
			$strUrl = $value['_content'];
		}
		
		$strTitle = $arrRspObjGetInfo['photo']['title']['_content'];
			
		// end: get all public photo specfic information to supply location urls and photo titles

		$arrRspObjGetSize = getResponseObject( $arrParamsGetSize );

		if ( empty( $arrRspObjGetSize['stat'] ) || 'ok' != $arrRspObjGetSize['stat'] )
		{
			$bolWriteToFile = false;
			echo 'Oops, there seems to be a problem accessing the Flickr photo details.';
			continue;
		}

		foreach ( $arrRspObjGetSize['sizes']['size'] as $value )
		{
			if ( $value['label'] == $strSizeChoice )
			{
				$strImageSrc = $value['source'];
				$strWidth = $value['width'];
				$strHeight = $value['height'];
				break;	
			}

		}

		// end: get all public photo size information to supply thumbnail details


		// start: construct an array with all the desired data 

		$arrPhotoInfo[] = array( 'strUrl'      => $strUrl, 
			                     'strImageSrc' => $strImageSrc, 
			                     'strTitle'    => $strTitle, 
			                   );

		// end: construct an array with all the desired data 

	} // end: foreach ( $arrAllPhotoIds as $value )
	
	if ( !$bolWriteToFile )
	{
		return false;
	}
	// start: write collected data to the Wordpress database

	update_option( FLICKR_USER_DATA, $arrPhotoInfo );

	// end: write collected data to the Wordpress database

	return true;
	
} // end: MAIN FUNCTION
?>