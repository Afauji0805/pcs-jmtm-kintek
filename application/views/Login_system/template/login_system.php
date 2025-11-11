<main class="container">

    <!-- Login Form Section -->

    <div class="d-flex align-items-center p-3 my-2 text-dark rounded shadow-lg" style="background: #ADA996;  /* fallback for old browsers */
                background: -webkit-linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996);  /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */       
            ">
        <i class="fa-solid fa-lock fa-beat fa-2xl"></i>&nbsp;&nbsp;&nbsp;
        <div class="lh-1">
            <h1 class="h6 mb-0 text-dark lh-1"><b>Form Log-In User Account</b></h1>
            <small>Elektronik Project Control System (E-PCS)</small>
        </div>
    </div>
    <div class="my-2 p-3 bg-body rounded shadow-lg">
        <div class="card border-dark shadow-lg">
            <div class="card-header border-dark d-flex justify-content-between align-items-center"
                style="background: #373B44;  /* fallback for old browsers */
                background: -webkit-linear-gradient(to right, #4286f4, #373B44);  /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to right, #4286f4, #373B44); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                <div class="flex-grow-1 bd-highlight">
                    <span class="text-white">
                        <i class="fa-solid fa-align-justify fa-lg px-1"></i>
                        <small><strong>Form Login</strong></small>
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6 col-sm-6">
                        <div class="text-center">
                            <img src="<?php echo base_url();?>/assets/brand/hero-img2.png" alt="" width="400"
                                height="300"><br>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="my-2 p-3 bg-body rounded shadow-lg">
                            <!-- Sub Judul Halaman -->
                            <h6 class="border-bottom border-dark pb-2 mb-0">
                                <i class="fa-solid fa-users-gear fa-2xl px-1"></i>
                                Login User Project Control System
                            </h6><!-- End Sub Judul Halaman -->
                            <div class="pt-2">
                                <form class="requires-validation" novalidate>
                                    <div class="row mb-1">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <span class="input-group-text border-dark">
                                                    <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                </span>
                                                <div class="form-floating">
                                                    <input type="text" class="form-control border-dark form-control-sm"
                                                        id="user_id" placeholder="Email / NPWP" value="">
                                                    <label>
                                                        <i class="fa-solid fa-user-lock fa-sm"></i>&nbsp;
                                                        <small>Username</small>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <span class="input-group-text border-dark">
                                                    <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                </span>
                                                <div class="form-floating">
                                                    <input type="Password"
                                                        class="form-control border-dark form-control-sm" id="pass_id"
                                                        placeholder="Password" value="">
                                                    <label>
                                                        <i class="fa-solid fa-key fa-sm"></i>&nbsp;
                                                        <small>Password</small>
                                                    </label>
                                                </div>
                                                <button class="btn btn-sm btn-outline-secondary" type="button"
                                                    id="button-addon2">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-2 mb-1">
                                        <div class="col-md-5">
                                            <div class="input-group">
                                                <span class="input-group-text border-dark">
                                                    <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                </span>
                                                <div class="form-floating">
                                                    <input type="text" class="form-control border-dark form-control-sm"
                                                        id="recap_id" value="667989" disabled>
                                                    <label>
                                                        <i class="fa-solid fa-laptop-code fa-sm"></i>&nbsp;
                                                        <small>ReCaptCha</small>
                                                    </label>
                                                </div>
                                                <button class="btn btn-sm btn-outline-secondary" type="button"
                                                    id="button-addon2">
                                                    <i class="fa-solid fa-arrows-rotate"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="input-group">
                                                <span class="input-group-text border-dark">
                                                    <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                </span>
                                                <div class="form-floating">
                                                    <input type="text" class="form-control border-dark form-control-sm"
                                                        id="textrecap_id" placeholder="Ketikkan Kode ReCaptCha"
                                                        value="">
                                                    <label>
                                                        <i class="fa-solid fa-laptop-code fa-sm"></i>&nbsp;
                                                        <small>Ketikkan Kode ReCaptCha </small>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="d-grid col-sm-12">
                                        <a href="http://localhost/pcs-jmtm/Administrator/Dashboard/Admin_dashboard"
                                            class="btn text-dark"
                                            style="background: #f46b45;  /* fallback for old browsers */
                                            background: -webkit-linear-gradient(to right, #eea849, #f46b45);  /* Chrome 10-25, Safari 5.1-6 */
                                            background: linear-gradient(to right, #eea849, #f46b45); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                                            <i class="fa-solid fa-lock-open px-1"></i>
                                            Login
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center p-3 my-2 text-white rounded shadow-lg"
            style="background: #44A08D;  /* fallback for old browsers */
                                    background: -webkit-linear-gradient(to right, #093637, #44A08D);  /* Chrome 10-25, Safari 5.1-6 */
                                    background: linear-gradient(to right, #093637, #44A08D); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
            <div class="lh-1 fst-italic">
                <h1 class="h6 mb-0 text-white lh-1">
                    <b>
                        <i class="fa-solid fa-circle-info fa-lg px-1"></i>
                        Catatan Penggunaan
                    </b>
                </h1><br>
                <p>
                    <small>
                        1. Sebelum melakukan login pastikan Username dan Password anda sudah terdaftar pada sistem PCS.
                        <br>
                        2. Pastikan anda pengguna dari sistem aplikasi PCS.
                        <br>
                        3. Hubungi pihak user administrator untuk me-reset password default atau username, jika
                        user pengguna lupa password atau username.
                        <br>
                        4. Pastikan ketikan kode ReCaptCha sudah sesuai (noted: Klik tombol Refresh sebelah kanan kode
                        ReCaptCha untuk mengganti konde ReCaptCha)
                        <br>
                    </small>
                </p>
            </div>
        </div>
    </div>

    <!-- /Login FormContact Section -->

</main>