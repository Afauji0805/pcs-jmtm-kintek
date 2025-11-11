<!-- Vendor JS Files -->
<script src="<?php echo base_url(); ?>/assets/Landing-home/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/Landing-home/vendor/php-email-form/validate.js"></script>
<script src="<?php echo base_url(); ?>/assets/Landing-home/vendor/aos/aos.js"></script>
<script src="<?php echo base_url(); ?>/assets/Landing-home/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/Landing-home/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="<?php echo base_url(); ?>/assets/Landing-home/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/Landing-home/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/Landing-home/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/template-custom/js//hanya_angka.js"></script>

<!-- Main JS File -->
<script src="<?php echo base_url(); ?>/assets/Landing-home/js/main.js"></script>

<!-- DataTable bootstrap5 -->
<script src="<?php echo base_url(); ?>/assets/template-custom/js//jquery-3.7.0.js"></script>
<script src="<?php echo base_url(); ?>/assets/template-custom/js//jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/template-custom/js//dataTables.bootstrap5.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/template-custom/js//dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/template-custom/js//buttons.bootstrap5.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/template-custom/js//jszip.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/template-custom/js//pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/template-custom/js//vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>/assets/template-custom/js//buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/template-custom/js//buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/template-custom/js//buttons.colVis.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/template-custom/js//dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/template-custom/js//responsive.bootstrap5.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/template-custom/js///data_table5.js"></script>
<!-- Sweet Alert 2 -->
<script src="<?php echo base_url(); ?>/assets/template-custom/js//sweetalert2.all.min.js"></script>

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
$(document).ready(function() {
    $('[data-bs-toggle="tooltip"]').tooltip();
});
</script>


</body>

</html>