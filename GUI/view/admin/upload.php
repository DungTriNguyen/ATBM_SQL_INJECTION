<?php
// Kiểm tra xem có file nào được gửi lên không
if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $tempFile = $_FILES['file']['tmp_name'];
    $fileName = isset($_GET['newFileName']) ? $_GET['newFileName'] : $_FILES['file']['name']; // Lấy tên mới của file từ tham số truy vấn
    $productFolder = $_GET['productFolder']; // Lấy tên thư mục sản phẩm từ tham số truy vấn

    // Tạo thư mục mới cho album ảnh sản phẩm nếu chưa tồn tại
    $uploadDir = '../../image/product/' . $productFolder . '/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Di chuyển file từ thư mục tạm sang thư mục lưu trữ
    if (move_uploaded_file($tempFile, $uploadDir . $fileName)) {
        echo 'File uploaded and renamed successfully.';
        echo 'File path: ' . $uploadDir . $fileName; // In ra đường dẫn của file ảnh
    } else {
        echo 'Failed to move file.';
    }
} else {
    echo 'Error uploading file.';
}

