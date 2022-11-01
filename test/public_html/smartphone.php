<?php
    class smartphone {
        public $name;
        public $color;
        public $size;
        public $version;
        public $insurance;

        public function setName($name) {
            $this->name = $name;
        }
        public function setColor($color) {
        $this->color = $color;
        }
        public function getColor(){
            return  $this->color;
        }
        public function getVersinon(){
            return  $this->version;
        }
        public function setVersinon($version){
            $this->version=$version;
        }

    }

    public function main(){
        $iphone = new smartphone();                 // dien thoai trang
        $iphone->setColor("orange");           // dien thoai mau cam
        $iphone->setVersinon(10);             // dien thoai version 10, mau cam
        echo $iphone->getVersinon();                // 10
        echo $iphone->getColor();                   // orange

}

?>