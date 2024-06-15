<?php
session_start();
require_once '../models/patient.php';
require_once '../models/okulist.php';
require_once '../../config/database.php';

header('Content-Type: application/json');

$database = new Database();
$db = $database->getConnection();
$user = null;

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'patient') {
        $user = new Patient($db);
    } elseif ($_SESSION['role'] === 'okulist') {
        $user = new Okulist($db);
    }
} else {
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}


if (!isset($_GET['conversation_id'])) {
    echo json_encode(['error' => 'Conversation ID is required']);
    exit();
}

$conversationId = $_GET['conversation_id'];

$messages = [];
if ($user) {
    $messages = $user->getMessages($conversationId);
    if ($messages === false) {
        echo json_encode(['error' => 'Error retrieving messages']);
    } else {
        echo json_encode(['messages' => $messages]);
    }
} else {
    echo json_encode(['error' => 'User not authenticated']);
}
?>
