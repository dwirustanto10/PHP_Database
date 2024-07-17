<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = $_POST['task'];
    $task_at = $_POST['task_at'];
    $sql = "INSERT INTO tasks (task, task_at) VALUES ('$task', '$task_at')";
    if ($conn->query($sql) === TRUE) {
        echo "New task task successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    header("Location: index.php");
}
?>