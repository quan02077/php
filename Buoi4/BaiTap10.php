<?php
ob_start();
require 'BaiTap1.php';

$id = '';
$name = '';
$email = '';
$phone = '';
$edit_mode = false;

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    header("Location: BaiTap10.php");
    exit;
}

if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($student) {
        $id = $student['id'];
        $name = $student['name'];
        $email = $student['email'];
        $phone = $student['phone'];
        $edit_mode = true;
    }
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? trim($_POST['id']) : '';
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';

    if ($id !== '') {
        $stmt = $conn->prepare("UPDATE students SET name = ?, email = ?, phone = ? WHERE id = ?");
        $stmt->execute([$name, $email, $phone, $id]);
    } else {
        $stmt = $conn->prepare("INSERT INTO students (name, email, phone) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $phone]);
    }
    header("Location: BaiTap10.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM students ORDER BY id DESC");
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài Tập 10 - Prepared Statement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0"><?= $edit_mode ? 'Cập nhật sinh viên' : 'Thêm sinh viên mới' ?></h5>
                </div>
                <div class="card-body">
                    <form method="post" action="BaiTap10.php">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                        <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($name) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($email) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($phone) ?>" required>
                        </div>
                        <button type="submit" class="btn <?= $edit_mode ? 'btn-warning' : 'btn-success' ?>">
                            <?= $edit_mode ? 'Cập nhật' : 'Thêm mới' ?>
                        </button>
                        <?php if ($edit_mode): ?>
                            <a href="BaiTap10.php" class="btn btn-secondary">Hủy</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="card-title mb-0">Danh sách sinh viên</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Họ và tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($students)): ?>
                                <?php foreach ($students as $index => $row): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= htmlspecialchars($row['name']) ?></td>
                                        <td><?= htmlspecialchars($row['email']) ?></td>
                                        <td><?= htmlspecialchars($row['phone']) ?></td>
                                        <td>
                                            <a href="BaiTap10.php?action=edit&id=<?= $row['id'] ?>" class="btn btn-sm btn-info">Sửa</a>
                                            <a href="BaiTap10.php?action=delete&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">Chưa có sinh viên nào</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
