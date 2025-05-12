<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $toEmail = "shaziyas.vsbizz@gmail.com";

    // Collect and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $serviceType = isset($_POST['service_type']) ? htmlspecialchars(trim($_POST['service_type'])) : "Not Provided";
    $phone = htmlspecialchars(trim($_POST['phone']));
    $message = htmlspecialchars(trim($_POST['message']));
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Validate required fields
    if (empty($name) || empty($email) || empty($message) || empty($phone) || empty($serviceType) || empty($recaptchaResponse)) {
        echo json_encode(["status" => "error", "message" => "All fields are required, including reCAPTCHA verification."]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Invalid email address."]);
        exit;
    }

    // Verify Google reCAPTCHA
    $secretKey = "6LcHxu8qAAAAAP8MX8tBJbbZTogO2Z3s7MC1w47C";
    $verifyUrl = "https://www.google.com/recaptcha/api/siteverify";
    $response = file_get_contents($verifyUrl . "?secret=" . $secretKey . "&response=" . $recaptchaResponse);
    $responseKeys = json_decode($response, true);

    if (!$responseKeys["success"]) {
        echo json_encode(["status" => "error", "message" => "reCAPTCHA verification failed. Please try again."]);
        exit;
    }

    // Prepare email content
    $subject = "New Quote Request";
    $body = "You have received a new quote request:\n\n" .
            "Name: $name\n" .
            "Email: $email\n" .
            "Phone: $phone\n" .
            "Service Type: $serviceType\n" .
            "Message: \n$message";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email
    if (mail($toEmail, $subject, $body, $headers)) {
        echo json_encode([ "Thank you! Your request has been sent successfully."]);
    } else {
        echo json_encode(["Sorry, there was an issue sending your request. Please try again later."]);
    }
} else {
    echo json_encode(["Invalid request method."]);
}
?>
