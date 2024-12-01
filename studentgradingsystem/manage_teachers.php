<?php
include_once("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teacher_name = mysqli_real_escape_string($con, $_POST['teacher_name']);
    $teacher_subject = mysqli_real_escape_string($con, $_POST['teacher_subject']);

    $query = "INSERT INTO teachers (name, subject) VALUES ('$teacher_name', '$teacher_subject')";
    $result = mysqli_query($con, $query);
    $message = $result ? "Teacher added successfully!" : "Error adding teacher: " . mysqli_error($con);
}


if (isset($_GET['delete'])) {
    $teacher_id = intval($_GET['delete']);
    $delete_query = "DELETE FROM teachers WHERE id=$teacher_id";
    $delete_result = mysqli_query($con, $delete_query);

    $message = $delete_result ? "Teacher deleted successfully!" : "Error deleting teacher: " . mysqli_error($con);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Teachers</title>
    <style>
        /
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            text-align: center;
            color: #4CAF50;
        }
        .message {
            text-align: center;
            font-size: 16px;
            margin: 15px 0;
            color: #333;
        }
        .message.success {
            color: #4CAF50;
        }
        .message.error {
            color: #d9534f;
        }
        form label {
            font-size: 16px;
            display: block;
            margin-bottom: 8px;
        }
        form input[type="text"], form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #45a049;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #4CAF50;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tr:hover {
            background-color: #f1f1f1;
        }
        .action-buttons a {
            text-decoration: none;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            margin-right: 5px;
        }
        .action-buttons .edit {
            background-color: #007BFF;
        }
        .action-buttons .delete {
            background-color: #d9534f;
        }

        
        .back-link {
            display: inline-block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
            width: fit-content;
        }
        .back-link:hover {
            background-color: #45a049;
        }
        .back-container {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Manage Teachers</h2>

    
    <?php if (isset($message)): ?>
        <p class="message <?php echo isset($result) && $result || isset($delete_result) && $delete_result ? 'success' : 'error'; ?>">
            <?php echo htmlspecialchars($message); ?>
        </p>
    <?php endif; ?>

    <form method="POST">
        <label for="teacher_name">Teacher Name:</label>
        <input type="text" name="teacher_name" placeholder="Enter teacher's name" required>

        <label for="teacher_subject">Subject:</label>
        <input type="text" name="teacher_subject" placeholder="Enter teacher's subject" required>

        <input type="submit" value="Add Teacher">
    </form>

    
    <h3>Existing Teachers</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Subject</th>
            <th>Actions</th>
        </tr>
        <?php
        $teachers = mysqli_query($con, "SELECT * FROM teachers");
        while ($teacher = mysqli_fetch_assoc($teachers)): ?>
            <tr>
                <td><?php echo $teacher['id']; ?></td>
                <td><?php echo htmlspecialchars($teacher['name']); ?></td>
                <td><?php echo htmlspecialchars($teacher['subject']); ?></td>
                <td class="action-buttons">
                    <a href="edit_teacher.php?id=<?php echo $teacher['id']; ?>" class="edit">Edit</a>
                    <a href="?delete=<?php echo $teacher['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this teacher?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <div class="back-container">
        <a href="index.php" class="back-link">Back to Home</a>
    </div>
</div>
</body>
</html>