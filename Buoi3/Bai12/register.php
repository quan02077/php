<?php
header('Content-Type: application/json');

$file = 'users.json';

$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$fullname = trim($_POST['fullname'] ?? '');

if ($username === '' || $email === '' || $password === '' || $fullname === '') {
    echo json_encode(['success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin!']);
    exit;
}

$users = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
if (!is_array($users)) {
    $users = [];
}

foreach($users as $user){
    if($user['username'] === $username){
        echo json_encode(['success' => false, 'message' => 'Tài khoản đã tồn tại']);
        exit;
    }
    if($user['email'] === $email){
        echo json_encode(['success' => false, 'message' => 'Email đã tồn tại']);
        exit;
    }
}

$newUser = [
    'id' => time(),
    'username' => $username,
    'email' => $email,
    'password' => $password,
    'fullname' => $fullname,
    'create_at' => date('Y-m-d H:i:s')
];

$users[] = $newUser;

file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo json_encode(['success' => true, 'message' => 'Đăng ký thành công']);

exit;
?>