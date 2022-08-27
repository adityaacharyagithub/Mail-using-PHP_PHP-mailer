<?php
if (isset($_POST["verify_email"])){
    $email = $_POST["email"];
    $verification_code = $_POST["verification_code"];
    // connect with database
    $conn = mysqli_connect("localhost", "root", "", "test");
    // mark email as verified
    $sql = "UPDATE users SET email_verified_at = NOW() WHERE email = '" . $email . "' AND verification_code = '" . $verification_code . "'";
    $result  = mysqli_query($conn, $sql);
 
    if (mysqli_affected_rows($conn) == 0){
    die("Verification code failed.");}
 
    echo "<p>You can login now.</p>"."<br><br>";
    echo "<a href='login.php'><button>Login</button></a>";
    exit();}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Email verify</title>
    <style>
    #mail_e:link{color: blue;text-decoration: none;}
    #mail_e:visited{color: blue;text-decoration: none;}
    #mail_e:hover{color: blue;text-decoration: underline;}
    #table_id3{
    width: 300px;
    padding-left: 100px;
    border: 0.1px solid ;
    border-color:#000000;
    border-radius: 10px;
    border-collapse: collapse;
	background-color:#ffffff;}</style>       
</head>
<body>
<center>
<div style="margin-bottom: 90px;">Welcome</div>
<table id="table_id3">
    <form method="post">
    <tr><th><p>Verify Email</p><br></th></tr>

    <th> <label >Verify</label><br><input type="hidden" name="email" value="<?php echo $_GET['email']; ?>"required></th>

    <tr><th><input class="phone_pass_box" type="text" placeholder="Enter Verification code" name="verification_code"></th></tr>

    <tr><th><input type="submit" value="Verify Email" name="verify_email"></th></tr>
</form>
</table>
</body>
</html>
