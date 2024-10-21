<?php

class PermissionDTO {
       private $codePermission;
       private $namePermission;
   
       // Constructor
       public function __construct($codePermission, $namePermission) {
           $this->codePermission = $codePermission;
           $this->namePermission = $namePermission;
       }
   
       // Getter và Setter cho $codePermission
       public function getCodePermission() {
           return $this->codePermission;
       }
   
       public function setCodePermission($codePermission) {
           $this->codePermission = $codePermission;
       }
   
       // Getter và Setter cho $namePermission
       public function getNamePermission() {
           return $this->namePermission;
       }
   
       public function setNamePermission($namePermission) {
           $this->namePermission = $namePermission;
       }
   }
   