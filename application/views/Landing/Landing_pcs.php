<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>PCS-JMTM</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="<?php echo base_url(); ?>/assets/Landing-home/img/jm1.png" rel="icon">
    <link href="<?php echo base_url(); ?>/assets/Landing-home/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/fontawesome-free/css/all.min.css">
    <link href="<?php echo base_url(); ?>/assets/Landing-home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/assets/Landing-home/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/assets/Landing-home/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/assets/Landing-home/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/assets/Landing-home/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?php echo base_url(); ?>/assets/Landing-home/css/main.css" rel="stylesheet">

    <style>
        #hero {
            background-image: url('<?php echo base_url(); ?>/assets/Landing-home/img/gedungjmtm1.png');
            /* Ganti path-nya */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 75vh;
            /* Contoh: Setinggi layar */
        }
    </style>

</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top" style="background: #373B44;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #4286f4, #373B44);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #4286f4, #373B44); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">

        <div class="container-fluid container-xl position-relative d-flex align-items-center">
            <div class="container-fluid container-xl position-relative d-flex align-items-center">
                <img src="<?php echo base_url(); ?>/assets/brand/jm1.png" width="20" height="20">&nbsp;&nbsp;
                <span class="text-white"><strong>Project Control System - PT JMTM</strong></span>
            </div>
        </div>
        <a class="btn-getstarted" href="<?= base_url() ?>Login_system/Login_user" target="_blank" style="background: #ffe259;  /* fallback for old browsers */
                background: -webkit-linear-gradient(to right, #ffa751, #ffe259);  /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to right, #ffa751, #ffe259); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
            <i class="fas fa-user-lock fa-lg text-dark"></i>
            &nbsp;<strong class="text-dark">Get Started</strong>
        </a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">
            <div class="container">
                <!-- <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h1 class="text-white">Grow your business with Vesperr</h1>
                        <p>We are team of talented designers making websites with Bootstrap</p>
                    </div>
                </div> -->
            </div>
        </section>
        <!-- /Hero Section -->

        <!-- Services Section -->
        <section id="services" class="services section">

            <!-- Section Title -->
            <div class="container section-title">
                <h2>Services</h2>
                <p>Fitur-fitur Yang Terdapat Pada Sistem Aplikasi Project Control System (PCS)</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-xl-3 col-md-6 d-flex">
                        <div class="service-item position-relative">
                            <i class="bi bi-activity"></i>
                            <h4><a href="" class="stretched-link">Dashboard</a></h4>
                            <p>Fitur Untuk Informasi Grafis & Grafik Data-data Keseluruhan Sistem PCS </p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-3 col-md-6 d-flex">
                        <div class="service-item position-relative">
                            <i class="bi bi-bounding-box-circles"></i>
                            <h4><a href="" class="stretched-link">Rencana Anggaran Pelaksanaan Proyek (RAPP)</a></h4>
                            <p>Fitur Untuk Penginputan Data-data RAPP, DKH dan Penunjang Data RAPP Lainnya</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-3 col-md-6 d-flex">
                        <div class="service-item position-relative">
                            <i class="bi bi-calendar4-week"></i>
                            <h4><a href="" class="stretched-link">Master Data / Database</a></h4>
                            <p>Fitur Untuk Inputan Data-data Utama yang berhubungan / saling berkaitan dengan data RAPP
                            </p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-3 col-md-6 d-flex">
                        <div class="service-item position-relative">
                            <i class="bi bi-broadcast"></i>
                            <h4><a href="" class="stretched-link">Log System Aplikasi</a></h4>
                            <p>Fitur Untuk Konfigurasi User Account Pada Sistem PCS </p>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>

        </section><!-- /Services Section -->


    </main>

    <footer id="footer" class="footer" style="background: #ffe259;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #ffa751, #ffe259);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #ffa751, #ffe259); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    ">

        <div class="container">
            <div class="copyright text-center ">
                <p>© <span>Copyright</span> <strong class="px-1 sitename text-primary">AMPE & HE JMTM 2025</strong>
                    <span>All
                        Rights
                        Reserved</span>
                </p>
            </div>
            <!-- <div class="credits">
                Designed by: <span class="text-primary">BootstrapMade - Kintekindo</span>
            </div> -->
        </div>

    </footer>

    <!-- Preloader -->
    <!-- <div id="preloader"></div> -->

    <!-- Vendor JS Files -->
    <script src="<?php echo base_url(); ?>/assets/Landing-home/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/Landing-home/vendor/php-email-form/validate.js"></script>
    <script src="<?php echo base_url(); ?>/assets/Landing-home/vendor/aos/aos.js"></script>
    <script src="<?php echo base_url(); ?>/assets/Landing-home/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/Landing-home/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="<?php echo base_url(); ?>/assets/Landing-home/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/Landing-home/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/Landing-home/vendor/isotope-layout/isotope.pkgd.min.js"></script>

    <!-- Main JS File -->
    <script src="<?php echo base_url(); ?>/assets/Landing-home/js/main.js"></script>


</body>

</html>