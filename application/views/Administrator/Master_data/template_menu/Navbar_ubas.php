<body class="index-page">

    <header id="header" class="header d-flex align-items-center sticky-top shadow-sm"
        style="background: linear-gradient(to right, #2a5298, #1e3c72); height: 60px; z-index: 999;">
        <div class="container-fluid d-flex align-items-center justify-content-between px-2 px-md-4">

            <!-- Logo -->
            <a class="logo d-flex align-items-center text-decoration-none flex-shrink-0">
                <img src="<?php echo base_url(); ?>/assets/brand/jm1.png" width="26" height="26" class="me-2">
                <span class="text-white fw-semibold fs-6 d-none d-sm-inline">
                    Project Control System - PT JMTM
                </span>
            </a>

            <!-- Spacer agar menu agak ke kanan -->
            <div class="flex-grow-1"></div>

            <!-- 🔹 Tombol Toggle untuk Mobile -->
            <button class="navbar-toggler d-md-none border-0 bg-transparent text-white fs-4 me-2" type="button"
                id="navToggleBtn">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Navbar Menu -->
            <nav id="navmenu" class="navmenu me-3 me-md-4">
                <ul
                    class="list-unstyled d-flex flex-column flex-md-row align-items-start align-items-md-center mb-0 gap-1 gap-md-3">

                    <!-- Dashboard -->
                    <li>
                        <a href="<?php echo base_url(); ?>Administrator/Dashboard/Admin_dashboard"
                            class="text-white text-decoration-none small">
                            <i class="fa-solid fa-gauge-high me-1"></i>Dashboard
                        </a>
                    </li>

                    <!-- Master Database -->
                    <li class="dropdown position-relative">
                        <a href="#"
                            class="text-white text-decoration-none small d-flex align-items-center dropdown-toggle"
                            data-bs-toggle="dropdown">
                            <i class="fa-solid fa-database me-1"></i>Master Database
                        </a>
                        <ul class="dropdown-menu small shadow border-0">
                            <li class="dropdown dropend">
                                <a href="#" class="dropdown-item d-flex align-items-center justify-content-between">
                                    <span><i class="fa-solid fa-person-digging me-2"></i>Master Data UBAS</span>
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                                <ul class="dropdown-menu small shadow border-0">
                                    <li>
                                        <a class="dropdown-item"
                                            href="<?php echo base_url(); ?>Administrator/Master_data/Master_upah/Master_data_upah">
                                            Master Data Upah <i class="fa-solid fa-money-bill-wave me-2"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="<?php echo base_url(); ?>Administrator/Master_data/Master_bahan/Master_data_bahan">
                                            Master Data Bahan <i class="fa-solid fa-mound me-2"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="<?php echo base_url(); ?>Administrator/Master_data/Master_alat/Master_data_alat">
                                            Master Data Alat <i class="fa-solid fa-screwdriver-wrench me-2"></i>
                                        </a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="<?php echo base_url(); ?>Administrator/Master_data/Master_subkon/Master_data_subkon">
                                            Master Data SubKon <i class="fa-solid fa-shop me-2"></i>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="<?php echo base_url(); ?>Administrator/Master_data/Master_supplier/Master_data_supplier">
                                    <i class="fa-solid fa-building-user me-2"></i>Master Data Supplier
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Dokumen RAPP -->
                    <li class="dropdown position-relative">
                        <a href="#"
                            class="text-white text-decoration-none small d-flex align-items-center dropdown-toggle"
                            data-bs-toggle="dropdown">
                            <i class="fa-solid fa-folder-open me-1"></i>Dokumen RAPP
                        </a>
                        <ul class="dropdown-menu small shadow border-0">
                            <li>
                                <a class="dropdown-item"
                                    href="<?php echo base_url(); ?>Administrator/RKAPP/Data_program/Data_program">
                                    Data Program Kegiatan <i class="fa-solid fa-book me-2"></i>
                                </a>
                            </li>
                            <li class="dropdown dropend">
                                <a href="#" class="dropdown-item d-flex align-items-center justify-content-between">
                                    <span>Data DKH Kontrak</span>
                                    <i class="bi bi-chevron-right"></i>
                                </a>
                                <ul class="dropdown-menu small shadow border-0">
                                    <li><a class="dropdown-item" href="#"><i
                                                class="fa-solid fa-file-invoice me-2"></i>Data DKH Rencana</a></li>
                                    <li><a class="dropdown-item" href="#"><i
                                                class="fa-solid fa-file-contract me-2"></i>Data DKH Realisasi</a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item" href="#">Cetak RAPP <i class="fas fa-print me-2"></i></a></li>
                        </ul>
                    </li>
                </ul>
            </nav>

            <!-- 🔹 Garis Separator -->
            <div class="vertical-separator mx-2 d-none d-md-block"></div>

            <!-- User Menu -->
            <div class="dropdown flex-shrink-0">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url(); ?>/assets/brand/avatar5.png" alt="mdo" width="28" height="28"
                        class="rounded-circle shadow-sm me-1">
                    <small>Administrator</small>
                </a>
                <ul class="dropdown-menu dropdown-menu-end small shadow border-0">
                    <li><a class="dropdown-item"><small><i class="fa-solid fa-user px-2"></i>Admin User</small></a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#"><small><i class="fa-solid fa-key px-2"></i>Ubah
                                Password</small></a></li>
                    <li><a class="dropdown-item" href="#"><small><i
                                    class="fa-solid fa-right-from-bracket px-2"></i>Log-Out System</small></a></li>
                </ul>
            </div>
        </div>
    </header>