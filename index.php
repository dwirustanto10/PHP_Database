<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM tasks WHERE id=$id";
    $conn->query($sql);
    header("Location: index.php");
}

if (isset($_GET['complete'])) {
    $id = $_GET['complete'];
    $sql = "UPDATE tasks SET status=1 WHERE id=$id";
    $conn->query($sql);
    header("Location: index.php");
}

$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>To-Do List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header class="bg-dark text-white text-center py-3">
        <h1>To-Do List</h1>
    </header>
    <?php include 'nav.php'; ?>
    <div class="container mt-4">
        <form method="POST" action="add_task.php" class="mb-4">
            <div class="form-group">
                <input type="text" name="task" class="form-control form-control-lg" placeholder="Enter task" required>
            </div>
            <div class="form-group">
                <input type="datetime-local" name="task_at" class="form-control form-control-lg" required>
            </div>
            <button type="submit" class="btn btn-primary btn-lg">Add Task</button>
        </form>
        <ul class="list-group">
            <?php while($row = $result->fetch_assoc()): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span><?php echo $row['task']; ?> - <?php echo $row['task_at']; ?></span>
                    <div>
                        <?php if (!$row['status']): ?>
                            <a href="index.php?complete=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Complete</a>
                        <?php endif; ?>
                        <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        <a href="edit_task.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    </div>
                </li>
            <?php endwhile; ?>
        </ul>
    </div>
</body>
</html>

<?php $conn->close(); ?>