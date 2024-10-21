<?php
// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/OrderDTO.php');

class OrderDAL extends AbstractionDAL
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
              // do bảng order có liên quan đến orderDetail
              // khi xóa một đơn hàng trong bảng order thì các chi tiết bên trong đơn hàng đó cũng biến mất bên bảng orderDeatail

              // xóa bên bảng chi tiet don hang trước
              $string1 = "DELETE FROM orderdetail WHERE orderCode = '$code'";

              // xoa ben bang order
              $string2 = "DELETE FROM orders WHERE orderCode = '$code'";

              $resutl1 = $this->actionSQL->query($string1);
              $resutl2 = $this->actionSQL->query($string2);

              return $resutl1 === $resutl2;
       }

       // xóa một đối tượng bằng cách truyền đối tượng vào
       function delete($obj)
       {
              if ($obj != null) {
                     $code = $obj->getOrderCode();
                     // do bảng order có liên quan đến orderDetail
                     // khi xóa một đơn hàng trong bảng order thì các chi tiết bên trong đơn hàng đó cũng biến mất bên bảng orderDeatail

                     // xóa bên bảng chi tiet don hang trước
                     $string1 = "DELETE FROM orderdetail WHERE orderCode = '$code'";

                     // xoa ben bang order
                     $string2 = "DELETE FROM orders WHERE orderCode = '$code'";

                     $resutl1 = $this->actionSQL->query($string1);
                     $resutl2 = $this->actionSQL->query($string2);

                     return $resutl1 === $resutl2;
              }
       }

       // lấy ra mảng các đối tượng
       function getListObj()
       {
              // Câu lệnh truy vấn
              $string = "SELECT * FROM orders ";

              // Thực hiện truy suất
              $result = $this->actionSQL->query($string);

              $orders = array();

              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $orderCode = $data["orderCode"];
                            $deliveryAddress = $data["deliveryAddress"];
                            $dateCreated = $data["dateCreated"];
                            $dateDelivery = $data["dateDelivery"];
                            $dateFinish = $data["dateFinish"];
                            $userName = $data["userName"];
                            $totalMoney = $data["totalMoney"];
                            $codePayments = $data["codePayments"];
                            $codeTransport = $data["codeTransport"];
                            $status = $data["status"];
                            $note = $data["note"];

                            // giải mã username
                            $userNameValue = base64_decode($userName);

                            $order = new OrderDTO($orderCode, $deliveryAddress, $dateCreated, $dateDelivery, $dateFinish, $userNameValue, $totalMoney, $codePayments, $codeTransport, $status, $note);
                            $orders[] = $order;
                     }
                     return $orders;
              } else {
                     // Trường hợp không có dữ liệu trả về
                     return null;
              }
       }

       // lấy một mảng đối tượng hóa đơn dựa theo mã username
       function getListObj_by_UserName($username)
       {
              // mã hóa username
              $username_encode = base64_encode($username);
              // Câu lệnh truy vấn
              $string = "SELECT * FROM orders WHERE 
              userName = '$username_encode' ";

              // Thực hiện truy suất
              $result = $this->actionSQL->query($string);

              $orders = array();

              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $orderCode = $data["orderCode"];
                            $deliveryAddress = $data['deliveryAddress'];
                            $dateCreated = $data["dateCreated"];
                            $dateDelivery = $data["dateDelivery"];
                            $dateFinish = $data["dateFinish"];
                            $userName = $data["userName"];
                            $totalMoney = $data["totalMoney"];
                            $codePayments = $data["codePayments"];
                            $codeTransport = $data["codeTransport"];
                            $status = $data["status"];
                            $note = $data["note"];

                            // giải mã username
                            $userNameValue = base64_decode($userName);

                            $order = new OrderDTO($orderCode, $deliveryAddress, $dateCreated, $dateDelivery, $dateFinish, $userNameValue, $totalMoney, $codePayments, $codeTransport, $status, $note);
                            $orders[] = $order;
                     }
                     return $orders;
              } else {
                     // Trường hợp không có dữ liệu trả về
                     return null;
              }
       }

       // lấy ra mảng đối tượng trong khoảng thời gian
       function getListObj_by_Date($dateStart, $dateEnd)
       {
              $sql = "SELECT * FROM orders od  WHERE od.dateCreated  
              BETWEEN '$dateStart' AND '$dateEnd' 
              ";

              // Thực hiện truy suất
              $result = $this->actionSQL->query($sql);

              $orders = array();
              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $orderCode = $data["orderCode"];
                            $deliveryAddress = $data['deliveryAddress'];
                            $dateCreated = $data["dateCreated"];
                            $dateDelivery = $data["dateDelivery"];
                            $dateFinish = $data["dateFinish"];
                            $userName = $data["userName"];
                            $totalMoney = $data["totalMoney"];
                            $codePayments = $data["codePayments"];
                            $codeTransport = $data["codeTransport"];
                            $status = $data["status"];
                            $note = $data["note"];

                            // giải mã username
                            $userNameValue = base64_decode($userName);

                            $order = new OrderDTO($orderCode, $deliveryAddress, $dateCreated, $dateDelivery, $dateFinish, $userNameValue, $totalMoney, $codePayments, $codeTransport, $status, $note);
                            $orders[] = $order;
                     }
                     return $orders;
              } else {
                     // Trường hợp không có dữ liệu trả về
                     return null;
              }
       }


       // lấy ra một đối tượng dựa theo mã đối tượng
       function getObj($code)
       {
              // Câu lệnh truy vấn
              $query = "SELECT * FROM orders WHERE orderCode = '$code'";

              // Thực hiện truy vấn
              $result = $this->actionSQL->query($query);

              // Kiểm tra số hàng được trả về
              if ($result->num_rows > 0) {
                     $data = $result->fetch_assoc();
                     $orderCode = $data["orderCode"];
                     $deliveryAddress = $data['deliveryAddress'];
                     $dateCreated = $data["dateCreated"];
                     $dateDelivery = $data["dateDelivery"];
                     $dateFinish = $data["dateFinish"];
                     $userName = $data["userName"];
                     $totalMoney = $data["totalMoney"];
                     $codePayments = $data["codePayments"];
                     $codeTransport = $data["codeTransport"];
                     $status = $data["status"];
                     $note = $data["note"];

                     // giải mã username
                     $userNameValue = base64_decode($userName);

                     // Tạo đối tượng OrderDTO và trả về
                     $order = new OrderDTO($orderCode, $deliveryAddress, $dateCreated, $dateDelivery, $dateFinish, $userNameValue, $totalMoney, $codePayments, $codeTransport, $status, $note);
                     return $order;
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
                     $orderCode = $obj->getOrderCode();

                     // Kiểm tra xem đơn hàng đã tồn tại trong cơ sở dữ liệu chưa
                     $checkQuery = "SELECT * FROM orders WHERE orderCode = '$orderCode'";
                     $resultCheck = $this->actionSQL->query($checkQuery);

                     // Nếu đối tượng không rỗng và đơn hàng chưa tồn tại
                     if ($resultCheck->num_rows < 1) {
                            // Lấy các thuộc tính khác từ đối tượng
                            $dateCreated = $obj->getDateCreated();
                            $deliveryAddress = $obj->getDeliveryAddress();
                            $dateDelivery = $obj->getDateDelivery();
                            $dateFinish = $obj->getDateFinish();
                            $userName = $obj->getUserName();
                            $totalMoney = $obj->getTotalMoney();
                            $codePayments = $obj->getCodePayments();
                            $codeTransport = $obj->getCodeTransport();
                            $status = $obj->getStatus();
                            $note = $obj->getNote();

                            // mã hóa username

                            $userName_encode = base64_encode($userName);

                            // Câu lệnh truy vấn để thêm đối tượng vào bảng orders
                            $insertQuery = "INSERT INTO orders (orderCode,deliveryAddress, dateCreated, dateDelivery, dateFinish, userName, totalMoney, codePayments, codeTransport, status, note) 
                                         VALUES ('$orderCode','$deliveryAddress', '$dateCreated', '$dateDelivery', '$dateFinish', '$userName_encode', $totalMoney, '$codePayments', '$codeTransport', '$status', '$note')";

                            // Thực hiện truy vấn
                            return $this->actionSQL->query($insertQuery);
                     } else {
                            // Trả về false đơn hàng đã tồn tại
                            return false;
                     }
              } else {
                     // Trả về false nếu đối tượng rỗng
                     return false;
              }
       }

       // sửa một đối tượng
       function upadateObj($obj)
       {
              if ($obj != null) {
                     // Lấy các thuộc tính từ đối tượng
                     $orderCode = $obj->getOrderCode();
                     $deliveryAddress = $obj->getDeliveryAddress();
                     $dateCreated = $obj->getDateCreated();
                     $dateDelivery = $obj->getDateDelivery();
                     $dateFinish = $obj->getDateFinish();
                     $userName = $obj->getUserName();
                     $totalMoney = $obj->getTotalMoney();
                     $codePayments = $obj->getCodePayments();
                     $codeTransport = $obj->getCodeTransport();
                     $status = $obj->getStatus();
                     $note = $obj->getNote();

                     // mã háo username
                     $userName_encode = base64_encode($userName);

                     // Câu lệnh UPDATE
                     $query = "UPDATE orders 
                               SET deliveryAddress = '$deliveryAddress',
                                   dateCreated = '$dateCreated', 
                                   dateDelivery = '$dateDelivery', 
                                   dateFinish = '$dateFinish', 
                                   userName = '$userName_encode', 
                                   totalMoney = $totalMoney, 
                                   codePayments = '$codePayments', 
                                   codeTransport = '$codeTransport', 
                                   status = '$status', 
                                   note = '$note' 
                               WHERE orderCode = '$orderCode'";

                     // Thực hiện truy vấn
                     return $this->actionSQL->query($query);
              } else {
                     // Trả về false nếu đối tượng rỗng
                     return false;
              }
       }

       // cap nhat trang thai don hang
       function updateState_by_orderCode($orderCode, $status)
       {
              $query = "UPDATE orders 
              SET status = '$status'
              WHERE orderCode = '$orderCode'";
              // Thực hiện truy vấn
              return $this->actionSQL->query($query);
       }
}

// check

// $check = new OrderDAL();
// $data = $check->getListobj();

// print_r($data);

// echo $check->getObj('ORD001')->getOrderCode();

// $order = new OrderDTO(
//        "ORD123",               // Mã đơn hàng
//        "2024-03-21",           // Ngày tạo đơn
//        "2024-03-28",           // Ngày giao hàng dự kiến
//        "2024-03-28",           // Ngày hoàn thành
//        "PhucApuTruong",             // Tên người dùng
//        250.50,                 // Tổng tiền
//        "PP001",               // Mã thanh toán
//        "EXP001",             // Mã vận chuyển
//        "Pending",              // Trạng thái
//        "Please deliver to the front."  // Ghi chú
// );
// echo $check->addobj($order);

// echo $check->upadateObj($order);

// echo $check->deleteByID('ORD123');