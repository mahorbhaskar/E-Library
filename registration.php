<?php
    session_start();
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<title>Registration</title>
    <?php
    
    include 'css/style.php';

    ?>
</head>
<body>
<!-- DataBase PHP code and Validations -->

<?php

    include 'datacon.php';

if (isset($_POST['submit']))
{
    $username=mysqli_real_escape_string($con,$_POST['username']);
    $email=mysqli_real_escape_string($con,$_POST['email']);
    $password=mysqli_real_escape_string($con,$_POST['password']);
    $cpassword=mysqli_real_escape_string($con,$_POST['cpassword']);

    $pass=password_hash($password,PASSWORD_BCRYPT);
    $cpass=password_hash($cpassword,PASSWORD_BCRYPT);

    $emailquery="select * from registration where email='$email'";
    $query=mysqli_query($con,$emailquery);
    $emailcount=mysqli_num_rows($query);

    if ($emailcount>0)
    {
        ?>
        <script>
            alert('Email Already Exist!');
        </script>
        <?php
    }
    elseif($password===$cpassword)
    {
        $insertquery="insert into registration(username, email, password, cpassword) 
                        values('$username','$email','$pass','$cpass')";
        $iquery=mysqli_query($con,$insertquery);

        if ($iquery)
        {
            ?>
            <script>
                alert("SignUp Successfully!");
            </script>
            <?php
        }
        else{
            ?>
            <script>
                alert("Something wrong!");
            </script>
            <?php
        }
    }
    else{
        ?>
        <script>
            alert("Password doesn't match!");
        </script>
        <?php
    }

}
?>
<!-- video part -->
<div class="banner">
<video autoplay muted loop>
		<source src="lib.mp4" type="video/mp4">
</video>
<!-- container -->

	<div class="container">
		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
			<div class="input-group">
				<input type="text" placeholder="Full Name" name="username"  required>
			</div>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password"  required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword"  required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Register</button>
			</div>
			<p class="login-register-text">Have an account? <a href="login.php">Login Here</a>.</p>
		</form>
	</div>
    </div>
</body>
</html>