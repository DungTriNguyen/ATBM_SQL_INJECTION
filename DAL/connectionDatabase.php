<?php

// Check connection
class ConnectionDatabase
{
       private $servername = "localhost";
       private $username = "root";
       private $password = "";
       private $databaseName = "website_sells_clothes_and_bags";

       private $conn = null;

       // Khởi tạo kết nối
       public function __construct()
       {
              $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->databaseName);
              // if($this->conn){
              //        echo 'thanh cong';
              // }
       }

       // get Conn
       public function getConn()
       {
              return $this->conn;
       }

       // close Conn
       public function closeConn()
       {
              $this->conn->close();
       }
}

// $con = new Conn();