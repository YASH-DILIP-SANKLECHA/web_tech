<?php
session_start();
include 'db.php';

$message = "";

if(isset($_POST['login']))
{
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = md5($_POST['password']);

    $query =
    "SELECT * FROM users
     WHERE username='$username'
     AND password='$password'
     AND role='student'";

    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result)==1)
    {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        header("Location: home.php");
        exit();
    }
    else
    {
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

<nav>
<div class="nav-brand">
📚 <span>CSE</span> Repository
</div>
</nav>

<div class="form-wrapper">
<div class="form-card">

<div class="form-header">
<h1>Student Login</h1>
<p>Login to continue</p>
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
name="login"
class="btn btn-primary">
Login
</button>

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