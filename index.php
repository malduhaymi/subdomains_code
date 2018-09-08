<?php

ini_set('max_execution_time', 30000); //300 seconds = 5 minutes
require 'class.phpmailer.php';
require 'class.smtp.php';
             

//change URL 
$cmd="C:\Users\Administrator\Downloads\Sublist3r-master\Sublist3r-master\sublist3r.py -d {URL} > C:\Users\Administrator\Downloads\Sublist3r-master\Sublist3r-master\out.txt";
exec($cmd);


$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "email@gmail.com";
$mail->Password = "password";
$mail->SetFrom("youremail@domain.com");
$mail->Subject = "sub domains for your org";

// read file

$myfile = fopen("C:\Users\Administrator\Downloads\Sublist3r-master\Sublist3r-master\out.txt", "r") ;
$output= fread($myfile,filesize("C:\Users\Administrator\Downloads\Sublist3r-master\Sublist3r-master\out.txt"));
$pieces = explode("Total Unique Subdomains Found", $output);


$mail->Body = $pieces[1];
$mail->AddAddress("email@gmail.com");



 if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    echo "Message has been sent";
 }




?>