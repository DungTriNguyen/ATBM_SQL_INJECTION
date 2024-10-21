<?php
// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/ShirtSizeDTO.php');

class ShirtSizeDAL extends AbstractionDAL
{


       private $actionSQL = null;
       public function __construct()
       {
              parent::__construct();
              $this->actionSQL = parent::getConn();

              // if ($this->actionSQL != null) {
              //        echo 'thanh cong';
              // }
       }

       // xóa một đối tượng bởi mã đối tượng 
       function deleteByID($code)
       {
              // do bang khong co khoa chinh
       }
       function deleteSizeCode($productCode,$code)
       {
              // xóa dựa theo mã size
              if ($code != null) {
                     $string = "DELETE FROM shirtsize WHERE sizeCode = '$code' and productCode = '$productCode'";

                     return $this->actionSQL->query($string);
              } else {
                     return false;
              }
       }

       // xóa một đối tượng bằng cách truyền đối tượng vào
       function delete($obj)
       {
              // xóa dựa theo khóa giữa mã sản phẩm và mã size
              if ($obj != null) {
                     $sizeCode = $obj->getSizeCode();
                     $productCode = $obj->getProductCode();

                     $string = "DELETE FROM shirtsize WHERE sizeCode = '$sizeCode' AND productCode = '$productCode'";

                     return $this->actionSQL->query($string);
              } else {
                     return false;
              }
       }

       // lấy ra mảng các đối tượng
       function getListObj()
       {
              // Mảng để lưu danh sách các đối tượng
              $shirtSizeList = array();

              // Câu lệnh truy vấn
              $query = 'SELECT * FROM ShirtSize';

              // Thực hiện truy vấn
              $result = $this->actionSQL->query($query);

              // Kiểm tra số hàng được trả về
              if ($result->num_rows > 0) {
                     // Lặp qua các hàng dữ liệu và thêm vào mảng
                     while ($data = $result->fetch_assoc()) {
                            $sizeCode = $data["sizeCode"];
                            $productCode = $data["productCode"];
                            $quantity = $data["quantity"];

                            // Tạo đối tượng ShirtSizeDTO và thêm vào mảng
                            $shirtSize = new ShirtSizeDTO($sizeCode, $productCode, $quantity);
                            array_push($shirtSizeList, $shirtSize);
                     }
                     return $shirtSizeList;
              } else {
                     // Trường hợp không có dữ liệu trả về
                     // Có thể xử lý thông báo hoặc trả về null
                     return null;
              }
       }

       // lấy ra một đối tượng dựa theo mã đối tượng
       function getObj($code)
       {
              // không thể lấy vì bảng không có kháo chính
       }

       function getObjByProductCodeAndSizeCode($productCode, $sizeCode)
       {
              // Câu lệnh truy vấn
              $query = "SELECT * FROM ShirtSize WHERE productCode = '$productCode' AND sizeCode = '$sizeCode'";

              // Thực hiện truy vấn
              $result = $this->actionSQL->query($query);

              if ($result->num_rows > 0) {
                     $data = $result->fetch_assoc();
                     $sizeCode = $data["sizeCode"];
                     $productCode = $data["productCode"];
                     $quantity = $data["quantity"];

                     // Tạo đối tượng ShirtSizeDTO và thêm vào mảng
                     $shirtSize = new ShirtSizeDTO($sizeCode, $productCode, $quantity);

                     return $shirtSize;
              }else{
                     return null;
              }
       }

       function getArrByProductCode($code)
       {
              // Mảng để lưu danh sách các đối tượng
              $shirtSizeList = array();

              // Câu lệnh truy vấn
              $query = "SELECT * FROM ShirtSize WHERE productCode = '$code'";

              // Thực hiện truy vấn
              $result = $this->actionSQL->query($query);

              // Kiểm tra số hàng được trả về
              if ($result->num_rows > 0) {
                     // Lặp qua các hàng dữ liệu và thêm vào mảng
                     while ($data = $result->fetch_assoc()) {
                            $sizeCode = $data["sizeCode"];
                            $productCode = $data["productCode"];
                            $quantity = $data["quantity"];

                            // Tạo đối tượng ShirtSizeDTO và thêm vào mảng
                            $shirtSize = new ShirtSizeDTO($sizeCode, $productCode, $quantity);
                            array_push($shirtSizeList, $shirtSize);
                     }
                     return $shirtSizeList;
              } else {
                     // Trường hợp không có dữ liệu trả về
                     // Có thể xử lý thông báo hoặc trả về null
                     return null;
              }
       }
       function checkSizeCodeExists($productCode, $sizeCode)
       {
              $query = "SELECT * FROM ShirtSize WHERE productCode = '$productCode' AND sizeCode = '$sizeCode'";
              $result = $this->actionSQL->query($query);
              return $result->num_rows > 0;
       }
       function getArrBySizeCode($code)
       {
              // Mảng để lưu danh sách các đối tượng
              $shirtSizeList = array();

              // Câu lệnh truy vấn
              $query = "SELECT * FROM ShirtSize WHERE sizeCode = '$code'";

              // Thực hiện truy vấn
              $result = $this->actionSQL->query($query);

              // Kiểm tra số hàng được trả về
              if ($result->num_rows > 0) {
                     // Lặp qua các hàng dữ liệu và thêm vào mảng
                     while ($data = $result->fetch_assoc()) {
                            $sizeCode = $data["sizeCode"];
                            $productCode = $data["productCode"];
                            $quantity = $data["quantity"];

                            // Tạo đối tượng ShirtSizeDTO và thêm vào mảng
                            $shirtSize = new ShirtSizeDTO($sizeCode, $productCode, $quantity);
                            array_push($shirtSizeList, $shirtSize);
                     }
                     return $shirtSizeList;
              } else {
                     // Trường hợp không có dữ liệu trả về
                     // Có thể xử lý thông báo hoặc trả về null
                     return null;
              }
       }

       // thêm một đối tượng 
       function addObj($obj)
       {
              if ($obj != null) {
                     $sizeCode = $obj->getSizeCode();
                     $productCode = $obj->getProductCode();
                     // Kiểm tra xem có sự trùng lặp thuộc tính khóa không
                     $checkQuery = "SELECT * FROM ShirtSize WHERE sizeCode = '$sizeCode' AND productCode = '$productCode'";
                     $checkResult = $this->actionSQL->query($checkQuery);

                     if ($checkResult->num_rows < 1) {

                            $quantity = $obj->getQuantity();

                            // Câu lệnh truy vấn để chèn dữ liệu
                            $insertQuery = "INSERT INTO ShirtSize (sizeCode, productCode, quantity) VALUES ('$sizeCode', '$productCode', '$quantity')";

                            // Thực hiện truy vấn
                            return $this->actionSQL->query($insertQuery);
                     } else {
                            // Trường hợp có sự trùng lặp
                            return false;
                     }
              } else {
                     // Trường hợp đối tượng trống
                     return false;
              }
       }
       function addSizeCode($productCode,$sizeCode,$quantity)
       {
              // thêm dựa theo mã size
              if ($sizeCode != null) {
                     $string = "INSERT INTO shirtsize (sizeCode, productCode, quantity) VALUES ('$sizeCode', '$productCode', '$quantity')";

                     return $this->actionSQL->query($string);
              } else {
                     return false;
              }
       }

       // sửa một đối tượng
       function upadateObj($obj)
       {
              if ($obj != null) {
                     $sizeCode = $obj->getSizeCode();
                     $productCode = $obj->getProductCode();
                     $quantity = $obj->getQuantity();

                     // Câu lệnh UPDATE
                     $updateQuery = "UPDATE ShirtSize 
                                     SET productCode = '$productCode', 
                                         quantity = $quantity 
                                         WHERE sizeCode = '$sizeCode' AND productCode = '$productCode'";

                     // Thực hiện truy vấn
                     return $this->actionSQL->query($updateQuery);
              } else {
                     // Trường hợp đối tượng trống
                     return false;
              }
       }
}

// check

// $check = new ShirtSizeDAL();

// print_r($check->getListObj());

// print_r($check->getArrByProductCode('P001'));

// print_r($check->getArrBySizeCode('S001'));

// echo $check->addObj(new ShirtSizeDTO('S003','P017',17));

// echo $check->upadateObj(new ShirtSizeDTO('S003','P017',15));

// echo $check->delete(new ShirtSizeDTO('S003','P017',50));