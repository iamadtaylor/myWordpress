<?php
	require_once dirname( __FILE__ ) . '/flickrScript.php';
	require_once dirname( __FILE__ ) . '/../../../wp-config.php';

	$bolScriptHasRun = flickrScriptMain();

	if ( false == $bolScriptHasRun )
	{
		exit( "ERROR: This script failed to run correctly." );
	}
?>