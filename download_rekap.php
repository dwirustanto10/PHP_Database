<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'db.php';
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=rekap_tugas.xls");
$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);
echo "ID\tTask\tStatus\ttask At\n";
while ($row = $result->fetch_assoc()) {
    echo $row['id'] . "\t" . $row['task'] . "\t" . ($row['status'] ? 'Complete' : 'Incomplete') . "\t" . $row['task_at'] . "\n";
}
$conn->close();
?>