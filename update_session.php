<?php
include 'db.php';

$id = $_POST['session_id'];
$title = $_POST['title'];
$client = $_POST['client'];
$type = $_POST['type'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$description = $_POST['description'];

$sql = "UPDATE sessions SET title=?, client_name=?, session_type=?, session_date=?, start_time=?, end_time=?, description=? WHERE id=?";
$stmt = $conn->prepare($sql);
$success = $stmt->execute([$title, $client, $type, $startDate, $startTime, $endTime, $description, $id]);

echo json_encode(['success' => $success]);
