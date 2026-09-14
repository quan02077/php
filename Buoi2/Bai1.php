<?php
    class Car{
        public $brand;
        public $color;

        public function showInfo(){
            echo "Brand: {$this -> brand}, Color: {$this -> color}<br>";
        }
    }

    $car1 = new Car();
    $car1->brand = "Toyota";
    $car1->color = "red";
    $car1->showInfo();

    $car2 = new Car();
    $car2->brand = "Honda";
    $car2->color = "Blue";
    $car2->showInfo();
?>