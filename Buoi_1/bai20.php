<?php
if (isset($_GET['del'])) {
    setcookie('username', '', time() - 3600, '/');
    header('Location: bai20.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['username'])) {
    setcookie('username', $_POST['username'], time() + (86400 * 30), '/');
    header('Location: bai20.php');
    exit;
}
?>
<h3>Bài 20: Ghi nhớ tên người dùng qua Cookie</h3>
<?php if (isset($_COOKIE['username'])): ?>
    <p>Chào mừng trở lại, <b><?= htmlspecialchars($_COOKIE['username']) ?></b>!</p>
    <p><a href="?del=1">Xóa cookie tên / Đăng xuất</a></p>
<?php else: ?>
    <form method="post">
        Nhập tên của bạn: <input type="text" name="username" required>
        <input type="submit" value="Lưu tên">
    </form>
<?php endif; ?>
