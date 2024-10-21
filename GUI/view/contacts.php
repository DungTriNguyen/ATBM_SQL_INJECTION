<!DOCTYPE html>
<html lang="en">
<?php require('../../config.php') ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- thư viện dùng cho alert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../image/logo-sgu.png" type="image/x-icon">
    <style>
        <?php
        require('../css/Header.css');
        require('../css/Footer.css');
        require('../css/contacts.css');
        ?>
    </style>

</head>

<body>
    <!-- Header -->
    <?php require './header.php'; ?>

    <!-- Section -->
    <section class="body mx-auto">
        <!-- Đường dẫn -->
        <div class="path">
            <div class="container mb-5">
                <ul class="list path-container">
                    <li><a href="./HomePage.php">Home</a></li>
                    <li><a href="#">Contacts</a></li>
                </ul>
            </div>
        </div>

        <!-- Content Page -->
        <div class="content-page container-sm row mx-auto">
            <!-- Form liên lạc -->
            <div class="left-content container col-sm-6 mt-2">
                <h3 class="h4">CONTACTS</h2>
                    <h4 class="title-contact">Contacts us</h4>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="name">NAME</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">EMAIL</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                        <!-- <div class="form-group">
                        <label for="subject">SUBJECT</label>
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                    </div> -->
                        <div class="form-group">
                            <label for="message">YOUR MESSAGE</label>
                            <textarea class="form-control" id="message" name="message" rows="8" placeholder="Your Message" required></textarea>
                        </div>
                        <button onclick="sendFeedback(event)" type="submit" class="btn btn-success mt-2 text-white" style="float: right; opacity: 50%;">SEND</button>
                    </form>
            </div>

            <!-- Maps -->
            <div class="right-content col-sm-6 container-lg mt-5">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.668745432812!2d106.67967527488231!3d10.759992589387734!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f1c81c64183%3A0xd3109d7a7a8f753c!2zMjczIMSQLiBBbiBExrDGoW5nIFbGsMahbmcsIFBoxrDhu51uZyAzLCBRdeG6rW4gNSwgVGjDoG5oIHBo4buRIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1709626123876!5m2!1svi!2s" class="map" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require('./footer.php'); ?>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="../Js/Header.js?v=<?php echo $version ?>"></script>
    <script src="../Js/ContactUs.js?v=<?php echo $version ?>"></script>
    <!-- thư viện dùng cho alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>
</body>

</html>