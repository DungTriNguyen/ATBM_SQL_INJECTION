<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm hình thức vận chuyển</title>

    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" /> -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        <?php
        require('../../css/admin/sidebar.css');
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
                    <h2 style="text-align:center;">Thêm hình thức vận chuyển</h2>
                    <div class="container-fluid">
                        <form id="addForm">
                            <div class="mb-3">
                                <label for="codeTransport" class="form-label">Mã hình thức vận chuyển</label>
                                <input type="text" class="form-control" id="codeTransport" name="codeTransport" value="" required>
                            </div>
                            <div class="mb-3">
                                <label for="nameTransport" class="form-label">Tên hình thức vận chuyển</label>
                                <input type="text" class="form-control" id="nameTransport" name="nameTransport" value="" required>
                            </div>
                            <div class="mb-3">
                                <label for="affiliatedCompany" class="form-label">Công ty liên kết</label>
                                <input type="text" class="form-control" id="affiliatedCompany" name="affiliatedCompany" value="" required>
                            </div>
                            <div class="group-btn d-flex" style="justify-content: space-between;">
                                <div class="button-back">
                                    <button class="btn btn-secondary"><a href="./list-transport.php" style="text-decoration:none;" class="text-white">Quay lại</a></button>
                                </div>
                                <div class="button-add" style=" margin-bottom: 2rem;">
                                    <button type="submit" class="btn btn-primary" onclick="addTransports(event)">Thêm hình thức vận chuyển</button>
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="footer">
            <?php require('./footer_admin.php'); ?>
            </div>
        </div>
    </div>
    <script src="../../Js/admin/sidebar.js"></script>
    <script src="../../Js/admin/addtransport.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>