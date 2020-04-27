<?php include('includes/header.php'); ?>
		<h2>Login</h2>
<?php
	if (isset($_POST['submit'])) {
		$error = '';
		if (!empty($_POST['un'])) {
			$un = $_POST['un'];
			// check if $un exists in DB
		} else {
			$error .= 'Please enter your username.<br>';
		}
		
		if (!empty($_POST['pw'])) {
			$pw = $_POST['pw'];
			// check if pw matches un.pw in DB
		} else {
			$error .= 'Invalid password.<br>';
		}
		
		if ($error != '') {
			echo "<section id=\"errors_container\">Please fix the following errors:<br><section id=\"errors\">$error</section></section><br>";
		} else {
			// Form was completely filled correctly (no errors)
			echo '<section id="confirm"><h3>Confirmation</h3>';
			echo "<p>Successfully logged $un in</p></section>";
			include('includes/footer.php');
			exit(); // Prevents rest of page from being loaded
		}
		
	} // i.e. submit not been hit
?>

		<section id="login_container">
		<form name="login" id="login_form" action="login.php" method="post">
			<section class="grid-container">
				<section class="grid-item-l">Username:</section>
				<section class="grid-item-r">
					<input type="text" name="un" id="un"
					<?php if (isset($un)) echo "value=\"$un\""; ?>
				>
				</section>
				
				<section class="grid-item-l">Password:</section>
				<section class="grid-item-r"><input type="password" name="pw" id="pw"</section>
		
			</section>
			<input type="submit" name="submit" value="Login">
		</form>
		</section>
		
		<section id="login">
			<p><a href="register.php">New User?</a></p>
		</section>
		
<?php include('includes/footer.php'); ?>