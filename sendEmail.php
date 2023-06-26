<?php 
error_reporting(E_ALL);
ini_set('display_errors', 'On');
// Import PHPMailer classes into the global namespace 
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\SMTP; 
use PHPMailer\PHPMailer\Exception; 
 
// Include library files 
require 'vendor/phpmailer/phpmailer/src/Exception.php'; 
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php'; 
require 'vendor/phpmailer/phpmailer/src/SMTP.php'; 


// Recieve candidate data from dashboad 
if(isset($_POST['submit'])){
    $candidateName = $_POST['name'];
    $candidateEmail = $_POST['email'];
    $link = $_POST['link'];
    $agentEmail = $_POST['agentEmail'];
    // echo $link;
    // die();
}
 
// Create an instance; Pass `true` to enable exceptions 
$mail = new PHPMailer; 
 
// Server settings 
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;    //Enable verbose debug output 
$mail->isSMTP();                            // Set mailer to use SMTP 
$mail->Host = 'smtp.hostinger.com';           // Specify main and backup SMTP servers 
$mail->SMTPAuth = true;                     // Enable SMTP authentication 
$mail->Username = 'admin@artfrica.studio';       // SMTP username 
$mail->Password = 'Admin@2023';         // SMTP password 
$mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted 
$mail->Port = 465;                          // TCP port to connect to 
 
// Sender info 
$mail->setFrom('admin@artfrica.studio', 'Tester Name'); 
$mail->addReplyTo('admin@artfrica.studio', 'Admin'); 
 
// Add a recipient 
$mail->AddAddress($candidateEmail, $candidateName); 
$mail->AddAddress($agentEmail); 
 
//$mail->addCC('cc@example.com'); 
//$mail->addBCC('bcc@example.com'); 
 
// Set email format to HTML 
$mail->isHTML(true); 
 
// Mail subject 
$mail->Subject = 'Email Testing Link'; 
 
// Mail body content 
$bodyContent = '<h1>Below is your Link</h1>'; 
$bodyContent .= '<p>Hi '.$candidateName.' <br> Link: '.$link.'</p>'; 
$mail->Body    = $bodyContent; 
 
// Send email 
if(!$mail->send()) { 
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
} else { 
    // If email is successful, redirect back to dashboard with a Get data
    header("Location: https://enaitchdevelopers.com/tsuktest/dashboard.html?emailStatus=sent"); 
    die();
}