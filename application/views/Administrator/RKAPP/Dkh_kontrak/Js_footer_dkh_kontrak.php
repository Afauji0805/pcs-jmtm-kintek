<!-- Vendor JS Files -->
<script src="<?php echo base_url();?>/assets/Landing-home/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>/assets/Landing-home/vendor/php-email-form/validate.js"></script>
<script src="<?php echo base_url();?>/assets/Landing-home/vendor/aos/aos.js"></script>
<script src="<?php echo base_url();?>/assets/Landing-home/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?php echo base_url();?>/assets/Landing-home/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="<?php echo base_url();?>/assets/Landing-home/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?php echo base_url();?>/assets/Landing-home/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo base_url();?>/assets/Landing-home/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url();?>/assets/template-custom/js//hanya_angka.js"></script>

<!-- Main JS File -->
<script src="<?php echo base_url();?>/assets/Landing-home/js/main.js"></script>

<!-- DataTable bootstrap5 -->
<script src="<?php echo base_url();?>/assets/template-custom/js//jquery-3.7.0.js"></script>
<script src="<?php echo base_url();?>/assets/template-custom/js//jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>/assets/template-custom/js//dataTables.bootstrap5.min.js"></script>
<script src="<?php echo base_url();?>/assets/template-custom/js//dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>/assets/template-custom/js//buttons.bootstrap5.min.js"></script>
<script src="<?php echo base_url();?>/assets/template-custom/js//jszip.min.js"></script>
<script src="<?php echo base_url();?>/assets/template-custom/js//pdfmake.min.js"></script>
<script src="<?php echo base_url();?>/assets/template-custom/js//vfs_fonts.js"></script>
<script src="<?php echo base_url();?>/assets/template-custom/js//buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>/assets/template-custom/js//buttons.print.min.js"></script>
<script src="<?php echo base_url();?>/assets/template-custom/js//buttons.colVis.min.js"></script>
<script src="<?php echo base_url();?>/assets/template-custom/js//dataTables.responsive.min.js"></script>
<script src="<?php echo base_url();?>/assets/template-custom/js//responsive.bootstrap5.min.js"></script>
<script src="<?php echo base_url();?>/assets/template-custom/js////data_table5.js"></script>
<!-- Sweet Alert 2 -->
<script src="<?php echo base_url();?>/assets/template-custom/js//sweetalert2.all.min.js"></script>

<script>
const toggleBtn = document.getElementById('navToggleBtn');
const navMenu = document.getElementById('navmenu');
if (toggleBtn) {
    toggleBtn.addEventListener('click', () => {
        navMenu.classList.toggle('show-menu');
    });
}

// Biarkan dropdown di mobile bisa dibuka
document.querySelectorAll('.dropdown-toggle').forEach(btn => {
    btn.addEventListener('click', (e) => {
        if (window.innerWidth <= 768) {
            e.preventDefault();
            const submenu = btn.nextElementSibling;
            submenu.classList.toggle('show');
        }
    });
});
</script>

<script>
$(document).on('click', '#link-simpan', function(e) {
    swal({
            title: "Apakah anda yakin data sudah terisi dengan benar?",
            text: "Proses Simpan Data",
            type: "info",
            confirmButtonText: "Simpan Data",
            showCancelButton: true
        })
        .then((result) => {
            if (result.value) {
                swal(
                    'Simpan Data',
                    'Anda berhasil menyimpan data. :)',
                    'success'
                )
            } else if (result.dismiss === 'cancel') {
                swal(
                    'Batal Menyimpan',
                    'Silahkan isi data dengan lengkap',
                    'error'
                )
            }
        })
});
$(document).on('click', '#link-ubah', function(e) {
    swal({
            title: "Apakah anda yakin data sudah terisi dengan benar?",
            text: "Proses Ubah Data",
            type: "warning",
            confirmButtonText: "Ubah Data",
            showCancelButton: true
        })
        .then((result) => {
            if (result.value) {
                swal(
                    'Ubah Data',
                    'Anda berhasil mengubah data. :)',
                    'success'
                )
            } else if (result.dismiss === 'cancel') {
                swal(
                    'Batal Mengubah',
                    'Silahkan isi data dengan lengkap',
                    'error'
                )
            }
        })
});
$(document).on('click', '#link-hapus', function(e) {
    swal({
            title: "Apakah anda yakin Menon-Aktifkan data ini?",
            text: "Proses Menon-Aktifkan Data",
            type: "error",
            confirmButtonText: "Menon-Aktifkan",
            showCancelButton: true
        })
        .then((result) => {
            if (result.value) {
                swal(
                    'Non-Aktifkan',
                    'Anda berhasil Menon-Aktifkan data. :)',
                    'success'
                )
            } else if (result.dismiss === 'cancel') {
                swal(
                    'Batal Non-Aktifkan',
                    'Silahkan isi cek data kembali',
                    'error'
                )
            }
        })

});
$(document).on('click', '#link-block', function(e) {
    swal({
            title: "Apakah anda yakin Menghapus data ini?",
            text: "Proses mMnghapus Data",
            type: "error",
            confirmButtonText: "Menghapus",
            showCancelButton: true
        })
        .then((result) => {
            if (result.value) {
                swal(
                    'Henghapus',
                    'Anda berhasil Menghapus data. :)',
                    'success'
                )
            } else if (result.dismiss === 'cancel') {
                swal(
                    'Batal Menghapus',
                    'Silahkan isi cek data kembali',
                    'error'
                )
            }
        })

});
$(document).on('click', '#link-tambahtabel', function(e) {
    swal({
            title: "Apakah anda yakin data sudah terisi dengan benar?",
            text: "Proses Tambah Datatabel",
            type: "info",
            confirmButtonText: "Tambah Datatabel",
            showCancelButton: true
        })
        .then((result) => {
            if (result.value) {
                swal(
                    'Tambah Datatabel',
                    'Anda berhasil Menambah Datatabel. :)',
                    'success'
                )
            } else if (result.dismiss === 'cancel') {
                swal(
                    'Batal Menambah Tabel',
                    'Silahkan isi data dengan lengkap',
                    'error'
                )
            }
        })

});
$(document).on('click', '#link-final', function(e) {
    swal({
            title: "Apakah anda yakin Mem-Finalisasi Data ini??",
            text: "Proses Finalisasi Datatabel",
            type: "info",
            confirmButtonText: "Finalisasi Datatabel",
            showCancelButton: true
        })
        .then((result) => {
            if (result.value) {
                swal(
                    'Finalisasi Datatabel',
                    'Anda berhasil Mem-Finalisasi Datatabel. :)',
                    'success'
                )
            } else if (result.dismiss === 'cancel') {
                swal(
                    'Batal Mem-Finalisasi Datatabel',
                    'Silahkan cek kembali Datatablenya ',
                    'error'
                )
            }
        })

});
</script>

<script>
$(document).ready(function() {
    $('[data-bs-toggle="tooltip"]').tooltip();
});
</script>


<!-- <script>
const table = $('#example').DataTable({
    lengthChange: false,
    ordering: false,
    responsive: true,
    searching: false,
    paging: false,
    info: false,
});

// === TAMBAH DIVISI ===
function addNewRow() {
    const newRow = $(`
        <tr class="row-divisi">
            <td class="kode-ma"></td>
            <td><input style="width:100%" type="text" placeholder="Nama Divisi"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-gears fa-lg px-1"></i>
                        Aksi
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item btn-sub" href="#"><i class="fa-solid fa-circle-plus fa-sm px-1"></i>Tambah Sub</a></li>
                        <li><a class="dropdown-item btn-hapus" href="#"><i class="fa-solid fa-ban fa-sm px-1"></i>Hapus Divisi</a></li>
                    </ul>
                </div>
            </td>
        </tr>
    `);
    $('#example tbody').append(newRow);
    table.row.add(newRow[0]);
    renumberAll();
}

// === TAMBAH SUB-ROW ===
function addSubRow(afterRow) {
    const divisiRow = $(afterRow);
    let lastSubRow = null;

    divisiRow.nextAll().each(function() {
        const tr = $(this);
        if (tr.hasClass('row-divisi')) return false; // stop di divisi berikut
        if (tr.hasClass('row-sub')) lastSubRow = tr;
    });

    const newSub = $(`
        <tr class="row-sub">
            <td class="kode-ma"></td>
            <td><input style="width:100%" type="text" placeholder="Uraian Pekerjaan"></td>
            <td><input type="text" placeholder="Sat" style="width:100%"></td>
            <td><input type="number" placeholder="Qty" style="width:100%"></td>
            <td><input type="number" placeholder="Harga Satuan" style="width:100%; background-color: #E5E7EB;" readonly></td>
            <td><input type="number" placeholder="Jumlah" style="width:100%; background-color: #E5E7EB;" readonly></td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-gears fa-lg px-1"></i>
                        Aksi
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item btn-ubas" href="#"><i class="fa-solid fa-screwdriver-wrench fa-sm px-1"></i>Data UBAS</a></li>
                        <li><a class="dropdown-item btn-hapus" href="#"><i class="fa-solid fa-ban fa-sm px-1"></i>Hapus Sub</a></li>
                    </ul>
                </div>
            </td>
        </tr>
    `);

    if (lastSubRow) {
        lastSubRow.after(newSub);
    } else {
        divisiRow.after(newSub);
    }

    table.row.add(newSub[0]);
    renumberAll();
}

// === PENOMORAN ULANG ===
function renumberAll() {
    let divisiCounter = 0;
    $('#example tbody tr').each(function() {
        const tr = $(this);
        const kodeCell = tr.find('td.kode-ma');

        if (tr.hasClass('row-divisi')) {
            divisiCounter++;
            tr.data('divisi', divisiCounter);
            tr.data('subCount', 0);
            kodeCell.text(divisiCounter);
        } else if (tr.hasClass('row-sub')) {
            const prevDiv = tr.prevAll('.row-divisi').first();
            const divNum = prevDiv.data('divisi');
            let subCount = prevDiv.data('subCount') + 1;
            prevDiv.data('subCount', subCount);
            kodeCell.text(divNum + '.' + subCount);
        }
    });
}

// === EVENT HANDLER ===
$('#addRow').on('click', addNewRow);

$('#example tbody').on('click', '.btn-hapus', function(e) {
    e.preventDefault();
    const $row = $(this).closest('tr');

    // jika divisi, hapus juga sub-row nya
    if ($row.hasClass('row-divisi')) {
        const divisiNum = $row.find('.kode-ma').text();
        $(`#example tbody tr.row-sub`).each(function() {
            if ($(this).find('.kode-ma').text().startsWith(divisiNum + '.')) {
                $(this).remove();
            }
        });
    }

    table.row($row).remove();
    $row.remove();
    renumberAll();
});

$('#example tbody').on('click', '.btn-sub', function(e) {
    e.preventDefault();
    const $row = $(this).closest('tr');
    addSubRow($row[0]);
});

$('#example tbody').on('click', '.btn-ubas', function(e) {
    e.preventDefault();
    alert('Fungsi Data UBAS belum diimplementasikan.');
});

// Tambahkan 1 divisi awal otomatis
addNewRow();
</script> -->




<!-- <script>
const table = $('#example').DataTable({
    lengthChange: false,
    ordering: false,
    responsive: true,
    searching: false,
    paging: false,
    info: false,
});

// ================== TAMBAH DIVISI ==================
function addNewRow() {
    const newRow = $(`
        <tr class="row-divisi">
            <td class="kode-ma"></td>
            <td><input style="width:100%" type="text" placeholder="Nama Divisi"></td>
            <td></td><td></td><td></td><td></td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-gears fa-lg px-1"></i> Aksi
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item btn-sub" href="#"><i class="fa-solid fa-circle-plus fa-sm px-1"></i>Tambah Sub</a></li>
                        <li><a class="dropdown-item btn-hapus" href="#"><i class="fa-solid fa-ban fa-sm px-1"></i>Hapus Divisi</a></li>
                    </ul>
                </div>
            </td>
        </tr>
    `);

    $('#example tbody').append(newRow);
    table.row.add(newRow[0]);
    updateDivisiCodes();
}

// ================== PENOMORAN DIVISI ==================
function updateDivisiCodes() {
    let divisiCount = 0;
    $('#example tbody tr').each(function() {
        const tr = $(this);
        if (tr.hasClass('row-divisi')) {
            divisiCount++;
            tr.find('.kode-ma').text(divisiCount);
            tr.data('kode', divisiCount.toString());
        }
    });
}

// ================== TAMBAH SUB ==================
function addSubRow(afterRow) {
    const divisiRow = $(afterRow);
    const divCode = divisiRow.data('kode');
    if (!divCode) return;

    let maxSub = 0;
    $('#example tbody tr').each(function() {
        const code = $(this).find('.kode-ma').text();
        if (code.startsWith(divCode + '.')) {
            const parts = code.split('.');
            if (parts.length === 2) {
                const num = parseInt(parts[1]);
                if (num > maxSub) maxSub = num;
            }
        }
    });

    const newCode = divCode + '.' + (maxSub + 1);
    const newSub = createSubRow(newCode);

    let insertAfter = divisiRow;
    divisiRow.nextAll().each(function() {
        const code = $(this).find('.kode-ma').text();
        if (!code.startsWith(divCode + '.')) return false;
        insertAfter = $(this);
    });

    insertAfter.after(newSub);
    table.row.add(newSub[0]);
}

// ================== TAMBAH UBAS ==================
function addUbasRow(afterRow) {
    const row = $(afterRow);
    const baseCode = row.find('.kode-ma').text();
    if (!baseCode) return;

    // Batasi hanya sampai level 3 (contoh: 1.1.1)
    const baseLevel = baseCode.split('.').length;
    if (baseLevel >= 3) return; // Tidak bisa lebih dalam

    let maxSub = 0;
    $('#example tbody tr').each(function() {
        const code = $(this).find('.kode-ma').text();
        if (code.startsWith(baseCode + '.')) {
            const parts = code.split('.');
            const lastNum = parseInt(parts[parts.length - 1]);
            if (lastNum > maxSub) maxSub = lastNum;
        }
    });

    const newCode = baseCode + '.' + (maxSub + 1);
    const newRow = createSubRow(newCode, true); // true = ini UBAS

    let insertAfter = row;
    row.nextAll().each(function() {
        const nextCode = $(this).find('.kode-ma').text();
        if (!nextCode.startsWith(baseCode + '.')) return false;
        insertAfter = $(this);
    });

    insertAfter.after(newRow);
    table.row.add(newRow[0]);
}

// ================== BUAT BARIS SUB GENERIK ==================
function createSubRow(kode, isUbas = false) {
    const level = kode.split('.').length;

    // placeholder UBAS
    const placeholderText = isUbas ?
        'Uraian Pekerjaan UBAS' :
        'Uraian Pekerjaan';

    // Jika level 3 (1.1.1) tampilkan hanya tombol hapus
    let actionButton = '';
    if (level >= 3) {
        actionButton = `
            <button type="button" class="btn btn-sm btn-danger btn-hapus">
                <i class="fa-solid fa-trash-can fa-sm px-1"></i>Hapus
            </button>
        `;
    } else {
        actionButton = `
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-gears fa-lg px-1"></i> Aksi
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item btn-ubas" href="#"><i class="fa-solid fa-screwdriver-wrench fa-sm px-1"></i>Data UBAS</a></li>
                    <li><a class="dropdown-item btn-hapus" href="#"><i class="fa-solid fa-ban fa-sm px-1"></i>Hapus Sub</a></li>
                </ul>
            </div>
        `;
    }

    return $(`
        <tr class="row-sub">
            <td class="kode-ma">${kode}</td>
            <td><input style="width:100%" type="text" placeholder="${placeholderText}"></td>
            <td><input type="text" placeholder="Sat" style="width:100%"></td>
            <td><input type="number" placeholder="Qty" style="width:100%"></td>
            <td><input type="number" placeholder="Harga Satuan" style="width:100%; background-color:#E5E7EB;" readonly></td>
            <td><input type="number" placeholder="Jumlah" style="width:100%; background-color:#E5E7EB;" readonly></td>
            <td>${actionButton}</td>
        </tr>
    `);
}

// ================== EVENT HANDLER ==================
$('#addRow').on('click', addNewRow);

// Tambah Sub
$('#example tbody').on('click', '.btn-sub', function(e) {
    e.preventDefault();
    const row = $(this).closest('tr');
    addSubRow(row[0]);
});

// Tambah UBAS
$('#example tbody').on('click', '.btn-ubas', function(e) {
    e.preventDefault();
    const row = $(this).closest('tr');
    addUbasRow(row[0]);
});

// Hapus Row
$('#example tbody').on('click', '.btn-hapus', function(e) {
    e.preventDefault();
    const $row = $(this).closest('tr');
    const kode = $row.find('.kode-ma').text();

    // Hapus semua anak (prefix)
    $('#example tbody tr').each(function() {
        const code = $(this).find('.kode-ma').text();
        if (code.startsWith(kode + '.')) $(this).remove();
    });

    $row.remove();
    table.row($row).remove();

    // Jika divisi dihapus → update nomor divisi
    if ($row.hasClass('row-divisi')) updateDivisiCodes();
});

// Tambah 1 divisi awal
addNewRow();
</script> -->


<script>
const table = $('#example').DataTable({
    lengthChange: false,
    ordering: false,
    responsive: true,
    searching: false,
    paging: false,
    info: false,
});

// ================== TAMBAH DIVISI ==================
function addNewRow() {
    const newRow = $(`
        <tr class="row-divisi">
            <td class="kode-ma"></td>
            <td><input style="width:100%" type="text" placeholder="Nama Divisi"></td>

            <!-- kolom Sat / Qty / Harga Satuan / Jumlah -->
            <td></td><td></td><td></td><td></td>

            <!-- ✅ Keterangan divisi -->
            <td></td>

            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-gears fa-lg px-1"></i> Aksi
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item btn-sub" href="#"><i class="fa-solid fa-circle-plus fa-sm px-1"></i>Tambah Sub</a></li>
                        <li><a class="dropdown-item btn-hapus" href="#"><i class="fa-solid fa-ban fa-sm px-1"></i>Hapus Divisi</a></li>
                    </ul>
                </div>
            </td>
        </tr>
    `);

    $('#example tbody').append(newRow);
    table.row.add(newRow[0]);
    updateDivisiCodes();
}

// ================== PENOMORAN DIVISI ==================
function updateDivisiCodes() {
    let divisiCount = 0;

    $('#example tbody tr').each(function() {
        const tr = $(this);
        if (tr.hasClass('row-divisi')) {
            divisiCount++;
            tr.find('.kode-ma').text(divisiCount);
            tr.data('kode', divisiCount.toString());
        }
    });
}

// ================== TAMBAH SUB (LEVEL 2 SAJA) ==================
function addSubRow(afterRow) {
    const divisiRow = $(afterRow);
    const divCode = divisiRow.data('kode');
    if (!divCode) return;

    let maxSub = 0;

    $('#example tbody tr').each(function() {
        const code = $(this).find('.kode-ma').text();
        if (code.startsWith(divCode + '.') && code.split('.').length === 2) {
            const num = parseInt(code.split('.')[1]);
            maxSub = Math.max(maxSub, num);
        }
    });

    const newCode = `${divCode}.${maxSub + 1}`;
    const newSub = createSubRow(newCode);

    let insertAfter = divisiRow;
    divisiRow.nextAll().each(function() {
        const nextCode = $(this).find('.kode-ma').text();
        if (!nextCode.startsWith(divCode + '.')) return false;
        insertAfter = $(this);
    });

    insertAfter.after(newSub);
    table.row.add(newSub[0]);
}

// ================== OPEN MODAL UBAS ==================
$('#example tbody').on('click', '.btn-ubas', function(e) {
    e.preventDefault();

    const tr = $(this).closest('tr');

    // ✅ Kode sub row
    const kodeSub = tr.find('.kode-ma').text();

    // ✅ Uraian sub row
    const uraian = tr.find('input[type="text"]').first().val() || '-';

    // ✅ Cari kode divisi (row-divisi sebelumnya)
    let kodeDivisi = '-';
    tr.prevAll('.row-divisi').each(function() {
        kodeDivisi = $(this).find('.kode-ma').text();
        return false;
    });

    // ✅ Tampilkan ke modal
    $('#modalUbasKodeDivisi').text(kodeDivisi);
    $('#modalUbasKodeSub').text(kodeSub);
    $('#modalUbasUraian').text(uraian);

    // ✅ Buka modal
    $('#modalDataUBAS').modal('show');
});

// ================== GENERATE SUB ROW ==================
function createSubRow(kode) {
    return $(`
        <tr class="row-sub">
            <td class="kode-ma">${kode}</td>

            <td><input style="width:100%" type="text" placeholder="Uraian Pekerjaan"></td>

            <td><input type="text" placeholder="Sat" style="width:100%"></td>
            <td><input type="number" placeholder="Qty" style="width:100%"></td>
            <td><input type="number" placeholder="Harga Satuan" style="width:100%; background-color:#E5E7EB;" readonly></td>
            <td><input type="number" placeholder="Jumlah" style="width:100%; background-color:#E5E7EB;" readonly></td>

            <td><input style="width:100%" type="text" placeholder="Keterangan"></td>

            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-gears fa-lg px-1"></i> Aksi
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item btn-ubas" href="#"><i class="fa-solid fa-screwdriver-wrench fa-sm px-1"></i>Data UBAS</a></li>
                        <li><a class="dropdown-item btn-hapus" href="#"><i class="fa-solid fa-ban fa-sm px-1"></i>Hapus Sub</a></li>
                    </ul>
                </div>
            </td>
        </tr>
    `);
}

// ================== EVENT HANDLER ==================
$('#addRow').on('click', addNewRow);

$('#example tbody').on('click', '.btn-sub', function(e) {
    e.preventDefault();
    addSubRow($(this).closest('tr')[0]);
});

$('#example tbody').on('click', '.btn-ubas', function(e) {
    e.preventDefault();
    openUbasModal($(this).closest('tr')[0]);
});

$('#example tbody').on('click', '.btn-hapus', function(e) {
    e.preventDefault();

    const $row = $(this).closest('tr');
    const kode = $row.find('.kode-ma').text();

    $('#example tbody tr').each(function() {
        if ($(this).find('.kode-ma').text().startsWith(kode + '.')) $(this).remove();
    });

    $row.remove();
    table.row($row).remove();

    if ($row.hasClass('row-divisi')) updateDivisiCodes();
});

// Tambah divisi pertama
addNewRow();
</script>





</body>

</html>