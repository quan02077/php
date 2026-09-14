<?php
header('Content-Type: application/json');

$file = 'toDos.json';
$toDos = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

if(!is_array($toDos)) {
    $toDos = [];
}

$action = $_POST['action'] ?? $_GET['action'] ?? 'get';

if($action == 'get'){
    echo json_encode($toDos, JSON_UNESCAPED_UNICODE);
    exit;
}

if($action == 'add'){
    $name = trim($_POST['name'] ?? '');
    if($name != ''){
        $newItem = [
            'id' => time() . rand(100, 999),
            'name' => $name,
            'completed' => false
        ];
        $toDos[] = $newItem;
        file_put_contents($file, json_encode($toDos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
    echo json_encode($toDos, JSON_UNESCAPED_UNICODE);
    exit;
}

if($action == 'toggle'){
    $id = trim($_POST['id'] ?? '');
    foreach($toDos as &$item){
        if($item['id'] == $id){
            $item['completed'] = !$item['completed'];
        }
    }
    file_put_contents($file, json_encode($toDos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo json_encode($toDos, JSON_UNESCAPED_UNICODE);
    exit;
}

if($action == 'delete'){
    $id = trim($_POST['id'] ?? '');
    
    $tempList = [];
    foreach($toDos as $item){
        if($item['id'] != $id){
            $tempList[] = $item; 
        }   
    }
    
    $toDos = $tempList;
    
    file_put_contents($file, json_encode($toDos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo json_encode($toDos, JSON_UNESCAPED_UNICODE);
    exit;
}


echo json_encode(['error' => 'Action không hợp lệ']);
?>