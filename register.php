<?php include 'mail.php';?>

<!-- Html starts -->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Signup</title>
  <style>
  #table_id2{
  width: 350px;
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

<table id="table_id2">
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <tr><th><br><p>Create account</p></th></tr>

    <tr><th><label>Your Name</label><br><input type="text" minlength="6" maxlength="50" placeholder="First and Last Name" name="name"></th></tr>

    <tr><th><label>Your Username</label><br><input class="phone_pass_box" type="text" minlength="6" maxlength="25" placeholder="Enter Username" name="user_name"></th></tr>

    <tr><th><label>Your Email</label><br><input class="phone_pass_box" type="text" placeholder="Email Address" name="email"></th></tr>

    <tr><th><label>Your Password</label><br><input class="phone_pass_box" type="password" minlength="8" maxlength="15" placeholder="New Password" name="password"></th></tr>

    <tr><th><input type="submit" value="Signup" name="register"><br><br></th></tr>
  </form>
</table>
</center>

</body>
</html>
