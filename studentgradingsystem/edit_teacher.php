<?php
include_once("config.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_GET['id'])) {
    $teacher_id = intval($_GET['id']);
    $query = "SELECT * FROM teachers WHERE id = $teacher_id";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $teacher = mysqli_fetch_assoc($result);
    } else {
        die("Error: Teacher not found or query failed.");
    }
} else {
    die("Error: Teacher ID is missing in the request.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_teacher'])) {
    $teacher_name = mysqli_real_escape_string($con, $_POST['teacher_name']);
    $teacher_subject = mysqli_real_escape_string($con, $_POST['teacher_subject']);

    $update_query = "UPDATE teachers SET name='$teacher_name', subject='$teacher_subject' WHERE id=$teacher_id";
    $update_result = mysqli_query($con, $update_query);

    if ($update_result) {
        echo "<div class='message success'>Teacher updated successfully!</div>";
        header("refresh:2;url=manage_teachers.php");
        exit;
    } else {
        echo "<div class='message error'>Error updating teacher: " . mysqli_error($con) . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Teacher</title>
    <style>
        
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #4CAF50;
        }
        .message {
            text-align: center;
            font-size: 16px;
            margin: 15px 0;
        }
        .message.success {
            color: #4CAF50;
        }
        .message.error {
            color: #d9534f;
        }

        form label {
            display: block;
            font-size: 16px;
            margin-bottom: 8px;
            color: #333;
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

        
        .back-container {
            text-align: center;
            margin-top: 20px;
        }
        .back-link {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 4px;
        }
        .back-link:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Teacher</h2>

        <form method="POST" action="">
            <label for="teacher_name">Teacher Name:</label>
            <input type="text" name="teacher_name" value="<?php echo isset($teacher['name']) ? htmlspecialchars($teacher['name']) : ''; ?>" required>

            <label for="teacher_subject">Subject:</label>
            <input type="text" name="teacher_subject" value="<?php echo isset($teacher['subject']) ? htmlspecialchars($teacher['subject']) : ''; ?>" required>

            <input type="submit" name="update_teacher" value="Update Teacher">
        </form>

        <div class="back-container">
            <a href="manage_teachers.php" class="back-link">Back to Manage Teachers</a>
        </div>
    </div>
</body>
</html>
