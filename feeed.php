<?php
// Database connection
$db = new mysqli('localhost', 'root', '', 'ums');
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Initialize variables
$feedback = [
    'satisfaction_with_faculties' => '',
    'satisfaction_with_teaching' => '',
    'doubts_cleared' => '',
    'satisfaction_with_notes' => ''
];
$isEdit = false;

// Read - Get feedback for editing
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $isEdit = true;
    $stmt = $db->prepare("SELECT * FROM feedback WHERE id = ?");
    $stmt->bind_param('i', $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $feedback = $row;
    }
}

// Create or Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $feedback = [
        'satisfaction_with_faculties' => $_POST['q1_1'] ?? null,
        'satisfaction_with_teaching' => $_POST['q1_2'] ?? null,
        'doubts_cleared' => $_POST['q2'] ?? null,
        'satisfaction_with_notes' => $_POST['q1_3'] ?? null,
    ];
    
    // Update existing feedback
    if (isset($_POST['id'])) {
        $sql = "UPDATE feedback SET 
            satisfaction_with_faculties = ?,
            satisfaction_with_teaching = ?,
            doubts_cleared = ?,
            satisfaction_with_notes = ?
            WHERE id = ?";
        
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ssssi', 
            $feedback['satisfaction_with_faculties'],
            $feedback['satisfaction_with_teaching'],
            $feedback['doubts_cleared'],
            $feedback['satisfaction_with_notes'],
            $_POST['id']
        );
    } 
    // Create new feedback
    else {
        $sql = "INSERT INTO feedback (
            satisfaction_with_faculties,
            satisfaction_with_teaching,
            doubts_cleared,
            satisfaction_with_notes
        ) VALUES (?, ?, ?, ?)";
        
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ssss', 
            $feedback['satisfaction_with_faculties'],
            $feedback['satisfaction_with_teaching'],
            $feedback['doubts_cleared'],
            $feedback['satisfaction_with_notes']
        );
    }
    
    if ($stmt->execute()) {
        header("Location: feedview.php");
        exit;
    } else {
        $error = "Error: " . $stmt->error;
    }
}

// Delete
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $stmt = $db->prepare("DELETE FROM feedback WHERE id = ?");
    $stmt->bind_param('i', $_GET['id']);
    if ($stmt->execute()) {
        header("Location: feedview.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="feed1.css">
    <title><?= htmlspecialchars($isEdit ? 'Edit Feedback' : 'Feedback Form') ?></title>
</head>
<body>
    <div class="container">
        <h1><?= htmlspecialchars($isEdit ? 'Edit Feedback' : 'Feedback Form') ?></h1>
        <?php if (isset($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <?php if ($isEdit): ?>
                <input type="hidden" name="id" value="<?= htmlspecialchars($feedback['id']) ?>">
            <?php endif; ?>
            <div class="question">
            <label for="bloodgroup">--:SELECT FACULTY:--</label>
            <select id="bloodgroup" name="bloodgroup" required>
                <option value="">Prof. Ayiesha</option>
                <option value="A+">Prof. Twinkle Modi</option>
                <option value="A-">Prof. Satyendra</option>
                <option value="B+">Prof. Pratima</option>
                <option value="B-">Prof. Pragati </option> 
           </select>
                <p>1. How satisfied are you with your faculties?</p> <br>
                <?php
                $options = ['very_satisfied', 'satisfied', 'neutral', 'dissatisfied', 'very_dissatisfied'];
                foreach ($options as $option) {
                    $checked = ($feedback['satisfaction_with_faculties'] === $option) ? 'checked' : '';
                    echo "<label><input type='radio' name='q1_1' value='$option' $checked> " . 
                         ucwords(str_replace('_', ' ', $option)) . "</label><br>";
                }
                ?>
            </div>

            <div class="question">
                <p>2. How satisfied are you with your faculties' teaching methods?</p>
                <?php
                foreach ($options as $option) {
                    $checked = ($feedback['satisfaction_with_teaching'] === $option) ? 'checked' : '';
                    echo "<label><input type='radio' name='q1_2' value='$option' $checked> " . 
                         ucwords(str_replace('_', ' ', $option)) . "</label><br>";
                }
                ?>
            </div>

            <div class="question">
                <p>3. Are your doubts cleared within the class?</p>
                <?php
                $options = ['definitely', 'probably', 'not_sure', 'probably_not', 'definitely_not'];
                foreach ($options as $option) {
                    $checked = ($feedback['doubts_cleared'] === $option) ? 'checked' : '';
                    echo "<label><input type='radio' name='q2' value='$option' $checked> " . 
                         ucwords(str_replace('_', ' ', $option)) . "</label><br>";
                }
                ?>
            </div>

            <div class="question">
                <p>4. How satisfied are you with the notes provided?</p>
                <?php
                foreach ($options as $option) {
                    $checked = ($feedback['satisfaction_with_notes'] === $option) ? 'checked' : '';
                    echo "<label><input type='radio' name='q1_3' value='$option' $checked> " . 
                         ucwords(str_replace('_', ' ', $option)) . "</label><br>";
                }
                ?>
            </div>
            <input type="submit" value="<?= htmlspecialchars($isEdit ? 'Update Feedback' : 'Submit Feedback') ?>">
        </form>
    </div>
</body>
</html>