<?php
include 'db.php';

$message = "";

if(isset($_POST['signup']))
{
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = md5($_POST['password']);

    $check = mysqli_query($conn,
        "SELECT * FROM users WHERE username='$username'");

    if(mysqli_num_rows($check) > 0)
    {
        $message = "Username already exists";
    }
    else
    {
        mysqli_query($conn,
        "INSERT INTO users(username,password,role)
         VALUES('$username','$password','student')");

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

<nav>
<div class="nav-brand">
📚 <span>CSE</span> Repository
</div>
</nav>

<div class="form-wrapper">
<div class="form-card">

<div class="form-header">
<h1>Create Account</h1>
<p>Student Registration</p>
</div>

<div class="form-body">

<?php
if($message!="")
{
echo "<div class='alert alert-error'>$message</div>";
}
?>

<form method="POST">

<div class="form-group">
<label>Username</label>
<input type="text" name="username" required>
</div>

<div class="form-group">
<label>Password</label>
<input type="password" name="password" required>
</div>

<button type="submit"
name="signup"
class="btn btn-primary">
Signup
</button>

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