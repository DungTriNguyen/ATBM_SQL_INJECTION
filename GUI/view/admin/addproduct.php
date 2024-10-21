<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới sản phẩm</title>

    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/admin/addproduct.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        <?php require('../../css/admin/sidebar.css');
        require('../../css/admin/header_admin.css');
        require('../../css/admin/footer_admin.css');
        ?>
    </style>
</head>

<body>
    <div class="container-sb">
        <div class="side-bar"><?php require('./sidebar.php'); ?></div>
        <div class="content">
            <div class="header">
                <?php require('./header_admin.php'); ?>
            </div>
            <div class="content-page-sb ">
                <div>
                    <h2 style="text-align:center;">Thêm sản phẩm</h2>
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="category" class="form-label fw-bold">Loại sản phẩm:</label>
                            <select id="category" class="form-control">
                                <option value="none" selected>Chọn loại sản phẩm</option>
                                <option value="quan-ao">Quần áo</option>
                                <option value="tui-xach">Túi xách</option>
                            </select>
                        </div>

                        <!-- Form thêm quần áo -->
                        <div id="form-quan-ao" class="d-none mt-2">
                            <form id="addFormShirt">
                                <div class="mb-3" id="fieldCode">
                                    <label for="productCode" class="form-label fw-bold">Mã sản phẩm</label>
                                    <input type="text" class="form-control" id="productCode" name="productCode">
                                    <p class="text-danger" id="codeMessageC"></p>
                                </div>

                                <div class="mb-3">
                                    <label for="nameProduct" class="form-label fw-bold">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="nameProduct" name="nameProduct">
                                </div>
                                <div class="mb-3">
                                    <label for="inputFileC" class="form-label fw-bold">Ảnh(PNG,JPG)</label>
                                    <input type="file" class="form-control" id="inputFileC" name="imgProduct"
                                        accept="image/jpeg, image/png" multiple>
                                    <div id="imagePreviewC" style="padding-top:2px;"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label fw-bold">Giá</label>
                                    <input type="number" class="form-control" id="price" name="price">
                                </div>
                                <div class="mb-3" id="listSupplier">
                                    <label for="supplierCode" class="form-label fw-bold">Nhà cung cấp</label>
                                    <select class="form-select" id="supplierCode" name="supplierCode">
                                        <option value="">Chọn nhà cung cấp</option>
                                        <option value="NCC001">NCC001</option>
                                        <option value="NCC002">NCC002</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="describeProduct" class="form-label fw-bold">Mô tả</label>
                                    <textarea class="form-control" id="describeProduct" name="describe"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="targetGender" class="form-label fw-bold">Đối tượng sử dụng</label>
                                    <select class="form-select" id="targetGender" name="targetGender">
                                        <option value="">Chọn đối tượng</option>
                                        <option value="Male">Nam</option>
                                        <option value="Female">Nữ</option>
                                        <option value="Both">Tất cả</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label fw-bold">Trạng thái</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="">Chọn trạng thái</option>
                                        <option value="1">Mở bán</option>
                                        <option value="0">Chưa bán</option>
                                    </select>
                                </div>

                                <!-- Size áo -->
                                <div class="mb-3">
                                    <h4>Chọn size</h4>
                                    <div class="row">
                                        <div class="col-md-6" id="listSize">
                                            <!-- <div class="form-check">
                                                <div class="form-vis">
                                                    <input type="checkbox" id="sizeS" class="form-check-input" data-target="#inputSizeS">
                                                    <label for="sizeS" class="form-check-label">S</label>
                                                </div>
                                                <input type="number" id="inputSizeS" class="form-control d-none" value="" placeholder="Nhập số lượng">
                                            </div>
                                            <div class="form-check">
                                                <div class="form-vis">
                                                    <input type="checkbox" id="sizeM" class="form-check-input" data-target="#inputSizeM">
                                                    <label for="sizeM" class="form-check-label">M</label>
                                                </div>
                                                
                                                <input type="number" id="inputSizeM" class="form-control d-none" value="" placeholder="Nhập số lượng">
                                            </div>
                                            <div class="form-check">
                                                <div class="form-vis">
                                                    <input type="checkbox" id="sizeL" class="form-check-input" data-target="#inputSizeL">
                                                    <label for="sizeL" class="form-check-label">L</label>
                                                </div>
                                                <input type="number" id="inputSizeL" class="form-control d-none" value="" placeholder="Nhập số lượng">
                                            </div>
                                            <div class="form-check">
                                                <div class="form-vis">
                                                    <input type="checkbox" id="sizeXL" class="form-check-input" data-target="#inputSizeXL">
                                                    <label for="sizeXL" class="form-check-label">XL</label>
                                                </div>
                                                <input type="number" id="inputSizeXL" class="form-control d-none" value="" placeholder="Nhập số lượng">
                                            </div> -->
                                        </div>
                                    </div>
                                </div>

                                <!-- Phong cách -->
                                <div class="mb-3">
                                    <label for="shirtStyle" class="form-label fw-bold">Phong cách</label>
                                    <input type="text" id="shirtStyle" class="form-control">
                                </div>
                                <!-- Chất liệu-->
                                <div class="mb-3">
                                    <label for="shirtMaterial" class="form-label fw-bold">Chất liệu</label>
                                    <input type="text" id="shirtMaterial" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="color" class="form-label fw-bold">Màu sắc</label>
                                    <input type="text" id="color" class="form-control">
                                </div>
                                <!-- Mô tả -->
                                <div class="mb-3">
                                    <label for="descriptionMaterial" class="form-label fw-bold">Mô tả chất liệu</label>
                                    <input type="text" id="descriptionMaterial" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="promotion" class="form-label fw-bold">Giảm giá</label>
                                    <input type="number" id="promotion" class="form-control">
                                </div>

                                <div class="group-btn d-flex justify-content-between"
                                    style="text-align:right; margin-bottom: 2rem;">
                                    <button class="btn btn-secondary"><a href="./list-products.php"
                                            class="text-decoration-none text-white">Quay lại</a></button>
                                    <button type="submit" class="btn btn-primary"
                                        onclick="addProduct(event)">Thêm</button>
                                </div>
                            </form>
                        </div>

                        <!-- Form túi xách -->
                        <div id="form-tui-xach" class="d-none mt-2">
                            <form id="addFormBag">
                                <div class="mb-3">
                                    <label for="productCode" class="form-label fw-bold">Mã sản phẩm</label>
                                    <input type="text" class="form-control" id="productCode" name="productCode">
                                    <p id="codeMessageB" class="text-danger"></p>
                                </div>

                                <div class="mb-3">
                                    <label for="nameProduct" class="form-label fw-bold">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="nameProduct" name="nameProduct">
                                </div>
                                <div class="mb-3">
                                    <label for="inputFileB" class="form-label fw-bold">Ảnh(PNG,JPG)</label>
                                    <input type="file" class="form-control" id="inputFileB" name="imgProduct"
                                        accept="image/jpeg, image/png" multiple>
                                    <div id="imagePreviewB" style="padding-top:2px;"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label fw-bold">Giá</label>
                                    <input type="number" class="form-control" id="price" name="price">
                                </div>

                                <div class="mb-3" id="listSupplier">
                                    <label for="supplierCode" class="form-label fw-bold">Nhà cung cấp</label>
                                    <select class="form-select" id="supplierCode" name="supplierCode">
                                        <!-- <option value="">Chọn nhà cung cấp</option>
                                        <option value="NCC001">NCC001</option>
                                        <option value="NCC002">NCC002</option> -->
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="describeProduct" class="form-label fw-bold">Mô tả</label>
                                    <textarea class="form-control" id="describeProduct"
                                        name="describeProduct"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="color" class="form-label fw-bold">Màu sắc</label>
                                    <textarea class="form-control" id="color" name="color"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="targetGender" class="form-label fw-bold">Đối tượng sử dụng</label>
                                    <select class="form-select" id="targetGender" name="targetGender">
                                        <option value="" selected>Chọn đối tượng</option>
                                        <option value="Male">Nam</option>
                                        <option value="Female">Nữ</option>
                                        <option value="Both">Tất cả</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="quantity" class="form-label fw-bold">Số lượng</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity">
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label fw-bold">Trạng thái</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="">Chọn trạng thái</option>
                                        <option value="1">Mở bán</option>
                                        <option value="0">Chưa bán</option>
                                    </select>
                                </div>
                                <!-- Chất liệu-->
                                <div class="mb-3">
                                    <label for="shirtMaterial" class="form-label fw-bold">Chất liệu</label>
                                    <input type="text" id="bagMaterial" class="form-control">
                                </div>



                                <div class="mb-3">
                                    <label for="shirtMaterial" class="form-label fw-bold">Mô tả chất liệu</label>
                                    <input type="text" id="descriptionMaterial" class="form-control">
                                </div>

                                <!-- Giảm giá -->
                                <div class="mb-3">
                                    <label for="descriptionMaterial" class="form-label fw-bold">Giảm giá</label>
                                    <input type="number" id="promotion" class="form-control">
                                </div>

                                <div class="group-btn d-flex justify-content-between"
                                    style="text-align:right; margin-bottom: 2rem;">
                                    <button class="btn btn-secondary"><a href="./list-products.php"
                                            class="text-decoration-none text-white">Quay lại</a></button>
                                    <button type="submit" class="btn btn-primary"
                                        onclick="addProduct(event)">Thêm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer">
                <?php require('./footer_admin.php'); ?>
            </div>
        </div>
    </div>
    <script src="../../Js/admin/sidebar.js?v=<?php echo time(); ?>"></script>
    <script>

    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../Js/admin/addproduct.js?v=<?php echo time(); ?>"></script>

</body>

</html>