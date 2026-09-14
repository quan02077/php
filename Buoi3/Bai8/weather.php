<?php
    $city = strtolower($_GET["city"] ?? '');
    $data = [
        "hanoi" => ["temp" => 30, "desc" => "Nang dep"],
        "danang" => ["temp" => 32, "desc" => "CO may"]
    ];
    header('Content-Type: application/json');
    echo json_encode($data[$city] ?? ["temp" => 0, "desc" => "Không có dữ liệu"]);
?>