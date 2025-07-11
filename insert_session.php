<?php
include 'db.php';

$title = $_POST['title'];
$client = $_POST['client'];
$type = $_POST['type'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$description = $_POST['description'];
$trainer_id = $_POST['trainer_id'] ?? 1; // use session or default

// Insert into DB (simplified example)
$sql = "INSERT INTO sessions (title, client_name, session_type, session_date, start_time, end_time, description, trainer_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$success = $stmt->execute([$title, $client, $type, $startDate, $startTime, $endTime, $description, $trainer_id]);

echo json_encode(['success' => $success]);
