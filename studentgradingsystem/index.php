<?php
include_once("config.php");

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$result = mysqli_query($con, "SELECT * FROM students");
if (!$result) {
    die("Error fetching students: " . mysqli_error($con));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Student Grading System</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: #ecf0f1;
            height: 100%;
            position: fixed;
            display: flex;
            flex-direction: column;
            padding: 20px 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .sidebar a {
            text-decoration: none;
            color: #ecf0f1;
            font-size: 18px;
            padding: 12px 20px;
            display: block;
            margin-bottom: 10px;
            transition: background-color 0.3s;
            border-radius: 4px;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            overflow-y: auto;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 28px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td a {
            color: #2980b9;
            text-decoration: none;
            font-size: 14px;
        }

        td a:hover {
            text-decoration: underline;
        }

        .actions a {
            margin-right: 10px;
            color: #e74c3c;
        }

        .actions a:hover {
            color: #c0392b;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .content {
                margin-left: 200px;
                width: calc(100% - 200px);
            }
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Menu</h2>
        <a href="index.php">Dashboard</a>
        <a href="manage_teachers.php">Manage Teachers</a>
        <a href="addstudent.php">Add Student</a>
        <a href="add_grade.php">Add Grade</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="content">
        <h1>Student Grading System Dashboard</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>View Grades</th>
                    <th>Actions</th>
 </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_array($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['age']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                        <td><a href="view_grades.php?id=<?php echo $row['id']; ?>">View Grades</a></td>
                        <td class="actions">
                            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                            <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>
</html>