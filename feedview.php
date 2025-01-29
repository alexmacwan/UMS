<?php
$db = new mysqli('localhost', 'root', '', 'ums');
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

$result = $db->query("SELECT * FROM feedback ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="feedvi.css">
    <title>View Feedback</title>
</head>
<body>
    <div class="container">
        <h1>All Feedback</h1>
        <a href="feeed.php" class="btn">Add New Feedback</a>
        
        <table class="feedback-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Faculties</th>
                    <th>Teaching</th>
                    <th>Doubts</th>
                    <th>Notes</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['satisfaction_with_faculties']) ?></td>
                    <td><?= htmlspecialchars($row['satisfaction_with_teaching']) ?></td>
                    <td><?= htmlspecialchars($row['doubts_cleared']) ?></td>
                    <td><?= htmlspecialchars($row['satisfaction_with_notes']) ?></td>
                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                    <td>
                        <a href="feeed.php?action=edit&id=<?= $row['id'] ?>" class="btn-edit">Edit</a>
                        <a href="feeed.php?action=delete&id=<?= $row['id'] ?>" 
                           onclick="return confirm('Are you sure?')" class="btn-delete">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html> 