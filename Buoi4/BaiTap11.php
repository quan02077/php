<?php
require 'BaiTap1.php';

$allowed_sorts = ['name', 'email'];
$sort = isset($_GET['sort']) && in_array($_GET['sort'], $allowed_sorts) ? $_GET['sort'] : 'name';

$allowed_orders = ['asc', 'desc'];
$order = isset($_GET['order']) && in_array(strtolower($_GET['order']), $allowed_orders) ? strtoupper($_GET['order']) : 'ASC';

$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

if ($keyword !== '') {
    $sql = "SELECT * FROM students WHERE name LIKE :keyword ORDER BY $sort $order";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
} else {
    $sql = "SELECT * FROM students ORDER BY $sort $order";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

$next_order_name = ($sort === 'name' && $order === 'ASC') ? 'desc' : 'asc';
$next_order_email = ($sort === 'email' && $order === 'ASC') ? 'desc' : 'asc';
$arrow_name = ($sort === 'name') ? ($order === 'ASC' ? '▲' : '▼') : '';
$arrow_email = ($sort === 'email') ? ($order === 'ASC' ? '▲' : '▼') : '';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài Tập 11 - Sắp xếp danh sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Danh sách sinh viên</h2>

    <form method="get" class="row g-3 mb-4 mt-2">
        <div class="col-md-3">
            <input type="text" name="keyword" value="<?= htmlspecialchars($keyword) ?>" class="form-control" placeholder="Nhập tên cần tìm">
        </div>
        <div class="col-md-3">
            <select name="sort" class="form-select">
                <option value="name" <?= $sort === 'name' ? 'selected' : '' ?>>Sắp xếp theo Họ và tên</option>
                <option value="email" <?= $sort === 'email' ? 'selected' : '' ?>>Sắp xếp theo Email</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="order" class="form-select">
                <option value="asc" <?= $order === 'ASC' ? 'selected' : '' ?>>Tăng dần (A - Z)</option>
                <option value="desc" <?= $order === 'DESC' ? 'selected' : '' ?>>Giảm dần (Z - A)</option>
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Áp dụng</button>
            <a href="BaiTap11.php" class="btn btn-secondary">Đặt lại</a>
        </div>
    </form>

    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>
                    <a href="?sort=name&order=<?= $next_order_name ?>&keyword=<?= urlencode($keyword) ?>" class="text-white text-decoration-none">
                        Họ và tên <?= $arrow_name ?>
                    </a>
                </th>
                <th>
                    <a href="?sort=email&order=<?= $next_order_email ?>&keyword=<?= urlencode($keyword) ?>" class="text-white text-decoration-none">
                        Email <?= $arrow_email ?>
                    </a>
                </th>
                <th>Số điện thoại</th>
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
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">Không có dữ liệu</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

