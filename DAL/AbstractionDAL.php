<?php

// require('../DAL/connectionDatabase.php');

abstract class AbstractionDAL
{
       public $conn = null;
       public function __construct()
       {
              $conectionDATA = new ConnectionDatabase();
              $this->conn = $conectionDATA->getConn();
       }
       public function getConn()
       {
              return $this->conn;
       }
       // xóa một đối tượng bởi mã đối tượng 
       abstract function deleteByID($code);

       // xóa một đối tượng bằng cách truyền đối tượng vào
       abstract function delete($obj);

       // lấy ra mảng các đối tượng
       abstract function getListObj();

       // lấy ra một đối tượng dựa theo mã đối tượng
       abstract function getObj($code);

       // thêm một đối tượng 
       abstract function addObj($obj);

       // sửa một đối tượng
       abstract function upadateObj($obj);

       // abstract function checkLogin($username, $password);
}