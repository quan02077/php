<?php
    interface CanRun {
        public function run();
    }
    abstract class Animal{
        abstract public function makeSound();
    }

    class Dog extends Animal implements canRun{
        public function makeSound()
        {
            echo"Woof! Woof!<br>";
        }
        public function run(){
            echo "Dog is running...<br>";
        }
    }

    class Cat extends Animal {
        public function makeSound() {
        echo "Meow! Meow!<br>";
    }
    }

    $dog = new Dog();   
    $dog->makeSound();
    $dog->run();
    
    $cat = new Cat();
    $cat->makeSound();
?>