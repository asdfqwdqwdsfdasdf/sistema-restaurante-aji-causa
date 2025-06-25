<?php
function response($success, $msg = '', $code = 200, $data = null) {
    http_response_code($code);
    echo json_encode([
        "success" => $success,
        "message" => $msg,
        "data" => $data
    ]);
}
