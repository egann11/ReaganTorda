<?php
include_once("config.php");

if (isset($_POST['Submit'])) { 
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    
    
    if (empty($name) || empty($age) || empty($email) || empty($address)) {
        $message = "All fields are required.";
    } else {
        
        $result = mysqli_query($con, "INSERT INTO students (name, age, email, address) VALUES ('$name', '$age', '$email', '$address')");
        
        if ($result) {
            $message = "Data added successfully!";
        } else {
            $message = "Error occurred while adding data. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
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

        .form-container {
            width: 50%;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 14px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .message {
            color: #d9534f;
            font-size: 16px;
            text-align: center;
            margin-bottom: 20px;
        }

        a {
            color: #007bff;
            text-decoration: none;
            text-align: center;
            display: block;
            margin-top: 20px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Student Registration Form</h1>
        
        <?php if (isset($message)): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        
        <form action="addstudent.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter name" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" required>

            <label for="age">Age:</label>
            <input type="text" id="age" name="age" placeholder="Enter age" value="<?php echo isset($age) ? htmlspecialchars($age) : ''; ?>" required>

            <label for="email">Email:</label>
            <input type="text" id="email" name="email" placeholder="Enter email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" required>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="Enter address" value="<?php echo isset($address) ? htmlspecialchars($address) : ''; ?>" required>

            <input type="submit" name="Submit" value="Register">
        </form>
        
        <a href="index.php">Back to Student List</a>
    </div>

</body>
</html>
