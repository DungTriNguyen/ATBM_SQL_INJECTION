<?php

// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/orderDetailDTO.php');

class OrderDetailDAL extends AbstractionDAL
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
              // do bảng không có khóa chính nên không thể xóa theo code
       }

       // xóa một đối tượng bằng cách truyền đối tượng vào
       function delete($obj)
       {
              if ($obj != null) {
                     $orderCode = $obj->getOrderCode();
                     $productCode = $obj->getProductCode();
                     $string = "DELETE FROM orderDetail WHERE orderCode = '$orderCode' AND productCode = '$productCode'";

                     return $this->actionSQL->query($string);
              } else {
                     return false;
              }
       }

       // lấy ra mảng các đối tượng
       function getListObj()
       {
              // Mảng để lưu trữ các đối tượng
              $array_list = array();

              // Câu lệnh truy vấn
              $string = 'SELECT * FROM orderDetail';

              // Thực hiện truy vấn
              $result = $this->actionSQL->query($string);

              // Kiểm tra số hàng được trả về
              if ($result->num_rows > 0) {
                     // Lặp qua các dòng kết quả và thêm vào mảng
                     while ($data = $result->fetch_assoc()) {
                            $orderCode = $data['orderCode'];
                            $productCode = $data['productCode'];
                            $nameProduct = $data['nameProduct'];
                            $priceProduct = $data['priceProduct'];
                            $quantity = $data['quantity'];
                            $sizeCode = $data["sizeCode"];
                            $totalMoney = $data['totalMoney'];

                            // Tạo đối tượng OrderDetailDTO và thêm vào mảng
                            $orderDetail = new OrderDetailDTO($orderCode, $productCode, $nameProduct, $quantity, $sizeCode,$priceProduct, $totalMoney);
                            array_push($array_list, $orderDetail);
                     }
                     return $array_list;
              } else {
                     // Trường hợp không có dữ liệu trả về
                     // echo "Không có dữ liệu được trả về từ truy vấn.";
                     return null;
              }
       }

       // lấy ra một đối tượng dựa theo mã đối tượng
       function getObj($code)
       {
              // do bảng không có khóa chính nên không thể lấy một đối tượng cụ thể theo khóa
       }

       function getArr_ByCodeOrder($code)
       {
              // Câu lệnh truy vấn
              $string = "SELECT * FROM orderDetail WHERE orderCode = '$code'";

              // Thực hiện truy vấn
              $result = $this->actionSQL->query($string);

              if ($result->num_rows > 0) {
                     $arr = array();
                     while ($data = $result->fetch_assoc()) {
                            $orderCode = $data['orderCode'];
                            $productCode = $data["productCode"];
                            $nameProduct = $data["nameProduct"];
                            $priceProduct = $data["priceProduct"];
                            $quantity = $data["quantity"];
                            $sizeCode = $data["sizeCode"];
                            $totalMoney = $data["totalMoney"];

                            // Tạo đối tượng OrderDetailDTO và trả về
                            $orderDetail = new OrderDetailDTO($orderCode, $productCode, $nameProduct, $quantity, $sizeCode,$priceProduct, $totalMoney);

                            array_push($arr, $orderDetail);
                     }
                     return $arr;
              } else {
                     // Trường hợp không có dữ liệu trả về
                     // echo "Không có dữ liệu được trả về từ truy vấn.";
                     return null;
              }
       }

       function getArrByProductCode($code)
       {
              // Câu lệnh truy vấn
              $string = "SELECT * FROM orderDetail WHERE productCode = '$code'";

              // Thực hiện truy vấn
              $result = $this->actionSQL->query($string);

              if ($result->num_rows > 0) {
                     $arr = array();
                     while ($data = $result->fetch_assoc()) {
                            $orderCode = $data['orderCode'];
                            $productCode = $data["productCode"];
                            $nameProduct = $data["nameProduct"];
                            $priceProduct = $data["priceProduct"];
                            $quantity = $data["quantity"];
                            $sizeCode = $data["sizeCode"];
                            $totalMoney = $data["totalMoney"];

                            // Tạo đối tượng OrderDetailDTO và trả về
                            $orderDetail = new OrderDetailDTO($orderCode, $productCode, $nameProduct, $quantity, $sizeCode,$priceProduct, $totalMoney);

                            array_push($arr, $orderDetail);
                     }
                     return $arr;
              } else {
                     // Trường hợp không có dữ liệu trả về
                     // echo "Không có dữ liệu được trả về từ truy vấn.";
                     return null;
              }
       }

       // thêm một đối tượng 
       function addObj($obj)
       {
              if ($obj != null) {
                     $orderCode = $obj->getOrderCode();
                     $productCode = $obj->getProductCode();
                     // Kiểm tra xem có bị trùng thuộc tính khóa không
                     $check = "SELECT * FROM orderdetail WHERE orderCode = '$orderCode' AND productCode = '$productCode'";
                     $resultCheck = $this->actionSQL->query($check);

                     if ($resultCheck->num_rows < 1) {
                            $nameProduct = $obj->getNameProduct();
                            $priceProduct = $obj->getPriceProduct();
                            $quantity = $obj->getQuantity();
                            $totalMoney = $obj->getTotalMoney();
                            $sizeCode = $obj->getSizeCode();
                            // Câu lệnh truy vấn
                            $string = "INSERT INTO orderDetail (orderCode, productCode, nameProduct, priceProduct, quantity,sizeCode, totalMoney) VALUES ('$orderCode', '$productCode', '$nameProduct', $priceProduct, $quantity,'$sizeCode', $totalMoney)";

                            return $this->actionSQL->query($string);
                     } else {
                            return false;
                     }
              } else {
                     return false;
              }
       }

       // sửa một đối tượng
       function upadateObj($obj)
       {
              if ($obj != null) {
                     $orderCode = $obj->getOrderCode();
                     $productCode = $obj->getProductCode();
                     $nameProduct = $obj->getNameProduct();
                     $priceProduct = $obj->getPriceProduct();
                     $quantity = $obj->getQuantity();
                     $sizeCode = $obj->getSizeCode();
                     $totalMoney = $obj->getTotalMoney();

                     // Câu lệnh UPDATE
                     $string = "UPDATE orderDetail 
                                 SET nameProduct = '$nameProduct', 
                                     priceProduct = $priceProduct, 
                                     quantity = $quantity, 
                                     sizeCode = $sizeCode,
                                     totalMoney = $totalMoney 
                                 WHERE orderCode = '$orderCode' AND productCode = '$productCode'";

                     return $this->actionSQL->query($string);
              } else {
                     return false;
              }
       }
}

// check

// $check = new OrderDetailDAL();

// $check->getListObj();

// print_r($check->getListObj());

// print_r($check->getArrByProductCode('P002'));

// echo $check->addObj(new OrderDetailDTO('ORD003', 'P001', '', 10, 0, 0));

// echo $check->upadateObj(new OrderDetailDTO('ORD003', 'P001', '', 0, 0, 0));

// echo $check->delete(new OrderDetailDTO('ORD003', 'P001', '', 0, 0, 0));
