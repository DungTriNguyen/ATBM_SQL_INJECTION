<?php
// gọi các lớp liên quan
require('../DAL/connectionDatabase.php');
require('../DAL/AbstractionDAL.php');

require('../DTO/TransportDTO.php');

require('../DAL/TransportDAL.php');

class TransportBLL
{
       private $TransportDAL;

       function __construct()
       {
              $this->TransportDAL = new TransportDAL();
       }

       // lấy mảng đối tượng Transport
       function getArrObj()
       {
              $arr = $this->TransportDAL->getListObj();

              $result = array();
              if (count($arr) > 0) {
                     foreach ($arr as $item) {
                            $nameTransport = $item->getNameTransport();
                            $codeTransport = $item->getCodeTransport();
                            $affiliatedCompany = $item->getAffiliatedCompany();

                            $obj = array(
                                   "nameTransport" => $nameTransport,
                                   "codeTransport" => $codeTransport,
                                   "affiliatedCompany" => $affiliatedCompany
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

       //Lấy 1 đối tượng Transport thông qua codeTransport
       function getObj($code)
       {
              $result = $this->TransportDAL->getObj($code);
              if ($result != null) {
                     $code = $result->getCodeTransport();
                     $name = $result->getNameTransport();
                     $company = $result->getAffiliatedCompany();

                     $obj = array(
                            "codeTransport" => $code,
                            "nameTransport" => $name,
                            "affiliateCompany" => $company,
                            "mess" => "Success"
                     );
                     return $obj;
              } else {
                     return array("mess" => "Not Found");
              }
       }

       //Cập nhật đối tượng thông qua đối tượng
       function updateObj($obj)
       {
              if ($obj != null) {
                     $result = $this->TransportDAL->upadateObj($obj);
                     if ($result) {
                            return array("mess" => "success");
                     } else {
                            return array("mess" => "failed");
                     }
              }
              return array("mess" => "Not Found");
       }

       //Xóa đối tượng thông qua codeTransport
       function deleteObjByID($code)
       {
              $result = $this->TransportDAL->deleteByID($code);
              if ($result) {
                     return array("mess" => "success");
              } else {
                     return array("mess" => "failed");
              }
       }

       //Xóa đối tượng thông qua chính đối tượng truyền vào
       function deleteObj($obj)
       {
              if ($obj != null) {
                     $result = $this->TransportDAL->delete($obj);
                     if ($result) {
                            return array("mess" => "Success");
                     } else {
                            return array("mess" => "Failed");
                     }
              }
              return array("mess" => "Not Found");
       }

       //Thêm đối tượng
       function addTransportByObj($obj)
       {
              if ($obj != null) {
                     // lấy thông tin từ đối tượng
                     $nameTransport = $obj->getNameTransport();
                     $codeTransport = $obj->getCodeTransport();
                     $affiliatedCompany = $obj->getAffiliatedCompany();
                     // Thực hiện thêm đối tượng trong CSDL
                     $result  = $this->TransportDAL->addObj($obj);
                     if ($result == true) {
                            return array(
                                   "codeTransport" => $codeTransport,
                                   "nameTransport" => $nameTransport,
                                   "affiliatedCompany" => $affiliatedCompany,
                                   "mess" => "success"
                            );
                     } else {
                            return array("mess" => "failed");
                     }
              }
              return array("mess" => "error");
       }

       function searchTransports($str)
       {
              $arr = $this->TransportDAL->getListObj();
              // Chuyển cả hai chuỗi về chữ thường
              $keyword = strtolower($str);

              $result = array();
              if (count($arr) > 0) {
                     foreach ($arr as $item) {
                            $nameTransport = $item->getNameTransport();
                            $codeTransport = $item->getCodeTransport();
                            $affiliatedCompany = $item->getAffiliatedCompany();

                            $nameTransport_lowercase = strtolower($nameTransport);
                            $codeTransport_lowercase = strtolower($codeTransport);
                            $affiliatedCompany_lowercase = strtolower($affiliatedCompany);
                            
                            if (
                                   strpos($nameTransport_lowercase, $keyword) !== false ||
                                   strpos($codeTransport_lowercase, $keyword) !== false ||
                                   strpos($affiliatedCompany_lowercase, $keyword) !== false
                            ) {

                                   $obj = array(
                                          "nameTransport" => $nameTransport,
                                          "codeTransport" => $codeTransport,
                                          "affiliatedCompany" => $affiliatedCompany,
                                          "mess" => "success"
                                   );
                                   array_push($result, $obj);
                            }
                     }
                     return $result;
              } else {
                     return $result;
              }
       }
}



// mục lục
header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       $check = new TransportBLL();

       $function = $_POST['function'];
       // menu
       switch ($function) {
              case 'getArrObj':
                     $temp = $check->getArrObj();
                     echo json_encode($temp);
                     break;

              case 'getObj':
                     $code = $_POST['codeTransport'];
                     $temp = $check->getObj($code);
                     echo json_encode($temp);
                     break;

              case 'deleteObj':
                     $code = $_POST['codeTransport'];
                     $name = $_POST['nameTransport'];
                     $company = $_POST['affiliatedCompany'];

                     $obj = new TransportDTO($name, $code, $company);
                     $temp = $check->deleteObj($obj);
                     echo json_encode($temp);
                     break;

              case 'deleteObjByID':
                     $code = $_POST['codeTransport'];
                     $temp = $check->deleteObjByID($code);
                     echo json_encode($temp);
                     break;

              case 'updateObj':
                     $code = $_POST['codeTransport'];
                     $name = $_POST['nameTransport'];
                     $company = $_POST['affiliatedCompany'];

                     $obj = new TransportDTO($name, $code, $company);
                     $temp = $check->updateObj($obj);
                     echo json_encode($temp);
                     break;

              case 'addObj':
                     $code = $_POST['codeTransport'];
                     $name = $_POST['nameTransport'];
                     $company = $_POST['affiliatedCompany'];

                     $obj = new TransportDTO($name, $code, $company);
                     $temp = $check->addTransportByObj($obj);
                     echo json_encode($temp);
                     break;

              case 'searchTransports':
                     $str = $_POST['str'];
                     $temp = $check->searchTransports($str);
                     echo json_encode($temp);
                     break;
       }
}
