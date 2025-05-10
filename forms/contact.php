<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get form inputs
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Prepare email
    $to = "smilestonedentalclinic11@gmail.com";
    $email_subject = "New Enquiry: $subject";
    $email_body = "You have received a new enquiry from your website contact form.\n\n" .
                  "Name: $name\n" .
                  "Email: $email\n" .
                  "Subject: $subject\n\n" .
                  "Message:\n$message";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Try to send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        // Send success response as JSON
        echo json_encode(['status' => 'success', 'message' => 'Your message has been sent. Thank you!']);
    } else {
        // Send error response as JSON
        echo json_encode(['status' => 'error', 'message' => 'Message could not be sent. Please try again.']);
    }
}
?>
