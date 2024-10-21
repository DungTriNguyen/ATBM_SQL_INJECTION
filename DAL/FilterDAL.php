<?php
class FillterDAL extends AbstractionDAL
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
       function deleteByID($code) {}

       // xóa một đối tượng bằng cách truyền đối tượng vào
       function delete($obj) {}

       // lấy ra mảng các đối tượng
       function getListObj() {}

       // lấy ra một đối tượng dựa theo mã đối tượng
       function getObj($code) {}

       // thêm một đối tượng 
       function addObj($obj) {}

       // sửa một đối tượng
       function upadateObj($obj) {}

       // lấy danh sách mã sản phẩm
       // Input:...
       // Output: mảng chứa mã productCode
       function getArrProductCode()
       {
              $sql = "
                     SELECT pr.productCode
                     FROM product pr
              ";
              $result = $this->actionSQL->query($sql);
              $arrList  = array();
              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $productCode = $data["productCode"];
                            array_push($arrList, $productCode);
                     }
                     return $arrList;
              } else {
                     return $arrList;
              }
       }

       // lọc sản phẩm theo sản phẩm được mua nhiều (bán chạy nhất) nhất
       // Input: các bảng (product, orderdetail)
       // Output: mảng chứa mã sản phẩm được sắp xếp theo số lượng được mua nhiều nhất trong chi tiết đơn hàng 
       function filter_product_best_selling()
       {
              $sql = "
                     SELECT pr.productCode, pr.nameProduct , SUM(odt.quantity) AS NumberOfBuying
                     FROM product pr, orderdetail odt
                     WHERE pr.productCode = odt.productCode
                     GROUP BY pr.productCode
                     ORDER BY NumberOfBuying DESC
              ";
              // NumberOfBuying DESC
              $result = $this->actionSQL->query($sql);
              $arrList  = array();
              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $productCode = $data["productCode"];
                            array_push($arrList, $productCode);
                     }
                     return $arrList;
              } else {
                     return $arrList;
              }
       }

       // lọc sản phẩm đang được giảm giá nhiều nhất
       // Input: bảng (product)
       // Output: mảng chứa mã sản phẩm sắp xếp giảm dần từ giảm giá cao nhất đến thấp nhất.
       function filter_product_best_promotion()
       {
              $sql = "
                     SELECT pr.productCode, pr.promotion
                     FROM product pr
                     ORDER BY pr.promotion DESC
              ";
              // pr.promotion DESC
              $result = $this->actionSQL->query($sql);
              $arrList  = array();
              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $productCode = $data["productCode"];
                            array_push($arrList, $productCode);
                     }
                     return $arrList;
              } else {
                     return $arrList;
              }
       }

       // Lấy danh sách giá trị thuộc tính targetGender của đối tượng product
       // Input:...
       // Output: Mảng chứa các giá trị của thộc tính targetGender
       function getArr_value_atributive_targetGender()
       {
              $sql = "
                     SELECT pr.targetGender
                     FROM product pr
                     GROUP BY pr.targetGender
              ";
              $result = $this->actionSQL->query($sql);
              $arrList  = array();
              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $targetGender = $data["targetGender"];
                            array_push($arrList, $targetGender);
                     }
                     return $arrList;
              } else {
                     return $arrList;
              }
       }

       // Lấy danh sách giá trị các thuộc tính color của đối tượng product
       // Input: ...
       // Output: Mảng chứa các giá trị của thộc tính color
       function getArr_value_atributive_color()
       {
              $sql = "
                     SELECT pr.color
                     FROM product pr
                     GROUP BY pr.color
              ";
              $result = $this->actionSQL->query($sql);
              $arrList  = array();
              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $color = $data["color"];
                            array_push($arrList, $color);
                     }
                     return $arrList;
              } else {
                     return $arrList;
              }
       }

       // Lấy danh dánh sách giá trị của thộc tính bagMaterial của đối tượng handbag product
       // Input:...
       // Output: Mảng chứa các giá trị của thuộc tings bagMaterial
       function getArr_value_atributive_bagMaterial()
       {
              $sql = "
                     SELECT hbpd.bagMaterial
                     FROM handbagproduct hbpd
                     GROUP BY hbpd.bagMaterial
              ";
              $result = $this->actionSQL->query($sql);
              $arrList  = array();
              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $bagMaterial = $data["bagMaterial"];
                            array_push($arrList, $bagMaterial);
                     }
                     return $arrList;
              } else {
                     return $arrList;
              }
       }

       // Lấy danh dánh sách giá trị của thộc tính shirtMaterial của đối tượng shirt product
       // Input:...
       // Output: Mảng chứa các giá trị của thuộc tings shirtMaterial
       function getArr_value_atributive_shirtMaterial()
       {
              $sql = "
                     SELECT sp.shirtMaterial
                     FROM shirtproduct sp
                     GROUP BY sp.shirtMaterial
              ";
              $result = $this->actionSQL->query($sql);
              $arrList  = array();
              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $shirtMaterial = $data["shirtMaterial"];
                            array_push($arrList, $shirtMaterial);
                     }
                     return $arrList;
              } else {
                     return $arrList;
              }
       }

       // Lấy danh dánh sách giá trị của thộc tính shirtStyle của đối tượng shirt product
       // Input:...
       // Output: Mảng chứa các giá trị của thuộc tings shirtStyle
       function getArr_value_atributive_shirtStyle()
       {
              $sql = "
                     SELECT sp.shirtStyle
                     FROM shirtproduct sp
                     GROUP BY sp.shirtStyle
              ";
              $result = $this->actionSQL->query($sql);
              $arrList  = array();
              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $shirtStyle = $data["shirtStyle"];
                            array_push($arrList, $shirtStyle);
                     }
                     return $arrList;
              } else {
                     return $arrList;
              }
       }

       // Lấy giá trị priceMax của thuộc tính price
       // Input:...
       // Output: Giá trị priceMax của thuộc tính price
       function getPriceMax()
       {
              $sql = "
                     SELECT MAX(pr.price) as priceMax
                     FROM product pr
              ";
              $result = $this->actionSQL->query($sql);
              $arrList  = array();
              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $priceMax = $data["priceMax"];
                            array_push($arrList, $priceMax);
                     }
                     return $arrList;
              } else {
                     return $arrList;
              }
       }

       // Lọc product dựa theo thuộc tính targetGender
       // Input: giá trị của thuôc tính targetGender
       // Output: mảng chứa mã productCode 
       function filterProduct_by_targetGender($targetGender)
       {
              $sql = "
                     SELECT pr.productCode, pr.targetGender
                     FROM product pr
                     WHERE pr.targetGender = '$targetGender'
              ";
              $result = $this->actionSQL->query($sql);
              $arrList  = array();
              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $productCode = $data["productCode"];
                            array_push($arrList, $productCode);
                     }
                     return $arrList;
              } else {
                     return $arrList;
              }
       }

       // Lọc product dựa theo thuộc tính color
       // Input: giá trị của thuôc tính color
       // Output: mảng chứa mã productCode 
       function filterProduct_by_color($color)
       {
              $sql = "
                     SELECT pr.productCode, pr.color
                     FROM product pr
                     WHERE pr.color = '$color'
              ";
              $result = $this->actionSQL->query($sql);
              $arrList  = array();
              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $productCode = $data["productCode"];
                            array_push($arrList, $productCode);
                     }
                     return $arrList;
              } else {
                     return $arrList;
              }
       }

       // Lọc handbag product dựa theo thuộc tính bagMaterial
       // Input: giá trị của thuôc tính bagMaterial
       // Output: mảng chứa mã productCode 
       function filterProduct_by_bagMaterial($bagMaterial)
       {
              $sql = "
                     SELECT pr.productCode, hbpd.bagMaterial
                     FROM product pr, handbagproduct hbpd
                     WHERE pr.productCode = hbpd.productCode AND hbpd.bagMaterial = '$bagMaterial'
              ";
              $result = $this->actionSQL->query($sql);
              $arrList  = array();
              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $productCode = $data["productCode"];
                            array_push($arrList, $productCode);
                     }
                     return $arrList;
              } else {
                     return $arrList;
              }
       }

       // Lọc shirt product dựa theo thuộc tính shirtMaterial
       // Input: giá trị của thuôc tính shirtMaterial
       // Output: mảng chứa mã productCode 
       function filterProduct_by_shirtMaterial($shirtMaterial)
       {
              $sql = "
                     SELECT pr.productCode, sp.shirtMaterial
                     FROM product pr, shirtproduct sp
                     WHERE pr.productCode = sp.productCode AND sp.shirtMaterial = '$shirtMaterial'
              ";
              $result = $this->actionSQL->query($sql);
              $arrList  = array();
              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $productCode = $data["productCode"];
                            array_push($arrList, $productCode);
                     }
                     return $arrList;
              } else {
                     return $arrList;
              }
       }

       // Lọc shirt product dựa theo thuộc tính shirtStyle
       // Input: giá trị của thuôc tính shirtStyle
       // Output: mảng chứa mã productCode 
       function filterProduct_by_shirtStyle($shirtStyle)
       {
              $sql = "
                     SELECT pr.productCode, sp.shirtStyle
                     FROM product pr, shirtproduct sp
                     WHERE pr.productCode = sp.productCode AND sp.shirtStyle = '$shirtStyle'
              ";
              $result = $this->actionSQL->query($sql);
              $arrList  = array();
              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $productCode = $data["productCode"];
                            array_push($arrList, $productCode);
                     }
                     return $arrList;
              } else {
                     return $arrList;
              }
       }

       // Lọc product dựa theo thuộc tính price - các product từ price A đến price B
       // Input: giá trị A và B của thuôc tính price 
       // Output: mảng chứa mã productCode 
       function filterProduct_by_price($priceMin, $priceMax)
       {
              $sql = "
                     SELECT pr.productCode, pr.price
                     FROM product pr
                     WHERE pr.price BETWEEN $priceMin AND $priceMax 
              ";
              $result = $this->actionSQL->query($sql);
              $arrList  = array();
              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $productCode = $data["productCode"];
                            array_push($arrList, $productCode);
                     }
                     return $arrList;
              } else {
                     return $arrList;
              }
       }

       // Sắp xếp sản phẩm theo giá tiền từ thấp đến cao.
       // Input:...
       // Output: Mảng chứa mã productCode.
       function sortProduct_by_price_low_to_high()
       {
              $sql = "
                     SELECT pr.productCode, pr.price
                     FROM product pr
                     ORDER BY pr.price 
              ";
              // pr.price 
              $result = $this->actionSQL->query($sql);
              $arrList  = array();
              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $productCode = $data["productCode"];
                            array_push($arrList, $productCode);
                     }
                     return $arrList;
              } else {
                     return $arrList;
              }
       }

       // Sắp xếp sản phẩm theo giá tiền từ cao đến thấp.
       // Input:...
       // Output: Mảng chứa mã productCode.
       function sortProduct_by_price_high_to_low()
       {
              $sql = "
                     SELECT pr.productCode, pr.price
                     FROM product pr
                     ORDER BY pr.price DESC
              ";
              $result = $this->actionSQL->query($sql);
              $arrList  = array();
              if ($result->num_rows > 0) {
                     while ($data = $result->fetch_assoc()) {
                            $productCode = $data["productCode"];
                            array_push($arrList, $productCode);
                     }
                     return $arrList;
              } else {
                     return $arrList;
              }
       }
}
