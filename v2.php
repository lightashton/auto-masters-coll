<?php 
  $name;$email_address;$your_message;$captcha;$phone_number;
  $name = filter_input(INPUT_POST, 'your_message', FILTER_SANITIZE_STRING);
  $email_address = filter_input(INPUT_POST, 'email_address', FILTER_VALIDATE_EMAIL);
  $your_message = filter_input(INPUT_POST, 'your_message', FILTER_SANITIZE_STRING);
  $phone_number = filter_input(INPUT_POST, 'phone_number', FILTER_SANITIZE_STRING);
  $captcha = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
  if(!$captcha){
    echo '
Please check the the captcha form.
';
    exit;
  }
  $secretKey = "6Le3QKshAAAAADHLv6e7ySQAXIT_mJnSwfEyLKop";
  $ip = $_SERVER['REMOTE_ADDR'];

  // post request to server
  $url = 'https://www.google.com/recaptcha/api/siteverify';
  $data = array('secret' => $secretKey, 'response' => $captcha);

  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  $context  = stream_context_create($options);
  $response = file_get_contents($url, false, $context);
  $responseKeys = json_decode($response,true);
  header('Content-type: application/json');
  if($responseKeys["success"]) {
    echo json_encode(array('success' => 'true'));
// automasterscollision2021@gmail.com

     # Recipient email
    //$mail_to = "info@rushax.com,info@rushax.io";
    $mail_to = "rashidupwork921@gmail.com";

    # Sender form data
    $subject = trim($_POST["subject"]);
    $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["name"])));
    $email_address = filter_var(trim($_POST["email_address"]), FILTER_SANITIZE_EMAIL);
    $phone_number = trim($_POST["phone_number"]);
    $your_message = trim($_POST["your_message"]);


    # Mail content
    $content = "Name: $name\n";
    $content .= "Email: $email_address\n\n";
    $content .= "Phone: $phone_number\n";
    $content .= "Message:\n$your_message\n";

    # Email headers
    $headers = "From: $name <$email>";

    # Send the email
    $success = mail($mail_to, $subject, $content, $headers);
    
    if ($success) {
      # Set a 200 (okay) response code
      http_response_code(200);
      echo '<p class="alert alert-success">Thank You! Your message has been successfully sent.</p>';
    } else {
      # Set a 500 (internal server error) response code
      http_response_code(500);
      echo '<p class="alert alert-warning">Something went wrong, your message could not be sent.</p>';
    }   




  } else {
    echo json_encode(array('success' => 'false'));
  }
?>