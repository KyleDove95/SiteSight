<?php include('includes/header.php'); ?>

<?php
	if ((!empty($_GET['u'])) and (!empty($_GET['t']))) {
		$error = '';
		require_once '../../../../mysqli_connect.php';
		$u = filter_var(trim($_GET['u']), FILTER_SANITIZE_STRING);
		$t = filter_var(trim($_GET['t']), FILTER_SANITIZE_STRING);
		
		if (isset($_POST['submit'])) { // if tile is created
			if (!empty($_POST['new_tile_name'])) {
				$nt_name = filter_var(trim($_POST['new_tile_name']), FILTER_SANITIZE_STRING);
				//echo $nt_name;
			} else {
				$error .= 'Tile name is required.<br>';
			}
			
			if (!empty($_POST['new_tile_url'])) {
				$nt_url = filter_var(trim($_POST['new_tile_url']), FILTER_SANITIZE_STRING);
				//echo $nt_url;
			} else {
				$error .= 'URL is required.<br>';
			}
			
			if (!empty($_POST['new_tile_desc'])) {
				$nt_desc = filter_var(trim($_POST['new_tile_desc']), FILTER_SANITIZE_STRING);
				if ($error === '') {
					$q = 'INSERT INTO SS_tiles(userID, tag_name, tile_name, description, url) VALUES (?, ?, ?, ?, ?)';
					$stmt = mysqli_prepare($dbc, $q);
					mysqli_stmt_bind_param($stmt, 'sssss', $u, $t, $nt_name, $nt_desc, $nt_url);
					mysqli_stmt_execute($stmt);
				} else {
					echo "<section id=\"errors_container\">Please fix the following errors to create a new tile:<br><section id=\"errors\">$error</section></section><br>";
				}
				
			} else {
				if ($error === '') {
					$q = 'INSERT INTO SS_tiles(userID, tag_name, tile_name, url) VALUES (?, ?, ?, ?)';
					$stmt = mysqli_prepare($dbc, $q);
					mysqli_stmt_bind_param($stmt, 'ssss', $u, $t, $nt_name, $nt_url);
					mysqli_stmt_execute($stmt);
				} else {
					echo "<section id=\"errors_container\">Please fix the following errors to create a new tile:<br><section id=\"errors\">$error</section></section><br>";
				}
			}
		}
		mysqli_free_result($result);
		mysqli_free_result($stmt);
		
		// Display all tiles for a user's tags
		$q = 'SELECT tile_name, description, url from SS_tiles WHERE userID = ? AND tag_name = ?';
		$stmt = mysqli_prepare($dbc, $q);
		mysqli_stmt_bind_param($stmt, 'ss', $u, $t);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$rows = mysqli_num_rows($result);
		
		if ($rows == 0) {
			echo "<p>It appears no tags have been created for <a href=\"tags.php?u=$u\">$u</a>'s tag named $t.</p>";
			
		} else { ?>
			<img src="images/anon.jpg">
			<h2><a href="tags.php?u=<?= $u ?>"><?= $u ?></a></h2>
			<section id="tiles">
				<table>
					<tr>
						<th>Title</th>
						<th>Description</th>
					</tr>
			<?php
			while ($row = mysqli_fetch_assoc($result)) {
				$tile_name = $row['tile_name'];
				$desc = $row['description'];
				$url = $row['url'];
				
				echo '<tr class="tile">';
				echo "<td><h4><a href=\"$url\" target=\"_blank\">$tile_name</a></h4></td>";
				echo "<td><p>$desc</p></td>";
				echo '</tr>';
				
			} ?>
			
				</table>
			</section>
			
			
		
		<?php
		}
		
		?>
		<form name="create_new_tile" id="create_new_tile" method="post">
			<h2>Create a New Tile</h2>
			<p>Type a tile name: </p><input type="text" name="new_tile_name" id="new_tile_name" placeholder="Name" <?php if(isset($nt_name)) echo "value=\"$nt_name\"";?>>
			<p>Type the description of the tile: </p><input type="text" name="new_tile_desc" id="new_tile_desc" placeholder="Description" <?php if(isset($nt_desc)) echo "value=\"$nt_desc\"";?>>
			<p>Add the URL</p><input type="url" name="new_tile_url" id="new_tile_url" placeholder="URL" <?php if(isset($nt_url)) echo "value=\"$nt_url\"";?>><br>
			<input type="submit" name="submit" id="submit" action="tags.php?u=<?= $u ?>" value="Create New Tag">
		</form>
	<?php
		
	} else { // user or tag is not specified
		echo 'It appears you have reached this page in error. Please <a href="num_tags.php">go back to Explore</a> to get started.';
	}
	?>

	

<?php include('includes/footer.php'); ?>
