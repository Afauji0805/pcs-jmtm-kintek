$(document).ready(function () {
    var table = $('.example').DataTable({
        lengthChange: false,
        ordering: false,
        responsive: true,
        buttons: ['print', 'pdf', 'colvis'],
        initComplete: function () {
            this.api().buttons().container()
                .appendTo($('.col-md-6:eq(0)', this.api().table().container()));
        },
    });
});

$(document).ready(function () {
    var table = $('.example1').DataTable({
        lengthChange: true,
        ordering: false,
        responsive: true,
        initComplete: function () {
            this.api().buttons().container()
                .appendTo($('.col-md-6:eq(0)', this.api().table().container()));
        },
    });
});
