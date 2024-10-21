<?php

class SupplierDTO {
       // Thuộc tính cho mã nhà cung cấp
       private $codeSupplier;
   
       // Thuộc tính cho tên nhà cung cấp
       private $nameSupplier;
   
       // Thuộc tính cho địa chỉ nhà cung cấp
       private $address;
   
       // Thuộc tính cho địa chỉ email nhà cung cấp
       private $email;
   
       // Thuộc tính cho thương hiệu nhà cung cấp
       private $brandSupplier;
   
       // Thuộc tính cho số điện thoại nhà cung cấp
       private $phoneNumber;
   
       // Constructor
       public function __construct($codeSupplier, $nameSupplier, $address, $email, $brandSupplier, $phoneNumber) {
           $this->codeSupplier = $codeSupplier;
           $this->nameSupplier = $nameSupplier;
           $this->address = $address;
           $this->email = $email;
           $this->brandSupplier = $brandSupplier;
           $this->phoneNumber = $phoneNumber;
       }
   
       // Getter và Setter cho $codeSupplier
       public function getCodeSupplier() {
           return $this->codeSupplier;
       }
   
       public function setCodeSupplier($codeSupplier) {
           $this->codeSupplier = $codeSupplier;
       }
   
       // Getter và Setter cho $nameSupplier
       public function getNameSupplier() {
           return $this->nameSupplier;
       }
   
       public function setNameSupplier($nameSupplier) {
           $this->nameSupplier = $nameSupplier;
       }
   
       // Getter và Setter cho $address
       public function getAddress() {
           return $this->address;
       }
   
       public function setAddress($address) {
           $this->address = $address;
       }
   
       // Getter và Setter cho $email
       public function getEmail() {
           return $this->email;
       }
   
       public function setEmail($email) {
           $this->email = $email;
       }
   
       // Getter và Setter cho $brandSupplier
       public function getBrandSupplier() {
           return $this->brandSupplier;
       }
   
       public function setBrandSupplier($brandSupplier) {
           $this->brandSupplier = $brandSupplier;
       }
   
       // Getter và Setter cho $phoneNumber
       public function getPhoneNumber() {
           return $this->phoneNumber;
       }
   
       public function setPhoneNumber($phoneNumber) {
           $this->phoneNumber = $phoneNumber;
       }
   }
   