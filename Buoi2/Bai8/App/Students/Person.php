<?php
namespace App\Students;

class Person {
    private $name;
    private $age;

    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName() { return $this->name; }
    public function setName($name) { $this->name = $name; }

    public function getAge() { return $this->age; }
    public function setAge($age) { $this->age = $age; }

    public function displayInfo() {
        echo "Ten: " . $this->name . " | Tuoi: " . $this->age;
    }
}
?>
