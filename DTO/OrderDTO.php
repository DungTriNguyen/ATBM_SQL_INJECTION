<?php

class OrderDTO {
       // Thuộc tính cho mã đơn hàng
       private $orderCode;
   
       // Thuộc tính cho ngày tạo đơn hàng
       private $dateCreated;

       // thuộc tính địa chỉ giao hàng
       private $deliveryAddress;
   
       // Thuộc tính cho ngày giao hàng dự kiến
       private $dateDelivery;
   
       // Thuộc tính cho ngày hoàn thành đơn hàng
       private $dateFinish;
   
       // Thuộc tính cho tên người dùng
       private $userName;
   
       // Thuộc tính cho tổng số tiền đơn hàng
       private $totalMoney;
   
       // Thuộc tính cho mã thanh toán
       private $codePayments;
   
       // Thuộc tính cho mã vận chuyển
       private $codeTransport;
   
       // Thuộc tính cho trạng thái đơn hàng (processing, shipped, completed, etc.)
       private $status;
   
       // Thuộc tính cho ghi chú đơn hàng
       private $note;
   
       // Constructor
       public function __construct(
           $orderCode,
           $deliveryAddress,
           $dateCreated,
           $dateDelivery,
           $dateFinish,
           $userName,
           $totalMoney,
           $codePayments,
           $codeTransport,
           $status,
           $note
       ) {
           $this->orderCode = $orderCode;
           $this->deliveryAddress = $deliveryAddress;
           $this->dateCreated = $dateCreated;
           $this->dateDelivery = $dateDelivery;
           $this->dateFinish = $dateFinish;
           $this->userName = $userName;
           $this->totalMoney = $totalMoney;
           $this->codePayments = $codePayments;
           $this->codeTransport = $codeTransport;
           $this->status = $status;
           $this->note = $note;
       }
   
       // Getter và Setter cho $orderCode
       public function getOrderCode() {
           return $this->orderCode;
       }
   
       public function setOrderCode($orderCode) {
           $this->orderCode = $orderCode;
       }

       // Getter và Setter cho $orderCode
       public function getDeliveryAddress() {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress($deliveryAddress) {
        $this->deliveryAddress = $deliveryAddress;
    }
   

       // Getter và Setter cho $dateCreated
       public function getDateCreated() {
           return $this->dateCreated;
       }
   
       public function setDateCreated($dateCreated) {
           $this->dateCreated = $dateCreated;
       }
   
       // Getter và Setter cho $dateDelivery
       public function getDateDelivery() {
           return $this->dateDelivery;
       }
   
       public function setDateDelivery($dateDelivery) {
           $this->dateDelivery = $dateDelivery;
       }
   
       // Getter và Setter cho $dateFinish
       public function getDateFinish() {
           return $this->dateFinish;
       }
   
       public function setDateFinish($dateFinish) {
           $this->dateFinish = $dateFinish;
       }
   
       // Getter và Setter cho $userName
       public function getUserName() {
           return $this->userName;
       }
   
       public function setUserName($userName) {
           $this->userName = $userName;
       }
   
       // Getter và Setter cho $totalMoney
       public function getTotalMoney() {
           return $this->totalMoney;
       }
   
       public function setTotalMoney($totalMoney) {
           $this->totalMoney = $totalMoney;
       }
   
       // Getter và Setter cho $codePayments
       public function getCodePayments() {
           return $this->codePayments;
       }
   
       public function setCodePayments($codePayments) {
           $this->codePayments = $codePayments;
       }
   
       // Getter và Setter cho $codeTransport
       public function getCodeTransport() {
           return $this->codeTransport;
       }
   
       public function setCodeTransport($codeTransport) {
           $this->codeTransport = $codeTransport;
       }
   
       // Getter và Setter cho $status
       public function getStatus() {
           return $this->status;
       }
   
       public function setStatus($status) {
           $this->status = $status;
       }
   
       // Getter và Setter cho $note
       public function getNote() {
           return $this->note;
       }
   
       public function setNote($note) {
           $this->note = $note;
       }

   }
   