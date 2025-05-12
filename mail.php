<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Your email address
    $toEmail = "shaziyas.vsbizz@gmail.com";

    // Google reCAPTCHA secret key
    $secretKey = "6LcHxu8qAAAAAP8MX8tBJbbZTogO2Z3s7MC1w47C";

    // Get reCAPTCHA response from the form
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Verify reCAPTCHA
    $verifyURL = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse";
    $response = file_get_contents($verifyURL);
    $responseData = json_decode($response);

    if (!$responseData->success) {
        echo json_encode(["status" => "error", "message" => "reCAPTCHA verification failed."]);
        exit;
    }

    // Collect and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $serviceType = isset($_POST['service_type']) ? htmlspecialchars(trim($_POST['service_type'])) : "Not Provided";
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate required fields
    if (empty($name) || empty($phone) || empty($message) || empty($serviceType)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit;
    }

    // Prepare email content
    $subject = "New Inquiry Received";
    $body = "You have received a new inquiry:\n\n" .
            "Name: $name\n" .
            "Phone: $phone\n" .
            "Service Type: $serviceType\n" .
            "Message: \n$message";

    $headers = "From: hassonjeeautomotive.com\r\n";
    $headers .= "Reply-To: hassonjeeautomotive.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email
    if (mail($toEmail, $subject, $body, $headers)) {
        echo json_encode(["status" => "success", "message" => "Thank you! Your request has been sent successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Sorry, there was an issue sending your request. Please try again later."]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>
