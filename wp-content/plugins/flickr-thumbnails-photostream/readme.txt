=== Flickr Thumbnails Photostream ===
Contributors: PlusNet
Tags: flickr, photo, widget, images, thumbnail
Requires at least: 2.3.3
Tested up to: 2.5
Stable tag: 1.1

The Flickr Thumbnails Photostream plugin makes including and linking to photos on a Flickr account simple and flexible.

== Description ==

Admin Control Panel

All the main functions of control such as connecting to a Flickr account and storing information on the photo thumbnails, can be achieved through the "Flickr Control" GUI in the Wordpress admin panel.
	
Any changes in current Flickr photo information/status can be immediately updated by clicking on the "Update Photos" button.

Photo Randomisation

Users can choose to randomise the display of photos.

Information Cache

Running the relevant Flickr API function calls can sometimes take between 2 & 3 minutes to fully execute. All information is stored in a cache data held locally, so that it minimises the chance of performance loss on web pages. 

The cache data is stored in the Wordpress database and can store up to 500 images at a time. See below for further details.

Cron Support

If users wish to have regular/automatic updates of their photo information and status, then that is achievable through creating a crontab entry, or similar automation mechanism, to execute the supplied "runScript.php" file.

Specific styling using CSS

A CSS file is supplied to provide a starting point for displaying the thumbnails, but changes can be made to suit individual preference.


== Installation ==

1. Extract the "flickr-thumbnails-photostream" folder from the downloaded file and put it in your Wordpress "/wp-content/plugins/" folder so that the resulting path is "/wp-content/plugins/flickr-thumbnails-photostream/".

2. The plugin should now be viewable in the Wordpress admin panel under the "Plugins -> Plugins" menu option. The plugin is entitled "Flickr Thumbnail Photostream" and can be activated in the normal way by clicking "Activate" in the far right column. 

3. First, click on the "Flickr Control" option found within the main "Plugin" menu, and you will be directed to the Flickr Control panel. From here you should be able to select how many photos you want to display and other options.

4. The two most important attributes to get working are your Flickr API Key and your Flickr user ID. Without these two codes it is impossible to connect to your Flickr account.
	
	API KEY
	
	The Flickr API Key has to be applied for, if you don't currently have one. If you using this plugin for non-commercial use then you should apply for a non-commercial Key. If you do this you should get your Key almost instantly. If you apply for the commercial Key it may take some time to process.
	You can apply for an API Key here:- http://www.flickr.com/services/api/keys/apply/
	
	If you know or think you already have an API Key then you can retrieve it from here:- http://www.flickr.com/services/api/keys/

	Your user ID or NSID is quite easy to find its located in the address/url bar of your web browser when you are on the "Your Photos" 
	page in your Flickr account. It appears just after http://www.flickr.com/photos/

	For an example this is how PlusNet's NSID is displayed:- http://www.flickr.com/photos/23469361@N07/
	
	So the NSID here is 23469361@N07

5. Next you can fill in the amount of photos you want to display. 
	
	Simply put, this option will set the number of photos that are to be randomly selected from your cached data, that you will then see on your web page.
	
	Please note: the Flickr API imposes a maximum of 500 photos that can be retrieved from your photo collection at any one time. If you have over 500 photos in your Flickr account, then any number that you enter here, for example 300, will be taken from the latest 500 photos. Only photos set as "public" in your Flickr account will be retrieved.

	Once you have filled in these options you need to click the "Update Options" button to save your preferences. Obviously you will need to update the options each time you change them.
	
	To populate the cached data stored in the Wordpress database with your photo information you will need to click on the "Update Photos" button. It may take a few minutes to run depending on how many photos you have on your Flickr account. This potentially extended download time is the reason why we have separated this function from the main display function.

6. The plugin enables you to randomise the photos that are displayed. This function in switched on by default but you can turn it off if you wish. If this function is disabled the plugin will use the latest images on your Flickr account.

7. Depending on how you use and implement Wordpress/your website, you may have to use the widget control menu to position where the Flickr application will appear and be utilised. To do this simply visit the "Presentation -> Widgets" menu option, and position the plugin where ever you like. In some cases it will be necessary to perform this task for the plugin to appear on your web page.


== Upgrade ==

If you are upgrading from version 1.0 or 1.0.1 to version 1.1 then you will need to de-activate and re-activate the plugin. This is to ensure that some of the new features will be fully initialised.

== Frequently Asked Questions ==

= How does the plugin connect to Flickr? =

It uses the PHP cURL library to connect to Flickr's API.

= Can the supplied plugin be re-styled? =

Yes, as mentioned previously, a CSS style sheet is provided to give a basic layout for the plugin. Please feel free to modify this to your heart's content to get the presentation you are after. However, this may require you to have some prior knowledge of HTML and CSS.

= Is it possible to automate the photo updates? =

Yes, we have provided a PHP file called "runScript.php" that is the file that should be run if you want to run an automated/scheduled update of your photo info. Essentially it performs the same task as clicking the "Update Photos" button but automatically.

= Will I experience any permission issues with the data cache storage/usage? =

No, the plugin has been re-designed to automatically save the data cache to the Wordpress database, this should prevent any file/folder permission issues. 

= Can I choose not to use the randomise image feature? =

Yes, there is an option in the admin panel to disable this feature. If it is disabled the latest images will be used instead.

== Screenshots ==

1. This is a screenshot of the application running on Wordpress' front page - screenshot-1.png
2. This is a screenshot of the Flickr Control screen in Wordpress' admin panel - screenshot-2.png

== File Listing ==

All files, both PHP and CSS, can be found within the main extracted plugin folder.

Within the folder "flickr-thumbnails-photostream" you should find the following 7 files:-

1. flickrScript.php - the file that will interface with the Flickr API (required)
2. flickrPlugin.php - the display file that Wordpress will interface with (required)
3. flickrInclude.php - used for commonly used PHP variables and functions (required)
4. runScript.php - used for cron or other photo data update automation control (optional usage)
5. style.css - used for styling the presentation of the thumbnails (required, but can be modified)
6. readme.txt - this information file
7. COPYING - a copy of the license terms for this release

== XSS Security Function ==

If Flickr change their URL content and/or structure you may see this error on your site "One or more photos have been disabled for XSS security reasons". If this happens then please de-activate the XSS security function by unticking the checkbox in the admin panel. The issue should then be fixed in the next release of the plugin. Please do NOT disable this function unless you experience this error message.

For further support or information please visit: http://community.plus.net/opensource/
