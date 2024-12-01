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


if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $address = mysqli_real_escape_string($con, $_POST['address']);

    
    $updateQuery = "UPDATE students SET name='$name', age='$age', email='$email', address='$address' WHERE id=$id";
    $result = mysqli_query($con, $updateQuery);

    if ($result) {
        
        header("Location: index.php");
    } else {
        die("Error updating student: " . mysqli_error($con));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
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
        }

        h1 {
            text-align: center;
            color: #34A853;
        }

        label {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"], input[type="number"], input[type="email"], textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #34A853;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #2C8E4B;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            color: #34A853;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Edit Student Details</h1>
    <form action="" method="post">
        
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($res['name']); ?>" required><br>
        
       
        <label for="age">Age:</label>
        <input type="number" name="age" value="<?php echo htmlspecialchars($res['age']); ?>" required><br>
        
       
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($res['email']); ?>" required><br>
        
        <label for="address">Address:</label>
        <textarea name="address" required><?php echo htmlspecialchars($res['address']); ?></textarea><br>

      
        <input type="submit" name="update" value="Update Student">
    </form>

 
    <a href="index.php">Back to Students List</a>
</div>

</body>
</html>
