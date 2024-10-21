<?php

class FunctionsDTO {
       private $functionCode;
       private $functionName;
   
       // Constructor
       public function __construct($functionCode, $functionName) {
           $this->functionCode = $functionCode;
           $this->functionName = $functionName;
       }
   
       // Getter và Setter cho $functionCode
       public function getFunctionCode() {
           return $this->functionCode;
       }
   
       public function setFunctionCode($functionCode) {
           $this->functionCode = $functionCode;
       }
   
       // Getter và Setter cho $functionName
       public function getFunctionName() {
           return $this->functionName;
       }
   
       public function setFunctionName($functionName) {
           $this->functionName = $functionName;
       }
   }
   