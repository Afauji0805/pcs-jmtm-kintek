<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Dashboard | PCS</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="<?php echo base_url();?>/assets/Landing-home/img/jm1.png" rel="icon">
    <link href="<?php echo base_url();?>/assets/Landing-home/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/fontawesome-free/css/all.min.css">
    <link href="<?php echo base_url();?>/assets/Landing-home/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>/assets/Landing-home/vendor/bootstrap-icons/bootstrap-icons.css"
        rel="stylesheet">
    <link href="<?php echo base_url();?>/assets/Landing-home/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?php echo base_url();?>/assets/Landing-home/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>/assets/Landing-home/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>/assets/template-custom/css//styles_cardboard.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?php echo base_url();?>/assets/Landing-home/css///main.css" rel="stylesheet">


    <style>
    .navmenu {
        transition: all 0.3s ease;
    }

    .navmenu ul li a {
        padding: 2px 6px;
        font-size: 13px;
    }

    .dropdown-menu {
        border-radius: 6px;
        padding: 6px 0;
    }

    /* 🔹 Separator Garis Vertikal */
    .vertical-separator {
        width: 1px;
        height: 30px;
        background-color: rgba(255, 255, 255, 0.4);
    }

    /* Mobile View */
    @media (max-width: 768px) {
        .navmenu {
            display: none;
            position: absolute;
            top: 60px;
            left: 0;
            width: 100%;
            background: #1e3c72;
            flex-direction: column;
            padding: 10px 0;
        }

        .navmenu.show-menu {
            display: flex;
        }

        .navmenu ul {
            flex-direction: column;
            gap: 5px;
            width: 100%;
            padding-left: 0;
        }

        .navmenu ul li {
            width: 100%;
        }

        .navmenu ul li a {
            padding: 8px 16px;
            display: block;
            color: white;
        }

        .dropdown-menu {
            display: none;
            position: static !important;
            background: rgba(255, 255, 255, 0.1);
            width: 100%;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            color: white !important;
        }

        .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.15);
        }

        /* Hilangkan garis di mobile */
        .vertical-separator {
            display: none;
        }
    }
    </style>

    <style>
    #footer {
        font-size: 13px;
        line-height: 1.2;
        z-index: 998;
    }

    #footer .container-fluid {
        max-width: 100%;
    }

    /* Responsif di mobile */
    @media (max-width: 768px) {
        #footer {
            height: auto;
            padding: 8px 0;
        }

        #footer .container-fluid {
            flex-direction: column;
            text-align: center;
            gap: 4px;
        }
    }
    </style>

</head>