<?php

class StatisticalDAL extends AbstractionDAL
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
       }

       // xóa một đối tượng bằng cách truyền đối tượng vào
       function delete($obj)
       {
       }

       // lấy ra mảng các đối tượng
       function getListObj()
       {
       }

       // lấy ra một đối tượng dựa theo mã đối tượng
       function getObj($code)
       {
       }

       // thêm một đối tượng 
       function addObj($obj)
       {
       }

       // sửa một đối tượng
       function upadateObj($obj)
       {
       }

       // Thống kê 2 loại sản phẩm túi và áo từ dateStart -> dateEnd
       // input: $dateStart, $dateEnd
       // output:  mảng chứa các thuộc tính thông kê

       function ThongKe_shirt_and_handbag($dateStart,$dateEnd)
       {

              $sql = "SELECT pr.productCode, pr.imgProduct ,pr.price, pr.nameProduct, pr.quantity as quantityStore, SUM(oddt.quantity) as quantityBuy
              FROM product pr , orderdetail oddt , orders od
              WHERE pr.productCode = oddt.productCode AND od.orderCode = oddt.orderCode AND od.dateCreated BETWEEN '$dateStart' AND '$dateEnd'
              GROUP BY pr.productCode";

              $result = $this->actionSQL->query($sql);
              $arrList  = array();

              if($result->num_rows > 0){
                     while ($data = $result->fetch_assoc()) {
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

                            array_push($arrList,$obj);
                     }
                     return $arrList;
              }else{
                     return null;
              }
       }

       // Thống kê loại sản phẩm túi 
       // input: $dateStart, $dateEnd
       // output:  mảng chứa các thuộc tính thông kê

       function ThongKe_handbag($dateStart,$dateEnd)
       {

              $sql = "SELECT pr.productCode , pr.imgProduct ,pr.price, pr.nameProduct, pr.quantity as quantityStore, SUM(oddt.quantity) as quantityBuy
              FROM product pr ,handbagproduct hbpr , orderdetail oddt , orders od
              WHERE pr.productCode = oddt.productCode AND hbpr.productCode = pr.productCode AND od.orderCode = oddt.orderCode AND od.dateCreated BETWEEN '$dateStart' AND '$dateEnd'
              GROUP BY pr.productCode";

              $result = $this->actionSQL->query($sql);
              $arrList  = array();

              if($result->num_rows > 0){
                     while ($data = $result->fetch_assoc()) {
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
                                   
                            );

                            array_push($arrList,$obj);
                     }
                     return $arrList;
              }else{
                     return null;
              }
       }

       // Thống kê loại sản phẩm túi 
       // input: $dateStart, $dateEnd
       // output:  mảng chứa các thuộc tính thông kê

       function ThongKe_shirt($dateStart,$dateEnd)
       {

              $sql = "SELECT pr.productCode , pr.imgProduct,pr.price, pr.nameProduct, pr.quantity as quantityStore, SUM(oddt.quantity) as quantityBuy
              FROM product pr ,shirtproduct shpr , orderdetail oddt, orders od
              WHERE pr.productCode = oddt.productCode AND shpr.productCode = pr.productCode AND od.orderCode = oddt.orderCode AND od.dateCreated BETWEEN '$dateStart' AND '$dateEnd'
              GROUP BY pr.productCode";

              $result = $this->actionSQL->query($sql);
              $arrList  = array();

              if($result->num_rows > 0){
                     while ($data = $result->fetch_assoc()) {
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

                            array_push($arrList,$obj);
                     }
                     return $arrList;
              }else{
                     return null;
              }
       }
}
