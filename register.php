<?php include('includes/header.php')?>
		<h2>Register</h2>
<?php
	if (isset($_POST['submit'])) {
		require_once '../../../../mysqli_connect.php';
		$error = '';
		if (!empty($_POST['un'])) {
			$un = filter_var(trim($_POST['un']), FILTER_SANITIZE_STRING);
			
			//search names in db
			$sql = 'SELECT username FROM SS_users';
			$r = mysqli_query($dbc, $sql);
			if ($r) { //if there are usernames registered in the db
				while ($row = mysqli_fetch_assoc($r)) {
					if ($un == $row['username']) {
						$error .= 'That username is already in use.<br>';
					}
				}
			}
			
		} else {
			$error .= 'Please enter a valid username.<br>';
		}
		
		if (!empty($_POST['em'])) {
			$em = filter_var(trim($_POST['em']), FILTER_SANITIZE_EMAIL); 
			$em = filter_var($em, FILTER_VALIDATE_EMAIL);
			
			//search emails in db
			$sql = 'SELECT email FROM SS_users';
			$r = mysqli_query($dbc, $sql);
			if ($r) { //if there are emails registered in the db
				while ($row = mysqli_fetch_assoc($r)) {
					if ($em == $row['email']) {
						$error .= 'That email is already in use.<br>';
					}
				}
			}
		} else {
			$error .= 'Please enter an email.<br>';
		}
		
		if (!empty($_POST['pw'])) {
			if (!empty($_POST['cpw'])) {
				if ($_POST['pw'] == $_POST['cpw']) {
					$pw = filter_var(trim($_POST['pw']), FILTER_SANITIZE_STRING);
					$hashed = password_hash($pw, PASSWORD_DEFAULT);
				} else {
					$error .= 'Passwords do not match.<br>';
				}
			} else {
				$error .= 'Please confirm your password.<br>';
			}
		} else {
			$error .= 'Please enter a password.<br>';
		}
		
		if (!isset($_POST['agree'])) {
			$error .= 'You must agree to the <a href="tac.php">Terms and Conditions</a>.';
		}
		
		if ($error != '') {
			echo "<section id=\"errors_container\">Please fix the following errors:<br><section id=\"errors\">$error</section></section><br>";
		} else { // Form was completely filled correctly (no errors)
			// insert into db
			$q = "INSERT INTO SS_users(userID, email, password) VALUES (?, ?, ?)";
			$stmt = mysqli_prepare($dbc, $q); // statement is prepared
			mysqli_stmt_bind_param($stmt, 'sss', $un, $em, $hashed);
			mysqli_stmt_execute($stmt);
			if (mysqli_stmt_affected_rows($stmt)) {
				// output data
				echo '<section id="confirm"><h3>Confirmation</h3>';
				echo "<p>Thank you, $un, for registering for Site Sight and agreeing to our <a href=\"tac.php\">Terms and Conditions</a>.</p>";
				echo "<p>A confirmation email will (not) be sent to $em. Please check your spam folder if it does not appear within 10 minutes.</p></section>";
				echo "<p>In the meantime, check out your own page: <a href=\"#\">$un</a>";
				echo "<p>We have successfully entered your data into our database. Thank you.</p>";
			
				include('includes/footer.php');
				exit(); // Prevents rest of page from being loaded
			}
		}
		
	} // i.e. submit not been hit
?>

		<section id="reg_container">
		<form name="register" id="reg_form" action="register.php" method="post">
			<section class="grid-container">
				<section class="grid-item-l">Create a username:</section>
				<section class="grid-item-r">
					<input type="text" name="un" id="un"
					<?php if (isset($un)) echo "value=\"$un\""; ?> 
					>
				</section>
				
				<section class="grid-item-l">Enter your email:</section>
				<section class="grid-item-r">
					<input type="text" name="em" id="em"
					<?php if (isset($em)) echo "value=\"$em\""; ?>
					>
				</section>
				
				<section class="grid-item-l">Create a password:</section>
				<section class="grid-item-r"><input type="password" name="pw" id="pw"></section>
				
				<section class="grid-item-l">Confirm your password:</section>
				<section class="grid-item-r"><input type="password" name="cpw" id="cpw"></section>
			</section>
			<section id="chkbx">
				<input type="checkbox" name="agree" id="agree"
					<?php if (isset($_POST['agree'])) echo 'checked'; ?>
				>&nbsp;I have read and agree to the <a href="tac.php">Terms and Conditions</a>.<br>
				<br>
			</section>
			<input type="submit" name="submit" value="Register">
		</form>
		</section>
		
		<section id="login">
			<p>Already have an account? <a href="login.php">Log in</a></p>
		</section>

<?php include('includes/footer.php'); ?>