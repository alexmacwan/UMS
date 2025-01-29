<?php
// Database connection
$db = new mysqli('localhost', 'root', '', 'uni');
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Create (Insert) new feedback
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_GET['action'])) {
    $sql = "INSERT INTO feedback (
        satisfaction_with_faculties,
        satisfaction_with_teaching,
        doubts_cleared,
        satisfaction_with_notes
    ) VALUES (?, ?, ?, ?)";
    
    $stmt = $db->prepare($sql);
    $stmt->bind_param('ssss', 
        $_POST['q1_1'],
        $_POST['q1_2'],
        $_POST['q2'],
        $_POST['q1_3']
    );
    
    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    }
}

// Update existing feedback
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'update') {
    $sql = "UPDATE feedback SET 
        satisfaction_with_faculties = ?,
        satisfaction_with_teaching = ?,
        doubts_cleared = ?,
        satisfaction_with_notes = ?
        WHERE id = ?";
    
    $stmt = $db->prepare($sql);
    $stmt->bind_param('ssssi', 
        $_POST['q1_1'],
        $_POST['q1_2'],
        $_POST['q2'],
        $_POST['q1_3'],
        $_GET['id']
    );
    
    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    }
}

// Read (Display) single feedback
if (isset($_GET['action']) && $_GET['action'] === 'view') {
    $sql = "SELECT * FROM feedback WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('i', $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $feedback = $result->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="feed.css">
        <title>Feedback Details</title>
    </head>
    <body>
        <div class="container">
            <h1>Feedback Details</h1>
            <p>Satisfaction with Faculties: <?= $feedback['satisfaction_with_faculties'] ?></p>
            <p>Satisfaction with Teaching: <?= $feedback['satisfaction_with_teaching'] ?></p>
            <p>Doubts Cleared: <?= $feedback['doubts_cleared'] ?></p>
            <p>Satisfaction with Notes: <?= $feedback['satisfaction_with_notes'] ?></p>
            <a href="index.php">Back to Feedback List</a>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Edit form for feedback
if (isset($_GET['action']) && $_GET['action'] === 'edit') {
    $sql = "SELECT * FROM feedback WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('i', $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $feedback = $result->fetch_assoc();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="feed.css">
        <title>Edit Feedback</title>
    </head>
    <body>
        <div class="container">
            <h1>Edit Feedback</h1>
            <form method="POST" action="index.php?action=update&id=<?= $feedback['id'] ?>">
                <div class="question">
                    <p>1. How satisfied are you with your faculties?</p>
                    <label><input type="radio" name="q1_1" value="very_satisfied" <?= $feedback['satisfaction_with_faculties'] === 'very_satisfied' ? 'checked' : '' ?>> Very Satisfied</label>
                    <label><input type="radio" name="q1_1" value="satisfied" <?= $feedback['satisfaction_with_faculties'] === 'satisfied' ? 'checked' : '' ?>> Satisfied</label>
                    <label><input type="radio" name="q1_1" value="neutral" <?= $feedback['satisfaction_with_faculties'] === 'neutral' ? 'checked' : '' ?>> Neutral</label>
                    <label><input type="radio" name="q1_1" value="dissatisfied" <?= $feedback['satisfaction_with_faculties'] === 'dissatisfied' ? 'checked' : '' ?>> Dissatisfied</label>
                    <label><input type="radio" name="q1_1" value="very_dissatisfied" <?= $feedback['satisfaction_with_faculties'] === 'very_dissatisfied' ? 'checked' : '' ?>> Very Dissatisfied</label>
                </div>
                <!-- Add similar radio button groups for the other questions -->
                <input type="submit" value="Update Feedback">
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Delete feedback
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $sql = "DELETE FROM feedback WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('i', $_GET['id']);
    
    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    }
}

// Display the feedback list
$sql = "SELECT * FROM feedback ORDER BY created_at DESC";
$result = $db->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="feed.css">
    <title>Feedback List</title>
</head>
<body>
    <div class="container">
        <h1>Feedback List</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Satisfaction with Faculties</th>
                    <th>Satisfaction with Teaching</th>
                    <th>Doubts Cleared</th>
                    <th>Satisfaction with Notes</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($feedback = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($feedback['id']) ?></td>
                    <td><?= htmlspecialchars($feedback['satisfaction_with_faculties']) ?></td>
                    <td><?= htmlspecialchars($feedback['satisfaction_with_teaching']) ?></td>
                    <td><?= htmlspecialchars($feedback['doubts_cleared']) ?></td>
                    <td><?= htmlspecialchars($feedback['satisfaction_with_notes']) ?></td>
                    <td><?= htmlspecialchars($feedback['created_at']) ?></td>
                    <td>
                        <a href="index.php?action=view&id=<?= $feedback['id'] ?>">View</a>
                        <a href="index.php?action=edit&id=<?= $feedback['id'] ?>">Edit</a>
                        <a href="index.php?action=delete&id=<?= $feedback['id'] ?>" 
                           onclick="return confirm('Are you sure you want to delete this feedback?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="feeed.php" class="btn">New Feedback</a>
    </div>
</body>
</html>