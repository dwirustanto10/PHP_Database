<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rekap Tugas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header class="bg-dark text-white text-center py-3">
        <h1>Rekap Tugas</h1>
    </header>
    <?php include 'nav.php'; ?>
    <div class="container mt-4">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Task At</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['task']; ?></td>
                    <td><?php echo $row['status'] ? 'Complete' : 'Incomplete'; ?></td>
                    <td><?php echo $row['task_at']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-secondary">Kembali ke Daftar Tugas</a>
        <a href="download_rekap.php" class="btn btn-primary">Download Rekap (Excel)</a>
    </div>
</body>
</html>
<?php $conn->close(); ?>