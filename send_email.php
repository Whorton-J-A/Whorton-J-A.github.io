<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate that fields are not empty
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "Please fill in all the fields.";
        exit;
    }

    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address.";
        exit;
    }

    // Set the recipient email address
    $to = "miawhorton@gmail.com"; 

    // Set email subject and headers
    $email_subject = "Contact Form: $subject";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Create the email body
    $email_body = "
    <html>
    <body>
    <h2>Contact Form Submission</h2>
    <p><strong>Name:</strong> $name</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Subject:</strong> $subject</p>
    <p><strong>Message:</strong></p>
    <p>$message</p>
    </body>
    </html>
    ";

    // Attempt to send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Thank you, your message has been sent!";
    } else {
        echo "Sorry, something went wrong. Please try again later.";
    }
} else {
    // If accessed without form submission
    echo "Invalid request method.";
}
?>
