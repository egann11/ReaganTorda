<?php
include_once("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $student_id = (int) $_POST['student_id']; 
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $grade = mysqli_real_escape_string($con, $_POST['grade']);
    $teacher_id = (int) $_POST['teacher_id']; 

   
    if (empty($subject) || empty($grade)) {
        $message = "Subject and grade cannot be empty.";
        $message_class = "error";
    } else {
        
        $result = mysqli_query($con, "INSERT INTO grades (student_id, subject, grade, teacher_id) VALUES ('$student_id', '$subject', '$grade', '$teacher_id')");

        if ($result) {
            $message = "Grade for {$subject} added successfully for student ID {$student_id}!";
            $message_class = "success";
        } else {
            $message = "Error adding grade.";
            $message_class = "error";
        }
    }
}


$students = mysqli_query($con, "SELECT * FROM students");
$teachers = mysqli_query($con, "SELECT * FROM teachers");
$subjects = mysqli_query($con, "SELECT DISTINCT subject FROM teachers");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Grade</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 14px;
            margin-bottom: 8px;
            color: #555;
        }

        select, input[type="text"] {
            padding: 10px;
            font-size: 14px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            text-align: center;
            display: block;
            margin-top: 15px;
            text-decoration: none;
            color: #007BFF;
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline;
        }

        .message {
            text-align: center;
            font-size: 16px;
            margin: 15px 0;
        }

        .success {
            color: #4CAF50;
        }

        .error {
            color: #d9534f;
        }
    </style>
    <script>
        function loadTeachers() {
            var subject = document.getElementById("subject").value;
            var teacherSelect = document.getElementById("teacher_id");

            
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "get_teachers.php?subject=" + subject, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var teachers = JSON.parse(xhr.responseText);
                    teacherSelect.innerHTML = "<option value=''>Select Teacher</option>"; 
                    teachers.forEach(function(teacher) {
                        var option = document.createElement("option");
                        option.value = teacher.id;
                        option.textContent = teacher.name;
                        teacherSelect.appendChild(option);
                    });
                }
            };
            xhr.send();
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Add Grade</h2>

    <?php if (isset($message)): ?>
        <div class="message <?php echo $message_class; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <label for="student_id">Select Student:</label>
        <select name="student_id" required>
            <?php while ($row = mysqli_fetch_array($students)) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
            } ?>
        </select><br>

        <label for="subject">Subject:</label>
        <select name="subject" id="subject" onchange="loadTeachers()" required>
            <option value="">Select Subject</option>
            <?php while ($row = mysqli_fetch_array($subjects)) {
                echo "<option value='{$row['subject']}'>{$row['subject']}</option>";
            } ?>
        </select><br>

        <label for="grade">Grade:</label>
        <input type="text" name="grade" required><br>

        <label for="teacher_id">Select Teacher:</label>
        <select name="teacher_id" id="teacher_id" required>
            <option value="">Select Teacher</option>
        </select><br>

        <input type="submit" value="Add Grade">
    </form>

    <a href="index.php">Back</a>
</div>

</body>
</html>
