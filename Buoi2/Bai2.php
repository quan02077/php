<?php
class Student{
    private $name;
    private $age;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function display(){
        echo"Name: {$this->name}, Age: {$this->age}<br>";
    }

    public function __destruct()
    {
        echo "Doi tuog Student da bi huy.<br>";
    }
}
    $student1 = new Student("Nguyen Van A", 20);
    $student1->display();
?>