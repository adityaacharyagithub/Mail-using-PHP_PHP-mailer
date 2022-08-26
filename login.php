<?php
     
    if (isset($_POST["submit"]))
    {
        $user_name = $_POST["user_name"];
        $password = $_POST["password"];
 
        // connect with database
        $conn = mysqli_connect("localhost", "root", "", "test");
 
        // check if credentials are okay, and email is verified
        $sql = "SELECT * FROM users WHERE user_name = '" . $user_name . "'";
        $result = mysqli_query($conn, $sql);
 
        if (mysqli_num_rows($result) == 0)
        {
            die("Email not found.");
        }
 
        $user = mysqli_fetch_object($result);
 
        if (!password_verify($password, $user->password))
        {
            die("Password is not correct");
        }
 
        if ($user->email_verified_at == null)
        {
            die("Please verify your email <a href='email-verification.php?email=" . $email . "'>from here</a>");
        }
 
        header("Location: http://localhost/blog/index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login or Signup</title>
    <style>
    #table_id1
    {
    width: 300px;
    padding-left: 100px;
    border: 0.1px solid ;
    border-color:#000000;
    border-radius: 10px;
    border-collapse: collapse;
	background-color:#ffffff;
    }
    </style>
</head>
<body> 
<center>
<div style="margin-bottom: 90px;">Welcome</div>


    <table id="table_id1">

        <form method="post">

            <tr>
            <th>
                <p>Sign-in</p>
            </th>
            </tr>
            <tr>
            <th>
                <label>Username</label><br><input class="phone_pass_box" type="text" placeholder="Enter Username" name="user_name" required>
            </th>
            </tr>
            <tr>
            <th>
                <label>Password</label><br><input class="phone_pass_box" type="password" placeholder="Enter Password" name="password" required>
            </th>
            </tr>
            <tr>
            <th>
                <input type="submit" name="submit" value="Login">
            </th>
            </tr>
            <tr>
            <th><p>
                <a href="forgot.php">
                    Forgot password?
                </a>
            </p>
            </th>
            </tr>
    </table>

<br>
<hr style="width: 22%;">
<br>

<p>Need a new account?<a href="register.php"> Sign up free</a></p>
        
</form>
</table>
</center>


<br><br><br><br><br><br><br><br><br><br><br><br>



</body>
</html>