<?php
class AccountDTO
{
       private $userName;
       private $passWord;
       private $dateCreate;
       private $accountStatus;
       private $name;
       private $address;
       private $email;
       private $phoneNumber;
       private $birth;
       private $sex;
       private $codePermission;

       // hàm khởi tạo
       public function __construct(
              $userName,
              $passWord,
              $dateCreate,
              $accountStatus,
              $name,
              $address,
              $email,
              $phoneNumber,
              $birth,
              $sex,
              $codePermission
       ) {
              $this->userName = $userName;
              $this->passWord = $passWord;
              $this->dateCreate = $dateCreate;
              $this->accountStatus = $accountStatus;
              $this->name = $name;
              $this->address = $address;
              $this->email = $email;
              $this->phoneNumber = $phoneNumber;
              $this->birth = $birth;
              $this->sex = $sex;
              $this->codePermission = $codePermission;
       }

       public function getUsername()
       {
              return $this->userName;
       }

       public function setUsername($userName)
       {
              $this->userName = $userName;
       }

       public function getPassword()
       {
              return $this->passWord;
       }

       public function setPassword($passWord)
       {
              $this->passWord = $passWord;
       }

       public function getDateCreate()
       {
              return $this->dateCreate;
       }

       public function setDateCreate($dateCreate)
       {
              $this->dateCreate = $dateCreate;
       }

       public function getAccountStatus()
       {
              return $this->accountStatus;
       }

       public function setAccountStatus($accountStatus)
       {
              $this->accountStatus = $accountStatus;
       }

       public function getName()
       {
              return $this->name;
       }

       public function setName($name)
       {
              $this->name = $name;
       }

       public function getAddress()
       {
              return $this->address;
       }

       public function setAddress($address)
       {
              $this->address = $address;
       }

       public function getEmail()
       {
              return $this->email;
       }

       public function setEmail($email)
       {
              $this->email = $email;
       }

       public function getPhoneNumber()
       {
              return $this->phoneNumber;
       }

       public function setPhoneNumber($phoneNumber)
       {
              $this->phoneNumber = $phoneNumber;
       }

       public function getBirth()
       {
              return $this->birth;
       }

       public function setBirth($birth)
       {
              $this->birth = $birth;
       }

       public function getSex()
       {
              return $this->sex;
       }

       public function setSex($sex)
       {
              $this->sex = $sex;
       }

       public function getCodePermission()
       {
              return $this->codePermission;
       }

       public function setCodePermission($codePermission)
       {
              $this->codePermission = $codePermission;
       }

       public function __toString()
       {
              return sprintf(
                     "Username: %s\nPassword: %s\nDate Created: %s\nAccount Status: %s\nName: %s\nAddress: %s\nEmail: %s\nPhone Number: %s\nBirth: %s\nSex: %s\nCode Permission: %s\n",
                     $this->userName,
                     $this->passWord,
                     $this->dateCreate,
                     $this->accountStatus,
                     $this->name,
                     $this->address,
                     $this->email,
                     $this->phoneNumber,
                     $this->birth,
                     $this->sex,
                     $this->codePermission
              );
       }
}