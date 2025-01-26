<?php

// Include the configuration file for database connection
include dirname(__DIR__,2) . '/config.php';

header('Content-Type: application/json');

try {
    // Decode the raw POST data
    $data = json_decode(file_get_contents('php://input'), true);
    if (!$data) {
        throw new Exception('Invalid or missing input data.');
    }

    // Check if 'chatHistory' key is present and not empty
    $chatHistory = $data['chatHistory'] ?? [];
    if (empty($chatHistory)) {
        throw new Exception('No chat history provided.');
    }

    // Extract and validate user data from chat history
    $name = "";
    $phone = "";
    $email = "";

    foreach ($chatHistory as $entry) {
        if ($entry['question'] === 'What is your name?') {
            $name = $entry['answer'];
        } elseif ($entry['question'] === 'What is your phone number?') {
            $phone = $entry['answer'];
        } elseif ($entry['question'] === 'What is your email address?') {
            $email = $entry['answer'];
        }
    }

    // Validate phone number
    if (!preg_match('/^\d{10}$/', $phone)) {
        throw new Exception('Invalid phone number.');
    }

    // Validate email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email address.');
    }

    // Prepare data for database storage
    $chatHistoryJson = json_encode($chatHistory);

    // Prepare SQL query
    $stmt = $conn->prepare("INSERT INTO chat (history, name, phone, email, created_at) VALUES (?, ?, ?, ?, NOW())");
    if (!$stmt) {
        throw new Exception('Failed to prepare SQL statement.');
    }

    // Bind parameters and execute query
    $stmt->bind_param('ssss', $chatHistoryJson, $name, $phone, $email);
    if (!$stmt->execute()) {
        throw new Exception('Database insertion failed: ' . $stmt->error);
    }

    // Success response
    echo json_encode(['success' => true]);

    // Close the statement
    $stmt->close();

} catch (Exception $e) {
    // Error response
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
