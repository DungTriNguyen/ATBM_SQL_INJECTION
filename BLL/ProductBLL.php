<?php

// gọi các lớp liên quan
require('../DAL/connectionDatabase.php');
require('../DAL/AbstractionDAL.php');

require('../DTO/ProductDTO.php');
require('../DTO/HandbagProductDTO.php');
require('../DTO/ShirtProductDTO.php');
require('../DTO/ShirtSizeDTO.php');
require('../DTO/SizeDTO.php');

require('../DAL/ProductDAL.php');
require('../DAL/HandbagProductDAL.php');
require('../DAL/ShirtProductDAL.php');
require('../DAL/ShirtSizeDAL.php');
require('../DAL/SizeDAL.php');
require('../DAL/FilterDAL.php');



class ProductBLL
{
       private $productList;
       // private $arr_handbag;
       // private $arr_shirt;
       private $HandbagProductDAL;
       private $ShirtProductDAL;
       private $ShirtSizeDAL;
       private $SizeDAL;
       private $FilterDAL;
       private $ProductDAL;
       function __construct()
       {
              $this->productList = array();
              $this->HandbagProductDAL = new HandbagProductDAL();
              $this->ShirtProductDAL = new ShirtProductDAL();
              $this->ShirtSizeDAL = new ShirtSizeDAL();
              $this->SizeDAL = new SizeDAL();
              $this->FilterDAL = new FillterDAL();
              $this->ProductDAL = new ProductDAL();
              // $this->arr_handbag = $this->HandbagProductDAL->getListObj();
              // $this->arr_shirt = $this->ShirtProductDAL->getListObj();
       }

       // trans to json
       function transHandbagProductToJson()
       {
              $arr_handbag = $this->HandbagProductDAL->getListObj();
              $arrJson = array();
              foreach ($arr_handbag as $item) {

                     $ProductCode = $item->getProductCode();
                     $imgProduct = $item->getImgProduct();
                     $nameProduct = $item->getNameProduct();
                     $supplierCode = $item->getSupplierCode();
                     $quantity = $item->getQuantity();
                     $describeProduct = $item->getDescribe();
                     $status = $item->getStatus();
                     $color = $item->getColor();
                     $targetGender = $item->getTargetGender();
                     $price = $item->getPrice();
                     $promotion = $item->getPromotion();
                     $bagMaterial = $item->getBagMaterial();
                     $descriptionMaterial = $item->getDescriptionMaterial();

                     $obj = array(
                            "productCode" => $ProductCode,
                            "imgProduct" => $imgProduct,
                            "nameProduct" => $nameProduct,
                            "supplierCode" => $supplierCode,
                            "quantity" => $quantity,
                            "describeProduct" => $describeProduct,
                            "status" => $status,
                            "color" => $color,
                            "targetGender" => $targetGender,
                            "price" => $price,
                            "promotion" => $promotion,
                            "bagMaterial" => $bagMaterial,
                            "descriptionMaterial" => $descriptionMaterial,
                            "type" => "handbagProduct"
                     );

                     array_push($arrJson, $obj);
              }
              return $arrJson;
       }
       function transShirtProductToJson()
       {
              $arr_shirt = $this->ShirtProductDAL->getListObj();
              $arrJson = array();

              foreach ($arr_shirt as $item) {

                     $ProductCode = $item->getProductCode();
                     $imgProduct = $item->getImgProduct();
                     $nameProduct = $item->getNameProduct();
                     $supplierCode = $item->getSupplierCode();
                     $quantity = $item->getQuantity();
                     $describeProduct = $item->getDescribe();
                     $status = $item->getStatus();
                     $color = $item->getColor();
                     $targetGender = $item->getTargetGender();
                     $price = $item->getPrice();
                     $promotion = $item->getPromotion();
                     $shirtMaterial = $item->getShirtMaterial();
                     $shirtStyle = $item->getShirtStyle();
                     $descriptionMaterial = $item->getDescriptionMaterial();

                     $obj = array(
                            "productCode" => $ProductCode,
                            "imgProduct" => $imgProduct,
                            "nameProduct" => $nameProduct,
                            "supplierCode" => $supplierCode,
                            "quantity" => $quantity,
                            "describeProduct" => $describeProduct,
                            "status" => $status,
                            "color" => $color,
                            "targetGender" => $targetGender,
                            "price" => $price,
                            "promotion" => $promotion,
                            "shirtMaterial" => $shirtMaterial,
                            "shirtStyle" => $shirtStyle,
                            "descriptionMaterial" => $descriptionMaterial,
                            "type" => "shirtProduct"
                     );

                     array_push($arrJson, $obj);
              }
              return $arrJson;
       }

       function getProductByCode_transToJson($productCode, $type)
       {
              if ($type === 'shirtProduct') {
                     $item = $this->ShirtProductDAL->getObj($productCode);
                     $item2 = $this->ShirtSizeDAL->getArrByProductCode($productCode);
                     $stringShirtSize = '';
                     $arrShirtSize = array();
                     if ($item2 != null) {
                            foreach ($item2 as $obj) {
                                   $sizeCode = $obj->getSizeCode();
                                   $item3 = $this->SizeDAL->getObj($sizeCode);
                                   $sizeName = $item3->getSizeName();
                                   $quantitySize = $obj->getQuantity();
                                   $string = "$sizeCode-$sizeName-$quantitySize";
                                   array_push($arrShirtSize, $string);
                            }
                            $stringShirtSize = implode(" ", $arrShirtSize);
                     } else {
                            return array('message' => 'loi');
                     }
                     if ($item != null) {
                            // chuyển sang dạng mảng obj

                            $ProductCode = $item->getProductCode();
                            $imgProduct = $item->getImgProduct();
                            $nameProduct = $item->getNameProduct();
                            $supplierCode = $item->getSupplierCode();
                            $quantity = $item->getQuantity();
                            $describeProduct = $item->getDescribe();
                            $status = $item->getStatus();
                            $color = $item->getColor();
                            $targetGender = $item->getTargetGender();
                            $price = $item->getPrice();
                            $promotion = $item->getPromotion();
                            $shirtMaterial = $item->getShirtMaterial();
                            $shirtStyle = $item->getShirtStyle();
                            $descriptionMaterial = $item->getDescriptionMaterial();

                            $obj = array(
                                   "productCode" => $ProductCode,
                                   "imgProduct" => $imgProduct,
                                   "nameProduct" => $nameProduct,
                                   "supplierCode" => $supplierCode,
                                   "quantity" => $quantity,
                                   "describeProduct" => $describeProduct,
                                   "status" => $status,
                                   "color" => $color,
                                   "targetGender" => $targetGender,
                                   "price" => $price,
                                   "promotion" => $promotion,
                                   "shirtMaterial" => $shirtMaterial,
                                   "shirtStyle" => $shirtStyle,
                                   "descriptionMaterial" => $descriptionMaterial,
                                   "quantitySize" => $stringShirtSize
                            );

                            return $obj;
                     } else {
                            return array('message' => 'loi');
                     }
              } elseif ($type === 'handbagProduct') {
                     $item = $this->HandbagProductDAL->getObj($productCode);

                     if ($item != null) {
                            $ProductCode = $item->getProductCode();
                            $imgProduct = $item->getImgProduct();
                            $nameProduct = $item->getNameProduct();
                            $supplierCode = $item->getSupplierCode();
                            $quantity = $item->getQuantity();
                            $describeProduct = $item->getDescribe();
                            $status = $item->getStatus();
                            $color = $item->getColor();
                            $targetGender = $item->getTargetGender();
                            $price = $item->getPrice();
                            $promotion = $item->getPromotion();
                            $bagMaterial = $item->getBagMaterial();
                            $descriptionMaterial = $item->getDescriptionMaterial();

                            $obj = array(
                                   "productCode" => $ProductCode,
                                   "imgProduct" => $imgProduct,
                                   "nameProduct" => $nameProduct,
                                   "supplierCode" => $supplierCode,
                                   "quantity" => $quantity,
                                   "describeProduct" => $describeProduct,
                                   "status" => $status,
                                   "color" => $color,
                                   "targetGender" => $targetGender,
                                   "price" => $price,
                                   "promotion" => $promotion,
                                   "bagMaterial" => $bagMaterial,
                                   "descriptionMaterial" => $descriptionMaterial
                            );

                            return $obj;
                     } else {
                            return array('message' => 'loi');
                     }
              }
       }

       // lấy số lượng dựa theo productCode và sizeCode
       function getQuantityByProductCodeAndSizeCode($productCode, $sizeCode)
       {
              $item = $this->ShirtSizeDAL->getObjByProductCodeAndSizeCode($productCode, $sizeCode);
              if ($item != null) {
                     $sizeCode = $item->getSizeCode();
                     $item2 = $this->SizeDAL->getObj($sizeCode);
                     $sizeName = $item2->getSizeName();
                     $quantitySize = $item->getQuantity();
                     return array(
                            "productCode" => $productCode,
                            "sizeCode" => $sizeCode,
                            "sizeName" => $sizeName,
                            "quantitySize" => $quantitySize
                     );
              }
              return array();
       }
       function getArrSizeCodeByProductCode($productCode)
       {
              $item = $this->ShirtSizeDAL->getArrByProductCode($productCode);
              $result = array();
              if ($item != null) {
                     foreach ($item as $i) {
                            $sizeCode = $i->getSizeCode();
                            $item2 = $this->SizeDAL->getObj($sizeCode);
                            $sizeName = $item2->getSizeName();
                            $quantitySize = $i->getQuantity();

                            $obj = array(
                                   "productCode" => $productCode,
                                   "sizeCode" => $sizeCode,
                                   "sizeName" => $sizeName,
                                   "quantitySize" => $quantitySize
                            );
                            array_push($result, $obj);
                     }
              }
              return $result;
       }

       // phan trang va tim kiem ben admin
       function Pagination_Search($page, $limit, $keyword, $typeNeed)
       {
              // Input: Các tham số truyền vào: page
              // Output: trả về danh sách sản phẩm dựa theo vị trí bắt đầu beginGet và vị trí kết thúc endGet

              // cộng thức tổng quát
              // BeginGet= limit* (page - 1); 
              // endGet: limit * page-1;

              // Dùng một mảng lưu sảm phẩm 
              // đối tượng sẽ trả về $obj = {productCode,imgProduct,nameProduct,price,promotion,type}

              // lấy dữ liệu bảng product
              $arr1 = $this->ShirtProductDAL->getListObj();
              $arr2 = $this->HandbagProductDAL->getListObj();

              // gọp 2 mảnh đó lại thành dữ liệu chung để phân trang
              $arr = array();
              foreach ($arr1 as $item) {

                     $ProductCode = $item->getProductCode();
                     $imgProduct = $item->getImgProduct();
                     $nameProduct = $item->getNameProduct();
                     $supplierCode = $item->getSupplierCode();
                     $quantity = $item->getQuantity();
                     $describeProduct = $item->getDescribe();
                     $status = $item->getStatus();
                     $color = $item->getColor();
                     $targetGender = $item->getTargetGender();
                     $price = $item->getPrice();
                     $promotion = $item->getPromotion();
                     $shirtMaterial = $item->getShirtMaterial();
                     $shirtStyle = $item->getShirtStyle();
                     $descriptionMaterial = $item->getDescriptionMaterial();

                     //  cac thuoc tinh rieng cua ao
                     $obj = array(
                            "productCode" => $ProductCode,
                            "imgProduct" => $imgProduct,
                            "nameProduct" => $nameProduct,
                            "supplierCode" => $supplierCode,
                            "quantity" => $quantity,
                            "describeProduct" => $describeProduct,
                            "status" => $status,
                            "color" => $color,
                            "targetGender" => $targetGender,
                            "price" => $price,
                            "promotion" => $promotion,
                            "shirtMaterial" => $shirtMaterial,
                            "shirtStyle" => $shirtStyle,
                            "descriptionMaterial" => $descriptionMaterial,
                            "type" => "shirtProduct"
                     );
                     array_push($arr, $obj);
              }
              foreach ($arr2 as $item) {

                     $ProductCode = $item->getProductCode();
                     $imgProduct = $item->getImgProduct();
                     $nameProduct = $item->getNameProduct();
                     $supplierCode = $item->getSupplierCode();
                     $quantity = $item->getQuantity();
                     $describeProduct = $item->getDescribe();
                     $status = $item->getStatus();
                     $color = $item->getColor();
                     $targetGender = $item->getTargetGender();
                     $price = $item->getPrice();
                     $promotion = $item->getPromotion();

                     // cac thuoc tinh handbag
                     $bagMaterial = $item->getBagMaterial();
                     $descriptionMaterial = $item->getDescriptionMaterial();
                     $obj = array(
                            "productCode" => $ProductCode,
                            "imgProduct" => $imgProduct,
                            "nameProduct" => $nameProduct,
                            "supplierCode" => $supplierCode,
                            "quantity" => $quantity,
                            "describeProduct" => $describeProduct,
                            "status" => $status,
                            "color" => $color,
                            "targetGender" => $targetGender,
                            "price" => $price,
                            "promotion" => $promotion,
                            "bagMaterial" => $bagMaterial,
                            "descriptionMaterial" => $descriptionMaterial,
                            "type" => "handbagProduct"
                     );
                     array_push($arr, $obj);
              }

              // loc theo tim kiem
              $arr_filter = array();
              // kiem tra

              $check_keyword = 0;
              $check_typeNeed = 0;
              if ($keyword != 'empty') {
                     $check_keyword = 1;
              }
              if ($typeNeed != 'empty') {
                     $check_typeNeed = 1;
              }

              if ($check_keyword == 1 && $check_typeNeed == 1) {
                     $keyword_lowercase = strtolower($keyword);
                     foreach ($arr as $item) {

                            // kiem tra cac truong
                            if ($item['type'] == $typeNeed) {
                                   if (
                                          strpos(strtolower($item['productCode']), $keyword_lowercase) !== false ||
                                          strpos(strtolower($item['nameProduct']), $keyword_lowercase) !== false ||
                                          strpos(strtolower($item['supplierCode']), $keyword_lowercase) !== false ||
                                          strpos(strtolower($item['quantity']), $keyword_lowercase) !== false ||
                                          strpos(strtolower($item['describeProduct']), $keyword_lowercase) !== false ||
                                          strpos(strtolower($item['color']), $keyword_lowercase) !== false ||
                                          strpos(strtolower($item['targetGender']), $keyword_lowercase) !== false ||
                                          strpos(strtolower($item['status']), $keyword_lowercase) !== false
                                   ) {
                                          array_push($arr_filter, $item);
                                   }
                            }
                     }

                     // phan trang

                     if (!empty($arr_filter)) {
                            // tính BeginGet và EndGet
                            $beginGet = $limit * ($page - 1);
                            $endGet = $limit * $page - 1;

                            $pagination = array();
                            $lenghtData = array("lengthProduct" => count($arr_filter));
                            for ($i = $beginGet; $i <= $endGet; $i++) {
                                   if (isset($arr_filter[$i])) {
                                          array_push($pagination, $arr_filter[$i]);
                                   }
                            }

                            array_push($pagination, $lenghtData);

                            return $pagination;
                     }
                     return null;
              }
              if ($check_keyword == 1 && $check_typeNeed == 0) {
                     $keyword_lowercase = strtolower($keyword);
                     foreach ($arr as $item) {
                            // Kiểm tra nếu từ khóa xuất hiện trong bất kỳ trường nào của mục
                            if (
                                   strpos(strtolower($item['productCode']), $keyword_lowercase) !== false ||
                                   strpos(strtolower($item['nameProduct']), $keyword_lowercase) !== false ||
                                   strpos(strtolower($item['supplierCode']), $keyword_lowercase) !== false ||
                                   strpos(strtolower($item['quantity']), $keyword_lowercase) !== false ||
                                   strpos(strtolower($item['describeProduct']), $keyword_lowercase) !== false ||
                                   strpos(strtolower($item['color']), $keyword_lowercase) !== false ||
                                   strpos(strtolower($item['targetGender']), $keyword_lowercase) !== false ||
                                   strpos(strtolower($item['status']), $keyword_lowercase) !== false
                            ) {
                                   array_push($arr_filter, $item);
                            }
                     }
                     // phan trang

                     if (!empty($arr_filter)) {
                            // tính BeginGet và EndGet
                            $beginGet = $limit * ($page - 1);
                            $endGet = $limit * $page - 1;

                            $pagination = array();
                            $lenghtData = array("lengthProduct" => count($arr_filter));
                            for ($i = $beginGet; $i <= $endGet; $i++) {
                                   if (isset($arr_filter[$i])) {
                                          array_push($pagination, $arr_filter[$i]);
                                   }
                            }

                            array_push($pagination, $lenghtData);

                            return $pagination;
                     }
                     return null;
              }
              if ($check_keyword == 0 && $check_typeNeed == 1) {
                     foreach ($arr as $item) {
                            // Kiểm tra nếu loại của mục khớp với loại cần tìm kiếm
                            if ($item['type'] == $typeNeed) {
                                   array_push($arr_filter, $item);
                            }
                     }
                     // phan trang

                     if (!empty($arr_filter)) {
                            // tính BeginGet và EndGet
                            $beginGet = $limit * ($page - 1);
                            $endGet = $limit * $page - 1;

                            $pagination = array();
                            $lenghtData = array("lengthProduct" => count($arr_filter));
                            for ($i = $beginGet; $i <= $endGet; $i++) {
                                   if (isset($arr_filter[$i])) {
                                          array_push($pagination, $arr_filter[$i]);
                                   }
                            }

                            array_push($pagination, $lenghtData);

                            return $pagination;
                     }
                     return null;
              }
              if ($check_keyword == 0 && $check_typeNeed == 0) {
                     // phan trang

                     // phan trang

                     if (!empty($arr)) {
                            // tính BeginGet và EndGet
                            $beginGet = $limit * ($page - 1);
                            $endGet = $limit * $page - 1;

                            $pagination = array();
                            $lenghtData = array("lengthProduct" => count($arr));
                            for ($i = $beginGet; $i <= $endGet; $i++) {
                                   if (isset($arr[$i])) {
                                          array_push($pagination, $arr[$i]);
                                   }
                            }

                            array_push($pagination, $lenghtData);

                            return $pagination;
                     }
                     return null;
              }
       }




       function Pagination_Search_Hack($page, $limit, $keyword)
       {
              // Input: Các tham số truyền vào: page, limit, keyword
              // Output: Trả về danh sách sản phẩm và thông tin phân trang

              // Tính toán vị trí bắt đầu và kết thúc
              $beginGet = $limit * ($page - 1);
              $endGet = $limit * $page - 1;

              // Lấy danh sách sản phẩm từ hàm searchProduct
              $arr = $this->ProductDAL->searchProduct($keyword);
              $result = array();

              // Nếu có sản phẩm, lấy thông tin và thêm vào mảng kết quả
              if (count($arr) > 0) {
                     foreach ($arr as $item) {
                            // Lấy thông tin sản phẩm
                            $productCode = $item->getProductCode();
                            $imgProduct = $item->getImgProduct();
                            $nameProduct = $item->getNameProduct();
                            $supplierCode = $item->getSupplierCode();
                            $quantity = $item->getQuantity();
                            $describeProduct = $item->getDescribeProduct();
                            $status = $item->getStatus();
                            $color = $item->getColor();
                            $targetGender = $item->getTargetGender();
                            $price = $item->getPrice();
                            $promotion = $item->getPromotion();

                            // Thêm sản phẩm vào mảng kết quả
                            $obj = array(
                                   "productCode" => $productCode,
                                   "imgProduct" => $imgProduct,
                                   "nameProduct" => $nameProduct,
                                   "supplierCode" => $supplierCode,
                                   "quantity" => $quantity,
                                   "describeProduct" => $describeProduct,
                                   "status" => $status,
                                   "color" => $color,
                                   "targetGender" => $targetGender,
                                   "price" => $price,
                                   "promotion" => $promotion,
                            );
                            array_push($result, $obj);
                     }
              }

              // Phân trang
              if (!empty($result)) {
                     $pagination = array();
                     $lengthData = array("lengthProduct" => count($result));

                     // Tạo mảng phân trang
                     for ($i = $beginGet; $i <= $endGet; $i++) {
                            if (isset($result[$i])) {
                                   array_push($pagination, $result[$i]);
                            }
                     }

                     // Thêm thông tin về tổng số sản phẩm vào kết quả
                     array_push($pagination, $lengthData);
                     return $pagination;
              }

              return null; // Trả về null nếu không có sản phẩm nào tìm thấy
       }



       // search box on header
       function searchProduct($keyword)
       {
              // lấy dữ liệu 
              $arrHandbag = $this->HandbagProductDAL->getListObj();
              $arrShirt = $this->ShirtProductDAL->getListObj();

              // tạo một mảng lưu kết quả tìm được
              $result = array();

              if ($keyword != 'null') {
                     // tra thông tin trên sản phẩm áo
                     foreach ($arrShirt as $item) {

                            $ProductCode = $item->getProductCode();
                            $imgProduct = $item->getImgProduct();
                            $nameProduct = $item->getNameProduct();
                            $supplierCode = $item->getSupplierCode();
                            $quantity = $item->getQuantity();
                            $describeProduct = $item->getDescribe();
                            $status = $item->getStatus();
                            $color = $item->getColor();
                            $targetGender = $item->getTargetGender();
                            $price = $item->getPrice();
                            $promotion = $item->getPromotion();
                            $shirtMaterial = $item->getShirtMaterial();
                            $shirtStyle = $item->getShirtStyle();

                            // Kiểm tra nếu "keyword" xuất hiện trong một trong các thuộc tính
                            if (
                                   strpos($ProductCode, $keyword) !== false ||
                                   strpos($imgProduct, $keyword) !== false ||
                                   strpos($nameProduct, $keyword) !== false ||
                                   strpos($supplierCode, $keyword) !== false ||
                                   strpos($describeProduct, $keyword) !== false ||
                                   strpos($color, $keyword) !== false ||
                                   strpos($targetGender, $keyword) !== false ||
                                   strpos($price, $keyword) !== false ||
                                   strpos($promotion, $keyword) !== false ||
                                   strpos($shirtMaterial, $keyword) !== false ||
                                   strpos($shirtStyle, $keyword) !== false
                            ) {

                                   // Nếu có, thêm item vào mảng result
                                   $obj = array(
                                          "productCode" => $ProductCode,
                                          "imgProduct" => $imgProduct,
                                          "nameProduct" => $nameProduct,
                                          "supplierCode" => $supplierCode,
                                          "quantity" => $quantity,
                                          "describeProduct" => $describeProduct,
                                          "status" => $status,
                                          "color" => $color,
                                          "targetGender" => $targetGender,
                                          "price" => $price,
                                          "promotion" => $promotion,
                                          "type" => "shirtProduct"
                                   );

                                   array_push($result, $obj);
                            }
                     }

                     // tra thong tin tren san pham tui sach
                     foreach ($arrHandbag as $item) {
                            if ($item->getStatus() == '1' && $item->getQuantity() > 1) {
                                   $ProductCode = $item->getProductCode();
                                   $imgProduct = $item->getImgProduct();
                                   $nameProduct = $item->getNameProduct();
                                   $supplierCode = $item->getSupplierCode();
                                   $quantity = $item->getQuantity();
                                   $describeProduct = $item->getDescribe();
                                   $status = $item->getStatus();
                                   $color = $item->getColor();
                                   $targetGender = $item->getTargetGender();
                                   $price = $item->getPrice();
                                   $promotion = $item->getPromotion();
                                   $bagMaterial = $item->getBagMaterial();
                                   $descriptionMaterial = $item->getDescriptionMaterial();

                                   // Kiểm tra nếu "keyword" xuất hiện trong một trong các thuộc tính
                                   if (
                                          strpos($ProductCode, $keyword) !== false ||
                                          strpos($imgProduct, $keyword) !== false ||
                                          strpos($nameProduct, $keyword) !== false ||
                                          strpos($supplierCode, $keyword) !== false ||
                                          strpos($describeProduct, $keyword) !== false ||
                                          strpos($color, $keyword) !== false ||
                                          strpos($targetGender, $keyword) !== false ||
                                          strpos($price, $keyword) !== false ||
                                          strpos($promotion, $keyword) !== false ||
                                          strpos($bagMaterial, $keyword) !== false
                                   ) {

                                          // Nếu có, thêm item vào mảng result
                                          $obj = array(
                                                 "productCode" => $ProductCode,
                                                 "imgProduct" => $imgProduct,
                                                 "nameProduct" => $nameProduct,
                                                 "supplierCode" => $supplierCode,
                                                 "quantity" => $quantity,
                                                 "describeProduct" => $describeProduct,
                                                 "status" => $status,
                                                 "color" => $color,
                                                 "targetGender" => $targetGender,
                                                 "price" => $price,
                                                 "promotion" => $promotion,
                                                 "type" => "handbagProduct"
                                          );

                                          array_push($result, $obj);
                                   }
                            }
                     }
                     return $result;
              } else {
                     if (empty($result)) {
                            $obj = array(
                                   "productCode" => '',
                            );
                            array_push($result, $obj);
                     }
                     return $result;
              }
       }

       // trả về mảng sản phẩm dựa theo mảng chứa mã sản phẩm. Hỗ trợ cho các hàm lọc
       function getArrObjProduct_by_ArrCodeProduct($arrProductCode)
       {
              $arr_handbag = $this->transHandbagProductToJson();
              $arr_shirt = $this->transShirtProductToJson();
              $result = array();

              foreach ($arrProductCode as $codeItem) {
                     foreach ($arr_handbag as $itemHandbag) {
                            if ($itemHandbag['productCode'] == $codeItem) {
                                   $obj = array(
                                          "productCode" => $itemHandbag['productCode'],
                                          "imgProduct" => $itemHandbag['imgProduct'],
                                          "nameProduct" => $itemHandbag['nameProduct'],
                                          "supplierCode" => $itemHandbag['supplierCode'],
                                          "quantity" => $itemHandbag['quantity'],
                                          "describeProduct" => $itemHandbag['describeProduct'],
                                          "status" => $itemHandbag['status'],
                                          "color" => $itemHandbag['color'],
                                          "targetGender" => $itemHandbag['targetGender'],
                                          "price" => $itemHandbag['price'],
                                          "promotion" => $itemHandbag['promotion'],
                                          "bagMaterial" => $itemHandbag['bagMaterial'],
                                          "descriptionMaterial" => $itemHandbag['descriptionMaterial'],
                                          "type" => "handbagProduct"
                                   );

                                   array_push($result, $obj);
                            }
                     }
                     foreach ($arr_shirt as $itemShirt) {
                            if ($itemShirt['productCode'] == $codeItem) {
                                   $obj = array(
                                          "productCode" => $itemShirt['productCode'],
                                          "imgProduct" => $itemShirt['imgProduct'],
                                          "nameProduct" => $itemShirt['nameProduct'],
                                          "supplierCode" => $itemShirt['supplierCode'],
                                          "quantity" => $itemShirt['quantity'],
                                          "describeProduct" => $itemShirt['describeProduct'],
                                          "status" => $itemShirt['status'],
                                          "color" => $itemShirt['color'],
                                          "targetGender" => $itemShirt['targetGender'],
                                          "price" => $itemShirt['price'],
                                          "promotion" => $itemShirt['promotion'],
                                          "shirtMaterial" => $itemShirt['shirtMaterial'],
                                          "shirtStyle" => $itemShirt['shirtStyle'],
                                          "descriptionMaterial" => $itemShirt['descriptionMaterial'],
                                          "type" => "shirtProduct"
                                   );
                                   array_push($result, $obj);
                            }
                     }
              }
              return $result;
       }

       // Lấy danh sách giá trị của thuộc tích targetGender
       // Input:...
       // Output: Mảng obj chứa giá trị của thộc tính targetGender
       function getArrObj_targetGender()
       {
              $result = $this->FilterDAL->getArr_value_atributive_targetGender();
              return $result;
       }

       // Lấy danh sách giá trị của thuộc tích color
       // Input:...
       // Output: Mảng obj chứa giá trị của thộc tính color
       function getArrObj_color()
       {
              $result = $this->FilterDAL->getArr_value_atributive_color();
              return $result;
       }

       // Lấy danh sách giá trị priceMax của thuộc tích price
       // Input:...
       // Output: Mảng obj chứa giá trị của thộc tính price
       function getArrObj_price()
       {
              $result = $this->FilterDAL->getPriceMax();
              return $result;
       }

       // Lấy danh sách giá trị của thuộc tích bagMaterial
       // Input:...
       // Output: Mảng obj chứa giá trị của thộc tính bagMaterial
       function getArrObj_bagMaterial()
       {
              $result = $this->FilterDAL->getArr_value_atributive_bagMaterial();
              return $result;
       }

       // Lấy danh sách giá trị của thuộc tích shirtMaterial
       // Input:...
       // Output: Mảng obj chứa giá trị của thộc tính shirtMaterial
       function getArrObj_shirtMaterial()
       {
              $result = $this->FilterDAL->getArr_value_atributive_shirtMaterial();
              return $result;
       }

       // Lấy danh sách giá trị của thuộc tích shirtStyle
       // Input:...
       // Output: Mảng obj chứa giá trị của thộc tính shirtStyle
       function getArrObj_shirtStyle()
       {
              $result = $this->FilterDAL->getArr_value_atributive_shirtStyle();
              return $result;
       }





       // Sắp xếp sản phẩm được mua nhiều nhất từ cao đến thấp. Dùng trong trang HomePage.
       // Input: ...
       // Output: Mảng chứa các product được mô hình hóa thành mảng obj.
       function filter_product_best_selling()
       {
              $arrProductCode = $this->FilterDAL->filter_product_best_selling();
              $result = $this->getArrObjProduct_by_ArrCodeProduct($arrProductCode);
              return $result;
       }

       // Sắp xếp sản phẩm được giảm giá nhiều nhất từ cao đến thấp. Dùng trong trang HomePage.
       // Input: ...
       // Output: Mảng chứa các product được mô hình hóa thành mảng obj.
       function filter_product_best_promotion()
       {
              $arrProductCode = $this->FilterDAL->filter_product_best_promotion();
              $result = $this->getArrObjProduct_by_ArrCodeProduct($arrProductCode);
              return $result;
       }

       // Lọc sản phẩm theo các tiêu chí và phân trang để hiển thị sản phẩm. Dùng trong trang Shop.
       // Input: Chuỗi chứa danh mục lọc và giá trị lọc được kết với nhau, trang hiện tại page, giới hạn sản phẩm trong 1 trang limit
       // Output: Mảng chứa các product được mô hình hóa thành mảng obj
       function filter_product_by_atributive($string_filter, $page, $limit)
       {


              // $str = "targetGender=male+color=blue+bagMaterial=skin+shirtMaterial=Cotton+shirtStyle=Polo+sortPrice=ASC+price=0-30";

              // Tách chuỗi thành mảng các cặp key-value
              $pairs = explode('+', $string_filter);

              // Khởi tạo mảng kết quả
              $filter = array();

              foreach ($pairs as $pair) {
                     // Tách từng cặp key-value
                     list($key, $value) = explode('=', $pair);

                     // Kiểm tra nếu key là price
                     if ($key === 'price') {
                            // Tách value thành priceMin và priceMax
                            list($priceMin, $priceMax) = explode('-', $value);
                            // Thêm vào mảng kết quả
                            $filter['priceMin'] = $priceMin;
                            $filter['priceMax'] = $priceMax;
                     } else {
                            // Thêm vào mảng kết quả
                            $filter[$key] = $value;
                     }
              }


              // lấy mảng productCode
              $arrProductCode = $this->FilterDAL->getArrProductCode();


              // loc price
              if ($filter['priceMin'] != 'null') {
                     if (!empty($arrProductCode)) {
                            $arrTempFilter = $this->FilterDAL->filterProduct_by_price($filter['priceMin'], $filter['priceMax']);
                            $arrTempResult = array();
                            foreach ($arrTempFilter as $i) {
                                   foreach ($arrProductCode as $j) {
                                          if ($j == $i) {
                                                 array_push($arrTempResult, $j);
                                          }
                                   }
                            }
                            $arrProductCode = $arrTempResult;
                     }
              }
              // lọc targetGender
              if ($filter['targetGender'] != 'null') {
                     if (!empty($arrProductCode)) {
                            $arrTempFilter = $this->FilterDAL->filterProduct_by_targetGender($filter['targetGender']);
                            $arrTempResult = array();
                            foreach ($arrTempFilter as $i) {
                                   foreach ($arrProductCode as $j) {
                                          if ($j == $i) {
                                                 array_push($arrTempResult, $j);
                                          }
                                   }
                            }
                            $arrProductCode = $arrTempResult;
                     }
              }



              // loc color
              if ($filter['color'] != 'null') {
                     if (!empty($arrProductCode)) {
                            $arrTempFilter = $this->FilterDAL->filterProduct_by_color($filter['color']);
                            $arrTempResult = array();
                            foreach ($arrTempFilter as $i) {
                                   foreach ($arrProductCode as $j) {
                                          if ($j == $i) {
                                                 array_push($arrTempResult, $j);
                                          }
                                   }
                            }
                            $arrProductCode = $arrTempResult;
                     }
              }

              // loc bagMaterial
              if ($filter['bagMaterial'] != 'null') {
                     if (!empty($arrProductCode)) {
                            $arrTempFilter = $this->FilterDAL->filterProduct_by_bagMaterial($filter['bagMaterial']);
                            $arrTempResult = array();
                            foreach ($arrTempFilter as $i) {
                                   foreach ($arrProductCode as $j) {
                                          if ($j == $i) {
                                                 array_push($arrTempResult, $j);
                                          }
                                   }
                            }
                            $arrProductCode = $arrTempResult;
                     }
              }

              // loc shirtMaterial
              if ($filter['shirtMaterial'] != 'null') {
                     if (!empty($arrProductCode)) {
                            $arrTempFilter = $this->FilterDAL->filterProduct_by_shirtMaterial($filter['shirtMaterial']);
                            $arrTempResult = array();
                            foreach ($arrTempFilter as $i) {
                                   foreach ($arrProductCode as $j) {
                                          if ($j == $i) {
                                                 array_push($arrTempResult, $j);
                                          }
                                   }
                            }
                            $arrProductCode = $arrTempResult;
                     }
              }

              // săp xép lại theo giá
              if ($filter['sortPrice'] != 'null') {
                     if (!empty($arrProductCode)) {
                            if ($filter['sortPrice'] == 'ASC') {
                                   $arrTempFilter = $this->FilterDAL->sortProduct_by_price_low_to_high();
                                   $arrTempResult = array();
                                   foreach ($arrTempFilter as $i) {
                                          foreach ($arrProductCode as $j) {
                                                 if ($j == $i) {
                                                        array_push($arrTempResult, $j);
                                                 }
                                          }
                                   }
                                   $arrProductCode = $arrTempResult;
                            } else if ($filter['sortPrice'] == 'DESC') {
                                   $arrTempFilter = $this->FilterDAL->sortProduct_by_price_high_to_low();
                                   $arrTempResult = array();
                                   foreach ($arrTempFilter as $i) {
                                          foreach ($arrProductCode as $j) {
                                                 if ($j == $i) {
                                                        array_push($arrTempResult, $j);
                                                 }
                                          }
                                   }
                                   $arrProductCode = $arrTempResult;
                            }
                     }
              }

              if (!empty($arrProductCode)) {

                     // Input: Các tham số truyền vào: page
                     // Output: trả về danh sách sản phẩm dựa theo vị trí bắt đầu beginGet và vị trí kết thúc endGet

                     // cộng thức tổng quát
                     // BeginGet= limit* (page - 1); 
                     // endGet: limit * page-1;

                     // tính BeginGet và EndGet
                     $beginGet = $limit * ($page - 1);
                     $endGet = $limit * $page - 1;

                     // Dùng một mảng lưu sảm phẩm 
                     // đối tượng sẽ trả về $obj = {productCode,imgProduct,nameProduct,price,promotion,type}
                     // list item trả về để hiện lên
                     $pagination = array();
                     $lenghtData = array("lenghtData" => count($arrProductCode));
                     for ($i = $beginGet; $i <= $endGet; $i++) {
                            if (isset($arrProductCode[$i])) {
                                   array_push($pagination, $arrProductCode[$i]);
                            }
                     }

                     $result = $this->getArrObjProduct_by_ArrCodeProduct($pagination);
                     array_push($result, $lenghtData);
                     return $result;
              } else {
                     return array();
              }
       }

       // hàm thêm sản phẩm túi
       function addHandBagProduct($productCode, $imgProduct, $nameProduct, $supplierCode, $quantity, $describe, $status, $color, $targetGender, $price, $promotion, $bagMaterial, $descriptionMaterial)
       {

              $obj = new HandbagProductDTO($productCode, $imgProduct, $nameProduct, $supplierCode, $quantity, $describe, $status, $color, $targetGender, $price, $promotion, $bagMaterial, $descriptionMaterial);
              if ($this->HandbagProductDAL->addObj($obj) == true) {
                     return array(
                            "mess" => "success"
                     );
              }
              return array(
                     "mess" => "failed"
              );
       }

       // hàm thêm sản phẩm túi và số lượng size của mỗi loại
       function addShirtProduct($productCode, $imgProduct, $nameProduct, $supplierCode, $quantity, $describe, $status, $color, $targetGender, $price, $promotion, $shirtMaterial, $shirtStyle, $descriptionMaterial, $stringSizeShirt)
       {
              $obj = new ShirtProductDTO($productCode, $imgProduct, $nameProduct, $supplierCode, $quantity, $describe, $status, $color, $targetGender, $price, $promotion, $shirtMaterial, $shirtStyle, $descriptionMaterial);

              if ($this->ShirtProductDAL->addObj($obj) == true) {

                     $check_add_shirt_size = true;

                     // $stringSizeShirt = S001-P001-12_S002-P001-10
                     $parts = explode("_", $stringSizeShirt);         // parts = [ 'S001-P001-12', 'S002-P001-10' ]
                     // Lặp qua từng phần tử để tách mã size, mã sản phẩm và số lượng
                     foreach ($parts as $part) {

                            // Tách phần tử thành mã size, mã sản phẩm và số lượng
                            list($sizeCode, $productCode, $quantitySize) = explode("-", $part);

                            $shirtSizeDTO = new ShirtSizeDTO($sizeCode, $productCode, $quantitySize);
                            // Thêm vào mảng vao database
                            if ($this->ShirtSizeDAL->addObj($shirtSizeDTO) != true) {
                                   $check_add_shirt_size = false;
                            }
                     }
                     if ($check_add_shirt_size == true) {
                            return array(
                                   "mess" => "success"
                            );
                     }
                     return array(
                            "mess" => "failed"
                     );
              }
              return array(
                     "mess" => "failed"
              );
       }

       function updateHandbag($obj)
       {
              // $obj = new HandbagProductDTO($productCode, $imgProduct, $nameProduct, $supplierCode, $quantity, $describe, $status, $color, $targetGender, $price, $promotion, $bagMaterial, $descriptionMaterial);
              if ($obj != null) {
                     $result = $this->HandbagProductDAL->upadateObj($obj);
                     if ($result) {
                            return array(
                                   "mess" => "success"
                            );
                     } else {
                            return array(
                                   "mess" => "failed"
                            );
                     }
              }
              return array(
                     "mess" => "failed"
              );
       }

       function updateShirt($productCode, $imgProduct, $nameProduct, $supplierCode, $quantity, $describe, $status, $color, $targetGender, $price, $promotion, $shirtMaterial, $shirtStyle, $descriptionMaterial, $stringSizeShirt)
       {
              $obj = new ShirtProductDTO($productCode, $imgProduct, $nameProduct, $supplierCode, $quantity, $describe, $status, $color, $targetGender, $price, $promotion, $shirtMaterial, $shirtStyle, $descriptionMaterial);

              if ($this->ShirtProductDAL->upadateObj($obj) == true) {

                     $check_add_shirt_size = true;

                     // $stringSizeShirt = S001-P001-12_S002-P001-10

                     $parts = explode("_", $stringSizeShirt);         // parts = [ 'S001-P001-12', 'S002-P001-10' ]
                     // Lặp qua từng phần tử để tách mã size, mã sản phẩm và số lượng

                     foreach ($parts as $part) {

                            // Tách phần tử thành mã size, mã sản phẩm và số lượng
                            list($sizeCode, $productCode, $quantitySize) = explode("-", $part);

                            $shirtSizeDTO = new ShirtSizeDTO($sizeCode, $productCode, $quantitySize);
                            //Nếu số lượng = 0 thì xóa luôn
                            if ($shirtSizeDTO->getQuantity() == 0) {
                                   $this->ShirtSizeDAL->deleteSizeCode($productCode, $sizeCode);
                            }

                            // Nếu sizeCode chưa tồn tại thì thêm mới
                            if ($this->ShirtSizeDAL->checkSizeCodeExists($productCode, $sizeCode) == false && $quantitySize > 0) {
                                   $this->ShirtSizeDAL->addSizeCode($productCode, $sizeCode, $quantitySize);
                            }
                            // Cập nhật số lượng size sẵn có
                            if ($this->ShirtSizeDAL->upadateObj($shirtSizeDTO) != true) {
                                   $check_add_shirt_size = false;
                            }
                     }
                     if ($check_add_shirt_size == true) {
                            return array(
                                   "mess" => "success"
                            );
                     }
                     return array(
                            "mess" => "failed"
                     );
              }
              return array(
                     "mess" => "failed"
              );
       }

       function deleteProduct($productCode, $type)
       {
              if ($type == 'shirtProduct') {
                     if ($this->ShirtProductDAL->deleteByID($productCode)) {
                            return array(
                                   "mess" => "success"
                            );
                     } else {
                            return array(
                                   "mess" => "failed"
                            );
                     }
              } else if ($type == 'handbagProduct') {
                     if ($this->HandbagProductDAL->deleteByID($productCode)) {
                            return array(
                                   "mess" => "success"
                            );
                     } else {
                            return array(
                                   "mess" => "failed"
                            );
                     }
              }
       }
}

// check






// menu

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       $check = new ProductBLL();
       // lấy tên chức năng
       $function = $_POST['function'];

       switch ($function) {
              case 'transHandbagProductToJson':
                     $temp = $check->transHandbagProductToJson();
                     echo json_encode($temp);
                     break;
              case 'transShirtProductToJson':
                     $temp = $check->transShirtProductToJson();
                     echo json_encode($temp);
                     break;
              case 'getProductByCode_transToJson':
                     $productCode = $_POST['code'];
                     $type = $_POST['type'];
                     $temp = $check->getProductByCode_transToJson($productCode, $type);
                     echo json_encode($temp);
                     break;
              case 'Pagination_Search':
                     $page = $_POST['page'];
                     $limit = $_POST['limit'];
                     $keyword = $_POST['keyword'];
                     $typeNeed = $_POST['type'];
                     $temp = $check->Pagination_Search($page, $limit, $keyword, $typeNeed);
                     echo json_encode($temp);
                     break;
              case 'Pagination_Search_Hack':
                     $page = $_POST['page'];
                     $limit = $_POST['limit'];
                     $keyword = $_POST['keyword'];
                     $temp = $check->Pagination_Search_Hack($page, $limit, $keyword);
                     echo json_encode($temp);
                     break;
              case 'searchProduct':
                     $keyword = $_POST['keyword'];
                     $temp = $check->searchProduct($keyword);
                     echo json_encode($temp);
                     break;
              case 'getQuantityByProductCodeAndSizeCode':
                     $productCode = $_POST['code'];
                     $sizeCode = $_POST['sizeCode'];
                     $temp = $check->getQuantityByProductCodeAndSizeCode($productCode, $sizeCode);
                     echo json_encode($temp);
                     break;
              case 'getArrSizeCodeByProductCode':
                     $productCode = $_POST['code'];
                     $temp = $check->getArrSizeCodeByProductCode($productCode);
                     echo json_encode($temp);
                     break;
              case 'getArrObjProduct_by_ArrCodeProduct':
                     $productCode = $_POST['code'];
                     $arr = array();
                     array_push($arr, $productCode);
                     $temp = $check->getArrObjProduct_by_ArrCodeProduct($arr);
                     echo json_encode($temp);
                     break;
              case 'filter_product_best_selling':
                     $temp = $check->filter_product_best_selling();
                     echo json_encode($temp);
                     break;
              case 'filter_product_best_promotion':
                     $temp = $check->filter_product_best_promotion();
                     echo json_encode($temp);
                     break;
              case 'filter_product_by_atributive':
                     $filterString = $_POST['filter'];
                     $page = $_POST['page'];
                     $limit = $_POST['limit'];
                     $temp = $check->filter_product_by_atributive($filterString, $page, $limit);
                     echo json_encode($temp);
                     break;
              case 'getArrObj_targetGender':
                     $temp = $check->getArrObj_targetGender();
                     echo json_encode($temp);
                     break;
              case 'getArrObj_color':
                     $temp = $check->getArrObj_color();
                     echo json_encode($temp);
                     break;
              case 'getArrObj_bagMaterial':
                     $temp = $check->getArrObj_bagMaterial();
                     echo json_encode($temp);
                     break;
              case 'getArrObj_shirtMaterial':
                     $temp = $check->getArrObj_shirtMaterial();
                     echo json_encode($temp);
                     break;
              case 'getArrObj_shirtStyle':
                     $temp = $check->getArrObj_shirtStyle();
                     echo json_encode($temp);
                     break;
              case 'getArrObj_price':
                     $temp = $check->getArrObj_price();
                     echo json_encode($temp);
                     break;


                     // them san pham tu'i
              case 'addHandBagProduct':
                     $productCode = $_POST['productCode'];
                     // xử lý mảng ảnh
                     $arrImg = json_decode($_POST['arrImg']);
                     // tạo chuỗi ảnh
                     $imgProduct = '';
                     for ($i = 0; $i < count($arrImg); $i++) {
                            if ($i != count($arrImg) - 1) {
                                   $imgProduct = $imgProduct . $arrImg[$i] . ' ';
                            } else {
                                   $imgProduct = $imgProduct . $arrImg[$i];
                            }
                     }

                     $nameProduct = $_POST['nameProduct'];
                     $supplierCode = $_POST['supplierCode'];
                     $quantity = $_POST['quantity'];
                     $describe = $_POST['describe'];
                     $status = $_POST['status'];
                     $color = $_POST['color'];
                     $targetGender = $_POST['targetGender'];
                     $price = $_POST['price'];
                     $promotion = $_POST['promotion'];
                     $bagMaterial = $_POST['bagMaterial'];
                     $descriptionMaterial = $_POST['descriptionMaterial'];

                     $temp = $check->addHandBagProduct($productCode, $imgProduct, $nameProduct, $supplierCode, $quantity, $describe, $status, $color, $targetGender, $price, $promotion, $bagMaterial, $descriptionMaterial);

                     echo json_encode($temp);
                     break;

                     // san pham ao
              case 'addShirtProduct':
                     $productCode = $_POST['productCode'];

                     // xử lý mảng ảnh
                     $arrImg = json_decode($_POST['arrImg']);
                     // tạo chuỗi ảnh
                     $imgProduct = '';
                     for ($i = 0; $i < count($arrImg); $i++) {
                            if ($i != count($arrImg) - 1) {
                                   $imgProduct = $imgProduct . $arrImg[$i] . ' ';
                            } else {
                                   $imgProduct = $imgProduct . $arrImg[$i];
                            }
                     }

                     $nameProduct = $_POST['nameProduct'];
                     $supplierCode = $_POST['supplierCode'];
                     $quantity = $_POST['quantity'];
                     $describe = $_POST['describe'];
                     $status = $_POST['status'];
                     $color = $_POST['color'];
                     $targetGender = $_POST['targetGender'];
                     $price = $_POST['price'];
                     $promotion = $_POST['promotion'];

                     $shirtMaterial = $_POST['shirtMaterial'];
                     $shirtStyle = $_POST['shirtStyle'];
                     $descriptionMaterial = $_POST['descriptionMaterial'];

                     $shirtSizeString = $_POST['shirtSizeString'];
                     // $stringSizeShirt = S001-P001-12_S002-P001-10

                     $temp = $check->addShirtProduct($productCode, $imgProduct, $nameProduct, $supplierCode, $quantity, $describe, $status, $color, $targetGender, $price, $promotion, $shirtMaterial, $shirtStyle, $descriptionMaterial, $shirtSizeString);

                     echo json_encode($temp);
                     break;

              case 'updateHandbag':
                     $productCode = $_POST['productCode'];
                     // xử lý mảng ảnh
                     $arrImg = json_decode($_POST['arrImg']);
                     // tạo chuỗi ảnh
                     $imgProduct = '';
                     for ($i = 0; $i < count($arrImg); $i++) {
                            if ($i != count($arrImg) - 1) {
                                   $imgProduct = $imgProduct . $arrImg[$i] . ' ';
                            } else {
                                   $imgProduct = $imgProduct . $arrImg[$i];
                            }
                     }

                     $nameProduct = $_POST['nameProduct'];
                     $supplierCode = $_POST['supplierCode'];
                     $quantity = $_POST['quantity'];
                     $describe = $_POST['describe'];
                     $status = $_POST['status'];
                     $color = $_POST['color'];
                     $targetGender = $_POST['targetGender'];
                     $price = $_POST['price'];
                     $promotion = $_POST['promotion'];
                     $bagMaterial = $_POST['bagMaterial'];
                     $descriptionMaterial = $_POST['descriptionMaterial'];
                     $obj = new HandbagProductDTO($productCode, $imgProduct, $nameProduct, $supplierCode, $quantity, $describe, $status, $color, $targetGender, $price, $promotion, $bagMaterial, $descriptionMaterial);
                     $temp = $check->updateHandbag($obj);

                     echo json_encode($temp);
                     break;

              case 'updateShirt':
                     $productCode = $_POST['productCode'];

                     // xử lý mảng ảnh
                     $arrImg = json_decode($_POST['arrImg']);
                     // tạo chuỗi ảnh
                     $imgProduct = '';
                     for ($i = 0; $i < count($arrImg); $i++) {
                            if ($i != count($arrImg) - 1) {
                                   $imgProduct = $imgProduct . $arrImg[$i] . ' ';
                            } else {
                                   $imgProduct = $imgProduct . $arrImg[$i];
                            }
                     }

                     $nameProduct = $_POST['nameProduct'];
                     $supplierCode = $_POST['supplierCode'];
                     $quantity = $_POST['quantity'];
                     $describe = $_POST['describe'];
                     $status = $_POST['status'];
                     $color = $_POST['color'];
                     $targetGender = $_POST['targetGender'];
                     $price = $_POST['price'];
                     $promotion = $_POST['promotion'];

                     $shirtMaterial = $_POST['shirtMaterial'];
                     $shirtStyle = $_POST['shirtStyle'];
                     $descriptionMaterial = $_POST['descriptionMaterial'];

                     $shirtSizeString = $_POST['shirtSizeString'];
                     // $stringSizeShirt = S001-P001-12_S002-P001-10

                     $temp = $check->updateShirt($productCode, $imgProduct, $nameProduct, $supplierCode, $quantity, $describe, $status, $color, $targetGender, $price, $promotion, $shirtMaterial, $shirtStyle, $descriptionMaterial, $shirtSizeString);

                     echo json_encode($temp);
                     break;

              case 'deleteProduct':
                     $productCode = $_POST['code'];
                     $type = $_POST['type'];
                     $temp = $check->deleteProduct($productCode, $type);
                     echo json_encode($temp);
                     break;
       }
}