<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $err = "";
    $recipient = 'cesard@fixaplace.com'; // Your email address where you want to receive the form data
    $subject = 'New Form Submission';
    
    if (empty(message)||empty(email)||empty(name)) {
    $err = "Please don't leave any fields empty.";
    }

    if (!empty($_POST["name"])) {
        $name = test_input($_POST["name"]);
        // Check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        $err = "Only letters and white space allowed";
        }
    }
    if (!empty($_POST["email"])) {
        $email = filter_var(test_input($_POST["email"]), FILTER_SANITIZE_EMAIL);
        // Check if the e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $err = "Invalid email format";
        }
    }
    $message = test_input($_POST['message']);

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $mailBody = "Name: $name<br>";
    $mailBody .= "Email: $email<br>";
    $mailBody .= "Message: $message<br>";
    
    
    
    
    if ($err == "" && mail($recipient, $subject, $mailBody, $headers)) {
        echo '<p>Thank you for contacting us. Your message has been sent successfully.</p>';
    } else {
        echo '<p>'.$err.'</p>';
    }
} else {
    echo '<p>Invalid request.</p>';
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
