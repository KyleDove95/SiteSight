<?php include('includes/header.php'); ?>

<?php
	if (!empty($_GET['u'])) { // if viewing a users tag page
		require_once '../../../../mysqli_connect.php';
		$u = filter_var(trim($_GET['u']), FILTER_SANITIZE_STRING);
		
		$q = "SELECT tag_name, description FROM SS_tags WHERE userID = ?";
		$stmt = mysqli_prepare($dbc, $q); // statement is prepared (change to username in session)
		mysqli_stmt_bind_param($stmt, 's', $u); // binding parameters to variables
		mysqli_stmt_execute($stmt); // execute query
		$result = mysqli_stmt_get_result($stmt); // get resulting relation
		$rows = mysqli_num_rows($result); // get number of rows of $result
		
		if ($rows == 0) { // user hasn't created a tag 
			echo "<p>It appears no tags have been created for $u yet.</p>";
			/* Create a new tag
			<!-- If user is logged in, allow the ability to create a new tag 
			<form name="create_tag" id="tag_form" action="#" method="get">
				
				
				<input type="submit" name="submit" value="Create Tag">
			</form>-->
			*/
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
				$tag_name = ucwords($row['tag_name']);
				$desc = $row['description'];
				
				echo '<tr class="tag">';
				echo "<td><h4><a href=\"tiles.php?u=$u&amp;t=$tag\">$tag_name</a></h4></td>";
				echo "<td><p>$desc</p></td>";
				echo '</tr>';
				
			} ?>
				</table>
			</section>
	<?php }
		
		
		
	} else { // user is not specified
		echo '<p>It appears you have reached this page in error. Please return <a href="index.php">home</a> to get started.</p>';
	}

?>

<?php include('includes/footer.php'); ?>
