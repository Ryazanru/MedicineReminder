<?php
include_once "config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
echo $argv[0];
$ID = $argv[1];
$query = "SELECT * FROM `reminders` WHERE `Id` = $ID";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);


try {
	$mail->SMTPDebug = 2;									
	$mail->isSMTP();											
	$mail->Host	 = 'smtp.gmail.com;';					
	$mail->SMTPAuth = true;							
	$mail->Username = 'email@gmail.com';				
	$mail->Password = '***';						
	$mail->SMTPSecure = 'tls';							
	$mail->Port	 = 587;

	$mail->setFrom('tehothrdanman@gmail.com', 'Medicine Reminder');		
	$mail->addAddress($row['Email']); //
	// $mail->addAddress('receiver2@gfg.com', 'Name'); // optional
	
	$mail->isHTML(true);								
	$mail->Subject = 'Medicine Reminder for '. $row['Medicine Name'];
	$mail->Body = 'Hey '. $row['Username'] . '<br> Its time to take '. $row['Medicine Dosage'] . ' of '. $row['Medicine Name'] . '<br> Medicine Type: '. $row['Medicine Type'];
	$mail->AltBody = 'Hey '. $row['Username'] . '\r\nIts time to take '. $row['Medicine Dosage'] . 'of '. $row['Medicine Name'] . '\r\nMedicine Type: '. $row['Medicine Type']; // if HTML cannot be read by client/ reciever email
	$mail->send();
	echo "Mail has been sent successfully!";
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
