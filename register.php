<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailerr/src/Exception.php';
require 'PHPMailerr/src/PHPMailer.php';
require 'PHPMailerr/src/SMTP.php';
require 'vendor/autoload.php';

$name = $email = $user_name = $password = "";
  if (isset($_POST["register"])){ 
    $conn = mysqli_connect("localhost", "root", "", "test");
    $email = $_POST['email'];
    $check_email = mysqli_query($conn, "SELECT * FROM users where email = '$email' ");

  if(mysqli_num_rows($check_email) > 0){
    echo"<script>window.alert('Account with Email Already exists')</script>";}

  if (isset($_POST["register"])) {
    $user_name = $_POST['user_name'];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
    $mail->isSMTP();                                           
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'samudaayverify@gmail.com';                    
    $mail->Password   = 'jsdeuhrklslblxdd';                             
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465; 

    //Recipients
    $mail->setFrom('samudaayverify@gmail.com', 'verify your mail');
    //Add a recipient
    $mail->addAddress($email, $name);
    //Set email format to HTML
    $mail->isHTML(true);

    $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);

    $mail->Subject = 'Email Verification';
    $mail->Body    = '<div style="width:550px ;height:320px; margin: 0 auto;">(your company name)&nbsp;|&nbsp;<span>Verify</span><hr><p style="font-family: Tahoma;">To verify your email address, please use the following One Time Password <br><br><b style="font-size: 15px;">' . $verification_code . '</b><br><br>Do not share this OTP with anyone. We take your account security very seriously and will never ask you to disclose any information submitted. <br><br>Thank you for registering with us!, Team (your company name)<font style="color: rgb(0, 0, 0) ;font-size:10px;font-family: verda"><center>This mail was for '.$name.', if this was not you click below<br><a href="#" style="color: rgb(0, 0, 0);"><spstyle="color:grey">Unsubscribe Here</span></a></font></p></center></div>';

    $mail->send();
    // echo 'Message has been sent';
    $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

    // connect with database
    $conn = mysqli_connect("localhost", "root", "", "test");

    // insert in users table
    $sql = "INSERT INTO users(user_name,name, email, password, verification_code, email_verified_at) VALUES ('".$user_name."','" . $name . "', '" . $email . "', '" . $encrypted_password . "', '" . $verification_code . "', NULL)";
    mysqli_query($conn, $sql);

    header("Location: email-verification.php?email=" . $email);
    exit();
    } catch (Exception $e) {
        echo "";}}}

function test_input($data) {  
  $data = trim($data);  
  $data = stripslashes($data);  
  $data = htmlspecialchars($data);  
  return $data;  
} 
?>
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





