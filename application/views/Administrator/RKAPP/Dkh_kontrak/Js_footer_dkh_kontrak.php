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


<!-- ===================== TABEL DKH ===================== -->
<script>
const table = $('#example').DataTable({
    lengthChange: false,
    ordering: false,
    responsive: true,
    searching: false,
    paging: false,
    info: false,
    language: {
        emptyTable: "",
        zeroRecords: ""
    }
});

// ================== TAMBAH DIVISI ==================
function addNewRow() {
    const newRow = $(`
        <tr class="row-divisi">
            <td class="kode-ma"></td>
            <td><input style="width:100%" type="text" placeholder="Nama Divisi"></td>
            <td></td><td></td><td></td><td></td><td></td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-gears fa-lg px-1"></i> Aksi
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item btn-sub" href="#">
                            <i class="fa-solid fa-circle-plus fa-sm px-1"></i>Tambah Sub</a></li>
                        <li><a class="dropdown-item btn-hapus" href="#">
                            <i class="fa-solid fa-ban fa-sm px-1"></i>Hapus Divisi</a></li>
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

// ================== TAMBAH SUB DIVISI ==================
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

// ================== GENERATE SUB ROW ==================
function createSubRow(kode) {
    return $(`
        <tr class="row-sub">
            <td class="kode-ma">${kode}</td>
            <td><input style="width:100%" type="text" placeholder="Uraian Pekerjaan"></td>
            <td><input type="text" placeholder="Sat" style="width:100%"></td>
            <td><input type="text" placeholder="Qty" style="width:100%; text-align:right;"></td>
            <td><input type="text" class="unit-price" placeholder="Unit Price" style="width:100%; text-align:right;"></td>
            <td><input type="text" placeholder="Jumlah" style="width:100%; text-align:right; background-color:#E5E7EB;" readonly></td>
            <td><input style="width:100%" type="text" placeholder="Keterangan"></td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-gears fa-lg px-1"></i> Aksi
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item btn-ubas" href="#">
                            <i class="fa-solid fa-screwdriver-wrench fa-sm px-1"></i>Data UBAS</a></li>
                        <li><a class="dropdown-item btn-hapus" href="#">
                            <i class="fa-solid fa-ban fa-sm px-1"></i>Hapus Sub</a></li>
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

$('#example tbody').on('click', '.btn-hapus', function(e) {
    e.preventDefault();

    const $row = $(this).closest('tr');
    const kode = $row.find('.kode-ma').text();

    // hapus semua sub yang punya prefix kode ini
    $('#example tbody tr').each(function() {
        if ($(this).find('.kode-ma').text().startsWith(kode + '.')) $(this).remove();
    });

    $row.remove();
    table.row($row).remove();

    if ($row.hasClass('row-divisi')) updateDivisiCodes();
});

// Tambah divisi pertama saat load
addNewRow();
</script>
<!-- ===================== END BAGIAN STRUKTUR ===================== -->

<!-- ===================== SCRIPT MODAL UBAS ===================== -->
<script>
/* ===============================================================
   TOMBOL DATA UBAS — GET DATA DARI TABEL KE MODAL (PAKAI MODAL KAMU)
   =============================================================== */
$('#example tbody').on('click', '.btn-ubas', function(e) {
    e.preventDefault();

    const $subRow = $(this).closest('tr'); // baris sub yang diklik

    // ✅ Ambil data dari baris sub
    const kodeSub = $subRow.find('.kode-ma').text().trim(); // contoh: "1.2"
    const uraianSub = $subRow.find('input[placeholder="Uraian Pekerjaan"]').val() || '-';

    // ✅ Cari baris divisi induknya (row sebelumnya yang class .row-divisi)
    let kodeDivisi = '-',
        namaDivisi = '-';
    $subRow.prevAll('.row-divisi').each(function() {
        kodeDivisi = $(this).find('.kode-ma').text().trim();
        namaDivisi = $(this).find('input[placeholder="Nama Divisi"]').val() || '-';
        return false; // berhenti di divisi pertama yang ketemu
    });

    // ✅ Masukkan hasil ke elemen <span> dalam modal kamu
    $('#modalUbasKodeDivisi').text(kodeDivisi);
    $('#modalUbasNamaDivisi').text(namaDivisi);
    $('#modalUbasKodeSub').text(kodeSub);
    $('#modalUbasUraian').text(uraianSub);

    // ✅ Tampilkan modal fullscreen yang sudah kamu buat
    const ubasModal = new bootstrap.Modal(document.getElementById('modalDataUBAS'));
    ubasModal.show();
});
</script>

<!-- ===================== END SCRIPT MODAL UBAS ===================== -->

<!-- ===================== HITUNG JUMLAH OTOMATIS (FINAL + DECIMAL SUPPORT) ===================== -->
<script>
/* ===========================================================
   FINAL FIX — SMOOTH INPUT, DECIMAL ENABLED, AUTO FORMAT
   =========================================================== */

// 🔹 Ubah "Rp 1.234,56" → angka 1234.56
function parseRupiahToNumber(str) {
    if (!str) return 0;
    str = str.replace(/[^\d,]/g, '').replace(/\./g, '').replace(',', '.');
    return parseFloat(str) || 0;
}

// 🔹 Format angka → "Rp 1.234,56"
function formatRupiah(num) {
    if (isNaN(num)) num = 0;
    const parts = num.toFixed(2).split('.');
    let intPart = parts[0];
    let decPart = parts[1];
    intPart = intPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    return 'Rp ' + intPart + ',' + decPart;
}

// 🔹 Hitung Jumlah otomatis
function hitungJumlah($row) {
    const qtyVal = ($row.find('input[placeholder="Qty"]').val() || '0').replace(',', '.');
    const qty = parseFloat(qtyVal) || 0;
    const hargaStr = $row.find('.unit-price').val() || '0';
    const harga = parseRupiahToNumber(hargaStr);
    const total = qty * harga;

    const jumlahInput = $row.find('input[placeholder="Jumlah"]');
    jumlahInput.val(formatRupiah(total));
}

// 🔹 Input Unit Price (support desimal dan tetap smooth)
$(document).on('input', '.unit-price', function(e) {
    const input = this;
    let value = input.value;

    // Simpan posisi kursor sebelum diubah
    const cursorPos = input.selectionStart;
    const oldLength = value.length;

    // Biarkan user ketik koma dulu tanpa format
    if (value.endsWith(',')) return;

    // Ambil angka + koma (jaga agar desimal tidak hilang)
    let clean = value.replace(/[^0-9,]/g, '');

    // Kalau ada lebih dari satu koma, keep yang pertama
    if ((clean.match(/,/g) || []).length > 1) {
        const parts = clean.split(',');
        clean = parts[0] + ',' + parts[1];
    }

    // Pisahkan ribuan dan desimal
    let [intPart, decPart] = clean.split(',');
    let num = parseInt(intPart || '0', 10);
    if (isNaN(num)) num = 0;

    let formatted = new Intl.NumberFormat('id-ID').format(num);

    // Kalau user sedang nulis desimal → jangan ubah desimalnya
    if (typeof decPart !== 'undefined') {
        formatted += ',' + decPart.substring(0, 2); // max 2 digit desimal
    }

    input.value = 'Rp ' + formatted;

    // Hitung ulang jumlah otomatis
    hitungJumlah($(input).closest('tr'));

    // Perbaiki posisi kursor biar gak loncat
    const newLength = input.value.length;
    const diff = newLength - oldLength;
    input.setSelectionRange(cursorPos + diff, cursorPos + diff);
});

// 🔹 Saat Qty diketik → hitung ulang
$(document).on('input', 'input[placeholder="Qty"]', function() {
    hitungJumlah($(this).closest('tr'));
});

// 🔹 Saat baris baru ditambahkan (Add Sub / Divisi)
$(document).on('DOMNodeInserted', '#example tbody tr', function() {
    hitungJumlah($(this));
});

// 🔹 Jalankan hitung ulang saat halaman load
$(document).ready(function() {
    $('#example tbody tr').each(function() {
        hitungJumlah($(this));
    });
});
</script>
<!-- ===================== END FINAL + DECIMAL SUPPORT ===================== -->

<script>
/* ============================================================
   VALIDASI INPUT QTY — HANYA ANGKA DAN KOMA (ANTI HURUF/SIMBOL)
   ============================================================ */

// Saat user mengetik di kolom Qty
$(document).on('input', 'input[placeholder="Qty"]', function() {
    let val = $(this).val();

    // 🔒 Hapus semua karakter selain angka & koma
    val = val.replace(/[^0-9,]/g, '');

    // 🔒 Jika ada lebih dari satu koma, sisakan satu saja
    if ((val.match(/,/g) || []).length > 1) {
        const parts = val.split(',');
        val = parts[0] + ',' + parts[1];
    }

    // Update nilai input dengan hasil bersih
    $(this).val(val);

    // 🔁 Hitung ulang jumlah otomatis
    hitungJumlah($(this).closest('tr'));
});

// Saat user paste di kolom Qty
$(document).on('paste', 'input[placeholder="Qty"]', function(e) {
    let pasteData = (e.originalEvent || e).clipboardData.getData('text');
    // 🔒 Bersihkan dari huruf/simbol
    pasteData = pasteData.replace(/[^0-9,]/g, '');

    // 🔒 Hapus koma ganda
    const parts = pasteData.split(',');
    if (parts.length > 2) pasteData = parts[0] + ',' + parts[1];

    // Masukkan hasil bersih ke input
    $(this).val(pasteData);
    e.preventDefault();

    // 🔁 Hitung ulang jumlah otomatis
    hitungJumlah($(this).closest('tr'));
});

// Blokir langsung huruf/simbol saat diketik (prevent default)
$(document).on('keypress', 'input[placeholder="Qty"]', function(e) {
    const char = String.fromCharCode(e.which);
    // hanya izinkan angka dan koma
    if (!/[0-9,]/.test(char)) {
        e.preventDefault();
    }
});
</script>



</body>

</html>