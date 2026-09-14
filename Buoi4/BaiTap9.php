<?php
    require 'BaiTap1.php';

    $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

    $sql = "SELECT * FROM students
            WHERE name LIKE :keyword
            ORDER BY id DESC
            LIMIT 5";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    $stmt->execute();
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css
" rel="stylesheet">
</head>

<body class="container mt-4">
    <h2>Danh sách sinh viên</h2>
    <form method="get" class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="keyword" value="<?=
                                                        htmlspecialchars($keyword) ?>"
                class="form-control" placeholder="Nhập tên cần tìm">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Họ và tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($students): ?>
                <?php foreach ($students as $index => $row): ?><tr>
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