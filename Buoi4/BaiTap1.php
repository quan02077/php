<?php
    $dsn = "mysql:host=localhost; dbname=buoi4;charset=utf8";
    $username = "root";
    $password = "";
    try{
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Ket noi thanh cong";
    }
    catch(PDOException $e){
        echo "Ket noi khong thanh cong: " . $e->getMessage();
    }
?>