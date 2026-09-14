<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['content'])) {
    $content = date("Y-m-d H:i:s") . " | " . str_replace(["\r", "\n"], " ", $_POST['content']) . PHP_EOL;
    file_put_contents('note.txt', $content, FILE_APPEND | LOCK_EX);
    $msg = "Đã lưu nội dung thành công!";
}
?>
<h3>Bài 19: Lưu form vào file note.txt</h3>
<?php if (!empty($msg)) echo "<p style='color:green;'>$msg</p>"; ?>
<form method="post">
    Nhập nội dung ghi chú:<br>
    <textarea name="content" rows="4" cols="40" required></textarea><br><br>
    <input type="submit" value="Lưu vào note.txt">
</form>
<hr>
<h4>Toàn bộ nội dung trong file note.txt:</h4>
<pre><?php
if (file_exists('note.txt')) {
    echo htmlspecialchars(file_get_contents('note.txt'));
} else {
    echo "Chưa có dữ liệu trong note.txt.";
}
?></pre>
