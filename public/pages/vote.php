<?php
session_start();
include dirname(__DIR__, 2) . '/config.php';
header('Content-Type: application/json');

// Check if the request method is POST and the required parameter is present
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'redirect' => true, 'message' => 'User not logged in']);
        exit;
    }

    $userId = intval($_SESSION['user_id']); // Get the logged-in user's ID
    $commentId = intval($_POST['id']); // Get the comment ID

    // Validate the comment ID
    if ($commentId <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid comment ID']);
        exit;
    }

    // Check if the user has already voted for this comment
    $checkVote = "SELECT * FROM votes WHERE user_id = ? AND comment_id = ?";
    $stmt = $conn->prepare($checkVote);
    $stmt->bind_param("ii", $userId, $commentId);
    $stmt->execute();
    $voteExists = $stmt->get_result()->num_rows > 0;

    if ($voteExists) {
        // If the user has already voted, remove their vote
        $deleteVote = "DELETE FROM votes WHERE user_id = ? AND comment_id = ?";
        $stmt = $conn->prepare($deleteVote);
        $stmt->bind_param("ii", $userId, $commentId);
        $stmt->execute();
        $userVoted = false;
    } else {
        // If the user hasn't voted, add their vote
        $addVote = "INSERT INTO votes (user_id, comment_id) VALUES (?, ?)";
        $stmt = $conn->prepare($addVote);
        $stmt->bind_param("ii", $userId, $commentId);
        $stmt->execute();
        $userVoted = true;
    }

    // Get the updated vote count for the comment
    $getVoteCount = "SELECT COUNT(*) AS count FROM votes WHERE comment_id = ?";
    $stmt = $conn->prepare($getVoteCount);
    $stmt->bind_param("i", $commentId);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    echo json_encode([
        'success' => true,
        'newCount' => $result['count'],
        'userVoted' => $userVoted
    ]);
    exit;
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}
?>

