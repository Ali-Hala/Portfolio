<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Honeypot field check
    if (!empty($_POST['hidden_field'])) {
        die("Spam detected");
    }

    // Sanitize and validate input
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

    if ($name && $email && $message) {
        // Send email or save to database
        $to = "a3halabi@uwaterloo.ca"; // Replace with your email address
        $subject = "New Contact Form Submission";
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        $email_body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        if (mail($to, $subject, $email_body, $headers)) {
            echo "Message sent successfully!";
        } else {
            echo "Failed to send message.";
        }
    } else {
        echo "Invalid input";
    }
} else {
    echo "Invalid request method";
}
?>