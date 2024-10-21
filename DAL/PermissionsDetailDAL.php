<?php
// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/PermissionsDetailDTO.php');

class PermissionsDetailDAL extends AbstractionDAL
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
              // không có khóa chính
       }

       // xóa một đối tượng bằng cách truyền đối tượng vào
       function delete($obj)
       {
              if ($obj != null) {
                     $codePermissions = $obj->getCodePermissions();
                     $functionCode = $obj->getFunctionCode();
                     $string = "DELETE FROM permissionsDetail WHERE codePermissions = '$codePermissions' AND functionCode = '$functionCode'";

                     return $this->actionSQL->query($string);
              } else {
                     return false;
              }
       }

       // xóa đối tượng theo mã codePermission
       function deleteObj_by_codePermission($codePermission)
       {
              $query = "DELETE FROM permissionsDetail WHERE codePermissions = '$codePermission'";
              return $this->actionSQL->query($query);
       }

       // lấy ra mảng các đối tượng
       function getListObj()
       {
              // Mảng để lưu trữ các đối tượng
              $array_list = array();

              // Câu lệnh truy vấn
              $query = 'SELECT * FROM permissionsDetail';

              // Thực thi truy vấn
              $result = $this->actionSQL->query($query);

              // Kiểm tra số hàng được trả về
              if ($result->num_rows > 0) {
                     // Lặp qua từng hàng dữ liệu và tạo đối tượng PermissionDTO
                     while ($data = $result->fetch_assoc()) {
                            $codePermissions = $data["codePermissions"];
                            $functionCode = $data["functionCode"];
                            $addPermission = $data["addPermission"];
                            $seePermission = $data["seePermission"];
                            $deletePermission = $data["deletePermission"];
                            $fixPermission = $data["fixPermission"];

                            // Tạo đối tượng PermissionDTO và thêm vào mảng
                            $permission = new PermissionsDetailDTO($codePermissions, $functionCode, $addPermission, $seePermission, $deletePermission, $fixPermission);
                            array_push($array_list, $permission);
                     }
                     // Trả về mảng các đối tượng PermissionDTO
                     return $array_list;
              } else {
                     // Trường hợp không có dữ liệu trả về
                     // echo "Không có dữ liệu được trả về từ truy vấn.";
                     return null;
              }
       }



       // lấy ra một array đối tượng dựa theo mã đối tượng
       function getObj($code)
       {
              // bảng không có khóa chính nên không thể truy suất ra 1 đối tượng cựu thể dựa theo mã code
       }

       // truy suất theo codePermission

       function getArrByPermission($code)
       {
              // Câu lệnh truy vấn
              $query = "SELECT * FROM permissionsDetail WHERE codePermissions = '$code'";

              // Thực thi truy vấn
              $result = $this->actionSQL->query($query);

              // Kiểm tra số hàng được trả về
              if ($result->num_rows > 0) {
                     $array = array();

                     while ($data = $result->fetch_assoc()) {

                            $codePermissions = $data["codePermissions"];
                            $functionCode = $data["functionCode"];
                            $addPermission = $data["addPermission"];
                            $seePermission = $data["seePermission"];
                            $deletePermission = $data["deletePermission"];
                            $fixPermission = $data["fixPermission"];

                            // Tạo đối tượng PermissionDTO từ dữ liệu và trả về
                            $permissionDetail = new PermissionsDetailDTO($codePermissions, $functionCode, $addPermission, $seePermission, $deletePermission, $fixPermission);

                            array_push($array, $permissionDetail);
                     }
                     return $array;
              } else {
                     // Trường hợp không có dữ liệu trả về
                     // echo "Không có dữ liệu được trả về từ truy vấn.";
                     return null;
              }
       }

       // truy suất theo function 
       function getArrByFunctionCode($code)
       {
              // Câu lệnh truy vấn
              $query = "SELECT * FROM permissionsDetail WHERE functionCode = '$code'";

              // Thực thi truy vấn
              $result = $this->actionSQL->query($query);

              // Kiểm tra số hàng được trả về
              if ($result->num_rows > 0) {
                     $array = array();

                     while ($data = $result->fetch_assoc()) {

                            $codePermissions = $data["codePermissions"];
                            $functionCode = $data["functionCode"];
                            $addPermission = $data["addPermission"];
                            $seePermission = $data["seePermission"];
                            $deletePermission = $data["deletePermission"];
                            $fixPermission = $data["fixPermission"];

                            // Tạo đối tượng PermissionDTO từ dữ liệu và trả về
                            $permissionDetail = new PermissionsDetailDTO($codePermissions, $functionCode, $addPermission, $seePermission, $deletePermission, $fixPermission);

                            array_push($array, $permissionDetail);
                     }
                     return $array;
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
                     $codePermissions = $obj->getCodePermissions();
                     $functionCode = $obj->getFunctionCode();

                     $check = "SELECT * FROM permissionsDetail WHERE codePermissions = '$codePermissions' AND functionCode = '$functionCode'";
                     $resultCheck = $this->actionSQL->query($check);

                     if ($resultCheck->num_rows < 1) {
                            $addPermission = $obj->getAddPermission();
                            $seePermission = $obj->getSeePermission();
                            $deletePermission = $obj->getDeletePermission();
                            $fixPermission = $obj->getFixPermission();

                            // Câu lệnh truy vấn để thêm dữ liệu mới
                            $query = "INSERT INTO permissionsDetail (codePermissions, functionCode, addPermission, seePermission, deletePermission, fixPermission) VALUES ('$codePermissions', '$functionCode', '$addPermission', '$seePermission', '$deletePermission', '$fixPermission')";

                            // Thực thi câu lệnh truy vấn và trả về kết quả
                            return $this->actionSQL->query($query);
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
                     $codePermissions = $obj->getCodePermissions();
                     $functionCode = $obj->getFunctionCode();
                     $addPermission = $obj->getAddPermission();
                     $seePermission = $obj->getSeePermission();
                     $deletePermission = $obj->getDeletePermission();
                     $fixPermission = $obj->getFixPermission();

                     // Câu lệnh UPDATE
                     $query = "UPDATE permissionsDetail 
                                 SET functionCode = '$functionCode', 
                                     addPermission = '$addPermission', 
                                     seePermission = '$seePermission', 
                                     deletePermission = '$deletePermission', 
                                     fixPermission = '$fixPermission' 
                                 WHERE codePermissions = '$codePermissions' AND functionCode = '$functionCode'";

                     // Thực thi câu lệnh UPDATE và trả về kết quả
                     return $this->actionSQL->query($query);
              } else {
                     return false;
              }
       }
}

// check

// $check = new PermissionsDetailDAL();
// // $data = $check->getListobj();

// // print_r($data);

// // $data1 = $check->getByPermission('admin');
// // print_r($data1);

// // $data2 = $check->getByFunctionCode('supplier');
// // print_r($data2);

// $permissionsDeatail = new PermissionsDetailDTO('user', 'test', 0, 1, 0, 0);

// echo $check->addObj($permissionsDeatail);

// echo $check->delete($permissionsDeatail);
