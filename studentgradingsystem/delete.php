<?php
include_once("config.php");


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $result = mysqli_query($con, "SELECT * FROM students WHERE id=$id");
    $res = mysqli_fetch_array($result);

    if (!$res) {
        die("Student not found.");
    }
}

if (isset($_POST['delete'])) {
    
    $deleteQuery = "DELETE FROM students WHERE id=$id";
    mysqli_query($con, $deleteQuery);

   
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #D9534F;
        }

        p {
            font-size: 18px;
            color: #555;
        }

        .btn {
            background-color: #D9534F;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #C9302C;
        }

        a {
            display: block;
            margin-top: 20px;
            color: #34A853;
            font-size: 16px;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Are you sure you want to delete this student?</h1>
        <p>Student: <?php echo $res['name']; ?> (ID: <?php echo $res['id']; ?>)</p>

        <form action="" method="post">
            <input type="submit" name="delete" class="btn" value="Yes, Delete">
        </form>

        <a href="index.php">Cancel</a>
    </div>

</body>
</html>
