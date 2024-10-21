<?php
// gọi các lớp liên quan
require('../DAL/connectionDatabase.php');
require('../DAL/AbstractionDAL.php');

require('../DTO/PermissionDTO.php');
require('../DTO/PermissionsDetailDTO.php');
require('../DTO/FunctionsDTO.php');

require('../DAL/PermissionDAL.php');
require('../DAL/PermissionsDetailDAL.php');
require('../DAL/FunctionsDAL.php');

class PermissionBLL
{

       private $PermissionDAL;
       private $PermissionsDetailDAL;
       private $FunctionsDAL;
       function __construct()
       {
              $this->PermissionDAL = new PermissionDAL();
              $this->PermissionsDetailDAL = new PermissionsDetailDAL();
              $this->FunctionsDAL = new FunctionsDAL();
       }

       // lấy mảng chứa permissionDAL
       function getArrPermissionDetail($codePermission)
       {
              $permissionObj = $this->PermissionDAL->getObj($codePermission);
              $arrPermissionDetail = $this->PermissionsDetailDAL->getArrByPermission($codePermission);
              $arrFunction = $this->FunctionsDAL->getListObj();

              $result = array();

              // lấy đối tượng permission
              // $codePermission = $permissionObj->getCodePermission();
              $namePermission = $permissionObj->getNamePermission();

              $result['codePermission'] = $codePermission;
              $result['namePermission'] = $namePermission;

              $dataPermissonDetail = array();
              foreach ($arrPermissionDetail as $item) {
                     $obj = array(
                            "codePermissions" => $codePermission,
                            "functionCode" => $item->getFunctionCode(),
                            "addPermission" => $item->getAddPermission(),
                            "seePermission" => $item->getSeePermission(),
                            "deletePermission" => $item->getDeletePermission(),
                            "fixPermission" => $item->getFixPermission()
                     );
                     array_push($dataPermissonDetail, $obj);
              }
              $result['permissionDetail'] = $dataPermissonDetail;

              $dataFunction = array();
              foreach ($arrFunction as $item) {
                     $obj = array(
                            "functionCode" => $item->getFunctionCode(),
                            "functionName" => $item->getFunctionName()
                     );
                     array_push($dataFunction, $obj);
              }
              $result['function'] = $dataFunction;

              return $result;
       }

       //Lấy danh sách 
       function getList()
       {
              //mảng dữ liệu lấy được từ DAL
              $arr = $this->PermissionDAL->getListObj();
              //mảng chứa các obj lấy được từ DAL ở trên
              $result = array();
              if (count($arr) > 0) {
                     foreach ($arr as $item) {
                            $codePermission = $item->getCodePermission();
                            $namePermission = $item->getNamePermission();

                            $obj = array(
                                   "codePermission" => $codePermission,
                                   "namePermission" => $namePermission,
                            );
                            array_push($result, $obj);
                     }
                     return $result;
              } else {
                     return array("mess" => "Failed");
              }
       }
}

// mục lục
header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       $check = new PermissionBLL();

       $function = $_POST['function'];

       switch ($function) {
              case 'getArrPermissionDetail':
                     $codePermission = $_POST['codePermission'];
                     $temp = $check->getArrPermissionDetail($codePermission);
                     echo json_encode($temp);
                     break;
              case 'getList':
                     $temp = $check->getList();
                     echo json_encode($temp);
                     break;
       }
}
