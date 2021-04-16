<?php
session_start();
include("../../dbconfig.php");
$names = $_POST['names'];
$email = $_POST['email'];
$message = $_POST['message'];
$s = "select * from contact";
$result = mysqli_query($db,$s);
$num=mysqli_num_rows($result);

$reg="INSERT Into contact (names,email,message) values('$names','$email','$message')";
mysqli_query($db,$reg);
echo '<script>alert("New record inserted sucessfully")</script>';
// echo "<meta http-equiv='refresh' content='0; url=contact.html' />";



 

use PHPMailer\PHPMailer\PHPMailer;

require_once 'phpmailer/Exception.php';
require_once 'phpmailer/PHPMailer.php';
require_once 'phpmailer/SMTP.php';

$mail = new PHPMailer(true);

$alert = '';


  $names = $_POST['names'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  try{
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'vinayd.vef@gmail.com'; // Gmail address which you want to use as SMTP server
    $mail->Password = 'openvinayd.vef@1'; // Gmail address Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = '587';

    $mail->setFrom('vinayd.vef@gmail.com'); // Gmail address which you used as SMTP server
    $mail->addAddress($_POST['email']); // Email address where you want to receive emails (you can use any of your gmail address including the gmail address which you used as SMTP server)

    $mail->isHTML(true);
    $mail->Subject = 'Message Received (Contact Page)';
    $mail->Body = "<h3>Name : $names <br>Email: $email <br>Message : $message</h3>";

    if($mail->send())
{
    echo "<meta http-equiv='refresh' content='0; url=thanksforcontact.html' />";
} 
  
    $alert = '<div class="alert-success">
                 <span>Message Sent! Thank you for contacting us.</span>
                </div>';
  } catch (Exception $e){
    $alert = '<div class="alert-error">
                <span>'.$e->getMessage().'</span>
              </div>';
  }

?>