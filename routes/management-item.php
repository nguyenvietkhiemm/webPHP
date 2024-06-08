<?php
$managementController = require __DIR__ . '/../app/controllers/management-item-controller.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $managementController->index();
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $managementController->create($data);
        break;
    case 'PATCH':
        $data = json_decode(file_get_contents('php://input'), true);
        $managementController->patch($data);
        break;
    case 'SOFT_DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $managementController->soft_delete($data);
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        $managementController->delete($data);
        break;
    case 'RESTORE':
        $data = json_decode(file_get_contents('php://input'), true);
        $managementController->restore($data);
        break;
    default:
        echo json_encode(['message' => 'Unsupported request method']);
        break;
    }