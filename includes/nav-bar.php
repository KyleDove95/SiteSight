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
	
?>

<header class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li <?php if ($title === 'Home') {echo 'class="active"';} ?>><a href="index">Home</a></li>
                <li <?php if ($title === 'Login') {echo 'class="active"';} ?>><a href="login.php">Login</a></li>
                <li <?php if ($title === 'Register') {echo 'class="active"';} ?>><a href="register.php">Register</a></li>
                <li <?php if ($title === 'Recent Posts') {echo 'class="active"';} ?>><a href="recent.php">Recent Posts</a></li>
            </ul>
        </div>
    </div>
</header>
