<?php
include_once("config.php");

if (isset($_GET['subject'])) {
    $subject = mysqli_real_escape_string($con, $_GET['subject']);

   
    $query = "SELECT id, name FROM teachers WHERE subject = '$subject'";
    $result = mysqli_query($con, $query);

    $teachers = [];
    while ($teacher = mysqli_fetch_assoc($result)) {
        $teachers[] = $teacher;
    }

    echo json_encode($teachers);
}
?>
