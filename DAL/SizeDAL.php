<?php
// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/SizeDTO.php');

class SizeDAL extends AbstractionDAL
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
              // khi xóa một size thì các sản phẩm có kích thước đó đều sẽ bị xóa mất trong bảng shirtsize

              $string1 = "DELETE FROM shirtsize WHERE sizeCode = '$code'";
              $string2 = "DELETE FROM shirtproduct WHERE sizeCode = '$code'";

              $result1 = $this->actionSQL->query($string1);
              $result2 = $this->actionSQL->query($string2);

              return $result1 === $result2;
       }

       // xóa một đối tượng bằng cách truyền đối tượng vào
       function delete($obj)
       {
              if ($obj != null) {
                     $code = $obj->getSizeCode();
                     // khi xóa một size thì các sản phẩm có kích thước đó đều sẽ bị xóa mất trong bảng shirtsize

                     $string1 = "DELETE FROM shirtsize WHERE sizeCode = '$code'";
                     $string2 = "DELETE FROM size WHERE sizeCode = '$code'";

                     $result1 = $this->actionSQL->query($string1);
                     $result2 = $this->actionSQL->query($string2);

                     return $result1 === $result2;
              } else {
                     return false;
              }
       }

       // lấy ra mảng các đối tượng
       function getListObj()
       {
              // Khởi tạo mảng để chứa các đối tượng SizeDTO
              $sizeList = array();

              // Câu lệnh truy vấn
              $query = 'SELECT * FROM Size';

              // Thực hiện truy vấn
              $result = $this->actionSQL->query($query);

              // Kiểm tra số hàng được trả về
              if ($result->num_rows > 0) {
                     // Lấy dữ liệu và đưa vào mảng
                     while ($data = $result->fetch_assoc()) {
                            $sizeCode = $data["sizeCode"];
                            $sizeName = $data["sizeName"];

                            // Tạo đối tượng SizeDTO và thêm vào mảng
                            $sizeDTO = new SizeDTO($sizeCode, $sizeName);
                            array_push($sizeList, $sizeDTO);
                     }
                     return $sizeList;
              } else {
                     // Trường hợp không có dữ liệu trả về
                     // Có thể xử lý hoặc thông báo lỗi ở đây
                     return null;
              }
       }

       // lấy ra một đối tượng dựa theo mã đối tượng
       function getObj($code)
       {
              // Câu lệnh truy vấn
              $query = "SELECT * FROM Size WHERE sizeCode = '$code'";

              // Thực hiện truy vấn
              $result = $this->actionSQL->query($query);

              if ($result->num_rows > 0) {
                     // Lấy dữ liệu
                     $data = $result->fetch_assoc();
                     $sizeCode = $data["sizeCode"];
                     $sizeName = $data["sizeName"];

                     // Tạo đối tượng SizeDTO
                     $sizeDTO = new SizeDTO($sizeCode, $sizeName);
                     return $sizeDTO;
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
                     $sizeCode = $obj->getSizeCode();
                     // Kiểm tra xem có bị trùng khóa chính không
                     $checkQuery = "SELECT * FROM Size WHERE sizeCode = '$sizeCode'";
                     $checkResult = $this->actionSQL->query($checkQuery);

                     if ($checkResult->num_rows < 1) {
                            $sizeName = $obj->getSizeName();

                            // Câu lệnh truy vấn
                            $query = "INSERT INTO Size (sizeCode, sizeName) VALUES ('$sizeCode', '$sizeName')";

                            // Thực hiện truy vấn
                            return $this->actionSQL->query($query);
                     } else {
                            // Trường hợp đã tồn tại mã kích thước trong cơ sở dữ liệu
                            return false;
                     }
              } else {
                     // Trường hợp đối tượng là null
                     return false;
              }
       }

       // sửa một đối tượng
       function upadateObj($obj)
       {
              if ($obj != null) {
                     $sizeCode = $obj->getSizeCode();
                     $sizeName = $obj->getSizeName();

                     // Câu lệnh UPDATE
                     $query = "UPDATE Size SET sizeName = '$sizeName' WHERE sizeCode = '$sizeCode'";

                     return $this->actionSQL->query($query);
              } else {
                     // Trường hợp đối tượng là null
                     return false;
              }
       }
}

// check

// $check = new SizeDAL();

// print_r($check->getListObj());

// echo $check->getObj('S001')->getSizeCode();

// echo $check->addObj(new SizeDTO('test', 'test'));

// echo $check->upadateObj(new SizeDTO('test', 'null'));

// echo $check->delete(new SizeDTO('test', 'null'));
