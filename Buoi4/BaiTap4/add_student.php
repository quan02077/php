<form  method="post">
    <label>Ho ten:</label> <input type="text" name="name" required>
    <label>Email:</label> <input type="email" name="email" required>
    <label>SDT:</label> <input type="text" name="phone" required>
    <button type="submit">Them</button>
</form>

<?php
    require '../BaiTap1.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $stmt = $conn->prepare('INSERT INTO students (name, email, phone) VALUES (?, ?, ?)');
        $stmt->execute([$_POST['name'], $_POST['email'], $_POST['phone']]);
        echo'Them thanh cong';
    }
?>