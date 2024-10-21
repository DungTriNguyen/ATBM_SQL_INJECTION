<?php

// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/PaymentDTO.php');

class PaymentDAL extends AbstractionDAL
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
              // do bảng order có tham chiếu khóa ngoại đến thuộc tính khóa codePayments của bảng Payment
              // kiểm tra nếu có khóa ngoại tham chiếu đến thì không được xóa

              $check_data_Orders = "SELECT * FROM orders WHERE codePayments = '$code'";

              $resutl_1 = $this->actionSQL->query($check_data_Orders);

              if ($resutl_1->num_rows < 1) {
                     $string = "DELETE FROM payment WHERE codePayments = '$code'";

                     return $this->actionSQL->query($string);
              } else {
                     return false;
              }
       }

       // xóa một đối tượng bằng cách truyền đối tượng vào
       function delete($obj)
       {
              if ($obj != null) {
                     $code = $obj->getCodePayments();
                     // do bảng order có tham chiếu khóa ngoại đến thuộc tính khóa codePayments của bảng Payment
                     // kiểm tra nếu có khóa ngoại tham chiếu đến thì không được xóa

                     $check_data_Orders = "SELECT * FROM orders WHERE codePayments = '$code'";

                     $resutl_1 = $this->actionSQL->query($check_data_Orders);

                     if ($resutl_1->num_rows < 1) {
                            $string = "DELETE FROM payment WHERE codePayments = '$code'";

                            return $this->actionSQL->query($string);
                     } else {
                            return false;
                     }
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
              $string = 'SELECT * FROM payment';

              // Thực hiện truy vấn
              $result = $this->actionSQL->query($string);

              // Kiểm tra số hàng được trả về
              if ($result->num_rows > 0) {
                     // Lặp qua các dòng kết quả và thêm vào mảng
                     while ($data = $result->fetch_assoc()) {
                            $namePayment = $data['namePayment'];
                            $codePayments = $data["codePayments"];
                            $affiliatedBank = $data["affiliatedBank"];

                            // Tạo đối tượng PaymentDTO và thêm vào mảng
                            $payment = new PaymentDTO($namePayment, $codePayments, $affiliatedBank);
                            array_push($array_list, $payment);
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
              // Câu lệnh truy vấn
              $string = "SELECT * FROM payment WHERE codePayments = '$code'";

              // Thực hiện truy vấn
              $result = $this->actionSQL->query($string);

              if ($result->num_rows > 0) {
                     $data = $result->fetch_assoc();
                     $namePayment = $data['namePayment'];
                     $codePayments = $data["codePayments"];
                     $affiliatedBank = $data["affiliatedBank"];

                     // Tạo đối tượng PaymentDTO và trả về
                     $payment = new PaymentDTO($namePayment, $codePayments, $affiliatedBank);
                     return $payment;
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
                     $codePayments = $obj->getCodePayments();
                     // Kiểm tra xem có bị trùng thuộc tính khóa không
                     $check = "SELECT * FROM payment WHERE codePayments = '$codePayments'";
                     $resultCheck = $this->actionSQL->query($check);
                     // không có bảng ghi nào trùng khóa
                     if ($resultCheck->num_rows < 1) {
                            $namePayment = $obj->getNamePayment();
                            $affiliatedBank = $obj->getAffiliatedBank();

                            // Câu lệnh truy vấn
                            $string = "INSERT INTO payment (namePayment, codePayments, affiliatedBank) VALUES ('$namePayment', '$codePayments', '$affiliatedBank')";

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
                     $codePayments = $obj->getCodePayments();
                     $namePayment = $obj->getNamePayment();
                     $affiliatedBank = $obj->getAffiliatedBank();

                     // Câu lệnh UPDATE
                     $string = "UPDATE payment 
                                 SET namePayment = '$namePayment', 
                                     affiliatedBank = '$affiliatedBank' 
                                 WHERE codePayments = '$codePayments'";

                     return $this->actionSQL->query($string);
              } else {
                     return false;
              }
       }
}

// check

// $check = new PaymentDAL();

// $check->getListObj();

// print_r($check->getListObj());

// echo $check->getObj('AP004')->getCodePayments();

// echo $check->addObj(new PaymentDTO('test', 'test', 'test'));

// echo $check->upadateObj(new PaymentDTO('test', 'test', '123'));

// echo $check->delete(new PaymentDTO('test', 'test', '123'));

// echo $check->deleteByID('PP001');