<?php
// gọi các lớp liên quan
require('../DAL/connectionDatabase.php');
require('../DAL/AbstractionDAL.php');
//

require('../DTO/SizeDTO.php');

require('../DAL/SizeDAL.php');


class SizeBLL
{
       private $SizeDAL;

       function __construct()
       {
              $this->SizeDAL = new SizeDAL();
       }

       // lấy mảng đối tượng payment
       function getArrObj()
       {

              // 
              $arr = $this->SizeDAL->getListObj();

              $result = array();
              if (count($arr) > 0) {
                     foreach ($arr as $item) {
                            $nameSize = $item->getSizeName();
                            $codeSize = $item->getSizeCode();

                            $obj = array(
                                   "sizeName" => $nameSize,
                                   "sizeCode" => $codeSize
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

       function updateSize($obj)
       {
              if ($obj != null) {
                     $result = $this->SizeDAL->upadateObj($obj);
                     if ($result) {
                            return array("mess" => "success");
                     } else {
                            return array("mess" => "failed");
                     }
              }
              return array("mess" => "Not Found");
       }
       function searchSizes($str)
       {
              $arr = $this->SizeDAL->getListObj();

              $result = array();
              if (count($arr) > 0) {
                     foreach ($arr as $item) {
                            $nameSize = $item->getSizeName();
                            $codeSize = $item->getSizeCode();

                            if (strpos(strtolower($nameSize), $str) !== false || strpos(strtolower($codeSize), $str) !== false) {
                                   $obj = array(
                                          "sizeName" => $nameSize,
                                          "sizeCode" => $codeSize,
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
       function addSize($Obj)
       {

              if ($Obj != null) {
                     $nameSize = $Obj->getSizeName();
                     $codeSize = $Obj->getSizeCode();

                     $result = $this->SizeDAL->addObj($Obj);
                     if ($result == true) {
                            return array(
                                   "sizeName" => $nameSize,
                                   "sizeCode" => $codeSize,
                                   "mess" => "success"
                            );
                     } else {
                            return array(
                                   "mess" => "error"
                            );
                     }
              }
              return array("mess" => "error");
       }
}

// mục lục
header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       $check = new SizeBLL();

       $function = $_POST['function'];
       // checkLogin
       // menu
       switch ($function) {
              case 'getArrObj':
                     $temp = $check->getArrObj();
                     echo json_encode($temp);
                     break;
              case 'searchSizes':
                     $str = $_POST["str"];
                     $temp = $check->searchSizes($str);
                     echo json_encode($temp);
                     break;
              case 'addSize';
                     $nameStr = $_POST['nameSize'];
                     $codeStr = $_POST['sizeCode'];
                     $Size = new SizeDTO($codeStr, $nameStr);
                     $temp = $check->addSize($Size);
                     echo json_encode($temp);
                     break;
              case 'updateSize':
                     $code = $_POST['sizeCode'];
                     $name = $_POST['nameSize'];

                     $obj = new SizeDTO($code, $name);
                     $temp = $check->updateSize($obj);
                     echo json_encode($temp);
                     break;
       }
}
