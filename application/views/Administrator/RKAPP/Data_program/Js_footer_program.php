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
<script src="<?php echo base_url();?>/assets/template-custom/js///data_table5.js"></script>
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


</body>

</html>