<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Contact Us - Mia5ko</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet"/>
    <link href="css/responsive.css" rel="stylesheet"/>
    <style>
        .navbar {
            background: #1e1371;
            padding: 20px;
        }
        .contact-container {
            padding: 50px 0;
        }
        .contact-info {
            font-size: 18px;
            line-height: 1.8;
        }
        .contact-info i {
            color: #1e1371;
            margin-right: 10px;
        }
        .map-container {
            height: 400px;
            border-radius: 10px;
            overflow: hidden;
        }
    </style>
</head>
<body>
<?php include './modules/header.php' ?>

<div class="container contact-container">
    <div class="row">

        <div class="col-md-6">
            <h2>Contact Us</h2>
            <p>Get in touch with us for any inquiries or support.</p>
            <div class="contact-info">
                <p><i class="fa fa-map-marker"></i> Boska Buhe 32, Kaludjerica, Beograd, Srbija</p>
                <p><i class="fa fa-phone"></i> +381 64 123 4567</p>
                <p><i class="fa fa-envelope"></i> mpetkovic9322it@raf.rs</p>
                <p><i class="fa fa-clock-o"></i> Mon - Fri: 9:00 AM - 12:00 PM</p>
            </div>
        </div>


        <div class="col-md-6">
            <h2>Find Us</h2>
            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29278.47002744369!2d20.55939765!3d44.7522498!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7705f3741165%3A0x5c64d63984be627e!2sKalu%C4%91erica!5e1!3m2!1sen!2srs!4v1743362989265!5m2!1sen!2srs"
                    width="100%" height="100%" style="border:0;" allowfullscreen loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</div>

<?php include './modules/footer.php' ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
