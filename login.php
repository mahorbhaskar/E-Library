<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>LogIn-ELib</title>
    <?php
        include 'css/style.php';
    ?>
</head>
<body>
<?php
    include 'datacon.php';

    if (isset($_POST['submit']))
    {
        $email=$_POST['email'];
        $password=$_POST['password'];

        $email_search="select * from registration where email='$email'";
        $query=mysqli_query($con,$email_search);
        $email_count=mysqli_num_rows($query);

		if($email_count)
		{
			$email_pass=mysqli_fetch_assoc($query);

			$db_pass=$email_pass['password'];
			$_SESSION['username']=$email_pass['username'];
			$pass_decode=password_verify($password, $db_pass);

			if($pass_decode)
			{
				?>
				<script>
					alert("Login Succesfully!");
					location.replace("home.php");
				</script>
				<?php
			}
			else
			{
				?>
				<script>
					alert("Password Incorrect!");
				</script>
				<?php
			}
		}
		else{
			?>
				<script>
					alert("Invalid Email");
				</script>
			<?php
		}
    }

?>
<!-- Video Container -->
<div class="banner">
	<video autoplay muted loop>
		<source src="lib.mp4" type="video/mp4">
		
	</video>
	<div class="container">
		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Login</button>
			</div>
			<p class="login-register-text">Don't have an account? <a href="registration.php">Register Here</a>.</p>
		</form>
	</div>
</div>
</body>
</html>