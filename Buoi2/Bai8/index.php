<?php
spl_autoload_register(function ($class) {
    $path = str_replace("\\", "/", $class) . ".php";
    if (file_exists($path)) {
        include $path;
    }
});

use App\Students\Student;

$student = new Student("Nguyen Nhat Minh Quan", 20, "SV123456");
$student->displayInfo();
?>
