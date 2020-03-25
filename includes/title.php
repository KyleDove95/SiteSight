<?php
	// Retrieve the name of the current file from the server
	$title = basename($_SERVER['SCRIPT_FILENAME'], '.php');
	
	// Replace any underscores with a space
	$title = str_replace('_', ' ', $title);
	
	// Replace any hyphens with a space
	$title = str_replace('-', ' ', $title);
	
	// Instead of index, just home
	if ($title == 'index') {
		$title = 'home';
	} else if ($title == 'tac') {
		$title = 'terms and conditions';
	}
	
	// Capitalize each word
	$title = ucwords($title);
	
	echo $title;
