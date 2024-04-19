<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $field = $_POST['field'];
    $value = $_POST['value'];
    $response = ['valid' => false, 'message' => ''];

    switch ($field) {
        case 'fname':
        case 'lname':
            // For simplicity, only checking if it starts with a letter
            if (preg_match('/^[a-zA-Z].*$/', $value)) {
                $response['valid'] = true;
            } else {
                $response['message'] = 'Must start with a letter a-z or A-Z';
            }
            break;
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
