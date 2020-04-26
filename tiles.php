<?php   include('includes/header.php'); ?>
		<h2>Create a Tile</h2>
<?php
	if (isset($_POST['submit'])) {
		require_once '../../../../mysqli_connect.php';
		$error = '';
		if (!empty($_POST['tn'])) {
			$un = filter_var(trim($_POST['tn']), FILTER_SANITIZE_STRING);
			
			//search names in db
			$q = 'SELECT username FROM SS_tiles';
			$r = mysqli_query($dbc, $q);
			if ($r) { //if there are usernames registered in the db
				while ($row = mysqli_fetch_assoc($r)) {
					if ($tn == $row['tile_name']) {
						$error .= 'That username is already in use.<br>';
					}
				}
			}
			
		} else {
			$error .= 'Unique tile name required!<br>';
		}
        
		
		if ($error != '') {
			echo "<section id=\"errors_container\">Please fix the following errors:<br><section id=\"errors\">$error</section></section><br>";
		} else { // Form was completely filled correctly (no errors)
			// insert into db
			$q = "INSERT INTO SS_tiles(userID, tag_name, tile_name, description, url) VALUES (?, ?, ?, ?, ?)";
				include('includes/footer.php');
				exit(); // Prevents rest of page from being loaded
			}
		}
		
	} // i.e. submit not been hit
?>

<section id="tile_container">
		<form name="tile" id="tile_form" action="tile.php" method="post">
			<section class="grid-container">
				<section class="grid-item-l">Create a Tile Name:</section>
				<section class="grid-item-r">
					<input type="text" name="tn" id="tn"
					<?php if (isset($tn)) echo "value=\"$tn\""; ?> 
					>
				</section>
				
				<section class="grid-item-l">Enter a Tile Description:</section>
				<section class="grid-item-r">
					<input type="text" name="td" id="td"
					<?php if (isset($td)) echo "value=\"$td\""; ?>
					>
				</section>
				
				<section class="grid-item-l">Provide a URL:</section>
				<section class="grid-item-r"><input type="text" name="ur" id="ur"></section>
				
			
			<input type="submit" name="submit" value="Tile">
		</form>
		</section>
		
