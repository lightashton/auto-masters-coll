<?php
function sendMail(){
    $email=$_POST["email_address"];
    $name=$_POST["name"];
    $phone_number=$_POST["phone_number"];
    $msg=$_POST["your_message"];
    $verif_box=$_POST["verif_box"];
    


// Checking For Blank Fields..
if($email=="" || $name =="" || $phone_number=="" || $msg=="" || $verif_box==""){
echo "Fill All Fields..";
}else{
// Check if the "Sender's Email" input field is filled out
// Sanitize E-mail Address
$email =filter_var($email, FILTER_SANITIZE_EMAIL);
// Validate E-mail Address
$email= filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$email){
echo "Invalid Sender's Email";
}
else{
$subject = "Auto Masters Collision";
  $message = '

<html>

<head>

<title>ATTENTION:  WEB FORM FOR BANKRUPTCY SERVICE REQUESTED</title>

</head>

<body>

  <p>Hi,<br />
  You have new enquiry

  </p>

  <table>

        <tr>

      <td>Name: </td><td>'.$name.'</td>

    </tr>

  <tr>

      <td>Contact Number: </td><td>'.$phone_number.'</td>

    </tr>
   <tr>

      <td>Email Address: </td><td>'.$email.'</td>

    </tr>

  <tr>

      <td>Message: </td><td>'.$msg.'</td>

    </tr>

    

  </table>

</body>

</html>

';
//   $message = "Name: $name\n";
//     $message .= "Email: $email\n\n";
//     $message.= "Phone: $phone_number\n";
//     $message .= "Message:\n$msg\n";


$headers = "$name = $name;" . "\r\n";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <admin@automasterscoll.com>' . "\r\n"; // Sender's Email // Carbon copy to Sender
// Message lines should not exceed 70 characters (PHP rule), so wrap it
$message = wordwrap($message, 70);
// Send Mail By PHP Mail Function
if( mail("automasterscollision2021@gmail.com", $subject, $message,  $headers)){
echo "Your mail has been sent successfuly ! Thank you for your feedback";
}
else{
    echo "Error in sending Mail";
}
}
}


}
if(1==1){
 sendMail();
}
$recaptcha = $_POST['g-recaptcha-response'];
$res = reCaptcha($recaptcha);
if($res['success']){
  // Send email
}else{
  // Error
}

function reCaptcha($recaptcha){
  $secret = "YOUR SECRET KEY";
  $ip = $_SERVER['REMOTE_ADDR'];

  $postvars = array("secret"=>$secret, "response"=>$recaptcha, "remoteip"=>$ip);
  $url = "https://www.google.com/recaptcha/api/siteverify";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
  $data = curl_exec($ch);
  curl_close($ch);

  return json_decode($data, true);
}


?>