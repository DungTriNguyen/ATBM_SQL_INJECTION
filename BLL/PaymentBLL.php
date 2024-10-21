<?php
// gọi các lớp liên quan
require('../DAL/connectionDatabase.php');
require('../DAL/AbstractionDAL.php');


require('../DTO/PaymentDTO.php');

require('../DAL/PaymentDAL.php');

class PaymentBLL
{
       private $PaymentDAL;

       function __construct()
       {
              $this->PaymentDAL = new PaymentDAL();
       }

       // lấy mảng đối tượng payment
       function getArrObj()
       {

              // 
              $arr = $this->PaymentDAL->getListObj();
              $result = array();
              if (count($arr) > 0) {
                     foreach ($arr as $item) {

                            $namePayment = $item->getNamePayment();
                            $codePayments = $item->getCodePayments();
                            $affiliatedBank = $item->getAffiliatedBank();

                            $obj = array(
                                   "namePayment" => $namePayment,
                                   "codePayments" => $codePayments,
                                   "affiliatedBank" => $affiliatedBank,
                                   "mess" => "Success"
                            );
                            array_push($result, $obj);
                     }
                     return $result;
              } else {
                     return array(
                            "mess" => "empty"
                     );
              }
       }
       // lấy 1 đối tượng bằng mã id cửa đối tượng đó
       function getObj($code)
       {
              $result = $this->PaymentDAL->getObj($code);
              if ($result != null) {
                     $code = $result->getCodePayments();
                     $obj = array(
                            "codePayments" => $code
                     );
                     return $result;
              } else {
                     return null;
              }
       }
       // Xóa một đối tượng sau khi lấy được id của đối tượng
       function deleteObjById($code)
       {

              $result = $this->PaymentDAL->deleteByID($code);


              if ($result) {
                     return array("mess" => "success");
              } else {
                     return array("mess" => "failed");
              }
       }
       // Xóa đối tượng khi lấy được thông tin của đối tượng 
       function deleteObj($obj)
       {
              if ($obj != null) {
                     // Lấy thông tin từ đối tượng
                     $namePayment = $obj->getNamePayment();
                     $codePayments = $obj->getCodePayments();
                     $affiliatedBank = $obj->getAffiliatedBank();

                     // Thực hiện xóa đối tượng từ cơ sở dữ liệu
                     $result = $this->PaymentDAL->delete($obj);

                     // Kiểm tra xem việc xóa có thành công hay không
                     if ($result) {
                            $obj = array(
                                   "codePayments" => $codePayments,
                                   "namePayments" => $namePayment,
                                   "affiliateBank" => $affiliatedBank
                            );
                            // Nếu xóa thành công, trả về thông báo thành công
                            return array("mess" => "success");
                     } else {
                            // Nếu xóa không thành công, trả về thông báo thất bại
                            return array("mess" => "failed");
                     }
              } else {
                     // Trả về null nếu đối tượng truyền vào là null
                     return null;
              }
       }


       //Thêm một đối tượng payment sau khi truyền vào một obj
       function addPaymentByObj($obj)
       {
              if ($obj != null) {
                     // lấy thông tin từ đối tượng
                     $namePayment = $obj->getNamePayment();
                     $codePayments = $obj->getCodePayments();
                     $affiliatedBank = $obj->getAffiliatedBank();
                     // Thực hiện thêm đối tượng trong CSDL
                     $result  = $this->PaymentDAL->addObj($obj);
                     if ($result != null) {
                            $obj = array(
                                   "codePayments" => $codePayments,
                                   "namePayments" => $namePayment,
                                   "affiliateBank" => $affiliatedBank,
                                   "mess" => "success"
                            );
                            return array("mess" => "success");
                     } else {
                            return array("mess" => "Failed");
                     }
              }
              return array("mess" => "Failed");
       }

       // Cập nhật một đối tượng payment sau khi truyền vào một obj
       function updatePaymentByObj($obj)
       {
              $result = $this->PaymentDAL->upadateObj($obj);
              if ($result) {
                     // Lấy thông tin từ đối tượng cập nhật
                     $namePayment = $obj->getNamePayment();
                     $codePayments = $obj->getCodePayments();
                     $affiliatedBank = $obj->getAffiliatedBank();

                     // Trả về mảng chứa thông báo thành công và thông tin cập nhật
                     return array(
                            "mess" => "success",
                            "codePayments" => $codePayments,
                            "namePayments" => $namePayment,
                            "affiliateBank" => $affiliatedBank
                     );
              } else {
                     return array("mess" => "Failed");
              }
       }


       // Tìm kiếm
       function searchPayment($str)
       {
              $arr = $this->PaymentDAL->getListObj();
              $result = array();
              if (count($arr) > 0) {
                     foreach ($arr as $item) {
                            $namePayment = $item->getNamePayment();
                            $codePayments = $item->getCodePayments();
                            $affiliatedBank = $item->getAffiliatedBank();

                            // Kiểm tra nếu chuỗi $str xuất hiện trong bất kỳ trường nào của đối tượng
                            if (
                                   strpos(strtolower($namePayment), $str) !== false || strpos(strtolower($codePayments), $str) !== false  ||
                                   strpos(strtolower($affiliatedBank), $str) !== false
                            ) {
                                   $obj = array(
                                          "codePayments" => $codePayments,
                                          "namePayment" => $namePayment,
                                          "affiliatedBank" => $affiliatedBank,
                                          "mess" => "Success",
                                   );
                                   array_push($result, $obj);
                            }
                     }
              }
              return $result;
       }
}



// mục lục
header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       $check = new PaymentBLL();

       $function = $_POST['function'];
       // checkLogin
       // menu
       switch ($function) {
              case 'getArrObj':
                     $temp = $check->getArrObj();
                     echo json_encode($temp);
                     break;
              case 'deletObjById':
                     $codePayments = $_POST['codePayments'];
                     $temp = $check->deleteObjById($codePayments);
                     echo json_encode($temp);
                     break;
              case 'deleteObj':
                     // Lấy dữ liệu đối tượng từ POST request
                     $namePayment = $_POST['namePayment'];
                     $codePayments = $_POST['codePayments'];
                     $affiliatedBank = $_POST['affiliatedBank'];
                     // Tạo một đối tượng PaymentDTO từ dữ liệu POST
                     $obj = new PaymentDTO($namePayment, $codePayments, $affiliatedBank);
                     // Gọi hàm deleteObj() với đối tượng đã tạo
                     $temp = $check->deleteObj($obj);
                     echo json_encode($temp);
                     break;
              case 'addPaymentByObj':
                     // Lấy dữ liệu đối tượng từ POST request
                     $namePayment = $_POST['namePayment'];
                     $codePayments = $_POST['codePayments'];
                     $affiliatedBank = $_POST['affiliatedBank'];
                     // Tạo một đối tượng PaymentDTO từ dữ liệu POST
                     $obj = new PaymentDTO($namePayment, $codePayments, $affiliatedBank);
                     $temp = $check->addPaymentByObj($obj);
                     echo json_encode($temp);
                     break;
              case 'updatePaymentByObj':
                     // Lấy dữ liệu đối tượng từ POST request
                     $namePayment = $_POST['namePayment'];
                     $codePayments = $_POST['codePayments'];
                     $affiliatedBank = $_POST['affiliatedBank'];
                     // Tạo một đối tượng PaymentDTO từ dữ liệu POST
                     $obj = new PaymentDTO($namePayment, $codePayments, $affiliatedBank);
                     $temp = $check->updatePaymentByObj($obj);
                     echo json_encode($temp);
                     break;
              case 'searchPayment':
                     $str = $_POST['str'];
                     $temp = $check->searchPayment($str);
                     echo json_encode($temp);
       }
}
