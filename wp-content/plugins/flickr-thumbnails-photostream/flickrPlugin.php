<?php

/*
Plugin Name: Flickr Thumbnail Photostream
Plugin URI: http://community.plus.net/opensource/flickr_thumbnail_wordpress/
Description: Generates a random selection of photo thumbnails from a given Flickr account.
Version: 1.1
Author: PlusNet Plc - Developer Responsible: James Tuck (Web Development Team)
Author URI: http://community.plus.net/opensource/
Copywrite: 2008 PlusNet plc
*/

/*
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// PLEASE NOTE: This plugin requires the use of the php curl and json libraries. 
//              Please ensure you have these installed

require_once dirname( __FILE__ ) . '/flickrInclude.php';
require_once dirname( __FILE__ ) . '/flickrScript.php';

register_activation_hook( __FILE__, 'flickrPluginOnActivationTasks' );

function flickrPluginOnActivationTasks()
{
	updateDataCacheLocation();

	//start: set photo randomisation default to true

	$intRandomise = 1;

	update_option( FLICKR_RANDOMISE, $intRandomise );

	//end: set photo randomisation default to true

	//start: set the size format of the retrieved default to Square

	$strSizeChoice = 'Square';

	update_option( FLICKR_SIZE_CHOICE, $strSizeChoice );

	//end: set the size format of the retrieved default to Square

	//start: set the XSS security function to activated as default

	$intXSSActivated = 1;

	update_option( FLICKR_XSS_ACTIVATED, $intXSSActivated );

	//end: set the XSS security function to activated as default
}

// start: enable the plugin to be used as a widget within wordpress

function startWidget()
{
	if ( function_exists( 'register_sidebar_widget' ) )
	{
		function widget_flickrphotostream( $args )
		{
			$before_widget = '';
			$before_title = '';
			$after_title = '';
			$after_widget = '';

			if ( is_array( $args ) )
			{
				if ( array_key_exists( 'before_widget', $args ) )
				{
					$before_widget = $args['before_widget'];
				}
				if ( array_key_exists( 'before_title', $args ) )
				{
					$before_title = $args['before_title'];
				}
				if ( array_key_exists( 'after_title', $args ) )
				{
					$after_title = $args['after_title'];
				}
				if ( array_key_exists( 'after_widget', $args ) )
				{
					$after_widget = $args['after_widget'];
				}
			
				echo $before_widget;
				echo $before_title. 'Flickr Photostream'. $after_title;
				
				displayRandomFlickrPhotos();
				
				echo $after_widget;
			}
		}
		register_sidebar_widget( 'Flickr Photostream', 'widget_flickrphotostream' );
	}
}

// end: enable the plugin to be used as a widget within wordpress

// start: get photo details and randomise the results

function displayRandomFlickrPhotos()
{
	updateDataCacheLocation();

	// start: create regex patterns for url check

	$strUrlPattern = '!^http://www\.flickr\.com/photos/.*!S';
	$strSrcPattern = '!^http://farm\d+\.static\.flickr\.com/.*!S';

	// end: create regex patterns for url check

	$intNumOfPicsDisplayed = get_option( FLICKR_DISPLAY_NUM );

	$arrFlickrData = get_option( FLICKR_USER_DATA );

	$intRandomise = (int) get_option( FLICKR_RANDOMISE );

	$intXSSActivated = (int) get_option( FLICKR_XSS_ACTIVATED );

	if ( !( empty ( $arrFlickrData ) ) )
	{
		$unkFlickrAllUrls = $arrFlickrData;

		if ( true == is_array( $unkFlickrAllUrls ) )
		{
			$arrUsePhotoUrls = array();

			$intNumOfAllPhotos = count( $unkFlickrAllUrls ) - 1;

			if ( $intNumOfPicsDisplayed > $intNumOfAllPhotos + 1 )
			{
				$intNumOfPicsDisplayed = $intNumOfAllPhotos + 1;
			}

			for ( $intIndex = 0; $intIndex < $intNumOfPicsDisplayed; $intIndex++ )
			{
				if ( 1 == $intRandomise )
				{
					// random generator: START

					if ( $intIndex > 0 )
					{
						$bolPicRepeated = true;
	
						while ( true == $bolPicRepeated )
						{
							$bolPicRepeated = false;
	
							$intRandNum = rand( 0, $intNumOfAllPhotos );
	
							foreach ( $arrUsePhotoUrls as $element )
							{
								if ( $unkFlickrAllUrls[$intRandNum]['strUrl'] == $element[0] )
								{
									$bolPicRepeated = true;
								}
							}
						}
	
						$arrUsePhotoUrls[$intIndex][0] = $unkFlickrAllUrls[$intRandNum]['strUrl'];
						$arrUsePhotoUrls[$intIndex][1] = $unkFlickrAllUrls[$intRandNum]['strImageSrc'];
						$arrUsePhotoUrls[$intIndex][2] = $unkFlickrAllUrls[$intRandNum]['strTitle'];
						
						$arrUsePhotoUrls[$intIndex][3] = $unkFlickrAllUrls[$intRandNum]['strWidth'];
						$arrUsePhotoUrls[$intIndex][4] = $unkFlickrAllUrls[$intRandNum]['strHeight'];
						$arrUsePhotoUrls[$intIndex][5] = $unkFlickrAllUrls[$intRandNum]['strFormat'];
	
					}
					else
					{
						$intRandNum = rand( 0, $intNumOfAllPhotos );
						$arrUsePhotoUrls[$intIndex][0] = $unkFlickrAllUrls[$intRandNum]['strUrl'];
						$arrUsePhotoUrls[$intIndex][1] = $unkFlickrAllUrls[$intRandNum]['strImageSrc'];
						$arrUsePhotoUrls[$intIndex][2] = $unkFlickrAllUrls[$intRandNum]['strTitle'];

						$arrUsePhotoUrls[$intIndex][3] = $unkFlickrAllUrls[$intRandNum]['strWidth'];
						$arrUsePhotoUrls[$intIndex][4] = $unkFlickrAllUrls[$intRandNum]['strHeight'];
						$arrUsePhotoUrls[$intIndex][5] = $unkFlickrAllUrls[$intRandNum]['strFormat'];
					}

					// random generator : END
				}
				else
				{
					$arrUsePhotoUrls[$intIndex][0] = $unkFlickrAllUrls[$intIndex]['strUrl'];
					$arrUsePhotoUrls[$intIndex][1] = $unkFlickrAllUrls[$intIndex]['strImageSrc'];
					$arrUsePhotoUrls[$intIndex][2] = $unkFlickrAllUrls[$intIndex]['strTitle'];

					$arrUsePhotoUrls[$intIndex][3] = $unkFlickrAllUrls[$intRandNum]['strWidth'];
					$arrUsePhotoUrls[$intIndex][4] = $unkFlickrAllUrls[$intRandNum]['strHeight'];
					$arrUsePhotoUrls[$intIndex][5] = $unkFlickrAllUrls[$intRandNum]['strFormat'];
				}
			}

			// start: display random photo thumbnails on page


			for ( $intIndex = 0; $intIndex < $intNumOfPicsDisplayed; $intIndex++ )
			{
				if ( 0 == $intXSSActivated || ( preg_match( $strUrlPattern, $arrUsePhotoUrls[$intIndex][0] ) && 
					                            preg_match( $strSrcPattern, $arrUsePhotoUrls[$intIndex][1] ) )
				   )
				{
					echo '
						
							<a href="'.$arrUsePhotoUrls[$intIndex][0].'"><img alt="photo" src="'.$arrUsePhotoUrls[$intIndex][1].'" title="'.htmlentities($arrUsePhotoUrls[$intIndex][2]).'"/></a>
						';
				}
				else
				{
					echo '
							<div id="footerText">
								<p>One or more photos have been disabled for XSS security reasons.</p>
							</div>';
				}
			}

		}
		else
		{
			echo '
				<div id="footerText">
					<p>Oops, there seems to be a problem accessing the Flickr photos.</p>
				</div>';
		}

	}
	else
	{
		echo '
			<div id="footerText">
				<p>Oops, there seems to be a problem accessing the Flickr photos.</p>	
			</div> ';

		// end: display random photo thumbnails on page
	}
}

// start: get photo details and randomise the results


add_action( 'admin_head', 'includeCSS' );

add_action( 'admin_menu', 'flickrAddOptionPage' );

add_action( 'init', 'startWidget' );

function flickrAddOptionPage()
{
	add_submenu_page( 'plugins.php','Flickr Control', 'Flickr Control', 8, __FILE__, 'flickr_options_page' );
}

function includeCSS()
{
}

// start: setup the options page in wordpress admin

function flickr_options_page()
{
	$bolIsAnId = true;

	$bolIsAnApiKey = true;

	$strApiKeyValue = get_option( FLICKR_API_KEY );
	$strUserIdValue = get_option( FLICKR_USER_ID );
	$intNumberOfPhotosValue = get_option( FLICKR_DISPLAY_NUM );
	$intRandomise = (int) get_option( FLICKR_RANDOMISE );
	$strSizeChoice = get_option( FLICKR_SIZE_CHOICE );
	$intXSSActivated = (int) get_option( FLICKR_XSS_ACTIVATED );
	
	if ( 'post' === strtolower( $_SERVER['REQUEST_METHOD'] ) )
	{
		if ( ( isset ( $_POST[FLICKR_API_KEY] ) ) && ( isset ( $_POST[FLICKR_USER_ID] ) ) &&
		    ( isset ( $_POST[FLICKR_DISPLAY_NUM] ) ) )
		{
			// Read the posted value
			$strApiKeyValue = $_POST[FLICKR_API_KEY];
			$strUserIdValue = $_POST[FLICKR_USER_ID];
			$intNumberOfPhotosValue = $_POST[FLICKR_DISPLAY_NUM];
			$intRandomise = $_POST[FLICKR_RANDOMISE];
			$strSizeChoice = $_POST[FLICKR_SIZE_CHOICE];
			$intXSSActivated = $_POST[FLICKR_XSS_ACTIVATED];

			// start: check user inputted data is valid and correctly formatted

			$arrParamsGetPhotoCount = array(
				'api_key'	=> $strApiKeyValue,
				'method'	=> 'flickr.people.getInfo',
				'user_id'	=> $strUserIdValue,
				'format'	=> 'php_serial',
			);

			$arrRspObjGetPhotoCount = getResponseObject( $arrParamsGetPhotoCount );

			if ( $arrRspObjGetPhotoCount['stat'] == 'fail' )
			{
				// invalid user ID
				if ( $arrRspObjGetPhotoCount['code'] == '1' )
				{
					$bolIsAnId = false;
				}
				
				// invalid API Key
				if ( $arrRspObjGetPhotoCount['code'] == '100' )
				{
					$bolIsAnApiKey = false;
				}
			}

			if ( ( true == $bolIsAnId ) && ( true == $bolIsAnApiKey ) )
			{
				// Save the posted values in the database
				update_option( FLICKR_API_KEY, $strApiKeyValue );
				update_option( FLICKR_USER_ID, $strUserIdValue );
				update_option( FLICKR_DISPLAY_NUM, $intNumberOfPhotosValue );
				update_option( FLICKR_RANDOMISE, $intRandomise );
				update_option( FLICKR_SIZE_CHOICE, $strSizeChoice );
				update_option( FLICKR_XSS_ACTIVATED, $intXSSActivated );
	
				echo '<div id="message" class="updated fade"><p><strong>Options saved.</strong></p></div>';
			}
			else
			{
				echo '<div id="message" class="updated fade"><p><strong>WARNING: Please fix the highlighted issue(s).</strong></p></div>';
			}
			// end: check user inputted data is correct
		}

		// start: if hidden value has been set update photo data from the main Flickr account

		if ( isset( $_POST['hidden'] ) )
		{
			$bolScriptHasRun = flickrScriptMain();
			
			if ( true == $bolScriptHasRun )
			{
				echo '<div id="message" class="updated fade"><p><strong>Photos Updated.</strong></p></div>';
			}
			else
			{
				echo '<div id="message" class="updated fade"><p><strong>WARNING: Photos have NOT been Updated.</strong></p></div>';
			}

		}

		// end: if hidden value has been set update photo data from the main Flickr account
	}

	// start: call the function to display the data on the admin pannel

	displayAdminOptionsPage( $bolIsAnApiKey, $strApiKeyValue, $bolIsAnId, $strUserIdValue, $intNumberOfPhotosValue, 
	                         $bolIsAFolder, $intRandomise, $strSizeChoice, $intXSSActivated );

	// end:  call the function to display the data on the admin pannel
}

function displayAdminOptionsPage( $bolIsAnApiKey, $strApiKeyValue, $bolIsAnId, $strUserIdValue, $intNumberOfPhotosValue, 
                                  $bolIsAFolder, $intRandomise, $strSizeChoice, $intXSSActivated )
{
	// start: display options on page

	echo '
		<div class="wrap">
	
			<h2> Flickr Control </h2>	
			<form name="form1" method="post" action="'.str_replace( '%7E', '~', $_SERVER['REQUEST_URI']).'">';
				
				if ( true == $bolIsAnApiKey )
				{
					echo '
					
						<div class="options">
							<p>Flickr API Key: 
							<input type="text" name="'.FLICKR_API_KEY.'" value="'.htmlentities( $strApiKeyValue ).'" size="30"></p>
							<p><a href="http://www.flickr.com/services/api/keys/">Check Your API Key</a> | 
							<a href="http://www.flickr.com/services/api/keys/apply/">Apply For An API Key</a></p>
						</div>';
				}
				else
				{
					echo '
					
						<div class="options">
							Flickr API Key: 
							<input type="text" name="'.FLICKR_API_KEY.'" value="'.htmlentities( $strApiKeyValue ).'" size="30">
							<strong><font color="red">This API Key does not exist! Your options have not been updated.</font></strong>
							<p><a href="http://www.flickr.com/services/api/keys/">Check Your API Key</a></p>
							<p><a href="http://www.flickr.com/services/api/keys/apply/">Apply For An API Key</a></p>
						</div>';
				}

				if ( true == $bolIsAnId )
				{
					echo '
						<div class="options">
							Flickr User NSID: 
							<input type="text" name="'.FLICKR_USER_ID.'" value="'.htmlentities( $strUserIdValue ).'" size="30">
							<p>The NSID can be found in the address/url bar of your web browser when you are on the "Your Photos" page in your Flickr account.<br /> It\'s the code that appears just after http://www.flickr.com/photos/</p>
						</div>';
				}
				else
				{
					echo '
						<div class="options">
							Flickr User NSID: 
							<input type="text" name="'.FLICKR_USER_ID.'" value="'.htmlentities( $strUserIdValue ).'" size="30">
							<strong><font color="red">This ID does not exist! Your options have not been updated.</font></strong>
							<p>The NSID can be found in the address/url bar of your web browser when you are on the "Your Photos" page in your Flickr account. <br /> It\'s the code that appears just after http://www.flickr.com/photos/</p>
						</div>';
				}

			echo '
				<div class="options">
					Number Of Photos To Display: 
					<input type="text" name="'.FLICKR_DISPLAY_NUM.'" value="'.htmlentities( $intNumberOfPhotosValue ).'" size="10"> (Max: 500)
					<p><strong>Please note: </strong>if you choose to display more photos than you have publically made available,<br /> the number of photos actually displayed will be capped at the total number publically available, up to a maximum of 500.</p>
				</div>
				
				';

			echo '
					<h3>Photo Size & Randomise Settings</h3>
					<p>Please select the size you would like the photos to arrive as from your Flickr account. You can be more specific to the size of your images by altering the CSS file used by this plugin. Please select the size closest to what you intend to set the size to in the CSS file. This will lower the chances of reduced quality displayed images.</p>
					<p><strong>Please Note: </strong>if you change the size in this list you will need to update the options AND update your photos also for it to take effect.</p>';

					$arrData = array(
					                 'Square' => '(Default) Square (75px x 75px)',
					                 'Thumbnail' => 'Thumbnail (variable x variable)',
					                 'Small' => 'Small (variable x variable)',
					                 'Medium' => 'Medium (variable x variable)',
					                 'Original' => 'Original (actual width x actual height)'
					                );

					foreach ($arrData as $strName => $strDescription)
					{
						$strChecked = '';

						if ($strName === $strSizeChoice)
						{
							$strChecked = ' checked="checked"';
						}
						printf ('<input type="radio" name="%s" value="%s"%s />%s<br />',
						        FLICKR_SIZE_CHOICE, $strName, $strChecked, $strDescription);
						
					}

					echo '<br />';

			echo '
					<div class="options">
					<p>Here you can enable a random selection of photos to be taken from your Flickr account. If you choose not to randomise the selection, the latest images from your account will be used.</p>
					<br />
					Randomise Photos: 
					<input type="checkbox" name="'.FLICKR_RANDOMISE.'" 
							value="1"';
							if ( 1 == htmlentities( $intRandomise ) ) 
							{
								echo ' checked="checked"';
							}
					echo '/> 
						
						<br />
						<h3>XSS Security Control</h3> 
						<p>If Flickr change their URL content and/or structure you may see this error on your site "One or more photos have been disabled for XSS security reasons". If this happens then please de-activate the XSS security function by unticking the checkbox below, the issue should then be fixed in the next release of the plugin.</p>
						<p><strong>Warning: </strong>Do NOT disable this function unless you experience this error message.</p>
						<br />
						Activate XSS Security: 
						<input type="checkbox" name="'.FLICKR_XSS_ACTIVATED.'" 
							value="1"';
							if ( 1 == htmlentities( $intXSSActivated ) ) 
							{
								echo ' checked="checked"';
							}
					echo '
						<p class="submit">
							<input type="submit" name="Submit" value="Update Options" />
						</p>

						</div> ';

					echo '
						
			</form>
			<br />
			<br />
			<br />

			<h3>Update Photo Collection</h3>	
			<form name="form2" method="post" action="'.str_replace( '%7E', '~', $_SERVER['REQUEST_URI']).'">
				<p>To populate the cache file with your current public Flickr photo collection, click on the Update Photos button.</p>
				<p><strong>Please note: </strong>you will need to perform this task to reflect any changes made in your Flickr account.</p>

				<input type="hidden" name="hidden" value="true" />
				<p class="submit">
					<input type="submit" name="Refresh" value="Update Photos" />
					<br />This process may take a few minutes to run,<br /> especially if you have a large number of photos.
				</p>

			</form>

		</div>';
		
		// end: display options on page

}
// end: setup the options page in wordpress admin

?>