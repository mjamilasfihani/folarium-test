<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

if (isset($_POST['submit']))
{
	try
	{
	    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
	    $mail->isSMTP();
	    $mail->Host       = 'smtp.example.com';
	    $mail->SMTPAuth   = true;
	    $mail->Username   = 'user@example.com';
	    $mail->Password   = 'secret';
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
	    $mail->Port       = 465;

	    $mail->setFrom('no-reply@example.com', 'No Reply');
	    $mail->addAddress($_POST['usermail']);

	    //Content
	    $mail->isHTML(true);
	    $mail->Subject = $_POST['subject'];
	    $mail->Body    = $_POST['message'];

	    $mail->send();

	    echo 'Message has been sent. <br><br>';
	}
	catch (Exception $e)
	{
	    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo} <br><br>";
	}
}

?>

<form action="" method="post">
	<label>Email</label><br>
	<input type="email" name="usermail">
	<br><br>
	<label>Subject</label><br>
	<input type="text" name="subject">
	<br><br>
	<label>Message</label><br>
	<textarea name="message"></textarea>
	<br><br>
	<button type="submit" name="submit">Submit</button>
</form>
