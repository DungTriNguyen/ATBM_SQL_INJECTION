<?php

// import
// require('../DAL/AbstractionDAL.php');
// require('../DTO/ProductDTO.php');

class ProductDAL extends AbstractionDAL
{

    private $actionSQL = null;
    public function __construct()
    {
        parent::__construct();
        $this->actionSQL = parent::getConn();
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

    //update đối tượng
    function upadateObj($obj) {}

    //Dữ liệu tìm kiếm
    function searchProduct($searchTerm)
    {
        // Khởi tạo mảng để lưu danh sách sản phẩm tìm được
        $product_list = array();

        // Truy vấn tìm kiếm không an toàn (SQL injection có thể xảy ra)
        $query = "SELECT * FROM product WHERE productCode LIKE '%$searchTerm%' OR nameProduct LIKE '%$searchTerm%'";

        // Thực hiện truy vấn
        $result = $this->actionSQL->query($query);

        // Kiểm tra nếu có kết quả
        if ($result->num_rows > 0) {
            // Lặp qua từng hàng kết quả
            while ($data = $result->fetch_assoc()) {
                $productCode = $data["productCode"];
                $imgProduct = $data["imgProduct"];
                $nameProduct = $data["nameProduct"];
                $supplierCode = $data["supplierCode"];
                $quantity = $data["quantity"];
                $describeProduct = $data["describeProduct"];
                $status = $data["status"];
                $color = $data["color"];
                $targetGender = $data["targetGender"];
                $price = $data["price"];
                $promotion = $data["promotion"];

                // Tạo đối tượng ProductDTO từ dữ liệu và thêm vào mảng
                $product = new ProductDTO($productCode, $imgProduct, $nameProduct, $supplierCode, $quantity, $describeProduct, $status, $color, $targetGender, $price, $promotion);
                array_push($product_list, $product);
            }
        }
        // Trả về danh sách sản phẩm
        return $product_list;
    }
}


// Thử nghiệm hàm searchProduct
// try {
//     // Tạo một đối tượng ProductDAL
//     $productDAL = new ProductDAL();

//     // Dữ liệu đầu vào để kiểm tra
//     $searchTerm = "P001";

//     // Gọi hàm searchProduct và lấy kết quả
//     $result = $productDAL->searchProduct($searchTerm);

//     // Kiểm tra và in ra kết quả
//     if (!empty($result)) {
//         echo "Tìm kiếm thành công. Danh sách sản phẩm: \n";
//         foreach ($result as $product) {
//             // Giả sử class ProductDTO có phương thức toString để in đối tượng
//             echo "Mã sản phẩm: " . $product->getProductCode() . " - Tên sản phẩm: " . $product->getNameProduct() . "\n";
//         }
//     } else {
//         echo "Không tìm thấy sản phẩm nào.";
//     }
// } catch (Exception $e) {
//     echo "Đã xảy ra lỗi: " . $e->getMessage();
// }