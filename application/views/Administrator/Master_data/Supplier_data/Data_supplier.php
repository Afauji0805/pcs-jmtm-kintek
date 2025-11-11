<main class="container">
    <div class="d-flex align-items-center p-3 my-2 text-dark rounded shadow-lg" style="background: #ADA996;  /* fallback for old browsers */
                background: -webkit-linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996);  /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */       
            ">
        <i class="fa-solid fa-building-user fa-bounce fa-2xl"></i>&nbsp;&nbsp;
        <div class="lh-1">
            <h1 class="h6 mb-0 text-dark lh-1"><b>Master Data Supplier</b></h1>
            <small>Elektronik Project Control System (E-PCS)</small>
        </div>
    </div>
    <div class="my-2 p-3 bg-body rounded shadow-lg">
        <h6 class="border-bottom border-dark pb-2 mb-0">
            <i class="fa-solid fa-circle-info px-1"></i>
            List Master Data Supplier
        </h6>
        <div class="pt-3">
            <div class="card shadow-lg">
                <div class="card-header d-flex justify-content-between align-items-center"
                    style="background: #373B44;  /* fallback for old browsers */
                    background: -webkit-linear-gradient(to right, #4286f4, #373B44);  /* Chrome 10-25, Safari 5.1-6 */
                    background: linear-gradient(to right, #4286f4, #373B44); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                    <div class="flex-grow-1 bd-highlight">
                        <span class="text-white">
                            <i class="fa-solid fa-newspaper fa-lg px-1"></i>
                            <small>
                                <strong>
                                    Form Master Data Supplier
                                </strong>
                            </small>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-sm align-middle">
                        <tr>
                            <td scope="col" class="text-start text-muted">
                                <small>
                                    <i class="fa-solid fa-table fa-lg px-1"></i>
                                    Tabel Master Data Supplier
                                </small>
                            </td>
                            <td scope="col align-baseline" class="text-end">
                                <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop-tambah-supplier">
                                    <i class="fa-solid fa-folder-plus fa-lg"></i>&nbsp;
                                    <small><b>Tambah Data</b></small>
                                </button>
                            </td>
                        </tr>
                    </table>
                    <table class="table-bordered table-sm table-hover align-middle border-dark example"
                        style="width:100%">
                        <thead class="bg-warning text-dark shadow-lg">
                            <tr>
                                <th scope="col" class="col-1 text-center">
                                    <small>
                                        Kode
                                    </small>
                                </th>
                                <th scope="col" class="col-3 text-center">
                                    <small>
                                        Nama Supplier
                                    </small>
                                </th>
                                <th scope="col" class="col-3 text-center">
                                    <small>
                                        Alamat Lengkap
                                    </small>
                                </th>
                                <th scope="col" class="col-2 text-center">
                                    <small>
                                        PIC
                                    </small>
                                </th>
                                <th scope="col" class="col-1 text-center">
                                    <small>
                                        Status
                                    </small>
                                </th>
                                <th scope="col" class="col-2 text-center">
                                    <small>
                                        .:: Aksi ::.
                                    </small>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($supplier as $b) : ?>
                                <tr>
                                    <!-- kode supplier -->
                                    <td scope="col" class="col-1 text-center">
                                        <small>
                                            <span class="d-inline-block text-truncate" style="max-width: 250px;">
                                                <?= $b->kode_supplier ?>
                                            </span>
                                        </small>
                                    </td>
                                    <!-- nama supplier -->
                                    <td scope="col" class="col-3 text-start">
                                        <small>
                                            <span class="d-inline-block text-truncate" style="max-width: 250px;">
                                                <?= $b->nama_supplier ?>
                                            </span>
                                        </small>
                                    </td>
                                    <!-- alamat supplier -->
                                    <td scope="col" class="col-2 text-start">
                                        <small>
                                            <span class="d-inline-block text-truncate" style="max-width: 250px;">
                                                <?= $b->alamat_supplier ?>
                                            </span>
                                        </small>
                                    </td>
                                    <!-- pic sup -->
                                    <td scope="col" class="col-2 text-center">
                                        <small>
                                            <span class="d-inline-block text-truncate" style="max-width: 250px;">
                                                <?= $b->pic_supplier ?>
                                            </span>
                                        </small>
                                    </td>
                                    <!-- status -->
                                    <td scope="col" class="col-2 text-center">
                                        <span id="status-<?= $b->id_supplier ?>"
                                            class="badge <?= $b->status_supplier == 'Active' ? 'text-bg-success' : 'text-bg-secondary' ?>">
                                            <i class="fa-solid <?= $b->status_supplier == 'Active' ? 'fa-recycle' : 'fa-ban' ?> fa-lg"></i>
                                            <?= $b->status_supplier ?>
                                        </span>
                                    </td>

                                    <td scope="col" class="col-2 text-center">
                                        <div class="btn-group" role="group" aria-label="Aksi Master Supplier">
                                            <!-- Tombol Detail & Ubah -->
                                            <button type="button" class="btn btn-sm btn-secondary btn-detail"
                                                data-id="<?= $b->id_supplier ?>"
                                                data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop-detail-supplier"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Detail & Ubah Data">
                                                <i class="fa-solid fa-users-viewfinder fa-lg px-1"></i>
                                            </button>


                                            <!-- Tombol Toggle Status Active / Non Active -->
                                            <button class="btn btn-sm btn-toggle-status <?= $b->status_supplier == 'Active' ? 'btn-danger' : 'btn-success' ?>"
                                                data-id="<?= $b->id_supplier ?>"
                                                data-status="<?= $b->status_supplier ?>"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="<?= $b->status_supplier == 'Active' ? 'Non-Aktifkan' : 'Aktifkan' ?>">
                                                <i class="fa-solid <?= $b->status_supplier == 'Active' ? 'fa-ban' : 'fa-check' ?> fa-lg"></i>
                                            </button>
                                        </div>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex align-items-center p-3 my-2 text-white rounded shadow-lg"
        style="background: #44A08D;  /* fallback for old browsers */
                                    background: -webkit-linear-gradient(to right, #093637, #44A08D);  /* Chrome 10-25, Safari 5.1-6 */
                                    background: linear-gradient(to right, #093637, #44A08D); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
        <div class="lh-1">
            <h1 class="h6 mb-0 text-white lh-1">
                <b>
                    <i class="fa-solid fa-circle-info fa-lg px-1"></i>
                    Catatan Penggunaan
                </b>
            </h1><br>
            <p>
                <small>
                    1. Untuk menambah data silahkan kilk tombol "Tambah Data".
                    <br>
                    2. Untuk melihat detail & ubah data yang sudah diisi, dan disimpan,
                    klik pada icon fokus kamera.
                    <br>
                    3. Untuk menon-aktifkan data yang sudah diisi, dan disimpan,
                    klik pada icon tempat Stop/Block.
                    <br>
                </small>
            </p>
        </div>
    </div>

    <!-- Modal Tambah Supplier -->
    <div class="modal fade" id="staticBackdrop-tambah-supplier" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex align-items-center p-2 my-2 text-white rounded shadow-lg"
                        style="background: #36D1DC;  /* fallback for old browsers */
                                background: -webkit-linear-gradient(to right, #5B86E5, #36D1DC);  /* Chrome 10-25, Safari 5.1-6 */
                                background: linear-gradient(to right, #5B86E5, #36D1DC); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                        <i class="fa-regular fa-folder-open fa-xl px-1"></i>
                        &nbsp;&nbsp;
                        <div class="lh-1">
                            <h1 class="h6 mb-0 text-white lh-1">
                                <b>Tambah Master Data Supplier</b>
                            </h1>
                            <small>
                                Halaman Pop Up Ini Berfungsi Untuk Menambah Master Data Supplier
                            </small>
                        </div>
                    </div>
                    <div class="my-2 p-2 bg-body rounded shadow-lg">
                        <div class="card shadow-lg">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="background: #232526;  /* fallback for old browsers */
                                        background: -webkit-linear-gradient(to right, #414345, #232526);  /* Chrome 10-25, Safari 5.1-6 */
                                        background: linear-gradient(to right, #414345, #232526); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                                <div class="flex-grow-1 bd-highlight">
                                    <span class="text-white">
                                        <i class="fa-solid fa-address-card fa-lg px-1"></i>
                                        <small>
                                            Form Isian Master Data Supplier
                                        </small>
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-start">
                                    <div class="col-12 col-sm-12">
                                        <form class="row g-1" method="post" action="<?= site_url('Administrator/Master_data/Master_supplier/Master_data_supplier/tambah') ?>">
                                            <input type="hidden"
                                                name="<?= $this->security->get_csrf_token_name(); ?>"
                                                value="<?= $this->security->get_csrf_hash(); ?>">

                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                    </span>
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="kode_supplier" name="kode_supplier"
                                                            value="<?= isset($kode_otomatis) ? $kode_otomatis : '' ?>" disabled>
                                                        <label>
                                                            <i class="fa-solid fa-barcode fa-sm"></i>&nbsp;
                                                            <small>Kode (automatis)</small>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                    </span>
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="nama_supplier" name="nama_supplier" placeholder="Nama Supplier">
                                                        <label>
                                                            <i class="fa-solid fa-building-user fa-sm"></i>&nbsp;
                                                            <small>Nama Supplier</small>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                    </span>
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="pic_supplier" name="pic_supplier" placeholder="PIC">
                                                        <label>
                                                            <i class="fa-solid fa-phone-volume fa-sm"></i>&nbsp;
                                                            <small>PIC</small>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                    </span>
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="alamat_supplier" name="alamat_supplier" placeholder="Uraian Pekerjaan"
                                                            value="">
                                                        <label>
                                                            <i class="fa-solid fa-signs-post fa-sm"></i>&nbsp;
                                                            <small>Alamat Lengkap</small>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-footer">
                                                <button type="button" class="btn btn-danger btn-sm rounded shadow-lg"
                                                    data-bs-dismiss="modal">
                                                    <i class="fa-regular fa-rectangle-xmark fa-lg px-1"></i>
                                                    Tutup Halaman
                                                </button>
                                                <button id="link-simpan" type="submit" class="btn btn-success btn-sm rounded shadow-lg">
                                                    <i class="fa-regular fa-floppy-disk fa-lg px-1"></i>
                                                    Simpan Data
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Catatan Pengguna -->
                        <div class="d-flex align-items-center p-3 my-2 text-white rounded shadow-lg"
                            style="background: #44A08D;  /* fallback for old browsers */
                                                background: -webkit-linear-gradient(to right, #093637, #44A08D);  /* Chrome 10-25, Safari 5.1-6 */
                                                background: linear-gradient(to right, #093637, #44A08D); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                            <div class="lh-1">
                                <h1 class="h6 mb-0 text-white lh-1">
                                    <b>
                                        <i class="fa-solid fa-circle-info fa-lg px-1"></i>
                                        Catatan Penggunaan
                                    </b>
                                </h1><br>
                                <p>
                                    <small>
                                        1. Semua kolom isian wajib diisi.
                                        <br>
                                        2. Kolom isian Kode automatis jadi ditidak perlu diinput.
                                        <br>
                                        3. Pastikan kolom isian diisi dengan benar sebelum mengklik
                                        tombol "Simpan Data".
                                        <br>
                                        4. Klik tombol "Tutup Halaman" untuk menutup jendela pop up.
                                        <br>
                                    </small>
                                </p>
                            </div>
                        </div> <!-- End Catatan Pengguna -->
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Modal Tambah Supplier -->

    <!-- Modal Detail Supplier -->
    <div class="modal fade" id="staticBackdrop-detail-supplier" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex align-items-center p-2 my-2 text-white rounded shadow-lg"
                        style="background: #36D1DC;  /* fallback for old browsers */
                                background: -webkit-linear-gradient(to right, #5B86E5, #36D1DC);  /* Chrome 10-25, Safari 5.1-6 */
                                background: linear-gradient(to right, #5B86E5, #36D1DC); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                        <i class="fa-regular fa-folder-open fa-xl px-1"></i>
                        &nbsp;&nbsp;
                        <div class="lh-1">
                            <h1 class="h6 mb-0 text-white lh-1">
                                <b>Detail Master Data Supplier</b>
                            </h1>
                            <small>
                                Halaman Pop Up Ini Berfungsi Untuk Detail Master Data Supplier
                            </small>
                        </div>
                    </div>
                    <div class="my-2 p-2 bg-body rounded shadow-lg">
                        <div class="card shadow-lg">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="background: #232526;  /* fallback for old browsers */
                                                        background: -webkit-linear-gradient(to right, #414345, #232526);  /* Chrome 10-25, Safari 5.1-6 */
                                                        background: linear-gradient(to right, #414345, #232526); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                                <div class="flex-grow-1 bd-highlight">
                                    <span class="text-white">
                                        <i class="fa-solid fa-address-card fa-lg px-1"></i>
                                        <small>
                                            Form Detail Master Data Supplier
                                        </small>
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-start">
                                    <div class="col-12 col-sm-12">
                                        <table class="table table-sm table-striped" id="detail-table">
                                            <tr>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <small>
                                                            <b>Kode</b>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <small>
                                                            <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td class="text-muted">
                                                    <div class="d-flex justify-content-start">
                                                        <small id="kode-supplier"></small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <small>
                                                            <b>Nama Supplier</b>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <small>
                                                            <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td class="text-muted">
                                                    <div class="d-flex justify-content-start">
                                                        <small id="nama-supplier"></small>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <small>
                                                            <b>PIC</b>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <small>
                                                            <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td class="text-muted">
                                                    <div class="d-flex justify-content-start">
                                                        <small id="pic-supplier"></small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <small>
                                                            <b>Alamat</b>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <small>
                                                            <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td class="text-muted">
                                                    <div class="d-flex justify-content-start">
                                                        <small id="alamat-supplier"></small>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <small>
                                                            <b>Status Data</b>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <small>
                                                            <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td class="text-muted" colspan="4" id="status-supplier">
                                                    <div class="d-flex justify-content-start">
                                                        <span class="badge text-bg-success">
                                                            <i class="fa-solid fa-recycle fa-lg"></i>
                                                            &nbsp;
                                                            Active
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <small>
                                                            <b>Insert Date</b>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <small>
                                                            <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td class="text-muted">
                                                    <div class="d-flex justify-content-start">
                                                        <small id="created-at"></small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <small>
                                                            <b>Update Date</b>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <small>
                                                            <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td class="text-muted">
                                                    <div class="d-flex justify-content-start ">
                                                        <small id="updated-at">-</small>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <small>
                                                            <b>Insert By</b>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <small>
                                                            <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td class="text-muted">
                                                    <div class="d-flex justify-content-start">
                                                        <small>-</small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <small>
                                                            <b>Update By</b>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <small>
                                                            <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td class="text-muted">
                                                    <div class="d-flex justify-content-start">
                                                        <small>-</small>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-danger btn-sm rounded shadow-lg" id="btn-tutup-detail">
                                    <i class="fa-regular fa-rectangle-xmark fa-lg px-1"></i>
                                    Tutup Halaman
                                </button>
                                <button type="button" class="btn btn-warning btn-sm rounded shadow-lg" id="btn-detail-ubah">
                                    <i class="fa-solid fa-pen-to-square fa-lg px-1"></i>
                                    Ubah Data
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Modal Detail Supplier -->

    <!-- Modal Ubah Upah -->
    <div class="modal fade" id="staticBackdrop-ubah-supplier" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex align-items-center p-2 my-2 text-white rounded shadow-lg"
                        style="background: #36D1DC;  /* fallback for old browsers */
                                background: -webkit-linear-gradient(to right, #5B86E5, #36D1DC);  /* Chrome 10-25, Safari 5.1-6 */
                                background: linear-gradient(to right, #5B86E5, #36D1DC); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                        <i class="fa-regular fa-folder-open fa-xl px-1"></i>
                        &nbsp;&nbsp;
                        <div class="lh-1">
                            <h1 class="h6 mb-0 text-white lh-1">
                                <b>Ubah Master Data Supplier </b>
                            </h1>
                            <small>
                                Halaman Pop Up Ini Berfungsi Untuk Mengubah Data Supplier
                            </small>
                        </div>
                    </div>
                    <div class="my-2 p-2 bg-body rounded shadow-lg">
                        <div class="card shadow-lg">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="background: #232526;  /* fallback for old browsers */
                                        background: -webkit-linear-gradient(to right, #414345, #232526);  /* Chrome 10-25, Safari 5.1-6 */
                                        background: linear-gradient(to right, #414345, #232526); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                                <div class="flex-grow-1 bd-highlight">
                                    <span class="text-white">
                                        <i class="fa-solid fa-address-card fa-lg px-1"></i>
                                        <small>
                                            Form Ubah Master Data Supplier
                                        </small>
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden" id="id_ubah_supplier">
                                <div class="row align-items-start">
                                    <div class="col-12 col-sm-12">
                                        <form class="row g-1" id="form-ubah-supplier">
                                            <input type="hidden" id="id_ubah_supplier">
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                    </span>
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="kode_ubah_supplier" placeholder="Kode"
                                                            disabled>
                                                        <label>
                                                            <i class="fa-solid fa-barcode fa-sm"></i>&nbsp;
                                                            <small>Kode (automatis)</small>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                    </span>
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="nama_ubah_supplier" placeholder="Nama Supplier">
                                                        <label>
                                                            <i class="fa-solid fa-building-user fa-sm"></i>&nbsp;
                                                            <small>Nama Supplier</small>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                    </span>
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="pic_ubah_supplier" placeholder="PIC">
                                                        <label>
                                                            <i class="fa-solid fa-phone-volume fa-sm"></i>&nbsp;
                                                            <small>PIC</small>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                    </span>
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="alamat_ubah_supplier" placeholder="Uraian Pekerjaan"
                                                            value="Jl Puspitek Serpong TNI No 15 Kodiklat Tangerang Selatan">
                                                        <label>
                                                            <i class="fa-solid fa-signs-post fa-sm"></i>&nbsp;
                                                            <small>Alamat Lengkap</small>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            
                                <div class="card-footer">
                                    <button type="button" class="btn btn-danger btn-sm rounded shadow-lg"
                                        data-bs-dismiss="modal">
                                        <i class="fa-regular fa-rectangle-xmark fa-lg px-1"></i>
                                        Tutup Halaman
                                    </button>
                                    <button id="link-ubah" type="submit" class="btn btn-success btn-sm rounded shadow-lg">
                                        <i class="fa-regular fa-floppy-disk fa-lg px-1"></i>
                                        Simpan Perubahan Data
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- Catatan Pengguna -->
                        <div class="d-flex align-items-center p-3 my-2 text-white rounded shadow-lg"
                            style="background: #44A08D;  /* fallback for old browsers */
                                    background: -webkit-linear-gradient(to right, #093637, #44A08D);  /* Chrome 10-25, Safari 5.1-6 */
                                    background: linear-gradient(to right, #093637, #44A08D); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                            <div class="lh-1">
                                <h1 class="h6 mb-0 text-white lh-1">
                                    <b>
                                        <i class="fa-solid fa-circle-info fa-lg px-1"></i>
                                        Catatan Penggunaan
                                    </b>
                                </h1><br>
                                <p>
                                    <small>
                                        1. Ubah data hanya untuk Atribut selain kode.
                                        <br>
                                        2. Dipastikan data yang diubah sudah sesuai sebelum meng klik tombol Simpan
                                        Perubahan Data.
                                        <br>
                                    </small>
                                </p>
                            </div>
                        </div> <!-- End Catatan Pengguna -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Ubah Supplier -->
</main>