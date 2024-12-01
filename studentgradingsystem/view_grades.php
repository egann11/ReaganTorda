<?php
include_once("config.php");

$student_id = $_GET['id'];
$student = mysqli_query($con, "SELECT * FROM students WHERE id=$student_id")->fetch_assoc();
$grades = mysqli_query($con, "SELECT * FROM grades WHERE student_id=$student_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades for <?php echo htmlspecialchars($student['name']); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            font-size: 14px;
        }

        a {
            text-decoration: none;
            color: #007BFF;
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Grades for <?php echo htmlspecialchars($student['name']); ?></h2>

    <table>
        <thead>
            <tr>
                <th>Subject</th>
                <th>Grade</th>
                <th>Teacher</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($grade = mysqli_fetch_array($grades)): ?>
                <?php
                $teacher_query = mysqli_query($con, "SELECT name FROM teachers WHERE id={$grade['teacher_id']}");
                $teacher_name = ($teacher_query && mysqli_num_rows($teacher_query) > 0) ? mysqli_fetch_assoc($teacher_query)['name'] : 'Unknown';
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($grade['subject']); ?></td>
                    <td><?php echo htmlspecialchars($grade['grade']); ?></td>
                    <td><?php echo htmlspecialchars($teacher_name); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="index.php" class="back-link">Back</a>
</div>

</body>
</html>
