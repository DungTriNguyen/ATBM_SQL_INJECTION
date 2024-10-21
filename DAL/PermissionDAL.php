<?php

// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/PermissionDTO.php');

class PermissionDAL extends AbstractionDAL
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
              // do bảng accounts có liên kết khoa ngoại đến thuộc tính codePermissions của  bảng Permissions. Nếu thỏa các bảng kia không có tham chiếu đến dữ liệu đang được xóa thì mới cho phép xóa. Còn không sẽ báo lỗi.

              // còn bảng PermissionsDetail chỉ là một bảng phụ, có khóa ngoại tham chiếu đến khóa chỉnh của bảng Permission nên khi xóa phải xóa bên bảng PermissionsDetail trước rồi mới đc xóa.  

              $check_data_Accounts = "SELECT * FROM accounts WHERE codePermissions = '$code'";

              $resutl_1 = $this->actionSQL->query($check_data_Accounts);

              // nếu tất cả các câu lệnh truy suất cho ra số dòng truy suất đều = 0 --> thỏa

              if ($resutl_1->num_rows < 1) {

                     // xóa bên bảng phụ trước
                     $string1 = "DELETE FROM permissionsdetail WHERE codePermissions = '$code'";

                     // xoa ben bang permissions
                     $string2 = "DELETE FROM permissions WHERE codePermissions = '$code'";

                     $resutl1 = $this->actionSQL->query($string1);
                     $resutl2 = $this->actionSQL->query($string2);

                     return $resutl1 === $resutl2;
              } else {
                     return false;
              }
       }

       // xóa một đối tượng bằng cách truyền đối tượng vào
       function delete($obj)
       {
              if ($obj != null) {
                     $code = $obj->getCodePermission();
                     // do bảng accounts có liên kết khoa ngoại đến thuộc tính codePermissions của  bảng Permissions. Nếu thỏa các bảng kia không có tham chiếu đến dữ liệu đang được xóa thì mới cho phép xóa. Còn không sẽ báo lỗi.

                     // còn bảng PermissionsDetail chỉ là một bảng phụ, có khóa ngoại tham chiếu đến khóa chỉnh của bảng Permission nên khi xóa phải xóa bên bảng PermissionsDetail trước rồi mới đc xóa.  

                     $check_data_Accounts = "SELECT * FROM accounts WHERE codePermissions = '$code'";

                     $resutl_1 = $this->actionSQL->query($check_data_Accounts);

                     // nếu tất cả các câu lệnh truy suất cho ra số dòng truy suất đều = 0 --> thỏa

                     if ($resutl_1->num_rows < 1) {

                            // xóa bên bảng phụ trước
                            $string1 = "DELETE FROM permissionsdetail WHERE codePermissions = '$code'";

                            // xoa ben bang permissions
                            $string2 = "DELETE FROM permissions WHERE codePermissions = '$code'";

                            $resutl1 = $this->actionSQL->query($string1);
                            $resutl2 = $this->actionSQL->query($string2);

                            return $resutl1 === $resutl2;
                     } else {
                            return false;
                     }
              }
       }

       // lấy ra mảng các đối tượng
       function getListObj()
       {
              // Mảng chứa các đối tượng
              $permission_list = array();

              // Câu lệnh truy vấn
              $query = 'SELECT * FROM permissions';

              // Thực hiện truy vấn
              $result = $this->actionSQL->query($query);

              // Kiểm tra số hàng được trả về
              if ($result->num_rows > 0) {
                     // Lấy dữ liệu và đưa vào mảng
                     while ($data = $result->fetch_assoc()) {
                            $codePermission = $data["codePermissions"];
                            $namePermission = $data["namePermissions"];

                            // Tạo đối tượng PermissionDTO và thêm vào mảng
                            $permission = new PermissionDTO($codePermission, $namePermission);
                            array_push($permission_list, $permission);
                     }
                     return $permission_list;
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
              $query = "SELECT * FROM permissions WHERE codePermissions = '$code'";

              // Thực hiện truy vấn
              $result = $this->actionSQL->query($query);

              // Kiểm tra số hàng được trả về
              if ($result->num_rows > 0) {
                     $data = $result->fetch_assoc();
                     $codePermission = $data["codePermissions"];
                     $namePermission = $data["namePermissions"];

                     // Tạo đối tượng PermissionDTO và trả về
                     $permission = new PermissionDTO($codePermission, $namePermission);
                     return $permission;
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
                     // Lấy các thuộc tính từ đối tượng
                     $codePermission = $obj->getCodePermission();
                     $namePermission = $obj->getNamePermission();

                     // Kiểm tra xem mã quyền đã tồn tại trong cơ sở dữ liệu chưa
                     $checkQuery = "SELECT * FROM permissions WHERE codePermissions = '$codePermission'";
                     $resultCheck = $this->actionSQL->query($checkQuery);

                     // Nếu đối tượng không rỗng và mã quyền chưa tồn tại
                     if ($obj != null && $resultCheck->num_rows < 1) {
                            // Câu lệnh truy vấn để thêm đối tượng vào bảng permissions
                            $insertQuery = "INSERT INTO permissions (codePermissions, namePermissions) VALUES ('$codePermission', '$namePermission')";

                            // Thực hiện truy vấn
                            return $this->actionSQL->query($insertQuery);
                     } else {
                            // Trả về false nếu đối tượng rỗng hoặc mã quyền đã tồn tại
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
                     // Lấy các thuộc tính từ đối tượng
                     $codePermission = $obj->getCodePermission();
                     $namePermission = $obj->getNamePermission();

                     // Câu lệnh UPDATE
                     $query = "UPDATE permissions 
                               SET namePermissions = '$namePermission' 
                               WHERE codePermissions = '$codePermission'";

                     // Thực hiện truy vấn
                     return $this->actionSQL->query($query);
              } else {
                     // Trả về false nếu đối tượng rỗng
                     return false;
              }
       }
}

// check

// $check = new PermissionDAL();
// $data = $check->getListobj();

// print_r($data);
// foreach($data as $obj){
//        echo $obj . "<br>";
// }

// $dataobj = $check->getobj('admin');
// echo $dataobj->getCodePermission();

// $permission = new PermissionDTO('test', 'o');
// echo $check->addobj($permission);

// echo $check->upadateobj($permission);

// echo $check->deleteByID('test');
// echo $check->delete($permission);
