<?php
require 'vendor/autoload.php'; // PHPMailer autoload
require 'db.php'; // your DB connection

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Set timezone
date_default_timezone_set('Asia/Kolkata');

// Get sessions starting in next 10 minutes
$now = new DateTime();
$in10min = clone $now;
$in10min->modify('+10 minutes');

$nowStr = $now->format('H:i:s');
$in10Str = $in10min->format('H:i:s');
$today = $now->format('Y-m-d');

$sql = "SELECT s.*, t.email AS trainer_email, t.name AS trainer_name
        FROM sessions s
        JOIN trainers t ON s.trainer_id = t.id
        WHERE s.session_date = ? 
        AND s.session_time BETWEEN ? AND ?
        AND s.status = 'scheduled'";


$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $today, $nowStr, $in10Str);
$stmt->execute();
$result = $stmt->get_result();

while ($session = $result->fetch_assoc()) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Or your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'pintooprajapati027@gmail.com';
        $mail->Password = 'mekp ztuy rcmg bjkt';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('pintooprajapati027@gmail.com', 'Smart Calendar');
        $mail->addAddress($session['trainer_email'], $session['trainer_name']);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Upcoming Session Reminder';
        $mail->Body = "
            <h3>Hi {$session['trainer_name']},</h3>
            <p>This is a reminder that you have a session coming up:</p>
            <ul>
                <li><strong>Title:</strong> {$session['title']}</li>
                <li><strong>Time:</strong> {$session['session_time']}</li>
                <li><strong>Client:</strong> {$session['client_name']}</li>
            </ul>
            <p>Please be prepared.</p>
            <br>
            <small>This is an automated message from Smart Calendar.</small>
        ";

        $mail->send();
        echo "Email sent to: " . $session['trainer_email'] . "\n";

    } catch (Exception $e) {
        error_log("Email could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }
}

echo "Reminder check done.";
?>
