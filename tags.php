<?php include('includes/header.php'); ?>

<?php
	if (!empty($_GET['u'])) { // if viewing a users tag page
		$error = '';
		require_once '../../../../mysqli_connect.php';
		$u = filter_var(trim($_GET['u']), FILTER_SANITIZE_STRING);
		
		if (isset($_POST['submit'])) { // if submit button is pressed
			if (!empty($_POST['new_tag_name'])) {
				$tag_name = filter_var(trim($_POST['new_tag_name']), FILTER_SANITIZE_STRING);
				if (!empty($_POST['new_tag_desc'])) { // description is optional
					$new_tag_desc = filter_var(trim($_POST['new_tag_desc']), FILTER_SANITIZE_STRING);
					$q = 'INSERT INTO SS_tags(userID, tag_name, description) VALUES (?, ?, ?)';
					$stmt = mysqli_prepare($dbc, $q);
					mysqli_stmt_bind_param($stmt, 'sss', $u, $tag_name, $new_tag_desc);
					mysqli_stmt_execute($stmt);
					
				} else {
					$q = 'INSERT INTO SS_tags(userID, tag_name) VALUES (?, ?)';
					$stmt = mysqli_prepare($dbc, $q);
					mysqli_stmt_bind_param($stmt, 'ss', $u, $tag_name);
					mysqli_stmt_execute($stmt);
				}
				
			} else {
				$error .= "<section id=\"errors_container\">Please fix the following errors to create a new tag:<br><section id=\"errors\">$error</section></section></br>";
			}
		}
		
		/*
			NEW TILE INSERT
		$s = 'INSERT INTO SS_tiles(userID, tag_name, tile_name, description, url)
		VALUES (?,?,?,?,?)';
		$stmt = mysqli_prepare($dbc, $q);
		mysqli_stmt_bind_param($stmt, 'sssss', $un, $tag_name, $tile_name, $description, $url);
		mysqli_stmt_execute($stmt);

		*/
		
		
		
		
		
		
		// Display all tags for user
		
		$q = "SELECT tag_name, description FROM viewSS_tags WHERE userID = ?";
		$stmt = mysqli_prepare($dbc, $q); // statement is prepared (change to username in session)
		mysqli_stmt_bind_param($stmt, 's', $u); // binding parameters to variables
		mysqli_stmt_execute($stmt); // execute query
		$result = mysqli_stmt_get_result($stmt); // get resulting relation
		$rows = mysqli_num_rows($result); // get number of rows of $result
		
		if ($rows == 0) { // user hasn't created a tag 
			echo "<p>It appears no tags have been created for $u yet.</p>";
			
		} else { // user has created a tag ?>
			<h2><?= $u ?></h2>
			<section id="tags">
				<table>
					<tr>
						<th>Title</th>
						<th>Description</th>
					</tr>
			<?php
			while ($row = mysqli_fetch_assoc($result)) {
				$tag = $row['tag_name'];
				$tag = str_replace(' ', '_', $tag);
				$tag_name = ucwords($row['tag_name']);
				$desc = $row['description'];
				
				echo '<tr class="tag">';
				echo "<td><h4><a href=\"tiles.php?u=$u&amp;t=$tag\">$tag_name</a></h4></td>";
				echo "<td><p>$desc</p></td>";
				echo '</tr>';
				
			} ?>
				</table>
			</section>
	<?php } ?>
	
		<form name="create_new_tag" id="new_tag" method="post">
			<h2>Create a New Tag</h2>
			<p>Type a tag name: </p><input type="text" name="new_tag_name" id="new_tag_name" placeholder="Name">
			<p>Type the description of the tag: </p><input type="text" name="new_tag_desc" id="new_tag_desc" placeholder="Description">
			<input type="submit" action="tags.php?u=<?= $u ?>" text="Create New Tag">
		</form>
		
		
	<?php	
	} else { // user is not specified
		echo '<p>It appears you have reached this page in error. Please return <a href="index.php">home</a> to get started.</p>';
	}

?>

<?php include('includes/footer.php'); ?>
