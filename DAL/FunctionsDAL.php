<?php

// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/FunctionsDTO.php');

class FunctionsDAL extends AbstractionDAL
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
              // còn bảng PermissionsDetail chỉ là một bảng phụ, có khóa ngoại tham chiếu đến khóa chỉnh của bảng Function nên khi xóa phải xóa bên bảng PermissionsDetail trước rồi mới đc xóa.  

              // xóa bên bảng phụ trước
              $string1 = "DELETE FROM permissionsdetail WHERE functionCode = '$code'";

              // xoa ben bang functions
              $string2 = "DELETE FROM functions WHERE functionCode = '$code'";

              $resutl1 = $this->actionSQL->query($string1);
              $resutl2 = $this->actionSQL->query($string2);

              return $resutl1 === $resutl2;
       }

       // xóa một đối tượng bằng cách truyền đối tượng vào
       function delete($obj)
       {
              if ($obj != null) {
                     $code = $obj->getCodePermission();
                     // còn bảng PermissionsDetail chỉ là một bảng phụ, có khóa ngoại tham chiếu đến khóa chỉnh của bảng Function nên khi xóa phải xóa bên bảng PermissionsDetail trước rồi mới đc xóa.  

                     // xóa bên bảng phụ trước
                     $string1 = "DELETE FROM permissionsdetail WHERE functionCode = '$code'";

                     // xoa ben bang functions
                     $string2 = "DELETE FROM functions WHERE functionCode = '$code'";

                     $resutl1 = $this->actionSQL->query($string1);
                     $resutl2 = $this->actionSQL->query($string2);

                     return $resutl1 === $resutl2;
              }
       }

       // lấy ra mảng các đối tượng
       function getListObj()
       {
              // Mảng chứa các đối tượng FunctionDTO
              $function_list = array();

              // Câu lệnh truy vấn
              $query = 'SELECT * FROM functions';

              // Thực hiện truy vấn
              $result = $this->actionSQL->query($query);

              // Kiểm tra số hàng được trả về
              if ($result->num_rows > 0) {
                     // Lấy dữ liệu và đưa vào mảng
                     while ($data = $result->fetch_assoc()) {
                            $functionCode = $data["functionCode"];
                            $functionName = $data["functionName"];

                            // Tạo đối tượng FunctionDTO và thêm vào mảng
                            $function = new FunctionsDTO($functionCode, $functionName);
                            array_push($function_list, $function);
                     }
                     return $function_list;
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
              $query = "SELECT * FROM functions WHERE functionCode = '$code'";

              // Thực hiện truy vấn
              $result = $this->actionSQL->query($query);

              // Kiểm tra số hàng được trả về
              if ($result->num_rows > 0) {
                     $data = $result->fetch_assoc();
                     $functionCode = $data["functionCode"];
                     $functionName = $data["functionName"];

                     // Tạo đối tượng FunctionDTO và trả về
                     $function = new FunctionsDTO($functionCode, $functionName);
                     return $function;
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
                     $functionCode = $obj->getFunctionCode();
                     $functionName = $obj->getFunctionName();

                     // Kiểm tra xem mã chức năng đã tồn tại trong cơ sở dữ liệu chưa
                     $checkQuery = "SELECT * FROM functions WHERE functionCode = '$functionCode'";
                     $resultCheck = $this->actionSQL->query($checkQuery);

                     // Nếu đối tượng không rỗng và mã chức năng chưa tồn tại
                     if ($obj != null && $resultCheck->num_rows < 1) {
                            // Câu lệnh truy vấn để thêm đối tượng vào bảng functions
                            $insertQuery = "INSERT INTO functions (functionCode, functionName) VALUES ('$functionCode', '$functionName')";

                            // Thực hiện truy vấn
                            return $this->actionSQL->query($insertQuery);
                     } else {
                            // Trả về false nếu đối tượng rỗng hoặc mã chức năng đã tồn tại
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
                     $functionCode = $obj->getFunctionCode();
                     $functionName = $obj->getFunctionName();

                     // Câu lệnh UPDATE
                     $query = "UPDATE functions 
                               SET functionName = '$functionName' 
                               WHERE functionCode = '$functionCode'";

                     // Thực hiện truy vấn
                     return $this->actionSQL->query($query);
              } else {
                     // Trả về false nếu đối tượng rỗng
                     return false;
              }
       }
}

// check

// $check = new FunctionsDAL();
// $data = $check->getListobj();

// print_r($data);

// $dataobj = $check->getobj('supplier');
// echo $dataobj->getFunctionCode();

// $function = new FunctionsDTO('test', '123');
// echo $check->addObj($function);
// echo $check->upadateObj($function);

// echo $check->deleteByID('test');
