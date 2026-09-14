<?php
class BankAccount{
    private $sTK;
    private $tenTK;
    private $soDu;

    public function __construct($sTK, $tenTK, $soDu)
    {
        $this->sTK = $sTK;
        $this->tenTK = $tenTK;
        $this->soDu = $soDu >= 0 ? $soDu : 0;
    }


    public function getSTK() {
        return $this->sTK;
    }

    public function getTenTK() {
        return $this->tenTK;
    }

    public function getSoDu() {
        return $this->soDu;
    }

    public function setTenTK($tenMoi) {
        $tenMoi = trim($tenMoi);
        if (!empty($tenMoi)) {
            $this->tenTK = $tenMoi;
            echo "Đã cập nhật tên tài khoản thành: {$this->tenTK}<br>";
        } else {
            echo "Tên tài khoản mới không được để trống!<br>";
        }
    }
    public function napTien($napTien){
        if($napTien <= 0){
            echo"So tien nap phai lon hon 0<br>";
        }
        else{
            $this->soDu += $napTien;
            echo"So tien da duoc nap thanh cong vao tai khoan<br>";
            echo"So du hien tai: {$this->soDu}<br>";
        }
    }

    public function rutTien($rutTien){
        if($rutTien <= 0){
            echo "So tiền rut phai lon hon 0<br>";
        }
        else if($this->soDu < $rutTien){
            echo"So tien rut khong duoc lon hon so du trong tai khoan<br>";
        }
        else{
            $this->soDu -= $rutTien;
            echo"So tien da duoc rut thanh cong<br>";
            echo"So du hien tai: {$this->soDu}<br>";
        }
    }

    public function hienThi(){
        echo"So tai khoan: {$this->sTK}, Ten tai khoan: {$this->tenTK}, So du tai khoan: {$this->soDu}<br>";
    }
}

$bank = new BankAccount("123456789", "Nguyen Nhat Minh Quan", 10000);
$bank->napTien(10000);
$bank->rutTien(5000);
echo "<br>--- Kiểm tra bằng hàm GET ---<br>";
echo "Chủ tài khoản hiện tại là: " . $bank->getTenTK() . "<br>";
echo "<br>--- Đổi tên bằng hàm SET ---<br>";
$bank->setTenTK("Nguyen Nhat Minh Quan - VIP");
echo "<br>--- Thông tin cuối cùng ---<br>";
$bank->hienThi();
?>
