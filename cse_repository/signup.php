<?php
include 'db.php';

$message = "";

// Checks if signup form is submitted
if(isset($_POST['signup']))
{
    // Get the username entered by user
    $username = mysqli_real_escape_string($conn,$_POST['username']);

    // Convert password before storing in database
    $password = md5($_POST['password']);

    // Check if username already exists
    $check = mysqli_query($conn,
        "SELECT * FROM users WHERE username='$username'");

    if(mysqli_num_rows($check) > 0)
    {
        // Username already taken
        $message = "Username already exists";
    }
    else
    {
        // Create new student account
        mysqli_query($conn,
        "INSERT INTO users(username,password,role)
         VALUES('$username','$password','student')");

        // Redirect user to login page
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Signup - CSE Repository</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navigation bar -->
<nav>
<div class="nav-brand">
📚 <span>CSE</span> Repository
</div>
</nav>

<!-- Signup section -->
<div class="form-wrapper">
<div class="form-card">

<!-- Page heading -->
<div class="form-header">
<h1>Create Account</h1>
<p>Student Registration</p>
</div>

<div class="form-body">

<?php
// Showing message if username already exists
if($message!="")
{
echo "<div class='alert alert-error'>$message</div>";
}
?>

<!-- Signup form -->
<form method="POST">

<div class="form-group">
<label>Username</label>
<input type="text" name="username" required>
</div>

<div class="form-group">
<label>Password</label>
<input type="password" name="password" required>
</div>

<!-- Signup button -->
<button type="submit"
name="signup"
class="btn btn-primary">
Signup
</button>

<!-- Login link for existing users -->
<p style="margin-top:15px;">
Already have account?
<a href="login.php">Login</a>
</p>

</form>

</div>
</div>
</div>

</body>
</html>
