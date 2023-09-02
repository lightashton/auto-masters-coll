<?php 


$errors = '';
$myemail = 'info@prontocarglass.com';//<-----Put Your email address here.
if(empty($_POST['full_name'])  || 
   empty($_POST['full_email']) || 
   empty($_POST['phone_num']) || 
   empty($_POST['full_message']))
{
    $errors .= "\n Error: all fields are required";
}

$name = $_POST['full_name']; 
$email_address = $_POST['full_email']; 
$phone = $_POST['phone_num']; 
$message = $_POST['full_message']; 



if (!preg_match(
"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", 
$email_address))
{
    $errors .= "\n Error: Invalid email address";
}

if( empty($errors))
{
	$to = $myemail; 
	$email_subject = "Contact form submission: $name";
	$email_body = "You have received a new message.  \n".
	" Here are the details:\n Name: $name \n Email: $email_address  \n Phone Number: $phone  \n Message:  $message"; 
	
	$headers = "From: $myemail\n"; 
	$headers .= "Reply-To: $email_address";
	
	mail($to,$email_subject,$email_body,$headers);
	//redirect to the 'thank you' page
	header('Location: thank-you');
} 
?>
<!DOCTYPE HTML> 
<html>
<head>
	<title>Contact form handler</title>
</head>

<body>
<!-- This page is displayed only if there is some error -->
<?php
echo nl2br($errors);
?>


</body>
</html>