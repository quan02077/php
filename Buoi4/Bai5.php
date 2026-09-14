<?php
    require 'BaiTap1.php';

    if(isset($_GET['id'])){
        $stmt = $conn->prepare('DELETE FROM students WHERE id=?');
        $stmt->execute([$_GET['id']]);
    }
    header("Location: BaiTap3.php");
    exit;
?>