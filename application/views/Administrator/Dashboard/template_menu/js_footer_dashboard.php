<!-- Vendor JS Files -->
<script src="<?php echo base_url();?>/assets/Landing-home/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>/assets/Landing-home/vendor/php-email-form/validate.js"></script>
<script src="<?php echo base_url();?>/assets/Landing-home/vendor/aos/aos.js"></script>
<script src="<?php echo base_url();?>/assets/Landing-home/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?php echo base_url();?>/assets/Landing-home/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="<?php echo base_url();?>/assets/Landing-home/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?php echo base_url();?>/assets/Landing-home/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo base_url();?>/assets/Landing-home/vendor/isotope-layout/isotope.pkgd.min.js"></script>

<!-- jQuery -->
<script src="<?php echo base_url();?>/assets/plugins-lte//jquery/jquery.min.js"></script>

<!-- ChartJS -->
<script src="<?php echo base_url();?>/assets/plugins-lte/chart.js/Chart.min.js"></script>

<!-- Main JS File -->
<script src="<?php echo base_url();?>/assets/Landing-home/js/main.js"></script>

<script>
$(function() {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
                label: 'Digital Goods',
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,0.8)',
                pointRadius: false,
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [28, 48, 40, 19, 86, 27, 90]
            },
            {
                label: 'Electronics',
                backgroundColor: 'rgba(210, 214, 222, 1)',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: false,
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: [65, 59, 80, 81, 56, 55, 40]
            },
        ]
    }

    var areaChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: false
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: false,
                }
            }],
            yAxes: [{
                gridLines: {
                    display: false,
                }
            }]
        }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
        type: 'line',
        data: areaChartData,
        options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
    })


})
</script>

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

</body>

</html>