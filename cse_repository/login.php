<?php
// Start session to keep  login details
session_start();
include 'db.php';

$message = "";

// Check if login form is submitted
if(isset($_POST['login']))
{
    // Getting username entered by user
    $username = mysqli_real_escape_string($conn,$_POST['username']);

    // Converting password to MD5 format
    $password = md5($_POST['password']);

    // Check student account in database
    $query =
    "SELECT * FROM users
     WHERE username='$username'
     AND password='$password'
     AND role='student'";

    $result = mysqli_query($conn,$query);

    // If account exists then create session
    if(mysqli_num_rows($result)==1)
    {
        $user = mysqli_fetch_assoc($result);

        // Save user details in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        // Moving user to home page
        header("Location: home.php");
        exit();
    }
    else
    {
        // Login failed
        $message = "Invalid Username or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navigation bar -->
<nav>
<div class="nav-brand">
📚 <span>CSE</span> Repository
</div>
</nav>

<!-- Student login section -->
<div class="form-wrapper">
<div class="form-card">

<!-- Login heading -->
<div class="form-header">
<h1>Student Login</h1>
<p>Login to continue</p>
</div>

<div class="form-body">

<?php
// Show error message if login is unsuccessful
if($message!="")
{
echo "<div class='alert alert-error'>$message</div>";
}
?>

<!-- Login form -->
<form method="POST">

<div class="form-group">
<label>Username</label>
<input type="text" name="username" required>
</div>

<div class="form-group">
<label>Password</label>
<input type="password" name="password" required>
</div>

<!-- Login button -->
<button type="submit"
name="login"
class="btn btn-primary">
Login
</button>

<!-- Signup link for new users -->
<p style="margin-top:15px;">
New User?
<a href="signup.php">Signup</a>
</p>

</form>

</div>
</div>
</div>

</body>
</html>
