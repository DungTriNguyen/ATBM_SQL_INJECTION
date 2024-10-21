<?php
// gọi các lớp liên quan
require('../DAL/connectionDatabase.php');
require('../DAL/AbstractionDAL.php');

require('../DAL/StatisticalDAL.php');

class StatisticalBLL
{
       private $StatisticalDAL;

       function __construct()
       {
              $this->StatisticalDAL = new StatisticalDAL();
       }

       // thống kê túi và áo trong một khoản thời gian
       function ThongKe_shirt_and_handbag($dateStart, $dateEnd)
       {
              $arr = $this->StatisticalDAL->ThongKe_shirt_and_handbag($dateStart, $dateEnd);
              $result = array();
              if ($arr != null) {
                     foreach ($arr as $data) {
                            $productCode = $data['productCode'];
                            $imgProduct = $data['imgProduct'];
                            $nameProduct = $data['nameProduct'];
                            $price = $data['price'];
                            $quantityStore = $data['quantityStore'];
                            $quantityBuy = $data['quantityBuy'];

                            $obj = array(
                                   'productCode' => $productCode,
                                   'imgProduct' => $imgProduct,
                                   'nameProduct' => $nameProduct,
                                   'price' => $price,
                                   'quantityStore' => $quantityStore,
                                   'quantityBuy' => $quantityBuy
                            );

                            array_push($result, $obj);
                     }
                     return $result;
              } else {
                     return $result;
              }
       }

       // thống kê túi trong một khoản thời gian
       function ThongKe_handbag($dateStart, $dateEnd)
       {
              $arr = $this->StatisticalDAL->ThongKe_handbag($dateStart, $dateEnd);
              $result = array();
              if ($arr != null) {
                     foreach ($arr as $data) {
                            $productCode = $data['productCode'];
                            $imgProduct = $data['imgProduct'];
                            $nameProduct = $data['nameProduct'];
                            $price = $data['price'];
                            $quantityStore = $data['quantityStore'];
                            $quantityBuy = $data['quantityBuy'];

                            $obj = array(
                                   'productCode' => $productCode,
                                   'imgProduct' => $imgProduct,
                                   'nameProduct' => $nameProduct,
                                   'price' => $price,
                                   'quantityStore' => $quantityStore,
                                   'quantityBuy' => $quantityBuy,
                                   'type' => 'handbagProduct'
                            );

                            array_push($result, $obj);
                     }
                     return $result;
              } else {
                     return $result;
              }
       }

       // thống kê ao trong một khoản thời gian
       function ThongKe_shirt($dateStart, $dateEnd)
       {
              $arr = $this->StatisticalDAL->ThongKe_shirt($dateStart, $dateEnd);
              $result = array();
              if ($arr != null) {
                     foreach ($arr as $data) {
                            $productCode = $data['productCode'];
                            $imgProduct = $data['imgProduct'];
                            $nameProduct = $data['nameProduct'];
                            $price = $data['price'];
                            $quantityStore = $data['quantityStore'];
                            $quantityBuy = $data['quantityBuy'];

                            $obj = array(
                                   'productCode' => $productCode,
                                   'imgProduct' => $imgProduct,
                                   'nameProduct' => $nameProduct,
                                   'price' => $price,
                                   'quantityStore' => $quantityStore,
                                   'quantityBuy' => $quantityBuy,
                                   'type' => 'shirtProduct'
                            );

                            array_push($result, $obj);
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
       $check = new StatisticalBLL();

       $function = $_POST['function'];

       switch ($function) {
              case 'ThongKe_shirt_and_handbag':
                     $dateStart = $_POST['dateStart'];
                     $dateEnd = $_POST['dateEnd'];
                     $temp = $check->ThongKe_shirt_and_handbag($dateStart, $dateEnd);
                     echo json_encode($temp);
                     break;
              case 'ThongKe_handbag':
                     $dateStart = $_POST['dateStart'];
                     $dateEnd = $_POST['dateEnd'];
                     $temp = $check->ThongKe_handbag($dateStart, $dateEnd);
                     echo json_encode($temp);
                     break;
              case 'ThongKe_shirt':
                     $dateStart = $_POST['dateStart'];
                     $dateEnd = $_POST['dateEnd'];
                     $temp = $check->ThongKe_shirt($dateStart, $dateEnd);
                     echo json_encode($temp);
                     break;
       }
}
