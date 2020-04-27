<?php include('includes/header.php')?>
		<h2>Number of Tags</h2>
<?php
	require_once '../../../../mysqli_connect.php';
	$q = "SELECT userID, COUNT(tag_name) FROM SS_tags GROUP BY userID ORDER BY COUNT(tag_name) DESC";
	$r = mysqli_query($dbc, $q);
	
	echo '<table>';
	echo '<tr>';
	echo '<th>Username</th>';
	echo '<th>Number of Tags</th>';
	echo '</tr>';
		
	if ($r) {
		while ($row = mysqli_fetch_assoc($r)) {
			$uid = $row['userID'];
			$count = $row['COUNT(tag_name)'];
			echo '<tr>';
			echo "<td><a href=\"tags.php?u=$uid\">$uid</a></td>";
			echo "<td>$count</td>";
			echo '</tr>';
		}
	}
	?>
	</table>
	
	<?php
	
include('includes/footer.php'); ?>
