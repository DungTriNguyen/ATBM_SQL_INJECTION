<?php

class SizeDTO {
       // Thuộc tính cho mã kích thước
       private $sizeCode;
   
       // Thuộc tính cho tên kích thước
       private $sizeName;
   
       // Constructor
       public function __construct($sizeCode, $sizeName) {
           $this->sizeCode = $sizeCode;
           $this->sizeName = $sizeName;
       }
   
       // Getter và Setter cho $sizeCode
       public function getSizeCode() {
           return $this->sizeCode;
       }
   
       public function setSizeCode($sizeCode) {
           $this->sizeCode = $sizeCode;
       }
   
       // Getter và Setter cho $sizeName
       public function getSizeName() {
           return $this->sizeName;
       }
   
       public function setSizeName($sizeName) {
           $this->sizeName = $sizeName;
       }
   }
   