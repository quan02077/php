<?php
$danhSachSV = [
    ["hoten" => "Nguyễn Văn A", "diem" => 8.5],
    ["hoten" => "Trần Thị B", "diem" => 9.2],
    ["hoten" => "Lê Văn C", "diem" => 7.0],
    ["hoten" => "Phạm Văn D", "diem" => 9.2]
];

function timDiemCaoNhat($ds) {
    if (empty($ds)) return [];
    $maxDiem = $ds[0]['diem'];
    foreach ($ds as $sv) {
        if ($sv['diem'] > $maxDiem) {
            $maxDiem = $sv['diem'];
        }
    }
    
    $ketQua = [];
    foreach ($ds as $sv) {
        if ($sv['diem'] == $maxDiem) {
            $ketQua[] = $sv;
        }
    }
    return $ketQua;
}

echo "<h3>Bài 18: Quản lý danh sách sinh viên</h3>";
echo "<h4>Danh sách sinh viên:</h4><ul>";
foreach ($danhSachSV as $sv) {
    echo "<li>" . $sv['hoten'] . " - Điểm: " . $sv['diem'] . "</li>";
}
echo "</ul>";

$svCaoNhat = timDiemCaoNhat($danhSachSV);
echo "<h4>Sinh viên có điểm cao nhất:</h4>";
foreach ($svCaoNhat as $sv) {
    echo "<p>Họ tên: <b>" . $sv['hoten'] . "</b> - Điểm: <b>" . $sv['diem'] . "</b></p>";
}
?>
