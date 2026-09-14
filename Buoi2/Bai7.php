<?php

interface Downloadable {
    public function download();
}

class Book {
    private $title;
    private $author;
    private $price;

    public function __construct($title, $author, $price) {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price >= 0 ? $price : 0;
    }

    public function getTitle() { return $this->title; }
    public function setTitle($title) { $this->title = $title; }

    public function getAuthor() { return $this->author; }
    public function setAuthor($author) { $this->author = $author; }

    public function getPrice() { return $this->price; }
    public function setPrice($price) { $this->price = $price >= 0 ? $price : 0; }

    public function displayInfo() {
        echo "Sach: " . $this->title . " | Tac gia: " . $this->author . " | Gia: " . $this->price . "<br>";
    }
}

class Ebook extends Book implements Downloadable {
    private $fileSize;

    public function __construct($title, $author, $price, $fileSize) {
        parent::__construct($title, $author, $price);
        $this->fileSize = $fileSize;
    }

    public function getFileSize() { return $this->fileSize; }
    public function setFileSize($fileSize) { $this->fileSize = $fileSize; }

    public function download() {
        echo "Dang tai xuong ebook " . $this->getTitle() . " voi dung luong " . $this->fileSize . " MB thanh cong<br>";
    }

    public function displayInfo() {
        echo "Ebook: " . $this->getTitle() . " | Tac gia: " . $this->getAuthor() . " | Gia: " . $this->getPrice() . " | Dung luong: " . $this->fileSize . " MB<br>";
    }
}

$normalBook = new Book("Lap trinh PHP", "Nguyen Van A", 150000);
$normalBook->displayInfo();

$myEbook = new Ebook("Lap trinh OOP", "Tran Thi B", 90000, 15);
$myEbook->displayInfo();
$myEbook->download();

?>
