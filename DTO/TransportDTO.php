<?php

class TransportDTO {
       // Thuộc tính cho tên đơn vị vận chuyển
       private $nameTransport;
   
       // Thuộc tính cho mã đơn vị vận chuyển
       private $codeTransport;
   
       // Thuộc tính cho công ty liên kết
       private $affiliatedCompany;
   
       // Constructor
       public function __construct($nameTransport, $codeTransport, $affiliatedCompany) {
           $this->nameTransport = $nameTransport;
           $this->codeTransport = $codeTransport;
           $this->affiliatedCompany = $affiliatedCompany;
       }
   
       // Getter và Setter cho $nameTransport
       public function getNameTransport() {
           return $this->nameTransport;
       }
   
       public function setNameTransport($nameTransport) {
           $this->nameTransport = $nameTransport;
       }
   
       // Getter và Setter cho $codeTransport
       public function getCodeTransport() {
           return $this->codeTransport;
       }
   
       public function setCodeTransport($codeTransport) {
           $this->codeTransport = $codeTransport;
       }
   
       // Getter và Setter cho $affiliatedCompany
       public function getAffiliatedCompany() {
           return $this->affiliatedCompany;
       }
   
       public function setAffiliatedCompany($affiliatedCompany) {
           $this->affiliatedCompany = $affiliatedCompany;
       }
   }
   