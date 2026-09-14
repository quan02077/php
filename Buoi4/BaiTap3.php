<?php
    require 'BaiTap1.php';

    $stmt = $conn->query("SELECT * FROM students");
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table border="1" cellpading="5">
    <tr>
        <th>ID</th>
        <th>Ho ten</th>
        <th>Email</th>
        <th>SDT</th>
    </tr>
    <?php foreach($students as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><a href="Bai5.php?id=<?= $row['id'] ?>" onclick="return confirm('Xóa?')">Xóa</a></td>
            <td><a href="BaiTap6.php?id=<?= $row['id'] ?>">Sửa</a></td>
        </tr>
    <?php endforeach;?>
</table>