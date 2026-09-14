<?php
function strToUpperText($str) {
    return mb_strtoupper($str, 'UTF-8');
}

$text = "Phần mềm PHP Lab 2026";
echo "<h3>Bài 17: Viết hoa toàn bộ chuỗi</h3>";
echo "Chuỗi ban đầu: " . $text . "<br>";
echo "Chuỗi sau khi viết hoa: <b>" . strToUpperText($text) . "</b>";
?>
