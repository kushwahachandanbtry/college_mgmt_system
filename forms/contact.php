<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and retrieve form inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Admin email to receive the form
    $to = "panditramjalamkumar@gmail.com";

    // Construct the email subject and message body
    $emailSubject = "New Contact Form Submission: " . $subject;
    $emailBody = "
        You have received a new message from the contact form:

        Name: $name
        Email: $email
        Subject: $subject
        Message:
        $message
    ";

    // Email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Attempt to send the email
    if (mail($to, $emailSubject, $emailBody, $headers)) {
        echo "success"; // You can return this to indicate success
    } else {
        echo "error"; // Return an error if the mail fails
    }
} else {
    // Redirect to the form page if accessed directly
    header("Location: ../index.php");
    exit;
}
?>
