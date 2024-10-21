<?php

// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/TransportDTO.php');

class TranSportDAL extends AbstractionDAL
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
              // do bảng order có tham chiếu khóa ngoại đến thuộc tính khóa codeTransport của bảng transport
              // kiểm tra nếu có khóa ngoại tham chiếu đến thì không được xóa

              $check_data_Orders = "SELECT * FROM orders WHERE codeTransport = '$code'";

              $resutl_1 = $this->actionSQL->query($check_data_Orders);

              if ($resutl_1->num_rows < 1) {
                     $string = "DELETE FROM transport WHERE codeTransport = '$code'";

                     return $this->actionSQL->query($string);
              } else {
                     return false;
              }
       }

       // xóa một đối tượng bằng cách truyền đối tượng vào
       function delete($obj)
       {
              if ($obj != null) {
                     $code = $obj->getCodeTransport();
                     // do bảng order có tham chiếu khóa ngoại đến thuộc tính khóa codeTransport của bảng transport
                     // kiểm tra nếu có khóa ngoại tham chiếu đến thì không được xóa

                     $check_data_Orders = "SELECT * FROM orders WHERE codeTransport = '$code'";

                     $resutl_1 = $this->actionSQL->query($check_data_Orders);

                     if ($resutl_1->num_rows < 1) {
                            $string = "DELETE FROM transport WHERE codeTransport = '$code'";

                            return $this->actionSQL->query($string);
                     } else {
                            return false;
                     }
              }
       }

       // lấy ra mảng các đối tượng
       function getListObj()
       {
              // Mảng để lưu trữ các đối tượng
              $array_list = array();

              // Câu lệnh truy vấn
              $string = 'SELECT * FROM Transport';

              // Thực hiện truy vấn
              $result = $this->actionSQL->query($string);

              // Kiểm tra số hàng được trả về
              if ($result->num_rows > 0) {
                     // Lặp qua các dòng kết quả và thêm vào mảng
                     while ($data = $result->fetch_assoc()) {
                            $nameTransport = $data['nameTransport'];
                            $codeTransport = $data["codeTransport"];
                            $affiliatedCompany = $data["affiliatedCompany"];

                            // Tạo đối tượng TransportDTO và thêm vào mảng
                            $transport = new TransportDTO($nameTransport, $codeTransport, $affiliatedCompany);
                            array_push($array_list, $transport);
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
              $string = "SELECT * FROM Transport WHERE codeTransport = '$code'";

              // Thực hiện truy vấn
              $result = $this->actionSQL->query($string);

              if ($result->num_rows > 0) {
                     $data = $result->fetch_assoc();
                     $nameTransport = $data['nameTransport'];
                     $codeTransport = $data["codeTransport"];
                     $affiliatedCompany = $data["affiliatedCompany"];

                     // Tạo đối tượng TransportDTO và trả về
                     $transport = new TransportDTO($nameTransport, $codeTransport, $affiliatedCompany);
                     return $transport;
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
                     $codeTransport = $obj->getCodeTransport();
                     // Kiểm tra xem có bị trùng thuộc tính khóa không
                     $check = "SELECT * FROM Transport WHERE codeTransport = '$codeTransport'";
                     $resultCheck = $this->actionSQL->query($check);

                     if ($obj != null && $resultCheck->num_rows < 1) {
                            $nameTransport = $obj->getNameTransport();
                            $affiliatedCompany = $obj->getAffiliatedCompany();

                            // Câu lệnh truy vấn
                            $string = "INSERT INTO Transport (nameTransport, codeTransport, affiliatedCompany) VALUES ('$nameTransport', '$codeTransport', '$affiliatedCompany')";

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
                     $codeTransport = $obj->getCodeTransport();
                     $nameTransport = $obj->getNameTransport();
                     $affiliatedCompany = $obj->getAffiliatedCompany();

                     // Câu lệnh UPDATE
                     $string = "UPDATE Transport 
                                 SET nameTransport = '$nameTransport', 
                                     affiliatedCompany = '$affiliatedCompany' 
                                 WHERE codeTransport = '$codeTransport'";

                     return $this->actionSQL->query($string);
              } else {
                     return false;
              }
       }
}

// check

// $check = new TranSportDAL();

// $check->getListObj();

// print_r($check->getListObj());

// echo $check->getObj('ECO003')->getCodeTransport();

// echo $check->addObj(new TransportDTO('test', 'test', 'test'));

// echo $check->upadateObj(new TransportDTO('test', 'test', '123'));

// echo $check->delete(new TransportDTO('test', 'test', '123'));
