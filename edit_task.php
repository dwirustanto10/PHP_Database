<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tasks WHERE id=$id";
    $result = $conn->query($sql);
    $task = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $task = $_POST['task'];
    $task_at = $_POST['task_at'];
    $sql = "UPDATE tasks SET task='$task', task_at='$task_at' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Task updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        .large-input {
            font-size: 24px;
            height: 40px;
            padding: 10px;
        }

        .large-button {
            font-size: 24px;
            height: 40px;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Edit Task</h1>
    </header>
    <?php include 'nav.php'; ?>
    <div class="container">
        <form method="POST" action="edit_task.php">
            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
            <input type="text" name="task" class="large-input" value="<?php echo $task['task']; ?>" required>
            <input type="datetime-local" name="task_at" class="large-input" value="<?php echo date('Y-m-d\TH:i', strtotime($task['task_at'])); ?>" required>
            <button type="submit" class="large-button">Update Task</button>
        </form>
    </div>
</body>
</html>