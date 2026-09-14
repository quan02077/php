<?php
require 'BaiTap1.php';

try{
    // $sql_add_column = "ALTER TABLE students ADD birthday DATE NULL";
    // $conn->exec($sql_add_column);
    // echo "Da them cot 'birthday' thanh cong!";

    $sql_update_data = "UPDATE students SET birthday = '2006-09-08' WHERE id = 2";
    $conn->exec($sql_update_data);
}
catch(PDOException $e){
    echo $e->getMessage();
}
?>