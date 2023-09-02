<?php
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email_address'];
$phone = $_POST['phone_number'];
$vehicletype = $_POST['vehicle-type'];
$preferred_contact_method = $_POST['preferred-contact-method'];
$date = $_POST['date'];
$time = $_POST['time'];
$message = $_POST['your_message'];
$formcontent=" From: $fname $lname \n Phone: $phone \n Email: $email \n Vehicle Type: $vehicletype \n Preferred Contact Method: $preferred_contact_method \n What Time Would You Like to Drop Off Your Vehicle?: $date $time  \n Message: $message";
$recipient = "faisal.fkhn0011@gmail.com";
$recipient1 = "faisal.fkhn0011@gmail.com";
$subject = "ATTENTION ASHER: Website Lead";
$mailheader = "From: $email \r\n";
$verif_box = $_POST['verif_box'];
if ($verif_box=='8123')
{
mail($recipient, $subject, $formcontent, $mailheader)

 or die("Error!");
echo "Thank You!";
}
else 
{
echo "Verification image entered is wrong.";
}
?>