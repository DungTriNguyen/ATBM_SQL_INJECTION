<!DOCTYPE html>
<html lang="en">

<head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <title>Sửa sản phẩm</title>
       <link rel="stylesheet" href="../../css/reset.css">
       <link rel="stylesheet" href="../../css/admin/addproduct.css">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
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
              <!-- Sidebar -->
              <div class="side-bar">
                     <?php require('./sidebar.php'); ?>
              </div>

              <!-- Content -->
              <div class="content">
                     <!-- Header -->
                     <div class="header">
                            <?php require('./header_admin.php'); ?>
                     </div>

                     <!-- Page Content -->
                     <div class="content-page">
                            <!-- Your page content goes here -->
                            <h2 class="text-center fw-bold">Sửa sản phẩm</h2>
                            <div id="editContainer" class="container-fluid">
                                   <!-- Container túi xách -->
                            </div>
                            <div id="editContainer1" class="container-fluid">
                                   <!-- Container quần áo -->
                            </div>
                     </div>

                     <!-- Footer -->
                     <div class="footer">
                            <?php require('./footer_admin.php'); ?>
                     </div>
              </div>
       </div>
       <script src="../../Js/admin/sidebar.js?v=<?php echo time(); ?>"></script>
       <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
       <script src="../../Js/admin/editProduct.js?v=<?php echo time(); ?>"></script>
</body>

</html>