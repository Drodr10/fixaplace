<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipient = 'diegor010206@gmail.com'; // Your email address where you want to receive the form data
    $subject = 'New Form Submission';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $mailBody = "Name: $name<br>";
    $mailBody .= "Email: $email<br>";
    $mailBody .= "Message: $message<br>";

    if (mail($recipient, $subject, $mailBody, $headers)) {
        echo '<p>Thank you for contacting us. Your message has been sent successfully.</p>';
    } else {
        echo '<p>Sorry, there was an error sending your message. Please try again later.</p>';
    }
} else {
    echo '<p>Invalid request.</p>';
}
?>
