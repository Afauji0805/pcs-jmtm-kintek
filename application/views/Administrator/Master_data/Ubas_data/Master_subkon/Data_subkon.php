<main class="container">
    <div class="d-flex align-items-center p-3 my-2 text-dark rounded shadow-lg" style="background: #ADA996;  /* fallback for old browsers */
                background: -webkit-linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996);  /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */       
            ">
        <i class="fa-solid fa-shop fa-bounce fa-2xl"></i>&nbsp;&nbsp;
        <div class="lh-1">
            <h1 class="h6 mb-0 text-dark lh-1"><b>Master Data Subkon</b></h1>
            <small>Elektronik Project Control System (E-PCS)</small>
        </div>
    </div>
    <div class="my-2 p-3 bg-body rounded shadow-lg">
        <h6 class="border-bottom border-dark pb-2 mb-0">
            <i class="fa-solid fa-circle-info px-1"></i>
            List Master Data Subkon
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
                                    Form Master Data Subkon
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
                                    Tabel Master Data Subkon
                                </small>
                            </td>
                            <td scope="col align-baseline" class="text-end">
                                <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop-tambah-subkon">
                                    <i class="fa-solid fa-folder-plus fa-lg"></i>&nbsp;
                                    <small><b>Tambah Data</b></small>
                                </button>
                            </td>
                        </tr>
                    </table>
                    <table class="table-bordered table-sm table-hover align-middle border-dark example"
                        style="width:100%">
                        <thead class="bg-secondary text-white shadow-lg">
                            <tr>
                                <th scope="col" class="col-1 text-center">
                                    <small>
                                        Kode
                                    </small>
                                </th>
                                <th scope="col" class="col-3 text-center">
                                    <small>
                                        Uraian Item
                                    </small>
                                </th>
                                <th scope="col" class="col-2 text-center">
                                    <small>
                                        Satuan
                                    </small>
                                </th>
                                <th scope="col" class="col-1 text-center">
                                    <small>
                                        Info Supplier
                                    </small>
                                </th>
                                <th scope="col" class="col-2 text-center">
                                    <small>
                                        Status Data
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
                            <?php foreach ($subkon as $b) : ?>
                                <tr>
                                    <td scope="col" class="col-1 text-center">
                                        <small>
                                            <span class="d-inline-block text-truncate" style="max-width: 250px;">
                                                <?= $b->kode_subkon ?>
                                            </span>
                                        </small>
                                    </td>
                                    <td scope="col" class="col-3 text-start">
                                        <small>
                                            <span class="d-inline-block text-truncate" style="max-width: 250px;">
                                                <?= $b->uraian_subkon ?>
                                            </span>
                                        </small>
                                    </td>
                                    <td scope="col" class="col-2 text-start">
                                        <small>
                                            <span class="d-inline-block text-truncate" style="max-width: 250px;">
                                                <?= $b->satuan_subkon ?>
                                            </span>
                                        </small>
                                    </td>
                                    <td scope="col" class="col-2 text-center">
                                        <span id="badge-supplier-<?= $b->kode_subkon ?>" class="badge <?= $b->jumlah_supplier > 0 ? 'text-bg-info' : 'text-bg-danger' ?>">
                                            <i class="fa-solid fa-recycle fa-lg"></i>
                                            &nbsp;
                                            <?= $b->jumlah_supplier ?> Supplier
                                        </span>
                                    </td>

                                    <!-- status -->
                                    <td scope="col" class="col-2 text-center">
                                        <span id="status-<?= $b->id_subkon ?>"
                                            class="badge <?= $b->status_subkon == 'Active' ? 'text-bg-success' : 'text-bg-secondary' ?>">
                                            <i class="fa-solid <?= $b->status_subkon == 'Active' ? 'fa-recycle' : 'fa-ban' ?> fa-lg"></i>
                                            <?= $b->status_subkon ?>
                                        </span>
                                    </td>

                                    <td scope="col" class="col-2 text-center">
                                        <small>
                                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                                <!-- Tombol Detail & Ubah -->
                                                <button type="button" class="btn btn-sm btn-warning btn-detail" data-bs-toggle="modal"
                                                    data-id="<?= $b->id_subkon ?>"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop-detail-subkon"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="Detail & Ubah Data">
                                                    <i class="fa-solid fa-users-viewfinder fa-lg px-1"></i>
                                                </button>
                                                <!-- <small>Detail</small> -->
                                                <button type="button" class="btn btn-sm btn-primary btn-detail-subkon" data-bs-toggle="modal" data-bs-target="#staticBackdrop-tambah-detail-subkon-supplier" data-id="<?= $b->id_subkon ?>" data-kode="<?= $b->kode_subkon ?>" data-uraian="<?= $b->uraian_subkon ?>">
                                                    <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Tambah Data Supplier Per-Item">
                                                        <i class="fa-solid fa-user-plus fa-lg px-1"></i>
                                                    </a>
                                                </button><!-- <small>Detail</small> -->
                                                <!-- <small>Hapus</small> -->

                                                <!-- Tombol Toggle Status Active / Non Active -->
                                                <button class="btn btn-sm btn-toggle-status <?= $b->status_subkon == 'Active' ? 'btn-danger' : 'btn-success' ?>"
                                                    data-id="<?= $b->id_subkon ?>"
                                                    data-status="<?= $b->status_subkon ?>"
                                                    data-bs-toggle="tooltip"
                                                    data-bs-placement="top"
                                                    title="<?= $b->status_subkon == 'Active' ? 'Non-Aktifkan' : 'Aktifkan' ?>">
                                                    <i class="fa-solid <?= $b->status_subkon == 'Active' ? 'fa-ban' : 'fa-check' ?> fa-lg"></i>
                                                </button>
                                            </div>
                                        </small>
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
                    3. Untuk menonkatifkan data yang sudah diisi, dan disimpan,
                    klik pada icon block warna merah.
                    <br>
                    4. Untuk menginput, menambahkan dan merubah data item UBAS per-supplier, klik icon user plus warna
                    hijau.
                    <br>
                </small>
            </p>
        </div>
    </div>

    <!-- Modal Tambah Subkon -->
    <div class="modal fade" id="staticBackdrop-tambah-subkon" data-bs-backdrop="static" data-bs-keyboard="false"
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
                                <b>Tambah Master Data Subkon</b>
                            </h1>
                            <small>
                                Halaman Pop Up Ini Berfungsi Untuk Menambah Master Data Subkon
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
                                            Form Isian Master Data Subkon
                                        </small>
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-start">
                                    <div class="col-12 col-sm-12">
                                        <form id="form-tambah-subkon" class="row g-1" method="post" action="<?= site_url('Administrator/Master_data/Master_subkon/Master_data_subkon/tambah') ?>">
                                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" id="csrf_token_tambah" />

                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                    </span>
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="kode_subkon" name="kode_subkon"
                                                            value="<?= isset($kode_otomatis) ? $kode_otomatis : '' ?>" disabled>
                                                        <label>
                                                            <i class="fa-solid fa-barcode fa-sm"></i>&nbsp;
                                                            <small>Kode (otomatis)</small>
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
                                                            id="uraian_subkon" name="uraian_subkon" placeholder="Uraian Subkon">
                                                        <label>
                                                            <i class="fa-solid fa-person-digging fa-sm"></i>&nbsp;
                                                            <small>Uraian Item</small>
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
                                                            id="satuan_subkon" name="satuan_subkon">
                                                        <label>
                                                            <i class="fa-solid fa-recycle fa-sm"></i>&nbsp;
                                                            <small>Satuan Item</small>
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
    <!-- End Modal Tambah Subkon -->

    <!-- Modal Detail Master Data Subkon -->
    <div class="modal fade" id="staticBackdrop-detail-subkon" data-bs-backdrop="static" data-bs-keyboard="false"
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
                                <b>Detail Master Data Subkon</b>
                            </h1>
                            <small>
                                Halaman Pop Up Ini Berfungsi Untuk Detail Master Data Subkon
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
                                            Form Detail Master Data Subkon
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
                                                        <small id="kode-subkon"></small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <small>
                                                            <b>Uraian Item</b>
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
                                                        <small id="uraian-subkon"></small>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <small>
                                                            <b>Satuan</b>
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
                                                        <small id="satuan-subkon"></small>
                                                    </div>
                                                </td>
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
                                                <td class="text-muted" colspan="4" id="status-subkon">
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
                                                        <small id="updated-at"></small>
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
                                        </table><br>
                                        <h6 class="border-bottom border-dark pb-2 mb-0">
                                            <i class="fa-solid fa-circle-info px-1"></i>
                                            Detail Tabel Data Subkon Per Supplier
                                        </h6><br>
                                        <table
                                            class="table-bordered table-sm table-hover align-middle border-dark example1"
                                            style="width:100%">
                                            <thead class="bg-warning text-dark shadow-lg">
                                                <tr>
                                                    <th scope="col" class="col-1 text-center">
                                                        <small>
                                                            Kode Detail
                                                        </small>
                                                    </th>
                                                    <th scope="col" class="col-2 text-center">
                                                        <small>
                                                            Kode Supplier
                                                        </small>
                                                    </th>
                                                    <th scope="col" class="col-5 text-center">
                                                        <small>
                                                            Nama Supplier
                                                        </small>
                                                    </th>
                                                    <th scope="col" class="col-2 text-center">
                                                        <small>
                                                            Harga Satuan (Rp)
                                                        </small>
                                                    </th>
                                                    <th scope="col" class="col-2 text-center">
                                                        <small>
                                                            Date
                                                        </small>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="tabel-detail">
                                            </tbody>
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
    </div>
    <!-- End Modal Detail Master Data Subkon -->

    <!-- Modal Ubah Subkon -->
    <div class="modal fade" id="staticBackdrop-ubah-subkon" data-bs-backdrop="static" data-bs-keyboard="false"
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
                                <b>Ubah Master Data Subkon</b>
                            </h1>
                            <small>
                                Halaman Pop Up Ini Berfungsi Untuk Mengubah Master Data Subkon
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
                                            Form Ubah Master Data Subkon
                                        </small>
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <input type="hidden" id="id_ubah_subkon">
                                <div class="row align-items-start">
                                    <div class="col-12 col-sm-12">
                                        <form class="row g-1" id="form-ubah-subkon">
                                            <input type="hidden" id="id_ubah_subkon">
                                            <div class="col-md-3">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                    </span>
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="kode_ubah_subkon" placeholder="Kode" disabled>
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
                                                            id="uraian_ubah_subkon" placeholder="Uraian Item">
                                                        <label>
                                                            <i class="fa-solid fa-person-digging fa-sm"></i>&nbsp;
                                                            <small>Uraian Item</small>
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
                                                            id="satuan_ubah_subkon" placeholder="Satuan Item">
                                                        <label>
                                                            <i class="fa-solid fa-recycle fa-sm"></i>&nbsp;
                                                            <small>Satuan Item</small>
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
                                    <button id="link-ubah" type="submit"
                                        class="btn btn-success btn-sm rounded shadow-lg">
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
                                    1. Semua kolom isian yang akan diubah wajib diisi.
                                    <br>
                                    2. Kolom isian Kode automatis jadi ditidak perlu diubah.
                                    <br>
                                    3. Pastikan kolom isian diubah dengan benar sebelum mengklik
                                    tombol "Simpan Perubahan Data".
                                    <br>
                                    4. Untuk merubah data detail item per supplier silahkan klik tombol icon user plus
                                    yang berwarna biru pada kolom aksi
                                    <br>
                                </small>
                            </p>
                        </div>
                    </div> <!-- End Catatan Pengguna -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Ubah Subkon -->

    <!-- Modal Tambah Detil Subkon Per-Supplier -->
    <div class="modal fade" id="staticBackdrop-tambah-detail-subkon-supplier" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                <b>Tambah Detail Data Item Subkon Per-Supplier</b>
                            </h1>
                            <small>
                                Halaman Pop Up Ini Berfungsi Untuk Tambah Detail Data Item Subkon Per-Supplier
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
                                            Form Tambah Detail Data Item Subkon Per-Supplier
                                        </small>
                                    </span>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-start">
                                    <div class="col-12 col-sm-12">
                                        <div class="card shadow-lg border-dark">
                                            <div class="card-body">
                                                <h6 class="border-bottom border-dark pb-2 mb-0">
                                                    <i class="fa-solid fa-circle-info px-1"></i>
                                                    Master Data Subkon
                                                </h6><br>
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
                                                                <small id="kode-subkon-suplier"></small>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-start">
                                                                <small>
                                                                    <b>Uraian Item</b>
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
                                                                <small id="uraian-subkon-suplier"></small>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex justify-content-start">
                                                                <small>
                                                                    <b>Satuan</b>
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
                                                                <small id="satuan-subkon-suplier"></small>
                                                            </div>
                                                        </td>
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
                                                        <td class="text-muted" colspan="4" id="status-subkon-suplier">
                                                            <div class="d-flex justify-content-start">
                                                                <span class="badge text-bg-success">
                                                                    <i class="fa-solid fa-recycle fa-lg"></i>
                                                                    &nbsp;
                                                                    Active
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <h6 class="border-bottom border-white pb-2 mb-0"></h6>
                                        <div class="card shadow-lg border-dark">
                                            <div class="card-body">
                                                <h6 class="border-bottom border-dark pb-2 mb-0">
                                                    <i class="fa-solid fa-circle-info px-1"></i>
                                                    Form Detail Data Subkon Per Supplier
                                                </h6><br>
                                                <form class="row g-1" id="form_tambah_detail_supplier">
                                                    <input type="hidden" id="hidden_kode_subkon" value="">
                                                    <input type="hidden" id="hidden_id_subkon" value="">
                                                    <input type="hidden">
                                                    <div class="col-md-1">
                                                        <label class="form-label">
                                                            <small> Kode</small>
                                                        </label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            value="Auto" disabled>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">
                                                            <small>Kode Supplier</small>
                                                        </label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                                                            </span>
                                                            <input class="form-control form-control-sm"
                                                                list="datalistOptions_supplier"
                                                                id="search_supplier_subkon" placeholder="Ketik kode supplier...">
                                                            <datalist id="datalistOptions_supplier"></datalist>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <label class="form-label">
                                                            <small>Nama Supplier</small>
                                                        </label>
                                                        <input type="text" class="form-control form-control-sm text-truncate"
                                                            id="nama_detail_supplier" readonly>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">
                                                            <small>Harga Satuan (Rp)</small>
                                                        </label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                            </span>
                                                            <input type="text" class="form-control form-control-sm"
                                                                id="harsat_detail_supplier" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">
                                                            <small>Currency (Rp)</small>
                                                        </label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="curr_detail_supplier" disabled="">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="form-label">
                                                            <small>Date (Now)</small>
                                                        </label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            id="date_detail_supplier" value="05/11/2025" readonly>
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="text-end">
                                                            <button id="link-tambah-tabel-persuplier" class="btn btn-sm btn-primary"
                                                                type="button">
                                                                <i class="fa-solid fa-folder-plus fa-lg"></i>&nbsp;
                                                                <small><b>Tambah Data Tabel Supplier</b></small>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <h6 class="border-bottom border-white pb-2 mb-0"></h6>
                                        <div class="card shadow-lg border-dark">
                                            <div class="card-body">
                                                <table class="table table-sm align-middle">
                                                    <tr>
                                                        <td scope="col" class="text-start text-muted">
                                                            <small>
                                                                <i class="fa-solid fa-table fa-lg px-1"></i>
                                                                Tabel Detail Data Item Subkon Per-Supplier
                                                            </small>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table
                                                    class="table-bordered table-sm table-hover align-middle border-dark example1"
                                                    style="width:100%">
                                                    <thead class="bg-warning text-dark shadow-lg">
                                                        <tr>
                                                            <th scope="col" class="col-1 text-center">
                                                                <small>
                                                                    Kode Detail
                                                                </small>
                                                            </th>
                                                            <th scope="col" class="col-2 text-center">
                                                                <small>
                                                                    Kode Supplier
                                                                </small>
                                                            </th>
                                                            <th scope="col" class="col-4 text-center">
                                                                <small>
                                                                    Nama Supplier
                                                                </small>
                                                            </th>
                                                            <th scope="col" class="col-2 text-center">
                                                                <small>
                                                                    Harga Satuan (Rp)
                                                                </small>
                                                            </th>
                                                            <th scope="col" class="col-2 text-center">
                                                                <small>
                                                                    Date
                                                                </small>
                                                            </th>
                                                            <th scope="col" class="col-1 text-center">
                                                                <small>
                                                                    .:: Aksi ::.
                                                                </small>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tabel-detail-persupplier">
                                                        <!-- tavbel append  -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-danger btn-sm rounded shadow-lg"
                                    data-bs-dismiss="modal">
                                    <i class="fa-regular fa-rectangle-xmark fa-lg px-1"></i>
                                    Tutup Halaman
                                </button>
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
                                        1. Untuk Kode Otomatis tergenerate sistem, tidak perlu disi.
                                        <br>
                                        2. ketikkan Kode Supplier atau Nama Supplier untuk melihat list data master
                                        supplier yang sudah tersimpan sebelumnya, lalu pilih pada list tersebut untuk
                                        menampilkan &nbsp;&nbsp;&nbsp;&nbsp;Nama Supplier kedalam kolom text Nama
                                        Supplier secara otomatis.
                                        <br>
                                        3. Input harga satuan pada kolom text harga satuan. kolom Currency akan otomatis
                                        mengkonversi menjadi bilangan Currency.
                                        <br>
                                        4. Klik tombol Tambah Data Table Supplier untuk memasukan data yang sudah
                                        diinput kedalam Tabel Data.
                                        <br>
                                        5. Jika data yang terdapat dalam Tabel Data ada kesalah, klik tombol icon hapus
                                        pada kolom aksi sebelah kanan pada Tabel Data.
                                        <br>
                                        6. Jika data supplier lebih dari 1, lakukan proses input berulang dari point 2
                                        sd point 4.
                                        <br>
                                    </small>
                                </p>
                            </div>
                        </div> <!-- End Catatan Pengguna -->
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Modal Tambah Detil Subkon Per-Supplier -->
</main>