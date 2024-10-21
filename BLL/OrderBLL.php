<?php
// gọi các lớp liên quan
require('../DAL/connectionDatabase.php');
require('../DAL/AbstractionDAL.php');

require('../DTO/OrderDTO.php');
require('../DTO/orderDetailDTO.php');
require('../DTO/ProductDTO.php');
require('../DTO/HandbagProductDTO.php');
require('../DTO/ShirtProductDTO.php');
require('../DTO/ShirtSizeDTO.php');
require('../DTO/SizeDTO.php');

require('../DAL/OrderDAL.php');
require('../DAL/orderDetailDAL.php');
require('../DAL/HandbagProductDAL.php');
require('../DAL/ShirtProductDAL.php');
require('../DAL/ShirtSizeDAL.php');
require('../DAL/SizeDAL.php');

class OrderBLL
{
       private $OrderDAL;
       private $orderDetailDAL;

       private $HandbagProductDAL;
       private $ShirtProductDAL;
       private $ShirtSizeDAL;
       private $SizeDAL;

       function __construct()
       {
              $this->OrderDAL = new OrderDAL();
              $this->orderDetailDAL = new OrderDetailDAL();

              $this->HandbagProductDAL = new HandbagProductDAL();
              $this->ShirtProductDAL = new ShirtProductDAL();
              $this->SizeDAL = new SizeDAL();
              $this->ShirtSizeDAL = new ShirtSizeDAL();
       }

       // lấy mảng hóa đơn
       // input: ...
       // output: ...
       function getArrOrder()
       {
              $arrObj = $this->OrderDAL->getListObj();
              $result = array();
              if ($arrObj != null) {
                     if (count($arrObj) > 0) {
                            foreach ($arrObj as $item) {
                                   $orderCode = $item->getOrderCode();
                                   $dateCreated = $item->getDateCreated();
                                   $dateDelivery = $item->getDateDelivery();
                                   $deliveryAddress = $item->getDeliveryAddress();
                                   $dateFinish = $item->getDateFinish();
                                   $userName = $item->getUserName();
                                   $totalMoney = $item->getTotalMoney();
                                   $codePayments = $item->getCodePayments();
                                   $codeTransport = $item->getCodeTransport();
                                   $status = $item->getStatus();
                                   $note = $item->getNote();

                                   $obj = array(
                                          "orderCode" => $orderCode,
                                          "dateCreated" => $dateCreated,
                                          "dateDelivery" => $dateDelivery,
                                          "deliveryAddress" => $deliveryAddress,
                                          "dateFinish" => $dateFinish,
                                          "userName" => $userName,
                                          "totalMoney" => $totalMoney,
                                          "codePayments" => $codePayments,
                                          "codeTransport" => $codeTransport,
                                          "status" => $status,
                                          "note" => $note
                                   );

                                   array_push($result, $obj);
                            }
                            return $result;
                     } else {
                            return $result;
                     }
              } else {
                     return $result;
              }
       }

       // lấy mảng hóa đơn dựa theo mã username
       // input: mã username
       // output: mảng chứa các đối tượng hóa đơn
       function getArrOrder_by_Username($username)
       {

              $arrObj = $this->OrderDAL->getListObj_by_UserName($username);
              $result = array();
              if ($arrObj != null) {
                     if (count($arrObj) > 0) {
                            foreach ($arrObj as $item) {
                                   $orderCode = $item->getOrderCode();
                                   $dateCreated = $item->getDateCreated();
                                   $dateDelivery = $item->getDateDelivery();
                                   $deliveryAddress = $item->getDeliveryAddress();
                                   $dateFinish = $item->getDateFinish();
                                   $userName = $item->getUserName();
                                   $totalMoney = $item->getTotalMoney();
                                   $codePayments = $item->getCodePayments();
                                   $codeTransport = $item->getCodeTransport();
                                   $status = $item->getStatus();
                                   $note = $item->getNote();

                                   $obj = array(
                                          "orderCode" => $orderCode,
                                          "dateCreated" => $dateCreated,
                                          "dateDelivery" => $dateDelivery,
                                          "deliveryAddress" => $deliveryAddress,
                                          "dateFinish" => $dateFinish,
                                          "userName" => $userName,
                                          "totalMoney" => $totalMoney,
                                          "codePayments" => $codePayments,
                                          "codeTransport" => $codeTransport,
                                          "status" => $status,
                                          "note" => $note
                                   );

                                   array_push($result, $obj);
                            }
                            return $result;
                     } else {
                            return $result;
                     }
              } else {
                     return $result;
              }
       }

       // lấy danh sach hóa đơn tư ngày A đến ngày B
       // input: dateA và dateB
       // output: mảng chứa các đối tượng order
       function getArrOrder_by_Date_State_UserName($dateStart, $dateEnd, $stateNeed, $keyword)
       {
              $arrObj = $this->OrderDAL->getListObj_by_Date($dateStart, $dateEnd);
              $result = array();

              $keyword_lowercase = strtolower($keyword);
              // $state_tolowercase = strtolower($stateNeed);
              $check_keyword = 0;
              $check_state = 0;
              if ($keyword_lowercase != 'empty') {
                     $check_keyword = 1;
              }
              if ($stateNeed != 'empty') {
                     $check_state = 1;
              }


              if ($arrObj != null) {
                     if (count($arrObj) > 0) {
                            if ($check_keyword == 1 && $check_state == 1) {
                                   foreach ($arrObj as $item) {
                                          $orderCode = $item->getOrderCode();
                                          $dateCreated = $item->getDateCreated();
                                          $deliveryAddress = $item->getDeliveryAddress();
                                          $dateDelivery = $item->getDateDelivery();
                                          $dateFinish = $item->getDateFinish();
                                          $userName = $item->getUserName();
                                          $totalMoney = $item->getTotalMoney();
                                          $codePayments = $item->getCodePayments();
                                          $codeTransport = $item->getCodeTransport();
                                          $status = $item->getStatus();
                                          $note = $item->getNote();

                                          // Áp dụng strtolower cho các biến còn lại
                                          $orderCode_lowercase = strtolower($orderCode);
                                          $dateCreated_lowercase = strtolower($dateCreated);
                                          $dateDelivery_lowercase = strtolower($dateDelivery);
                                          $dateFinish_lowercase = strtolower($dateFinish);
                                          $userName_lowercase = strtolower($userName);
                                          $codePayments_lowercase = strtolower($codePayments);
                                          $codeTransport_lowercase = strtolower($codeTransport);
                                          $deliveryAddress_lowercase = strtolower($deliveryAddress);
                                          $status_lowercase = strtolower($status);
                                          $note_lowercase = strtolower($note);
                                          if ($status == $stateNeed) {

                                                 if (
                                                        strpos($orderCode_lowercase, $keyword_lowercase) !== false ||
                                                        strpos($dateCreated_lowercase, $keyword_lowercase) !== false ||
                                                        strpos($dateDelivery_lowercase, $keyword_lowercase) !== false ||
                                                        strpos($dateFinish_lowercase, $keyword_lowercase) !== false ||
                                                        strpos($userName_lowercase, $keyword_lowercase) !== false ||
                                                        strpos($codePayments_lowercase, $keyword_lowercase) !== false ||
                                                        strpos($codeTransport_lowercase, $keyword_lowercase) !== false ||
                                                        strpos($note_lowercase, $keyword_lowercase) !== false ||
                                                        strpos($deliveryAddress_lowercase, $keyword_lowercase) !== false
                                                 ) {
                                                        $obj = array(
                                                               "orderCode" => $orderCode,
                                                               "dateCreated" => $dateCreated,
                                                               "dateDelivery" => $dateDelivery,
                                                               "deliveryAddress" => $deliveryAddress,
                                                               "dateFinish" => $dateFinish,
                                                               "userName" => $userName,
                                                               "totalMoney" => $totalMoney,
                                                               "codePayments" => $codePayments,
                                                               "codeTransport" => $codeTransport,
                                                               "status" => $status,
                                                               "note" => $note
                                                        );

                                                        array_push($result, $obj);
                                                 }
                                          }
                                   }
                                   return $result;
                            } elseif ($check_keyword == 1 && $check_state == 0) {
                                   foreach ($arrObj as $item) {
                                          $orderCode = $item->getOrderCode();
                                          $dateCreated = $item->getDateCreated();
                                          $deliveryAddress = $item->getDeliveryAddress();
                                          $dateDelivery = $item->getDateDelivery();
                                          $dateFinish = $item->getDateFinish();
                                          $userName = $item->getUserName();
                                          $totalMoney = $item->getTotalMoney();
                                          $codePayments = $item->getCodePayments();
                                          $codeTransport = $item->getCodeTransport();
                                          $status = $item->getStatus();
                                          $note = $item->getNote();

                                          // Áp dụng strtolower cho các biến còn lại
                                          $orderCode_lowercase = strtolower($orderCode);
                                          $dateCreated_lowercase = strtolower($dateCreated);
                                          $dateDelivery_lowercase = strtolower($dateDelivery);
                                          $dateFinish_lowercase = strtolower($dateFinish);
                                          $userName_lowercase = strtolower($userName);
                                          $codePayments_lowercase = strtolower($codePayments);
                                          $codeTransport_lowercase = strtolower($codeTransport);
                                          $deliveryAddress_lowercase = strtolower($deliveryAddress);
                                          $status_lowercase = strtolower($status);
                                          $note_lowercase = strtolower($note);
                                          if (
                                                 strpos($orderCode_lowercase, $keyword_lowercase) !== false ||
                                                 strpos($dateCreated_lowercase, $keyword_lowercase) !== false ||
                                                 strpos($dateDelivery_lowercase, $keyword_lowercase) !== false ||
                                                 strpos($dateFinish_lowercase, $keyword_lowercase) !== false ||
                                                 strpos($userName_lowercase, $keyword_lowercase) !== false ||
                                                 strpos($codePayments_lowercase, $keyword_lowercase) !== false ||
                                                 strpos($codeTransport_lowercase, $keyword_lowercase) !== false ||
                                                 strpos($note_lowercase, $keyword_lowercase) !== false ||
                                                 strpos($deliveryAddress_lowercase, $keyword_lowercase) !== false
                                          ) {
                                                 $obj = array(
                                                        "orderCode" => $orderCode,
                                                        "dateCreated" => $dateCreated,
                                                        "dateDelivery" => $dateDelivery,
                                                        "deliveryAddress" => $deliveryAddress,
                                                        "dateFinish" => $dateFinish,
                                                        "userName" => $userName,
                                                        "totalMoney" => $totalMoney,
                                                        "codePayments" => $codePayments,
                                                        "codeTransport" => $codeTransport,
                                                        "status" => $status,
                                                        "note" => $note
                                                 );

                                                 array_push($result, $obj);
                                          }
                                   }
                                   return $result;
                            } elseif ($check_keyword == 0 && $check_state == 1) {
                                   foreach ($arrObj as $item) {
                                          $orderCode = $item->getOrderCode();
                                          $dateCreated = $item->getDateCreated();
                                          $deliveryAddress = $item->getDeliveryAddress();
                                          $dateDelivery = $item->getDateDelivery();
                                          $dateFinish = $item->getDateFinish();
                                          $userName = $item->getUserName();
                                          $totalMoney = $item->getTotalMoney();
                                          $codePayments = $item->getCodePayments();
                                          $codeTransport = $item->getCodeTransport();
                                          $status = $item->getStatus();
                                          $note = $item->getNote();

                                          // Áp dụng strtolower cho các biến còn lại
                                          $orderCode_lowercase = strtolower($orderCode);
                                          $dateCreated_lowercase = strtolower($dateCreated);
                                          $dateDelivery_lowercase = strtolower($dateDelivery);
                                          $dateFinish_lowercase = strtolower($dateFinish);
                                          $userName_lowercase = strtolower($userName);
                                          $codePayments_lowercase = strtolower($codePayments);
                                          $codeTransport_lowercase = strtolower($codeTransport);
                                          $deliveryAddress_lowercase = strtolower($deliveryAddress);
                                          $status_lowercase = strtolower($status);
                                          $note_lowercase = strtolower($note);
                                          if ($status == $stateNeed) {
                                                 $obj = array(
                                                        "orderCode" => $orderCode,
                                                        "dateCreated" => $dateCreated,
                                                        "dateDelivery" => $dateDelivery,
                                                        "deliveryAddress" => $deliveryAddress,
                                                        "dateFinish" => $dateFinish,
                                                        "userName" => $userName,
                                                        "totalMoney" => $totalMoney,
                                                        "codePayments" => $codePayments,
                                                        "codeTransport" => $codeTransport,
                                                        "status" => $status,
                                                        "note" => $note
                                                 );

                                                 array_push($result, $obj);
                                          }
                                   }
                                   return $result;
                            } else {
                                   foreach ($arrObj as $item) {
                                          $orderCode = $item->getOrderCode();
                                          $dateCreated = $item->getDateCreated();
                                          $deliveryAddress = $item->getDeliveryAddress();
                                          $dateDelivery = $item->getDateDelivery();
                                          $dateFinish = $item->getDateFinish();
                                          $userName = $item->getUserName();
                                          $totalMoney = $item->getTotalMoney();
                                          $codePayments = $item->getCodePayments();
                                          $codeTransport = $item->getCodeTransport();
                                          $status = $item->getStatus();
                                          $note = $item->getNote();

                                          $obj = array(
                                                 "orderCode" => $orderCode,
                                                 "dateCreated" => $dateCreated,
                                                 "dateDelivery" => $dateDelivery,
                                                 "deliveryAddress" => $deliveryAddress,
                                                 "dateFinish" => $dateFinish,
                                                 "userName" => $userName,
                                                 "totalMoney" => $totalMoney,
                                                 "codePayments" => $codePayments,
                                                 "codeTransport" => $codeTransport,
                                                 "status" => $status,
                                                 "note" => $note
                                          );

                                          array_push($result, $obj);
                                   }
                                   return $result;
                            }
                     } else {
                            return $result;
                     }
              } else {
                     return $result;
              }
       }

       // tìm kiếm hóa đơn thuộc về người dùng theo mã hóa đơn, dùng bên user
       // input: username, keyword
       // output: mangr hóa đơn

       function SearchOrder_by_key($username, $str)
       {
              $keyword = strtolower($str);

              $arrObj = $this->OrderDAL->getListObj_by_UserName($username);
              $result = array();
              if ($arrObj != null) {
                     foreach ($arrObj as $item) {
                            $orderCode = $item->getOrderCode();

                            $orderCode_lowercase = strtolower($orderCode);

                            $dateCreated = $item->getDateCreated();
                            $dateDelivery = $item->getDateDelivery();
                            $dateFinish = $item->getDateFinish();
                            $userName = $item->getUserName();
                            $totalMoney = $item->getTotalMoney();
                            $codePayments = $item->getCodePayments();
                            $codeTransport = $item->getCodeTransport();
                            $status = $item->getStatus();
                            $note = $item->getNote();

                            if (
                                   strpos($orderCode_lowercase, $keyword) !== false
                            ) {
                                   $obj = array(
                                          "orderCode" => $orderCode,
                                          "dateCreated" => $dateCreated,
                                          "dateDelivery" => $dateDelivery,
                                          "dateFinish" => $dateFinish,
                                          "userName" => $userName,
                                          "totalMoney" => $totalMoney,
                                          "codePayments" => $codePayments,
                                          "codeTransport" => $codeTransport,
                                          "status" => $status,
                                          "note" => $note
                                   );
                                   array_push($result, $obj);
                            }
                     }
                     return $result;
              } else {
                     return $result;
              }
       }

       // lấy mảng chi tiết hóa đơn dựa vào háo đơn dược truyền vào
       // input: mã hóa đơn
       // output: mảng obj các chi tiết hóa đơn của hóa đơn đó
       function getArrOrderDetail_by_orderCode($orderCode)
       {
              // get arr orderDetail
              $arr = $this->orderDetailDAL->getArr_ByCodeOrder($orderCode);
              $result = array();

              if ($arr != null) {
                     foreach ($arr as $item) {
                            // $orderCode = $item->getOrderCode();
                            $productCode = $item->getProductCode();
                            $nameProduct = $item->getNameProduct();
                            $quantity = $item->getQuantity();
                            $sizeCode = $item->getSizeCode();
                            $priceProduct = $item->getPriceProduct();
                            $totalMoney = $item->getTotalMoney();

                            $obj = array(
                                   "orderCode" => $orderCode,
                                   "productCode" => $productCode,
                                   "nameProduct" => $nameProduct,
                                   "quantity" => $quantity,
                                   "sizeCode" => $sizeCode,
                                   "priceProduct" => $priceProduct,
                                   "totalMoney" => $totalMoney
                            );
                            array_push($result, $obj);
                     }
                     return $result;
              } else {
                     return $result;
              }
       }

       // thêm hóa đơn bên user
       // input: cần phải đăng nhập và có sản phẩm trong sesion, địa chỉ nhận, số điện thoại, ghi chú, mã thanh toán, mã hình thức thanh toán,status
       // output: thông báo thêm hóa đơn
       function addOrderUser($username, $deliveryAddress, $note, $status, $codePayment, $codeTransport)
       {
              if (session_status() == PHP_SESSION_NONE) {
                     session_start();
              }

              $result = array();

              // kiểm tra xem có vỏ hàng chưa
              if (isset($_SESSION['cart'])) {
                     $arrCart = $_SESSION['cart'];

                     // có vỏ hàng nhưng ko có sản phẩm bên trong
                     if (count($arrCart) > 0) {
                            // tạo mã hóa đơn ngẫu nhiên
                            // Tạo chuỗi 'ORD' cố định
                            $orderPrefix = 'ORD';

                            // Tạo một số duy nhất dựa trên thời gian hiện tại và số ngẫu nhiên
                            $orderNumber = uniqid();

                            // Kết hợp chuỗi 'ORD' với số duy nhất để tạo ra chuỗi hoàn chỉnh
                            $orderCode = $orderPrefix . $orderNumber;

                            // lấy các thông tin khác
                            $dateCreated = date('Y-m-d');
                            $dateDelivery = date('Y-m-d', strtotime($dateCreated . ' + 5 days'));
                            $dateFinish = $dateDelivery;

                            // tính tổng tiền hóa đơn, them chi tiet hoa don

                            $arrCTHD = array();
                            $sumMoney = 0;
                            for ($i = 0; $i < count($arrCart); $i++) {
                                   $item = $arrCart[$i];
                                   $productCode = $item['productCode'];
                                   $nameProduct = $item['nameProduct'];
                                   $quantity = $item['quantityBuy'];
                                   $sizeCode = $item['sizeCode'];
                                   $price = $item['price'];
                                   $promotion = $item['promotion'];


                                   // tính tiền nếu co giảm giá
                                   if ($promotion > 0) {
                                          $price = (float) ($price - $price * $promotion / 100);
                                   }
                                   // tính tổng tiền chi tiết hóa đơn bằng lấy số lượng mua * giá tiền từng cái
                                   $totalMoney = $quantity * $price;

                                   // tinh tong tien cho hoa don
                                   $sumMoney += $totalMoney;

                                   $objOrderDetail = new OrderDetailDTO($orderCode,$productCode, $nameProduct, $quantity, $sizeCode, $price, $totalMoney);

                                   array_push($arrCTHD, $objOrderDetail);
                            }
                            // sau khi lấy tất cả chi tiết trong vỏ hàng thì làm sạch vỏ hàng
                            $_SESSION['cart'] = array();

                            // tạo đối tượng order
                            $order = new OrderDTO($orderCode, $deliveryAddress, $dateCreated, $dateDelivery, $dateFinish, $username, $sumMoney, $codePayment, $codeTransport, $status, $note);

                            // thêm đối tượng order vao db
                            $check1 = $this->OrderDAL->addObj($order);
                            $check2 = true;
                            // nếu thêm thành công order vào thì thêm các chi tiết vào db, đồng thời cập nhật lại số lượng
                            if ($check1 == true) {
                                   foreach ($arrCTHD as $item) {

                                          if ($this->orderDetailDAL->addObj($item) == true) {
                                                 // cập nhật lại số lượng
                                                 $productCode = $item->getProductCode();
                                                 // kiểm tra xem sản phẩm áo hay túi sách
                                                 $productHandbag = $this->HandbagProductDAL->getObj($productCode);
                                                 $productShirt = $this->ShirtProductDAL->getObj($productCode);
                                                 // Neu la san pham tui sach
                                                 if ($productHandbag != null) {
                                                        $quantity = $item->getQuantity();
                                                        //câp nhật lại số lượng tổng
                                                        $productHandbag->setQuantity($productHandbag->getQuantity() - $quantity);

                                                        $this->HandbagProductDAL->upadateObj($productHandbag);
                                                 }
                                                 // neu la san pham ao
                                                 if ($productShirt != null) {
                                                        // cập nhật lại số lượng theo size
                                                        $sizeCode = $item->getSizeCode();
                                                        $quantity = $item->getQuantity();

                                                        $shirtsize = $this->ShirtSizeDAL->getObjByProductCodeAndSizeCode($productCode, $sizeCode);

                                                        $shirtsize->setQuantity($shirtsize->getQuantity() - $quantity);

                                                        $this->ShirtSizeDAL->upadateObj($shirtsize);

                                                        // cập nhật lại số lượng tổng
                                                        $productShirt->setQuantity($productShirt->getQuantity() - $quantity);
                                                        $this->ShirtProductDAL->upadateObj($productShirt);
                                                 }
                                          } else {
                                                 $check2 = false;
                                                 break;
                                          }
                                   }
                            }
                            if ($check1 == $check2) {
                                   return array(
                                          "mess" => "success",
                                          "orderCode" => $orderCode
                                   );
                            } else {
                                   return array(
                                          "mess" => "addorder failed"
                                   );
                            }
                     } else {
                            return array(
                                   "mess" => "cart empty"
                            );
                     }
              } else {
                     return array(
                            "mess" => "notFoundCart"
                     );
              }
       }


       // khi người dùng click thêm sản phẩm vào vỏ hàng thì hàm vừa lấy thông tin sản phẩm đó trả về để hiển thị và vừa thêm sản phẩm đó lên session
       // cartItem(productCode,nameProduct,quantityBuy,type)

       // input : productCode,type,quantityBuy
       // output : message (success,notEnoughQuantity,false)
       function addCartToSession($productCode, $type, $quantityBuy, $sizeCode)
       {
              $result = array();
              if (session_status() == PHP_SESSION_NONE) {
                     session_start();
              }
              // neu gio hang da ton tai
              if (isset($_SESSION['cart'])) {
                     $cartArr = $_SESSION['cart'];
                     $flag = 0;
                     $nameProduct = '';
                     // tim kím trong giỏ hàng
                     for ($i = 0; $i < count($cartArr); $i++) {
                            $item = $cartArr[$i];
                            // nếu mà sản phẩm và mã size trùng trong giỏ hàng thì chỉ cập nhật số lượng
                            if ($item['productCode'] == $productCode) {
                                   if ($type == 'shirtProduct' && $item['sizeCode'] == $sizeCode) {
                                          $shirtSizeObj = $this->ShirtSizeDAL->getObjByProductCodeAndSizeCode($productCode, $sizeCode);
                                          $quantityShirtSize = $shirtSizeObj->getQuantity();
                                          $obj = $this->ShirtProductDAL->getObj($productCode);
                                          $quantity = $obj->getQuantity();
                                          $tempCheck = $item['quantityBuy'] + $quantityBuy;
                                          if ($tempCheck >= $quantity || $tempCheck >= $quantityShirtSize) {
                                                 $temp = array(
                                                        "message" => "notEnoughQuantity",
                                                        "productCode" => $productCode,
                                                        "quantityBuy" => $quantityBuy,
                                                        "sizeCode" => $sizeCode,
                                                        "type" => $type,
                                                        "nameProduct" => $item['nameProduct']
                                                 );
                                                 array_push($result, $temp);
                                                 return $result;
                                          } else {
                                                 $nameProduct = $item['nameProduct'];
                                                 $item['quantityBuy'] = $tempCheck; // Cập nhật số lượng mua
                                                 $flag = 1;
                                          }
                                   } elseif ($type == 'handbagProduct') {
                                          $obj = $this->HandbagProductDAL->getObj($productCode);
                                          $quantity = $obj->getQuantity();
                                          $tempCheck = $item['quantityBuy'] + $quantityBuy;
                                          if ($tempCheck >= $quantity) {
                                                 $temp = array(
                                                        "message" => "notEnoughQuantity",
                                                        "productCode" => $productCode,
                                                        "quantityBuy" => $quantityBuy,
                                                        "sizeCode" => 'null',
                                                        "type" => $type,
                                                        "nameProduct" => $item['nameProduct']
                                                 );
                                                 array_push($result, $temp);
                                                 return $result;
                                          } else {
                                                 $nameProduct = $item['nameProduct'];
                                                 $item['quantityBuy'] = $tempCheck; // Cập nhật số lượng mua
                                                 $flag = 1;
                                          }
                                   }
                            }
                            $cartArr[$i] = $item;
                     }

                     // Kiểm tra nếu sản phẩm với size sản phẩm đó chưa có trong giỏ hàng
                     if ($flag == 0) {
                            // Thêm sản phẩm mới vào giỏ hàng
                            if ($type == 'shirtProduct') {
                                   $item = $this->ShirtProductDAL->getObj($productCode);
                            } elseif ($type == 'handbagProduct') {
                                   $item = $this->HandbagProductDAL->getObj($productCode);
                            }


                            if ($item != null) {
                                   $nameProduct = $item->getNameProduct();
                                   $quantity = $item->getQuantity();
                                   $img = $item->getImgProduct();
                                   $price = $item->getPrice();
                                   $promotion = $item->getPromotion();
                                   if ($type == 'shirtProduct') {
                                          $shirtSizeObj = $this->ShirtSizeDAL->getObjByProductCodeAndSizeCode($productCode, $sizeCode);
                                          $quantityShirtSize = $shirtSizeObj->getQuantity();
                                          if ($quantityBuy >= $quantity || $quantityBuy >= $quantityShirtSize) {
                                                 $temp = array(
                                                        "message" => "notEnoughQuantity",
                                                        "productCode" => $productCode,
                                                        "quantityBuy" => $quantityBuy,
                                                        "sizeCode" => $sizeCode,
                                                        "type" => $type,
                                                        "nameProduct" => $nameProduct
                                                 );
                                                 array_push($result, $temp);
                                                 return $result;
                                          }
                                          $obj = array(
                                                 "productCode" => $productCode,
                                                 "nameProduct" => $nameProduct,
                                                 "imgProduct" => $img,
                                                 "price" => (float)$price,
                                                 "promotion" => (float)$promotion,
                                                 "quantityBuy" => (int)$quantityBuy,
                                                 "sizeCode" => $sizeCode,
                                                 "type" => $type
                                          );
                                          array_push($cartArr, $obj);
                                   } else if ($type == 'handbagProduct') {
                                          if ($quantityBuy >= $quantity) {
                                                 $temp = array(
                                                        "message" => "notEnoughQuantity",
                                                        "productCode" => $productCode,
                                                        "quantityBuy" => $quantityBuy,
                                                        "sizeCode" => 'null',
                                                        "type" => $type,
                                                        "nameProduct" => $nameProduct
                                                 );
                                                 array_push($result, $temp);
                                                 return $result;
                                          }

                                          $obj = array(
                                                 "productCode" => $productCode,
                                                 "nameProduct" => $nameProduct,
                                                 "imgProduct" => $img,
                                                 "price" => (float)$price,
                                                 "promotion" => (float)$promotion,
                                                 "quantityBuy" => (int)$quantityBuy,
                                                 "sizeCode" => 'null',
                                                 "type" => $type
                                          );
                                          array_push($cartArr, $obj);
                                   }
                            } else {
                                   $temp = array("message" => "không tìm thấy item");
                                   array_push($result, $temp);
                                   return $result;
                            }
                     }


                     $_SESSION['cart'] = $cartArr;
                     $temp = array(
                            "message" => "success",
                            "productCode" => $productCode,
                            "quantityBuy" => $quantityBuy,
                            "sizeCode" => $sizeCode,
                            "type" => $type,
                            "nameProduct" => $nameProduct
                     );
                     array_push($result, $temp);
                     return $result;
              } else {
                     $nameProduct = '';
                     // Nếu giỏ hàng chưa tồn tại trong session
                     $cartArr = array();
                     $_SESSION['cart'] = $cartArr;
                     if ($type == 'shirtProduct') {
                            $item = $this->ShirtProductDAL->getObj($productCode);
                     } elseif ($type == 'handbagProduct') {
                            $item = $this->HandbagProductDAL->getObj($productCode);
                     }

                     if ($item != null) {
                            $nameProduct = $item->getNameProduct();
                            $quantity = $item->getQuantity();
                            $img = $item->getImgProduct();
                            $price = $item->getPrice();
                            $promotion = $item->getPromotion();
                            if ($type == 'shirtProduct') {
                                   $shirtSizeObj = $this->ShirtSizeDAL->getObjByProductCodeAndSizeCode($productCode, $sizeCode);
                                   $quantityShirtSize = $shirtSizeObj->getQuantity();
                                   if ($quantityBuy >= $quantity || $quantityBuy >= $quantityShirtSize) {
                                          $temp = array(
                                                 "message" => "notEnoughQuantity",
                                                 "productCode" => $productCode,
                                                 "quantityBuy" => $quantityBuy,
                                                 "sizeCode" => $sizeCode,
                                                 "type" => $type,
                                                 "nameProduct" => $nameProduct
                                          );
                                          array_push($result, $temp);
                                          return $result;
                                   }
                                   $obj = array(
                                          "productCode" => $productCode,
                                          "nameProduct" => $nameProduct,
                                          "imgProduct" => $img,
                                          "price" => (float)$price,
                                          "promotion" => (float)$promotion,
                                          "quantityBuy" => (int)$quantityBuy,
                                          "sizeCode" => $sizeCode,
                                          "type" => $type
                                   );
                                   array_push($cartArr, $obj);
                            } else if ($type == 'handbagProduct') {
                                   if ($quantityBuy >= $quantity) {
                                          $temp = array(
                                                 "message" => "notEnoughQuantity",
                                                 "productCode" => $productCode,
                                                 "quantityBuy" => $quantityBuy,
                                                 "sizeCode" => 'null',
                                                 "type" => $type,
                                                 "nameProduct" => $nameProduct
                                          );
                                          array_push($result, $temp);
                                          return $result;
                                   }

                                   $obj = array(
                                          "productCode" => $productCode,
                                          "nameProduct" => $nameProduct,
                                          "imgProduct" => $img,
                                          "price" => (float)$price,
                                          "promotion" => (float)$promotion,
                                          "quantityBuy" => (int)$quantityBuy,
                                          "sizeCode" => 'null',
                                          "type" => $type
                                   );
                                   array_push($cartArr, $obj);
                            }

                            $_SESSION['cart'] = $cartArr;
                            $temp = array(
                                   "message" => "success",
                                   "productCode" => $productCode,
                                   "quantityBuy" => $quantityBuy,
                                   "sizeCode" => $sizeCode,
                                   "type" => $type,
                                   "nameProduct" => $nameProduct
                            );
                            array_push($result, $temp);
                            return $result;
                     } else {
                            $temp = array("message" => "not found item");
                            array_push($result, $temp);
                            return $result;
                     }
              }
       }

       function deleteItemCartInSession($productCode, $sizeCode)
       {
              $result = array();
              if (session_status() == PHP_SESSION_NONE) {
                     session_start();
              }
              if (isset($_SESSION['cart'])) {
                     $cartArr = $_SESSION['cart'];
                     $flag = false; // Sử dụng biến boolean thay vì số nguyên
                     $nameProduct = '';
                     $quantityBuy = '';
                     $type = '';
                     foreach ($cartArr as $index => $item) {
                            if ($item['productCode'] == $productCode) {
                                   $type = $item['type'];
                                   if ($type == 'shirtProduct' && $sizeCode == $item['sizeCode']) {
                                          $nameProduct = $item['nameProduct'];
                                          $quantityBuy = $item['quantityBuy'];

                                          unset($cartArr[$index]); // Xóa phần tử từ mảng
                                          $flag = true;
                                          break; // Dừng vòng lặp sau khi tìm thấy và xóa phần tử
                                   }
                                   if ($type == 'handbagProduct') {
                                          $nameProduct = $item['nameProduct'];
                                          $quantityBuy = $item['quantityBuy'];

                                          unset($cartArr[$index]); // Xóa phần tử từ mảng
                                          $flag = true;
                                          break; // Dừng vòng lặp sau khi tìm thấy và xóa phần tử
                                   }
                            }
                     }
                     if (!$flag) {
                            $temp = array("message" => "notFount");
                            array_push($result, $temp);
                            return $result;
                     } else {
                            // Cập nhật lại chỉ số của các phần tử còn lại trong mảng
                            $cartArr = array_values($cartArr);
                            $_SESSION['cart'] = $cartArr;
                            $temp = array(
                                   "message" => "success",
                                   "productCode" => $productCode,
                                   "nameProduct" => $nameProduct,
                                   "sizeCode" => $sizeCode,
                                   "type" => $type,
                                   "quantityBuy" => $quantityBuy
                            );
                            array_push($result, $temp);
                            return $result;
                     }
              } else {
                     $temp = array("message" => "cart chua duoc khoi tao");
                     array_push($result, $temp);
                     return $result;
              }
       }

       // getArrCart
       function getArrCart()
       {
              if (session_status() == PHP_SESSION_NONE) {
                     session_start();
              }
              $result = array();
              if (isset($_SESSION['cart'])) {
                     $arrCart = $_SESSION['cart'];
                     foreach ($arrCart as $item) {
                            // lay ten sizeCode
                            $nameSize = 'null';
                            if ($item['sizeCode'] != 'null') {
                                   $temp = $this->SizeDAL->getObj($item['sizeCode']);
                                   $nameSize = $temp->getSizeName();
                            }
                            $obj = array(
                                   "productCode" => $item['productCode'],
                                   "nameProduct" => $item['nameProduct'],
                                   "imgProduct" => $item['imgProduct'],
                                   "price" => $item['price'],
                                   "promotion" => $item['promotion'],
                                   "quantityBuy" => $item['quantityBuy'],
                                   "sizeCode" => $item['sizeCode'],
                                   "sizeName" => $nameSize,
                                   "type" => $item['type']
                            );
                            array_push($result, $obj);
                     }
                     return $result;
              } else {

                     $obj = array(
                            "productCode" => '',
                            "nameProduct" => '',
                            "imgProduct" => '',
                            "quantityBuy" => '',
                            "type" => ''
                     );
                     array_push($result, $obj);
                     return $result;
              }
       }

       // làm sạch cart khi không tìm thấy tài khoản
       function clearCart()
       {
              if (session_status() == PHP_SESSION_NONE) {
                     session_start();
              }
              if (isset($_SESSION['username']) == false) {
                     session_start();
                     session_unset();
                     session_destroy();
              }
       }

       // cập nhật trạng thái đơn hàng: completed,processing, cancelled
       function updateStateOrder($orderCode, $status)
       {
              $result = $this->OrderDAL->updateState_by_orderCode($orderCode, $status);

              if ($result == true) {
                     return array(
                            "mess" => "success"
                     );
              }
              return array(
                     "mess" => "failed"
              );
       }

       // lấy một đối tượng hóa đơn dựa theo mã hóa đơn
       function getObjOrder($orderCode)
       {
              $item = $this->OrderDAL->getObj($orderCode);
              if ($item != null) {
                     $orderCode = $item->getOrderCode();
                     $dateCreated = $item->getDateCreated();
                     $deliveryAddress = $item->getDeliveryAddress();
                     $dateDelivery = $item->getDateDelivery();
                     $dateFinish = $item->getDateFinish();
                     $userName = $item->getUserName();
                     $totalMoney = $item->getTotalMoney();
                     $codePayments = $item->getCodePayments();
                     $codeTransport = $item->getCodeTransport();
                     $status = $item->getStatus();
                     $note = $item->getNote();
                     return array(
                            "orderCode" => $orderCode,
                            "dateCreated" => $dateCreated,
                            "dateDelivery" => $dateDelivery,
                            "deliveryAddress" => $deliveryAddress,
                            "dateFinish" => $dateFinish,
                            "userName" => $userName,
                            "totalMoney" => $totalMoney,
                            "codePayments" => $codePayments,
                            "codeTransport" => $codeTransport,
                            "status" => $status,
                            "note" => $note
                     );
              } else {
                     return array();
              }
       }
}

// muc luc
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       $check = new OrderBLL();
       $function = $_POST['function'];

       switch ($function) {
              case 'addCartToSession':
                     $productCode = $_POST['code'];
                     $type = $_POST['type'];
                     $quantityBuy = (int)$_POST['quantityBuy'];
                     $sizeCode = $_POST['sizeCode'];
                     $temp = $check->addCartToSession($productCode, $type, $quantityBuy, $sizeCode);
                     echo json_encode($temp);
                     break;

              case 'getArrCart':
                     $temp = $check->getArrCart();
                     echo json_encode($temp);
                     break;

              case 'clearCart':
                     $check->clearCart();
                     break;

              case 'deleteItemCartInSession':
                     $productCode = $_POST['code'];
                     $sizeCode = $_POST['sizeCode'];
                     $temp = $check->deleteItemCartInSession($productCode, $sizeCode);
                     echo json_encode($temp);
                     break;
              case 'getArrOrder_by_Username':
                     $username = $_POST['username'];
                     $temp = $check->getArrOrder_by_Username($username);
                     echo json_encode($temp);
                     break;
              case 'getArrOrderDetail_by_orderCode':
                     $orderCode = $_POST['orderCode'];
                     $temp = $check->getArrOrderDetail_by_orderCode($orderCode);
                     echo json_encode($temp);
                     break;
              case 'addOrderUser':
                     $username = $_POST['username'];
                     $deliveryAddress = $_POST['deliveryAddress'];
                     $note = $_POST['note'];
                     $state = $_POST['state'];
                     $codePayment = $_POST['codePayment'];
                     $codeTransport = $_POST['codeTransport'];

                     $temp = $check->addOrderUser($username, $deliveryAddress, $note, $state, $codePayment, $codeTransport);
                     echo json_encode($temp);
                     break;
              case 'SearchOrder_by_key':
                     $username = $_POST['username'];
                     $keyword = $_POST['keyword'];

                     $temp = $check->SearchOrder_by_key($username, $keyword);
                     echo json_encode($temp);
                     break;
              case 'getArrOrder':
                     $temp = $check->getArrOrder();
                     echo json_encode($temp);
                     break;
              case 'getArrOrder_by_Date_State_UserName':
                     $dateStart = $_POST['dateStart'];
                     $dateEnd = $_POST['dateEnd'];
                     $keyword = $_POST['keyword'];
                     $stateNeed = $_POST['stateNeed'];
                     $temp = $check->getArrOrder_by_Date_State_UserName($dateStart, $dateEnd, $stateNeed, $keyword);
                     echo json_encode($temp);
                     break;
              case 'updateStateOrder':
                     $orderCode = $_POST['orderCode'];
                     $state = $_POST['state'];
                     $temp = $check->updateStateOrder($orderCode, $state);
                     echo json_encode($temp);
                     break;
              case 'getObjOrder':
                     $orderCode = $_POST['orderCode'];
                     $temp = $check->getObjOrder($orderCode);
                     echo json_encode($temp);
                     break;
       }
}
