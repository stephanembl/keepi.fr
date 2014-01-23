<?php
include ('../classes/Bdd.php');
$bdd = new Bdd('keepi');
if(isset($_POST['email'])) {
    if(($_POST['email'] != '')) {
		$to      = $_POST['email'].'@epitech.eu';
		$subject = 'We\'ve received your Beta application!';
		$message = '
		<html>
			<head>
			  <title>Application received!</title>
			</head>
			<body>
			  <p>Hello '.$_POST['email'].'!</p>
			  <p>Thank you for your interest in KeePi!</p>
			  <p>If you are selected to participate, a notification email will be sent to this address at a later time.</p>
			  <p>Sincerely,<br />The KeePi Team</p>
			</body>
		</html>
		';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		// Additional headers
		$headers .= 'To: '.$_POST['email'].' <'.$_POST['email'].'@epitech.eu>' . "\r\n";
		$headers .= 'From: KeePi  <info@keepi.fr>' . "\r\n";

		if ($bdd->addRegistration($to))
		{
			if (mail($to, $subject, $message, $headers))
			{
				$headers2 = 'MIME-Version: 1.0' . "\r\n";
				$headers2 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers2 .= 'To: KeePi <info@keepi.fr>' . "\r\n";
				$headers2 .= 'From: KeePi <info@keepi.fr>' . "\r\n";
				mail("info@keepi.fr", "New submission", $message, $headers2);
				$response = 'ok';
			}
			else
			{
				$response = 'error mail';
			}
		} else {
			$response = 'already';
		}
    } else {
        $response = 'empty fields';
    }
} else {
    $response = 'error';
}
 
$array['response'] = $response;
echo json_encode($array);
?>