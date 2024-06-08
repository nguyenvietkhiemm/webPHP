<?php
$managementController = require __DIR__ . '/../app/controllers/management-bill-controller.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $managementController->index();
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $managementController->create($data);
        break;
    default:
        echo json_encode(['message' => 'Unsupported request method']);
        break;
    }