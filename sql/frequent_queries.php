<?php
// ####################################################################
// Determine if a username is already in use
$q = 'SELECT username FROM SS_users';
$r = mysqli_query($dbc, $q);
if ($r) { //if there are usernames registered in the db
	while ($row = mysqli_fetch_assoc($r)) {
		if ($un == $row['username']) {
			$error .= 'That username is already in use.<br>';
		}
	}
}

// ####################################################################
// Determine if an email is already in use
$q = 'SELECT email FROM SS_users';
$r = mysqli_query($dbc, $q);
if ($r) { //if there are emails registered in the db
	while ($row = mysqli_fetch_assoc($r)) {
		if ($em == $row['email']) {
			$error .= 'That email is already in use.<br>';
		}
	}
}

// ####################################################################
// Registering a new user
// Given: userID, email, and hashed password
$q = 'INSERT INTO SS_users (userID, email, password) VALUES (?, ?, ?)';
$stmt = mysqli_prepare($dbc, $q); // statement is prepared
mysqli_stmt_bind_param($stmt, 'sss', $un, $em, $hashed);
mysqli_stmt_execute($stmt);

// ####################################################################
// Registering a new tag
// Given: userID (already logged in), tag_name, possibly description
if (!empty($_POST['description'])) { // description is filled out
	$q = 'INSERT INTO SS_tags (userID, tag_name, description) VALUES (?, ?, ?)';
	$stmt = mysqli_prepare($dbc, $q); // statement is prepared
	mysqli_stmt_bind_param($stmt, 'sss', $username, $tag_name, $description);
	mysqli_stmt_execute($stmt);
} else { // description is not filled out
	$q = 'INSERT INTO SS_tags (userID, tag_name) VALUES (?, ?)';
	$stmt = mysqli_prepare($dbc, $q); // statement is prepared
	mysqli_stmt_bind_param($stmt, 'ss', $username, $tag_name);
	mysqli_stmt_execute($stmt);
}

// ####################################################################
// Registering a new tile
// Given: userID (already logged in), tag_name, tile_name, possibly description, url
if (!empty($_POST['description'])) { // description is filled out
	$q = 'INSERT INTO SS_tiles (userID, tag_name, tile_name, description) VALUES (?, ?, ?, ?)';
	$stmt = mysqli_prepare($dbc, $q); // statement is prepared
	mysqli_stmt_bind_param($stmt, 'ssss', $username, $tag_name, $tile_name, $description);
	mysqli_stmt_execute($stmt);
} else { // description is not filled out
	$q = 'INSERT INTO SS_tags (userID, tag_name, tile_name) VALUES (?, ?, ?)';
	$stmt = mysqli_prepare($dbc, $q); // statement is prepared
	mysqli_stmt_bind_param($stmt, 'sss', $username, $tag_name, $tile_name);
	mysqli_stmt_execute($stmt);
}

// ####################################################################
// Updating SS_users last_login when they log in
// Given: userID (as they login)
$q = 'UPDATE SS_users SET last_login = ? WHERE userID == ?';

// ####################################################################
// Get all tags of a user

// ####################################################################
// Get all tiles of a user's tag


?>
