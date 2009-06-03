<?php
define( 'FLICKR_API_KEY',       'flickr_api_key' );
define( 'FLICKR_USER_ID',       'flickr_user_id' );
define( 'FLICKR_DISPLAY_NUM',   'flickr_display_num' );
define( 'FLICKR_FILE_LOCATION', 'flickr_file_location' );
define( 'FLICKR_USER_DATA',     'flickr_user_data' );
define( 'FLICKR_RANDOMISE',     'flickr_randomise' );
define( 'FLICKR_SIZE_CHOICE',   'flickr_size_choice' );
define( 'FLICKR_XSS_ACTIVATED', 'flickr_xss_activated' );

function updateDataCacheLocation()
{
	//start: check for existing json cache data and transfer that to the new wordpress database location

	if ( true == file_exists( get_option( FLICKR_FILE_LOCATION ) ) && 
		 true == is_readable( get_option( FLICKR_FILE_LOCATION ).'/flickrdata.json' ) 
	   )
	{
		if ( function_exists( 'json_decode' ) )
		{
			$strFlickrData = file_get_contents( get_option( FLICKR_FILE_LOCATION ).'/flickrdata.json' );

			if ( !( empty ( $strFlickrData ) ) )
			{
				$arrFlickrAllUrls = json_decode( $strFlickrData );
				
				if ( true == is_array( $arrFlickrAllUrls ) )
				{
					$arrPhotoInfo = array();

					foreach ( $arrFlickrAllUrls as $element )
					{
						$arrPhotoInfo[] = array( 'strUrl'      => $element->strUrl, 
						                         'strImageSrc' => $element->strImageSrc,
						                         'strTitle'    => $element->strTitle 
						                       );
					}

					update_option( FLICKR_USER_DATA, $arrPhotoInfo );

					$bolSuccessful = @unlink( get_option( FLICKR_FILE_LOCATION ).'/flickrdata.json' );

					if ( true == $bolSuccessful )
					{
						delete_option( FLICKR_FILE_LOCATION );
					}
					else
					{
						update_option( FLICKR_FILE_LOCATION, '' );
					}
				}
			}
		}
	}

	//end: check for existing json cache data and transfer that to the new wordpress database location

}

function getResponseObject( $arrParams )
{
	if ( function_exists( 'curl_init' ) )
	{
		$arrEncodedParams = array();
		
		foreach ( $arrParams as $strKey => $unkValue )
		{
			$arrEncodedParams[] = urlencode( $strKey ) . '=' . urlencode( $unkValue );
		}
		
		$strUrl = 'http://api.flickr.com/services/rest/?' . implode( '&', $arrEncodedParams );
		$resCurl = curl_init( $strUrl );
		$strError = curl_error ( $resCurl );
	
		if (  "" == $strError )
		{
			curl_setopt( $resCurl, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $resCurl, CURLOPT_HEADER, false );
			curl_setopt( $resCurl, CURLOPT_CONNECTTIMEOUT, 3 );
			curl_setopt( $resCurl, CURLOPT_TIMEOUT, 600 ); 
			$unkRsp = curl_exec( $resCurl );
			
			if ( false != $unkRsp )
			{
				curl_close( $resCurl );
				$arrRspObj = unserialize( $unkRsp );
		
				return $arrRspObj;
			}
			else
			{
				echo 'Flickr Curl Function failed to execute.';
			}
		}
		else
		{
			echo 'Flickr Curl Error: '.$strError;
		}
	}
	else
	{
		echo 'Warning: The php curl library is missing. 
		      Please check you have the curl library installed.';
	}
}
?>
