<?php
session_start();
require_once '../models/patient.php';
require_once '../models/okulist.php';
require_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();
$user = null;
$conversationId = 1; 

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'patient') {
        $user = new Patient($db);
    } elseif ($_SESSION['role'] === 'okulist') {
        $user = new OKulist($db);
    }
} else {
    echo 'Unauthorized';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message']) && !empty($_POST['message'])) {
    $message = htmlspecialchars(strip_tags($_POST['message']));
    if ($user) {
        $user->sendMessage($conversationId, $message);
    }
}

$messages = [];
if ($user) {
    $messages = $user->getMessages($conversationId);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiadomości</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .chat-box {
            max-height: 500px;
            overflow-y: scroll;
        }
        .message {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .message.patient {
            text-align: right;
            background-color: #e1ffe1;
        }
        .message.doctor {
            text-align: left;
            background-color: #e1e1ff;
        }
    </style>
</head>
<body>
    <?php include 'shared_navbar.php'; ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h3><br>Chat</h3>
                <div class="chat-box p-3 mb-3 border">
                    <?php foreach ($messages as $message): ?>
                        <div class="message <?= htmlspecialchars($message['sender_role']) ?>">
                            <strong><?= htmlspecialchars($message['sender_role']) ?>:</strong>
                            <?= htmlspecialchars($message['message_text']) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="message" class="form-control" placeholder="Type your message...">
                        <button class="btn btn-primary" type="submit">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        setInterval(function() {
            fetch(`../controllers/get_messages.php?conversation_id=<?= $conversationId ?>`)
                .then(response => response.json())
                .then(data => {
                    const chatBox = document.querySelector('.chat-box');
                    chatBox.innerHTML = '';
                    data.messages.forEach(message => {
                        const messageDiv = document.createElement('div');
                        messageDiv.classList.add('message', message.sender_role);
                        messageDiv.innerHTML = `<strong>${message.sender_role}:</strong> ${message.message_text}`;
                        chatBox.appendChild(messageDiv);
                    });
                });
        }), 3000; 
    </script>
</body>
</html>
