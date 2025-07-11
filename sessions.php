<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, PUT');
header('Access-Control-Allow-Headers: Content-Type');

// Database connection
$host = 'localhost';
$dbname = 'project';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'error' => 'Database connection failed']);
    exit;
}

// GET - Fetch sessions
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $trainer_id = $_GET['trainer_id'] ?? '';

    if (empty($trainer_id)) {
        echo json_encode(['success' => false, 'error' => 'Trainer ID is required']);
        exit;
    }

    try {
        $current_datetime = date('Y-m-d H:i:s');

        // ✅ Auto-mark sessions as 'missed' if time is passed and not started/completed
        $updateMissed = $pdo->prepare("
            UPDATE sessions
            SET status = 'missed'
            WHERE trainer_id = ?
              AND (status IS NULL OR status = '' OR status = 'scheduled')
              AND CONCAT(session_date, ' ', session_time) + INTERVAL duration MINUTE < ?
        ");
        $updateMissed->execute([$trainer_id, $current_datetime]);

        // ✅ Fetch all sessions (no auto-deletion)
        $stmt = $pdo->prepare("SELECT * FROM sessions WHERE trainer_id = ? ORDER BY session_date, session_time");
        $stmt->execute([$trainer_id]);
        $sessions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(['success' => true, 'sessions' => $sessions]);
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'error' => 'Failed to fetch sessions']);
    }
}

// POST - Create new sessions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $trainer_id = $input['trainer_id'] ?? '';
    $sessions = $input['sessions'] ?? [];

    if (empty($trainer_id) || empty($sessions)) {
        echo json_encode(['success' => false, 'error' => 'Trainer ID and sessions are required']);
        exit;
    }

    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("INSERT INTO sessions (trainer_id, title, client_name, session_date, session_time, duration, session_type, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        $created = [];

        foreach ($sessions as $session) {
            $stmt->execute([
                $trainer_id,
                $session['title'],
                $session['client'],
                $session['date'],
                $session['time'],
                $session['duration'],
                $session['type'],
                $session['description']
            ]);

            $created[] = [
                'id' => $pdo->lastInsertId(),
                'trainer_id' => $trainer_id,
                'title' => $session['title'],
                'client_name' => $session['client'],
                'session_date' => $session['date'],
                'session_time' => $session['time'],
                'duration' => $session['duration'],
                'session_type' => $session['type'],
                'description' => $session['description']
            ];
        }

        $pdo->commit();
        echo json_encode(['success' => true, 'sessions' => $created]);
    } catch(PDOException $e) {
        $pdo->rollBack();
        echo json_encode(['success' => false, 'error' => 'Failed to create sessions']);
    }
}

// PUT - Update session status
// if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
//     $input = json_decode(file_get_contents('php://input'), true);
//     $session_id = $input['id'] ?? '';
//     $status = $input['status'] ?? '';

//     if (empty($session_id) || empty($status)) {
//         echo json_encode(['success' => false, 'error' => 'Session ID and status are required']);
//         exit;
//     }

//     // ✅ Allow "scheduled", "started", "completed", and "missed"
//     $valid_statuses = ['scheduled', 'started', 'completed', 'missed'];
//     if (!in_array($status, $valid_statuses)) {
//         echo json_encode(['success' => false, 'error' => 'Invalid session status']);
//         exit;
//     }

//     try {
//         $stmt = $pdo->prepare("UPDATE sessions SET status = ? WHERE id = ?");
//         $stmt->execute([$status, $session_id]);

//         if ($stmt->rowCount() > 0) {
//             echo json_encode(['success' => true, 'message' => 'Session status updated successfully']);
//         } else {
//             echo json_encode(['success' => false, 'error' => 'Session not found']);
//         }
//     } catch(PDOException $e) {
//         echo json_encode(['success' => false, 'error' => 'Failed to update session status']);
//     }
// }

// PUT - Update session status
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $input = json_decode(file_get_contents('php://input'), true);
    $session_id = $input['id'] ?? '';
    $status = $input['status'] ?? '';

    if (empty($session_id) || empty($status)) {
        echo json_encode(['success' => false, 'error' => 'Session ID and status are required']);
        exit;
    }

    // ✅ Allow only valid statuses
    $valid_statuses = ['scheduled', 'started', 'completed', 'missed'];
    if (!in_array($status, $valid_statuses)) {
        echo json_encode(['success' => false, 'error' => 'Invalid session status']);
        exit;
    }

    try {
        // Update query based on status
        if ($status === 'started') {
            $stmt = $pdo->prepare("UPDATE sessions SET status = ?, started_at = NOW() WHERE id = ?");
        } elseif ($status === 'completed') {
            $stmt = $pdo->prepare("UPDATE sessions SET status = ?, ended_at = NOW() WHERE id = ?");
        } else {
            $stmt = $pdo->prepare("UPDATE sessions SET status = ? WHERE id = ?");
        }

        $stmt->execute([$status, $session_id]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'Session status updated successfully']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Session not found']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => 'Failed to update session status']);
    }
}



// DELETE - Delete session
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $input = json_decode(file_get_contents('php://input'), true);
    $session_id = $input['id'] ?? '';

    if (empty($session_id)) {
        echo json_encode(['success' => false, 'error' => 'Session ID is required']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("DELETE FROM sessions WHERE id = ?");
        $stmt->execute([$session_id]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'Session deleted successfully']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Session not found']);
        }
    } catch(PDOException $e) {
        echo json_encode(['success' => false, 'error' => 'Failed to delete session']);
    }
}
?>
