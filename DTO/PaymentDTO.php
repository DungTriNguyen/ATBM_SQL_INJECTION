<?php

class PaymentDTO {
       // Thuộc tính cho tên phương thức thanh toán
       private $namePayment;
   
       // Thuộc tính cho mã phương thức thanh toán
       private $codePayments;
   
       // Thuộc tính cho ngân hàng liên kết
       private $affiliatedBank;
   
       // Constructor
       public function __construct($namePayment, $codePayments, $affiliatedBank) {
           $this->namePayment = $namePayment;
           $this->codePayments = $codePayments;
           $this->affiliatedBank = $affiliatedBank;
       }
   
       // Getter và Setter cho $namePayment
       public function getNamePayment() {
           return $this->namePayment;
       }
   
       public function setNamePayment($namePayment) {
           $this->namePayment = $namePayment;
       }
   
       // Getter và Setter cho $codePayments
       public function getCodePayments() {
           return $this->codePayments;
       }
   
       public function setCodePayments($codePayments) {
           $this->codePayments = $codePayments;
       }
   
       // Getter và Setter cho $affiliatedBank
       public function getAffiliatedBank() {
           return $this->affiliatedBank;
       }
   
       public function setAffiliatedBank($affiliatedBank) {
           $this->affiliatedBank = $affiliatedBank;
       }
   }
   