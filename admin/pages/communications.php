<?php
include "../config.php";
include "../helpers.php";
delete_data_message();

// Fetch all chat data from the database
$query = "SELECT id, history, created_at FROM chat";
$result = $conn->query($query);

// Prepare data for the table
$communications = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $history = json_decode($row['history'], true); // Decode JSON history

        // Extract name, phone, and email from chat history
        $name = '';
        $phone = '';
        $email = '';
        foreach ($history as $entry) {
            if ($entry['question'] === 'What is your name?') {
                $name = $entry['answer'];
            } elseif ($entry['question'] === 'What is your phone number?') {
                $phone = $entry['answer'];
            } elseif ($entry['question'] === 'What is your email address?') {
                $email = $entry['answer'];
            }
        }

        // Validate phone number (should be 10 digits)
        if (!preg_match('/^[0-9]{10}$/', $phone)) {
            $phone = 'N/A'; // If invalid, set to N/A
        }

        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = 'N/A'; // If invalid, set to N/A
        }

        // Only add to the communications array if phone and email are valid (not N/A)
        if ($phone !== 'N/A' && $email !== 'N/A') {
            $communications[] = [
                'id' => $row['id'],
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'date' => $row['created_at']
            ];
        }
    }
}
?>

<?php if (!empty($communications)) : ?>
    <table id="smsTable" class="table table-striped table-hover">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Sender Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Chat Date</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($communications as $i => $record) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($i + 1); ?></td>
                    <td><?php echo htmlspecialchars($record['name']); ?></td>
                    <td><?php echo htmlspecialchars($record['email']); ?></td>
                    <td><?php echo htmlspecialchars($record['phone']); ?></td>
                    <td><?php echo htmlspecialchars($record['date']); ?></td>
                    <td>
                        <li style="color: red; list-style: none; cursor: pointer;" onclick="confirmDelete(<?php echo $record['id']; ?>, 'delete_communication')">
                            <i class="fa-solid fa-delete-left"></i>
                        </li>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <p class="no-data">No AI Chat records found.</p>
<?php endif; ?>
