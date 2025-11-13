<main class="container">
    <style>
    .ellipsis-200 {
        display: inline-block;
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        position: relative;
        cursor: pointer;
    }
    </style>
    <div class="d-flex align-items-center p-3 my-2 text-dark rounded shadow-lg" style="background: #ADA996;  /* fallback for old browsers */
                background: -webkit-linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996);  /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */       
            ">
        <i class="fa-solid fa-person-digging fa-bounce fa-2xl"></i>&nbsp;&nbsp;
        <div class="lh-1">
            <h1 class="h6 mb-0 text-dark lh-1"><b>Data Program Kegiatan</b></h1>
            <small>Elektronik Project Control System (E-PCS)</small>
        </div>
    </div>
    <div class="my-2 p-3 bg-body rounded shadow-lg">
        <h6 class="border-bottom border-dark pb-2 mb-0">
            <i class="fa-solid fa-circle-info px-1"></i>
            List Data Program Kegiatan
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
                                    Form Data Program Kegiatan
                                </strong>
                            </small>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-sm align-middle">
                        <tr>
                            <td scope="col" class="text-start text-muted">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-text border-dark">
                                            <i class="fa-solid fa-calendar-days fa-lg"></i>
                                        </span>
                                        <select class="form-select form-select-sm border-dark" id="filter_th_program">
                                            <option selected disabled value="0">
                                                <small>Pilih Tahun...</small>
                                            </option>
                                            <option value="1">All</option>
                                            <option value="2">2024</option>
                                            <option value="3">2025</option>
                                            <option value="4">2026</option>
                                            <option value="5">2027</option>
                                        </select>
                                        <span class="input-group-text border-dark">
                                            <i class="fa-solid fa-square-check fa-lg"></i>
                                        </span>
                                        <select class="form-select form-select-sm border-dark" id="filter_sts_program">
                                            <option selected disabled value="0">
                                                <small>Pilih Status...</small>
                                            </option>
                                            <option value="1">All</option>
                                            <option value="2">Masa Perencanaan</option>
                                            <option value="3">Masa Pelaksanaan</option>
                                            <option value="4">Masa Pemeliharaan</option>
                                            <option value="5">Pekerjaan Selesai</option>
                                        </select>
                                        <button class="btn btn-outline-info btn-sm text-dark border-dark" type="button"
                                            id="btn_fillter_prg">
                                            <i class="fa-solid fa-magnifying-glass fa-sm"></i>
                                            <strong>Filter Data</strong>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td scope="col align-baseline" class="text-end">
                                <button class="btn btn-sm btn-primary" type="button" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop-tambah-program">
                                    <i class="fa-solid fa-folder-plus fa-lg"></i>&nbsp;
                                    <small><b>Tambah Data</b></small>
                                </button>
                            </td>
                        </tr>
                    </table>
                    <table class="table-bordered table-sm table-hover align-middle border-dark tbl_program"
                        style="width:100%">
                        <thead class="bg-warning text-dark shadow-lg">
                            <tr>
                                <th scope="col" class="col-1 text-center">
                                    <small style="font-size: 12px">
                                        Kode
                                    </small>
                                </th>
                                <th scope="col" class="col-3 text-center">
                                    <small style="font-size: 12px">
                                        Nama Pekerjaan
                                    </small>
                                </th>
                                <th scope="col" class="col-2 text-center">
                                    <small style="font-size: 12px">
                                        Nilai Kontrak
                                    </small>
                                </th>
                                <th scope="col" class="col-2 text-center">
                                    <small style="font-size: 12px">
                                        Tanggal & Durasi Kontrak
                                    </small>
                                </th>
                                <th scope="col" class="col-2 text-center">
                                    <small style="font-size: 12px">
                                        Tanggal & Durasi PHO
                                    </small>
                                </th>
                                <th scope="col" class="col-1 text-center">
                                    <small style="font-size: 12px">
                                        Status Data
                                    </small>
                                </th>
                                <th scope="col" class="col-1 text-center">
                                    <small style="font-size: 12px">
                                        .:: Aksi ::.
                                    </small>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="col" class="col-1 text-start">
                                    <small>
                                        <span class="d-inline-block text-truncate" style="max-width: 250px;">
                                            PK.25.1
                                        </span>
                                    </small>
                                </td>
                                <td scope="col" class="col-3 text-start">
                                    <small>
                                        <span class="d-inline-block text-truncate" style="max-width: 250px;">
                                            Pekerjaan Struktur dan Pengadaan Material Geodipa Patuha
                                        </span>
                                    </small>
                                </td>
                                <td scope="col" class="col-2 text-end">
                                    <small>
                                        <span class="d-inline-block text-truncate" style="max-width: 250px;">
                                            0
                                        </span>
                                    </small>
                                </td>
                                <td scope="col" class="col-2 text-center">
                                    <small>
                                        <span class="d-inline-block text-truncate" style="max-width: 250px;">
                                            06/10/2025 || 90 Hari
                                        </span>
                                    </small>
                                </td>
                                <td scope="col" class="col-2 text-center">
                                    <small>
                                        <span class="d-inline-block text-truncate" style="max-width: 250px;">
                                            07/01/2026 || 365 Hari
                                        </span>
                                    </small>
                                </td>
                                <td scope="col" class="col-1 text-start">
                                    <span class="badge text-bg-success text-white">
                                        <i class="fa-solid fa-recycle fa-lg"></i>
                                        &nbsp;
                                        Masa Pelaksanaan
                                    </span>
                                </td>
                                <td scope="col" class="col-1 text-center">
                                    <small>
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <!-- <small>Detail</small> -->
                                            <a id="link-dhk-r" type="button" class="btn btn-sm btn-success"
                                                href="<? base_url() ?>Administrator/RKAPP/data_dkh_kontrak/data_dkh_kontrak"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Halaman Pengisian DKH Kontrak">
                                                <i class="fa-solid fa-share-from-square fa-lg px-1"></i>
                                            </a>
                                            </a>
                                        </div>
                                    </small>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
                        3. Klik tombol panah arah berwarna hijau pada tabel kolom aksi, untuk membuka Halam Pengisian
                        DKH Kontrak berdasarkan Kode dan Nama Program yang dipilih.
                        <br>
                    </small>
                </p>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Program -->
    <div class="modal fade" id="staticBackdrop-tambah-program" data-bs-backdrop="static" data-bs-keyboard="false"
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
                                <b>Tambah Data Program Kegiatan</b>
                            </h1>
                            <small>
                                Halaman Pop Up Ini Berfungsi Untuk Menambah Data Program Kegiatan
                            </small>
                        </div>
                    </div>
                    <!-- buatkan insert nya dengan form pake ajax dan sweetalert dan juga controler dan model serta store prosedur saya yang tadi insert -->
                    <div class="my-2 p-2 bg-body rounded shadow-lg">
                        <div class="card shadow-lg">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="background: #232526;  /* fallback for old browsers */
                                        background: -webkit-linear-gradient(to right, #c1c7ccff, #232526);  /* Chrome 10-25, Safari 5.1-6 */
                                        background: linear-gradient(to right, #c1c7ccff, #232526); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                                <div class="flex-grow-1 bd-highlight">
                                    <span class="text-white">
                                        <i class="fa-solid fa-address-card fa-lg px-1"></i>
                                        <small>
                                            Form Isian Data Program Kegiatan
                                        </small>
                                    </span>
                                </div>
                            </div>
                            <form action="javascript:;" id="formData_tambah_program" method="post">
                                <!-- TOKEN CSRF -->
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                    value="<?= $this->security->get_csrf_hash(); ?>" id="csrf_token" />

                                <div class="card-body">
                                    <div class="row align-items-start">
                                        <div class="col-12 col-sm-12">
                                            <div class="card shadow-lg border-dark">
                                                <div class="card-body">
                                                    <h6 class="border-bottom border-dark pb-2 mb-0">
                                                        <i class="fa-solid fa-circle-info px-1"></i>
                                                        Form Inputan Data Program Pekerjaan
                                                    </h6>
                                                    <h6 class="border-bottom border-white pb-2 mb-0"></h6>
                                                    <table class="table table-sm">
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="col-md-6">
                                                                        <div class="input-group input-group-sm">
                                                                            <span class="input-group-text border-dark">
                                                                                Kode Program
                                                                            </span>
                                                                            <span class="input-group-text border-dark">
                                                                                <i
                                                                                    class="fa-solid fa-barcode fa-lg"></i>
                                                                            </span>
                                                                            <input type="text"
                                                                                class="form-control text-end border-dark"
                                                                                name="kd_prg" id="kd_prg"
                                                                                aria-label="Sizing example input"
                                                                                aria-describedby="inputGroup-sizing-sm"
                                                                                value="PK.25.1" readonly
                                                                                style="background-color: #c1c7ccff">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-end">
                                                                    <div class="col-md-6">
                                                                        <div class="input-group input-group-sm">
                                                                            <span class="input-group-text border-dark">
                                                                                Date Program
                                                                            </span>
                                                                            <span class="input-group-text border-dark">
                                                                                <i
                                                                                    class="fa-solid fa-calendar-days fa-lg"></i>
                                                                            </span>
                                                                            <input type="date"
                                                                                class="form-control border-dark text-end"
                                                                                id="date_prg"
                                                                                value="<?= date('Y-m-d') ?>"
                                                                                name="date_prg"
                                                                                aria-label="Sizing example input"
                                                                                readonly
                                                                                style="background-color: #c1c7ccff"
                                                                                aria-describedby="inputGroup-sizing-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan=2>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            Nama Program Pekerjaan
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i
                                                                                class="fa-solid fa-person-digging fa-lg"></i>
                                                                        </span>
                                                                        <input type="text"
                                                                            class="form-control border-dark" id="nd_prg"
                                                                            name="nd_prg"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            placeholder="Input data..." value="">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            Unit kerja
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i class="fa-solid fa-building fa-lg"></i>
                                                                        </span>
                                                                        <input type="text"
                                                                            class="form-control border-dark"
                                                                            id="unit_prg" name="unit_prg"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            placeholder="Input data..." value="">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-end">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            Lokasi Pekerjaan
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i
                                                                                class="fa-solid fa-map-location-dot fa-lg"></i>
                                                                        </span>
                                                                        <input type="text"
                                                                            class="form-control border-dark"
                                                                            id="lokasi_prg" name="lokasi_prg"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            placeholder="Input data..." value="">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- Gituhub -->
                                            <h6 class="border-bottom border-white pb-2 mb-0"></h6>
                                            <div class="card shadow-lg border-dark">
                                                <div class="card-body">
                                                    <h6 class="border-bottom border-dark pb-2 mb-0">
                                                        <i class="fa-solid fa-circle-info px-1"></i>
                                                        Form Inputan Data Kontrak Pekerjaan
                                                    </h6>
                                                    <h6 class="border-bottom border-white pb-2 mb-0"></h6>
                                                    <table class="table table-sm">
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            Nilai Kontrak
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i
                                                                                class="fa-solid fa-money-bill-wave fa-lg"></i>
                                                                        </span>
                                                                        <input type="text"
                                                                            class="form-control border-dark text-end"
                                                                            id="nilai_prg" name="nilai_prg"
                                                                            aria-label="Sizing example input" readonly
                                                                            style="background-color: #c1c7ccff"
                                                                            value="0"
                                                                            readaria-describedby="inputGroup-sizing-sm">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            Start Date
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i
                                                                                class="fa-solid fa-calendar-days fa-lg"></i>
                                                                        </span>
                                                                        <input type="date" name="date_awal_kontrak_prg"
                                                                            class="form-control border-dark"
                                                                            id="date_awal_kontrak_prg"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            value="">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            Durasi
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i
                                                                                class="fa-solid fa-calendar-days fa-lg"></i>
                                                                        </span>
                                                                        <input type="number" name="durasi_kontrak_prg"
                                                                            class="form-control border-dark"
                                                                            id="durasi_kontrak_prg"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            placeholder="Input number..." value="">
                                                                        <span class="input-group-text border-dark">
                                                                            Hari
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-end">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            End Date
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i
                                                                                class="fa-solid fa-calendar-days fa-lg"></i>
                                                                        </span>

                                                                        <input readonly type="text"
                                                                            name="date_akhir_kontrak_prg"
                                                                            class="form-control border-dark"
                                                                            id="date_akhir_kontrak_prg"
                                                                            style="background-color: #c1c7ccff"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            value="">
                                                                    </div>
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
                                                        Form Inputan Data PHO & FHO Pekerjaan
                                                    </h6>
                                                    <h6 class="border-bottom border-white pb-2 mb-0"></h6>
                                                    <table class="table table-sm">
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            Date PHO
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i
                                                                                class="fa-solid fa-calendar-days fa-lg"></i>
                                                                        </span>
                                                                        <input type="date" name="date_awal_pho_prg"
                                                                            class="form-control border-dark"
                                                                            id="date_awal_pho_prg"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            value="">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            Durasi
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i
                                                                                class="fa-solid fa-calendar-days fa-lg"></i>
                                                                        </span>
                                                                        <input type="number" name="durasi_pho_prg"
                                                                            class="form-control border-dark"
                                                                            id="durasi_pho_prg"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            placeholder="Input number..." value="">
                                                                        <span class="input-group-text border-dark">
                                                                            Hari
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-end">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            End Date
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i
                                                                                class="fa-solid fa-calendar-days fa-lg"></i>
                                                                        </span>

                                                                        <input type="text" name="date_akhir_pho_prg"
                                                                            class="form-control border-dark"
                                                                            id="date_akhir_pho_prg"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            readonly style="background-color: #c1c7ccff"
                                                                            value="">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            Date FHO
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i
                                                                                class="fa-solid fa-calendar-days fa-lg"></i>
                                                                        </span>
                                                                        <input type="date" name="date_awal_fho_prg"
                                                                            class="form-control border-dark"
                                                                            id="date_awal_fho_prg" value=""
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm">
                                                                    </div>
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
                                                        Form Inputan User Project Control
                                                    </h6>
                                                    <h6 class="border-bottom border-white pb-2 mb-0"></h6>
                                                    <table class="table table-sm">
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            Owner
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i class="fa-solid fa-user-tie fa-lg"></i>
                                                                        </span>
                                                                        <input name="owner_prg" type="text"
                                                                            class="form-control border-dark"
                                                                            id="owner_prg"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            placeholder="Input data..." value="">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            PM Pusat
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i class="fa-solid fa-user-tie fa-lg"></i>
                                                                        </span>
                                                                        <input type="text" name="pusat_prg"
                                                                            class="form-control border-dark"
                                                                            id="pusat_prg"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            placeholder="Input data..." value="">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            GS
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i class="fa-solid fa-user-tie fa-lg"></i>
                                                                        </span>
                                                                        <input type="text" name="gs"
                                                                            class="form-control border-dark" id="gs_prg"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            placeholder="Input data..." value="">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
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
                                    <button id="btn-simpan" type="submit"
                                        class="btn btn-success btn-sm rounded shadow-lg">
                                        <i class="fa-regular fa-floppy-disk fa-lg px-1"></i>
                                        Simpan Data
                                    </button>
                                </div>
                            </form>
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
                                        2. Kolom isian Kode itu automatis jadi ditidak perlu
                                        diinput.
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
    </div><!-- End Modal Tambah Program -->

    <!-- Modal Detail Data Program -->
    <div class="modal fade" id="staticBackdrop-detail-program" data-bs-backdrop="static" data-bs-keyboard="false"
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
                                <b>Detail Data Program Kegiatan Pekerjaan</b>
                            </h1>
                            <small>
                                Halaman Pop Up Ini Berfungsi Untuk Detail Data Program Kegiatan
                            </small>
                        </div>
                    </div>
                    <div class="my-2 p-2 bg-body rounded shadow-lg">
                        <div class="card shadow-lg">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="background: #232526;  /* fallback for old browsers */
                                                        background: -webkit-linear-gradient(to right, #c1c7ccff, #232526);  /* Chrome 10-25, Safari 5.1-6 */
                                                        background: linear-gradient(to right, #c1c7ccff, #232526); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                                <div class="flex-grow-1 bd-highlight">
                                    <span class="text-white">
                                        <i class="fa-solid fa-address-card fa-lg px-1"></i>
                                        <small>
                                            Form Detail Data Program Kegiatan
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
                                                    Informasi Data Program Kegiatan
                                                </h6>
                                                <h6 class="border-bottom border-white pb-2 mb-0"></h6>
                                                <table class="table table-sm table-striped">
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
                                                                <small id="detail_kode_program">PK.25.0001</small>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-start">
                                                                <small>
                                                                    <b>Date Program</b>
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
                                                                <small id="detail_tanggal_program">07/11/2025</small>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex justify-content-start">
                                                                <small>
                                                                    <b>Nama Program Pekerjaan</b>
                                                                </small>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <small>
                                                                    <i class="fa-regular fa-pen-to-square fa-lg"></i>
                                                                </small>
                                                            </div>
                                                        </td colspan=2>
                                                        <td class="text-muted">
                                                            <div class="d-flex justify-content-start">
                                                                <small id="detail_nama_program">
                                                                    Pekerjaan Struktur dan Pengadaan Material Geodipa
                                                                    Patuha
                                                                </small>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex justify-content-start">
                                                                <small>
                                                                    <b>Unit Kerja</b>
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
                                                                <small id="detail_unit_kerja">AMP-HE</small>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-start">
                                                                <small>
                                                                    <b>Lokasi Pekerjaan</b>
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
                                                                <small id="detail_lokasi_pekerjaan">Ciwiday
                                                                    Bandung</small>
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
                                                    Informasi Data Kontrak Program
                                                </h6>
                                                <h6 class="border-bottom border-white pb-2 mb-0"></h6>
                                                <table class="table table-sm table-striped">
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex justify-content-start">
                                                                <small>
                                                                    <b>Nilai Kontrak</b>
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
                                                                <small id="detail_nilai_kontrak">0</small>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-start">
                                                                <small>
                                                                    <b>Start Date</b>
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
                                                                <small
                                                                    id="detail_tanggal_mulai_kontrak">15/11/2025</small>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex justify-content-start">
                                                                <small>
                                                                    <b>Durasi</b>
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
                                                                <small id="detail_durasi_kontrak">90 Hari</small>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-start">
                                                                <small>
                                                                    <b>End Date</b>
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
                                                                <small
                                                                    id="detail_tanggal_selesai_kontrak">01/02/2026</small>
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
                                                    Informasi Data PHO & FHO Program
                                                </h6>
                                                <h6 class="border-bottom border-white pb-2 mb-0"></h6>
                                                <table class="table table-sm table-striped">
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex justify-content-start">
                                                                <small>
                                                                    <b>Date PHO</b>
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
                                                                <small id="detail_tanggal_mulai_pho">07/02/2026</small>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-start">
                                                                <small>
                                                                    <b>Durasi PHO</b>
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
                                                                <small id="detail_durasi_pho">365 Hari</small>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex justify-content-start">
                                                                <small>
                                                                    <b>End Date PHO</b>
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
                                                                <small
                                                                    id="detail_tanggal_selesai_pho">08/02/2027</small>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-start">
                                                                <small>
                                                                    <b>Date FHO</b>
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
                                                        <td>
                                                            <div class="d-flex justify-content-start">
                                                                <small id="detail_tanggal_fho">
                                                                    <b>15/02/2027</b>
                                                                </small>
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
                                                    Informasi Data User Project Control
                                                </h6>
                                                <h6 class="border-bottom border-white pb-2 mb-0"></h6>
                                                <table class="table table-sm table-striped">
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex justify-content-start">
                                                                <small>
                                                                    <b>Owner</b>
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
                                                                <small id="detail_owner">Owner 123</small>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-start">
                                                                <small>
                                                                    <b>PM Pusat</b>
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
                                                                <small id="detail_pm_pusat">PM Pusat 123</small>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-start">
                                                                <small>
                                                                    <b>GS</b>
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
                                                                <small id="detail_gs">GS 123</small>
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
                                                    Informasi Data User Logger
                                                </h6>
                                                <h6 class="border-bottom border-white pb-2 mb-0"></h6>
                                                <table class="table table-sm table-striped">
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
                                                                <small>Administrator</small>
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
                                                                <small>03/11/2025</small>
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
                                                                <small>-</small>
                                                            </div>
                                                        </td>
                                                    </tr>
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
                                <button type="button" class="btn btn-warning btn-sm rounded shadow-lg"
                                    id="btn-ubah-program" data-id="" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop-ubah-program">
                                    <i class="fa-solid fa-pen-to-square fa-lg px-1"></i>
                                    Ubah Data
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Modal Detail Data Program -->

    <!-- Modal Ubah Program -->
    <div class="modal fade" id="staticBackdrop-ubah-program" data-bs-backdrop="static" data-bs-keyboard="false"
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
                                <b>Ubah Data Program Kegiatan</b>
                            </h1>
                            <small>
                                Halaman Pop Up Ini Berfungsi Untuk Mengubah Data Program Kegiatan
                            </small>
                        </div>
                    </div>
                    <div class="my-2 p-2 bg-body rounded shadow-lg">
                        <div class="card shadow-lg">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="background: #232526;  /* fallback for old browsers */
                                        background: -webkit-linear-gradient(to right, #c1c7ccff, #232526);  /* Chrome 10-25, Safari 5.1-6 */
                                        background: linear-gradient(to right, #c1c7ccff, #232526); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */">
                                <div class="flex-grow-1 bd-highlight">
                                    <span class="text-white">
                                        <i class="fa-solid fa-address-card fa-lg px-1"></i>
                                        <small>
                                            Form Isian Ubah Data Program Kegiatan
                                        </small>
                                    </span>
                                </div>
                            </div>
                            <form method="post">
                                <!-- TOKEN CSRF -->
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                    value="<?= $this->security->get_csrf_hash(); ?>" id="csrf_token_ubah" />

                                <div class="card-body">
                                    <div class="row align-items-start">
                                        <div class="col-12 col-sm-12">
                                            <div class="card shadow-lg border-dark">
                                                <div class="card-body">
                                                    <h6 class="border-bottom border-dark pb-2 mb-0">
                                                        <i class="fa-solid fa-circle-info px-1"></i>
                                                        Form Inputan Ubah Data Program Pekerjaan
                                                    </h6>
                                                    <h6 class="border-bottom border-white pb-2 mb-0"></h6>
                                                    <table class="table table-sm">
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="col-md-6">
                                                                        <input type="hidden" id="ubah_id_program"
                                                                            name="id_program">
                                                                        <div class="input-group input-group-sm">
                                                                            <span class="input-group-text border-dark">
                                                                                Kode Program
                                                                            </span>
                                                                            <span class="input-group-text border-dark">
                                                                                <i
                                                                                    class="fa-solid fa-barcode fa-lg"></i>
                                                                            </span>
                                                                            <input type="text"
                                                                                class="form-control text-end border-dark"
                                                                                id="kd_ubah_program"
                                                                                aria-label="Sizing example input"
                                                                                aria-describedby="inputGroup-sizing-sm"
                                                                                value="PK.25.1" readonly
                                                                                style="background-color: #c1c7ccff">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-end">
                                                                    <div class="col-md-6">
                                                                        <div class="input-group input-group-sm">
                                                                            <span class="input-group-text border-dark">
                                                                                Date Program
                                                                            </span>
                                                                            <span class="input-group-text border-dark">
                                                                                <i
                                                                                    class="fa-solid fa-calendar-days fa-lg"></i>
                                                                            </span>
                                                                            <input type="date"
                                                                                class="form-control border-dark text-end"
                                                                                id="ubah_tanggal_program"
                                                                                value="<?= date('Y-m-d') ?>"
                                                                                aria-label="Sizing example input"
                                                                                readonly
                                                                                style="background-color: #c1c7ccff"
                                                                                aria-describedby="inputGroup-sizing-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan=2>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            Nama Program Pekerjaan
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i
                                                                                class="fa-solid fa-person-digging fa-lg"></i>
                                                                        </span>
                                                                        <input type="text"
                                                                            class="form-control border-dark"
                                                                            id="ubah_nama_program"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            placeholder="Input data..."
                                                                            value="Pekerjaan Kintek Dev App Web PCS-1">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            Unit kerja
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i class="fa-solid fa-building fa-lg"></i>
                                                                        </span>
                                                                        <input type="text"
                                                                            class="form-control border-dark"
                                                                            id="ubah_unit_kerja"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            placeholder="Input data..." value="AMP">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-end">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            Lokasi Pekerjaan
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i
                                                                                class="fa-solid fa-map-location-dot fa-lg"></i>
                                                                        </span>
                                                                        <input type="text"
                                                                            class="form-control border-dark"
                                                                            id="ubah_lokasi_pekerjaan"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            placeholder="Input data..." value="Jakarta">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- Gituhub -->
                                            <h6 class="border-bottom border-white pb-2 mb-0"></h6>
                                            <div class="card shadow-lg border-dark">
                                                <div class="card-body">
                                                    <h6 class="border-bottom border-dark pb-2 mb-0">
                                                        <i class="fa-solid fa-circle-info px-1"></i>
                                                        Form Inputan Data Kontrak Pekerjaan
                                                    </h6>
                                                    <h6 class="border-bottom border-white pb-2 mb-0"></h6>
                                                    <table class="table table-sm">
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            Nilai Kontrak
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i
                                                                                class="fa-solid fa-money-bill-wave fa-lg"></i>
                                                                        </span>
                                                                        <input type="text"
                                                                            class="form-control border-dark text-end"
                                                                            id="ubah_nilai_kontrak"
                                                                            aria-label="Sizing example input" readonly
                                                                            style="background-color: #c1c7ccff"
                                                                            value="0"
                                                                            readaria-describedby="inputGroup-sizing-sm">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            Start Date
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i
                                                                                class="fa-solid fa-calendar-days fa-lg"></i>
                                                                        </span>
                                                                        <input type="date"
                                                                            class="form-control border-dark"
                                                                            id="ubah_tanggal_mulai_kontrak"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            value="11/11/2025">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            Durasi
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i
                                                                                class="fa-solid fa-calendar-days fa-lg"></i>
                                                                        </span>
                                                                        <input type="number"
                                                                            class="form-control border-dark"
                                                                            id="ubah_durasi_kontrak"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            placeholder="Input number..." value="90">
                                                                        <span class="input-group-text border-dark">
                                                                            Hari
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-end">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            End Date
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i
                                                                                class="fa-solid fa-calendar-days fa-lg"></i>
                                                                        </span>

                                                                        <input readonly type="text"
                                                                            class="form-control border-dark"
                                                                            id="ubah_tanggal_selesai_kontrak"
                                                                            style="background-color: #c1c7ccff"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            value="11/02/2026">
                                                                    </div>
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
                                                        Form Inputan Data PHO & FHO Pekerjaan
                                                    </h6>
                                                    <h6 class="border-bottom border-white pb-2 mb-0"></h6>
                                                    <table class="table table-sm">
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            Date PHO
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i
                                                                                class="fa-solid fa-calendar-days fa-lg"></i>
                                                                        </span>
                                                                        <input type="date"
                                                                            class="form-control border-dark"
                                                                            id="ubah_tanggal_mulai_pho"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            value="12/02/2026">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            Durasi
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i
                                                                                class="fa-solid fa-calendar-days fa-lg"></i>
                                                                        </span>
                                                                        <input type="number"
                                                                            class="form-control border-dark"
                                                                            id="ubah_durasi_pho"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            placeholder="Input number..." value="10">
                                                                        <span class="input-group-text border-dark">
                                                                            Hari
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-end">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            End Date
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i
                                                                                class="fa-solid fa-calendar-days fa-lg"></i>
                                                                        </span>

                                                                        <input type="text"
                                                                            class="form-control border-dark"
                                                                            id="ubah_tanggal_selesai_pho"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            readonly style="background-color: #c1c7ccff"
                                                                            value="19/02/2026">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            Date FHO
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i
                                                                                class="fa-solid fa-calendar-days fa-lg"></i>
                                                                        </span>
                                                                        <input type="date"
                                                                            class="form-control border-dark"
                                                                            id="ubah_tanggal_fho" value="20/02/2026"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm">
                                                                    </div>
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
                                                        Form Inputan User Project Control
                                                    </h6>
                                                    <h6 class="border-bottom border-white pb-2 mb-0"></h6>
                                                    <table class="table table-sm">
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            Owner
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i class="fa-solid fa-user-tie fa-lg"></i>
                                                                        </span>
                                                                        <input type="text"
                                                                            class="form-control border-dark"
                                                                            id="ubah_owner"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            placeholder="Input data..." value="user 1">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            PM Pusat
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i class="fa-solid fa-user-tie fa-lg"></i>
                                                                        </span>
                                                                        <input type="text"
                                                                            class="form-control border-dark"
                                                                            id="ubah_pm_pusat"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            placeholder="Input data..." value="user 2">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-start">
                                                                    <div class="input-group input-group-sm">
                                                                        <span class="input-group-text border-dark">
                                                                            GS
                                                                        </span>
                                                                        <span class="input-group-text border-dark">
                                                                            <i class="fa-solid fa-user-tie fa-lg"></i>
                                                                        </span>
                                                                        <input type="text"
                                                                            class="form-control border-dark"
                                                                            id="ubah_gs"
                                                                            aria-label="Sizing example input"
                                                                            aria-describedby="inputGroup-sizing-sm"
                                                                            placeholder="Input data..." value="user 3">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
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
                                    <button id="btn-update" type="button"
                                        class="btn btn-success btn-sm rounded shadow-lg">
                                        <i class="fa-regular fa-floppy-disk fa-lg px-1"></i>
                                        Simpan Perubahan Data
                                    </button>
                                </div>
                            </form>
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
                                        2. Kolom isian Kode itu automatis jadi ditidak perlu diubah.
                                        <br>
                                        3. Pastikan kolom isian diubah dengan benar sebelum mengklik
                                        tombol "Simpan Perubahan Data".
                                        <br>
                                    </small>
                                </p>
                            </div>
                        </div> <!-- End Catatan Pengguna -->
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Modal Ubah Program -->

</main>