<script>
$(document).ready(function() {
    $.ajaxSetup({
        data: {
            '<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>'
        }
    });

    $('#btn-simpan').click(function(e) {
        e.preventDefault();

        // --- VALIDASI INPUT ---
        let fields = [{
                id: '#nd_prg',
                label: 'Nama Program Pekerjaan'
            },
            {
                id: '#unit_prg',
                label: 'Unit Kerja'
            },
            {
                id: '#lokasi_prg',
                label: 'Lokasi Pekerjaan'
            },
            {
                id: '#date_awal_kontrak_prg',
                label: 'Start Date Kontrak'
            },
            {
                id: '#durasi_kontrak_prg',
                label: 'Durasi Kontrak'
            },
            {
                id: '#date_awal_pho_prg',
                label: 'Date PHO'
            },
            {
                id: '#durasi_pho_prg',
                label: 'Durasi PHO'
            },
            {
                id: '#date_awal_fho_prg',
                label: 'Date FHO'
            },
            {
                id: '#owner_prg',
                label: 'Owner'
            },
            {
                id: '#pusat_prg',
                label: 'PM Pusat'
            },
            {
                id: '#gs_prg',
                label: 'GS'
            }
        ];

        let isValid = true;
        let emptyFields = [];

        fields.forEach(function(field) {
            let value = $(field.id).val().trim();
            if (value === '' || value === 'dd/mm/yyyy' || value === '0') {
                isValid = false;
                emptyFields.push(field.label);
                $(field.id).addClass('is-invalid'); // kasih efek border merah
            } else {
                $(field.id).removeClass('is-invalid');
            }
        });

        if (!isValid) {
            let msg = `
        <div style="text-align:left; font-size:14px;">
            <p><i class="fa-solid fa-triangle-exclamation text-warning fa-lg"></i> 
            <b>Beberapa field belum diisi dengan lengkap:</b></p>
            <div style="background-color:#fff7e6; border-left:4px solid #ffb74d; padding:10px; border-radius:6px;">
                <ul style="margin:0; padding-left:18px; list-style-type: square; color:#444;">
                    ${emptyFields.map(f => `<li>${f}</li>`).join('')}
                </ul>
            </div>
            <p style="margin-top:10px; color:#777; font-size:13px;">
                Silakan lengkapi data di atas sebelum melanjutkan penyimpanan.
            </p>
        </div>
    `;

            swal({
                title: "⚠️ Data Belum Lengkap",
                html: msg,
                icon: "warning",
                buttons: {
                    confirm: {
                        text: "Periksa Kembali",
                        className: "btn btn-warning shadow-lg",
                    }
                },
            });
            return false; // hentikan proses
        }


        // --- KONFIRMASI SIMPAN ---
        swal({
            title: "Apakah anda yakin data sudah terisi dengan benar?",
            text: "Data akan disimpan ke sistem.",
            icon: "info",
            buttons: ["Batal", "Simpan Data"],
            dangerMode: false,
        }).then((willSave) => {
            if (willSave) {
                $.ajax({
                    url: "<?= base_url('Administrator/rkapp/data_program/data_program/insert'); ?>",
                    method: "POST",
                    data: $('#formData_tambah_program').serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $('#btn-simpan')
                            .prop('disabled', true)
                            .html(
                                '<i class="fa fa-spinner fa-spin"></i> Menyimpan...'
                            );
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            swal("Simpan Data", "Anda berhasil menyimpan data.",
                                "success");
                            $('#staticBackdrop-tambah-program').modal('hide');
                            $('#formData_tambah_program')[0].reset();

                            function formatDDMMYYYY(dateString) {
                                if (!dateString) return '';
                                const date = new Date(dateString);
                                if (isNaN(date))
                                    return dateString; // kalau bukan format tanggal valid, tampilkan apa adanya
                                const day = String(date.getDate()).padStart(2, '0');
                                const month = String(date.getMonth() + 1).padStart(
                                    2, '0');
                                const year = date.getFullYear();
                                return `${day}/${month}/${year}`;
                            }


                            // Jika DataTable sudah ada sebelumnya, hancurkan dulu
                            if ($.fn.DataTable.isDataTable('.tbl_program')) {
                                $('.tbl_program').DataTable().destroy();
                            }

                            // Inisialisasi DataTable baru
                            var table = $('.tbl_program').DataTable({
                                destroy: true, // aman dari reinit error
                                responsive: true,
                                lengthChange: false,
                                ordering: false,
                                processing: true,
                                ajax: {
                                    url: "<?= base_url('Administrator/Rkapp/Data_program/data_program/get_data_program'); ?>",
                                    dataSrc: 'data'
                                },
                                columns: [{
                                        data: 'kode_program',
                                        render: function(data) {
                                            return `<small>${data}</small>`;
                                        }
                                    },
                                    {
                                        data: 'nama_program',
                                        render: function(data) {
                                            return `<small>${data}</small>`;
                                        }
                                    },
                                    {
                                        data: 'nilai_kontrak',
                                        render: function(data) {
                                            return `<small>${$.fn.dataTable.render.number('.', ',', 0, 'Rp ').display(data)}</small>`;
                                        }
                                    },
                                    {
                                        data: null,
                                        render: function(data) {
                                            // Format tanggal mulai kontrak jadi dd/mm/yyyy
                                            const tglMulai =
                                                formatDDMMYYYY(data
                                                    .tanggal_mulai_kontrak
                                                );
                                            return `<small>${tglMulai} || ${data.durasi_kontrak} Hari</small>`;
                                        }
                                    },
                                    {
                                        data: null,
                                        render: function(data) {
                                            // Format tanggal mulai PHO jadi dd/mm/yyyy
                                            const tglPHO =
                                                formatDDMMYYYY(data
                                                    .tanggal_mulai_pho
                                                );
                                            return `<small>${tglPHO} || ${data.durasi_pho} Hari</small>`;
                                        }
                                    },
                                    {
                                        data: 'status_proyek',
                                        render: function(val) {
                                            if (val ===
                                                'Masa Pelaksanaan')
                                                return `<span class="badge text-bg-success text-white"><i class="fa-solid fa-recycle"></i> Masa Pelaksanaan</span>`;
                                            if (val ===
                                                'Masa Pemeliharaan')
                                                return `<span class="badge text-bg-warning text-dark"><i class="fa-solid fa-recycle"></i> Masa Pemeliharaan</span>`;
                                            if (val ===
                                                'Pekerjaan Selesai')
                                                return `<span class="badge text-bg-danger text-white"><i class="fa-solid fa-recycle"></i> Pekerjaan Selesai</span>`;
                                            if (val ===
                                                'Masa Perencanaan')
                                                return `<span class="badge text-bg-info text-white"><i class="fa-solid fa-recycle"></i> Masa Perencanaan</span>`;
                                            return `<span class="badge text-bg-secondary">${val}</span>`;
                                        }
                                    },
                                    {
                                        data: 'id_program',
                                        render: function(id) {
                                            return `
                                        <small>
                                            <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-sm btn-secondary"
                                                data-bs-toggle="modal" data-bs-target="#staticBackdrop-detail-program">
                                                <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Detail & Ubah Data">
                                                    <i class="fa-solid fa-users-viewfinder fa-lg px-1"></i>
                                                </a>
                                            </button>
        
                                                <a href="<?= base_url('Administrator/RKAPP/data_dkh_kontrak/data_dkh_kontrak'); ?>" 
                                                    class="btn btn-sm btn-success" 
                                                    data-bs-toggle="tooltip"
                                                    title="Halaman DKH Kontrak"> 
                                                    <i class="fa-solid fa-share-from-square"></i>
                                                </a>
                                            </div>
                                        </small>`;
                                        }
                                    }
                                ],
                                buttons: ['print', 'pdf', 'colvis'],
                                initComplete: function() {
                                    this.api().buttons().container()
                                        .appendTo($('.col-md-6:eq(0)',
                                            this.api().table()
                                            .container()));
                                }
                            });

                            // Tambahkan styling global biar lebih kecil dan rapi
                            $('.tbl_program').addClass('table-sm align-middle');
                            $('.dataTables_wrapper').find(
                                'label, input, select, .btn').addClass('small');
                        } else {
                            swal("Gagal",
                                "Data gagal disimpan, periksa kembali input Anda.",
                                "error");
                        }

                        // update token CSRF
                        if (response.csrf_token) {
                            $('#csrf_token').val(response.csrf_token);
                            $.ajaxSetup({
                                data: {
                                    '<?= $this->security->get_csrf_token_name(); ?>': response
                                        .csrf_token
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        swal("Terjadi Kesalahan", xhr.status + " " + xhr.statusText,
                            "error");
                    },
                    complete: function() {
                        $('#btn-simpan')
                            .prop('disabled', false)
                            .html(
                                '<i class="fa-regular fa-floppy-disk fa-lg px-1"></i> Simpan Data'
                            );
                    }
                });
            } else {
                swal("Batal", "Proses penyimpanan dibatalkan.", "error");
            }
        });
    });
});
</script>
<script>
$(document).ready(function() {

    // === Fungsi bantu format ===
    function formatDDMMYYYY(date) {
        const d = new Date(date);
        if (isNaN(d)) return '';
        const day = String(d.getDate()).padStart(2, '0');
        const month = String(d.getMonth() + 1).padStart(2, '0');
        const year = d.getFullYear();
        return `${day}/${month}/${year}`;
    }

    function parseDDMMYYYY(dateStr) {
        if (!dateStr || dateStr === 'dd/mm/yyyy') return null;
        const [day, month, year] = dateStr.split('/');
        return new Date(`${year}-${month}-${day}`);
    }

    function toISO(date) {
        return date.toISOString().split('T')[0];
    }

    // === Hitung End Date Kontrak ===
    $('#date_awal_kontrak_prg, #durasi_kontrak_prg').on('change', function() {
        let start = new Date($('#date_awal_kontrak_prg').val());
        let durasi = parseInt($('#durasi_kontrak_prg').val());
        if (!isNaN(start) && !isNaN(durasi)) {
            start.setDate(start.getDate() + durasi);
            $('#date_akhir_kontrak_prg').val(formatDDMMYYYY(start));
            // Set tanggal minimal PHO ke tanggal akhir kontrak
            $('#date_awal_pho_prg').attr('min', toISO(start));
        } else {
            $('#date_akhir_kontrak_prg').val('dd/mm/yyyy');
            $('#date_awal_pho_prg').removeAttr('min');
        }
    });

    // === Hitung End PHO ===
    $('#date_awal_pho_prg, #durasi_pho_prg').on('change', function() {
        let start = new Date($('#date_awal_pho_prg').val());
        let durasi = parseInt($('#durasi_pho_prg').val());
        if (!isNaN(start) && !isNaN(durasi)) {
            start.setDate(start.getDate() + durasi);
            $('#date_akhir_pho_prg').val(formatDDMMYYYY(start));
            // Set tanggal minimal FHO ke akhir PHO
            $('#date_awal_fho_prg').attr('min', toISO(start));
        } else {
            $('#date_akhir_pho_prg').val('dd/mm/yyyy');
            $('#date_awal_fho_prg').removeAttr('min');
        }
    });

    // === Update batas min PHO jika End Date Kontrak diubah manual ===
    $('#date_akhir_kontrak_prg').on('change', function() {
        let endDateText = $(this).val();
        let endDate = parseDDMMYYYY(endDateText);
        if (endDate) {
            $('#date_awal_pho_prg').attr('min', toISO(endDate));
        } else {
            $('#date_awal_pho_prg').removeAttr('min');
        }
    });

    // === Update batas min FHO jika End Date PHO diubah manual ===
    $('#date_akhir_pho_prg').on('change', function() {
        let endDateText = $(this).val();
        let endDate = parseDDMMYYYY(endDateText);
        if (endDate) {
            $('#date_awal_fho_prg').attr('min', toISO(endDate));
        } else {
            $('#date_awal_fho_prg').removeAttr('min');
        }
    });
});
</script>

<script>
$(document).ready(function() {

    function formatDDMMYYYY(dateString) {
        if (!dateString) return '';
        const date = new Date(dateString);
        if (isNaN(date)) return dateString; // kalau bukan format tanggal valid, tampilkan apa adanya
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
    }


    // Jika DataTable sudah ada sebelumnya, hancurkan dulu
    if ($.fn.DataTable.isDataTable('.tbl_program')) {
        $('.tbl_program').DataTable().destroy();
    }

    // Inisialisasi DataTable baru
    var table = $('.tbl_program').DataTable({
        destroy: true, // aman dari reinit error
        responsive: true,
        lengthChange: false,
        ordering: false,
        processing: true,
        ajax: {
            url: "<?= base_url('Administrator/Rkapp/Data_program/data_program/get_data_program'); ?>",
            dataSrc: 'data'
        },
        columns: [{
                data: 'kode_program',
                render: function(data) {
                    return `<small>${data}</small>`;
                }
            },
            {
                data: 'nama_program',
                render: function(data) {
                    return `<small>${data}</small>`;
                }
            },
            {
                data: 'nilai_kontrak',
                className: 'text-end',
                render: function(data) {
                    return `<small>${$.fn.dataTable.render.number('.', ',', 0, 'Rp ').display(data)}</small>`;
                }
            },
            {
                data: null,
                className: 'text-center',
                render: function(data) {
                    // Format tanggal mulai kontrak jadi dd/mm/yyyy
                    const tglMulai = formatDDMMYYYY(data.tanggal_mulai_kontrak);
                    return `<small>${tglMulai} || ${data.durasi_kontrak} Hari</small>`;
                }
            },
            {
                data: null,
                className: 'text-center',
                render: function(data) {
                    // Format tanggal mulai PHO jadi dd/mm/yyyy
                    const tglPHO = formatDDMMYYYY(data.tanggal_mulai_pho);
                    return `<small>${tglPHO} || ${data.durasi_pho} Hari</small>`;
                }
            },
            {
                data: 'status_proyek',
                render: function(val) {
                    if (val === 'Masa Pelaksanaan')
                        return `<span class="badge text-bg-success text-white"><i class="fa-solid fa-recycle"></i> Masa Pelaksanaan</span>`;
                    if (val === 'Masa Pemeliharaan')
                        return `<span class="badge text-bg-warning text-dark"><i class="fa-solid fa-recycle"></i> Masa Pemeliharaan</span>`;
                    if (val === 'Pekerjaan Selesai')
                        return `<span class="badge text-bg-danger text-white"><i class="fa-solid fa-recycle"></i> Pekerjaan Selesai</span>`;
                    if (val === 'Masa Perencanaan')
                        return `<span class="badge text-bg-info text-white"><i class="fa-solid fa-recycle"></i> Masa Perencanaan</span>`;
                    return `<span class="badge text-bg-secondary">${val}</span>`;
                }
            },
            {
                data: 'id_program',
                className: 'text-center',
                render: function(id) {
                    return `
                    <small>
                        <div class="btn-group" role="group">
                           <button type="button" class="btn btn-sm btn-secondary"
                                                data-bs-toggle="modal" data-bs-target="#staticBackdrop-detail-program">
                                                <a data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Detail & Ubah Data">
                                                    <i class="fa-solid fa-users-viewfinder fa-lg px-1"></i>
                                                </a>
                                            </button>
        
                            <a href="<?= base_url('Administrator/RKAPP/data_dkh_kontrak/data_dkh_kontrak'); ?>" 
                                class="btn btn-sm btn-success" 
                                data-bs-toggle="tooltip"
                                title="Halaman DKH Kontrak"> 
                                <i class="fa-solid fa-share-from-square"></i>
                            </a>
                        </div>
                    </small>`;
                }
            }
        ],
        buttons: ['print', 'pdf', 'colvis'],
        initComplete: function() {
            this.api().buttons().container()
                .appendTo($('.col-md-6:eq(0)', this.api().table().container()));
        }
    });

    // Tambahkan styling global biar lebih kecil dan rapi
    $('.tbl_program').addClass('table-sm align-middle');
    $('.dataTables_wrapper').find('label, input, select, .btn').addClass('small');
});
</script>

<script>
$(document).ready(function() {
    $.ajax({
        url: "<?= base_url('Administrator/Rkapp/Data_program/data_program/get_kode_program'); ?>",
        type: "GET",
        dataType: "json",
        success: function(res) {
            $('#kd_prg').val(res.kode_program);
        },
        error: function() {
            console.error('Gagal mengambil kode program');
        }
    });
});
</script>
<script>
$(document).ready(function() {
    $('[data-bs-toggle="tooltip"]').tooltip();
});
</script>