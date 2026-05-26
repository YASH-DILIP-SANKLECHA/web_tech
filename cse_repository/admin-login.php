<?php
session_start();
include 'db.php';

$message = "";

// Checking if login button is clicked
if(isset($_POST['login']))
{
    // Getting entered username safely
    $username = mysqli_real_escape_string($conn,$_POST['username']);

    // Same password format as stored in database
    $password = md5($_POST['password']);

    // Checking admin details from users table
    $query =
    "SELECT * FROM users
     WHERE username='$username'
     AND password='$password'
     AND role='admin'";

    $result = mysqli_query($conn,$query);

    // If matching admin found then start session
    if(mysqli_num_rows($result)==1)
    {
        $user = mysqli_fetch_assoc($result);

        // Storing admin information in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = 'admin';

        // Redirect to dashboard page
        header("Location: home.php");
        exit();
    }
    else
    {
        // Login failed
        $message = "Invalid Admin Credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Simple navigation bar -->
<nav>
<div class="nav-brand">
📚 <span>CSE</span> Repository
</div>
</nav>

<!-- Login form section -->
<div class="form-wrapper">
<div class="form-card">

<!-- Login page heading -->
<div class="form-header">
<h1>Admin Login</h1>
<p>Administrator Access</p>
</div>

<div class="form-body">

<?php
// Show error if login details are wrong
if($message!="")
{
echo "<div class='alert alert-error'>$message</div>";
}
?>

<!-- Admin login form starts here -->
<form method="POST">

<div class="form-group">
<label>Username</label>
<input type="text" name="username" required>
</div>

<div class="form-group">
<label>Password</label>
<input type="password" name="password" required>
</div>

<!-- Submit button -->
<button type="submit"
name="login"
class="btn btn-primary">
Admin Login
</button>

</form>

</div>
</div>
</div>

</body>
</html>
