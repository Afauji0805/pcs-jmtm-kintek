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
                        url: "<?= base_url('Administrator/Rkapp/data_program/data_program/insert'); ?>",
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
                                reload_program_table();
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
        var tbl_program;

        function init_program_table() {
            tbl_program = $('.tbl_program').DataTable({
                destroy: true,
                responsive: false,
                processing: true,
                serverSide: true,
                lengthChange: false,
                ordering: false,

                ajax: {
                    url: "<?= base_url('Administrator/Rkapp/Data_program/data_program/get_data_program'); ?>",
                    type: "POST"
                },
                columns: [{
                        data: 0,
                        render: function(data) {
                            return `
                <small  title="${data}" class="ellipsis-200">
                    ${data}
                </small>
            `;
                        }
                    },
                    {
                        data: 1,
                        render: function(data) {
                            return `
                <small  title="${data}" class="ellipsis-200">
                    ${data}
                </small>
            `;
                        }
                    },
                    {
                        data: 2,
                        className: 'text-end',
                        render: function(data) {
                            return `<small >Rp ${(parseInt(data) || 0).toLocaleString('id-ID')}</small>`;
                        }
                    },
                    {
                        data: 3,
                        className: 'text-center',
                    },
                    {
                        data: 4,
                        className: 'text-center',

                    },
                    {
                        data: 5,
                        className: 'text-center',
                    },
                    {
                        data: 6,
                        className: 'text-center',
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
        }

        function reload_program_table() {
            if (tbl_program) tbl_program.ajax.reload(null, false);
        }

        $(document).ready(function() {
            init_program_table();
        });

    });
</script>

<script>
    function reload_program_table() {
        $('.tbl_program').DataTable().ajax.reload(null, false);
    }
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

<!-- ==================================================================================================================== -->
<script>
    $(document).ready(function() {

        // ubah berbagai format tanggal -> ISO yyyy-mm-dd (untuk input[type=date])
        function convertToDateInput(dateStr) {
            if (!dateStr) return '';
            dateStr = dateStr.trim();
            // if already ISO
            if (/^\d{4}-\d{2}-\d{2}$/.test(dateStr)) return dateStr;

            let m;
            if (m = dateStr.match(/^(\d{2})[\/-](\d{2})[\/-](\d{4})$/)) {
                return `${m[3]}-${m[2]}-${m[1]}`;
            }

            const d = new Date(dateStr);
            if (!isNaN(d)) {
                const y = d.getFullYear();
                const mm = String(d.getMonth() + 1).padStart(2, '0');
                const dd = String(d.getDate()).padStart(2, '0');
                return `${y}-${mm}-${dd}`;
            }
            console.warn('convertToDateInput: cannot parse dateStr=', dateStr);
            return '';
        }

        // format ISO yyyy-mm-dd -> dd/mm/yyyy for display (if needed)
        function formatToDDMMYYYYFromISO(iso) {
            if (!iso) return '';
            if (/^\d{4}-\d{2}-\d{2}$/.test(iso)) {
                const parts = iso.split('-');
                return `${parts[2]}/${parts[1]}/${parts[0]}`;
            }

            if (/^\d{2}[\/-]\d{2}[\/-]\d{4}$/.test(iso)) {
                return iso.replace(/\//g, '-');
            }
            return iso;
        }

        // dd-mm-yyyy or dd/mm/yyyy or yyyy-mm-dd -> returns Date object or null
        function parseToDateObj(dateStr) {
            if (!dateStr) return null;
            dateStr = dateStr.trim();
            if (/^\d{4}-\d{2}-\d{2}$/.test(dateStr)) {
                const p = dateStr.split('-');
                return new Date(p[0], p[1] - 1, p[2]);
            }
            let m;
            if (m = dateStr.match(/^(\d{2})[\/-](\d{2})[\/-](\d{4})$/)) {
                return new Date(m[3], m[2] - 1, m[1]);
            }
            const dd = new Date(dateStr);
            return isNaN(dd) ? null : dd;
        }

        function tambahHariFormat(tanggalMulai, jumlahHari) {
            const date = parseToDateObj(tanggalMulai);
            if (!date) return '';
            date.setDate(date.getDate() + Number(jumlahHari || 0));
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }

        function ubahKeISOfromDDMMYYYY(tanggalDDMMYYYY) {
            if (!tanggalDDMMYYYY) return '';
            const parts = tanggalDDMMYYYY.split(/[-\/]/);
            if (parts.length !== 3) return '';
            // parts could be dd,mm,yyyy OR yyyy,mm,dd
            if (parts[0].length === 4) return `${parts[0]}-${parts[1]}-${parts[2]}`; // already iso-like
            return `${parts[2]}-${parts[1].padStart(2,'0')}-${parts[0].padStart(2,'0')}`;
        }

        /* ----------------------------------- DETAIL ----------------------------------- */

        $(document).on('click', '.btn-detail-program', function() {
            const id_program = $(this).data('id');

            // reset text placeholders
            $('#staticBackdrop-detail-program small[id^="detail_"]').text('-');

            $.ajax({
                url: "<?= base_url('Administrator/Rkapp/Data_program/data_program/get_detail_program/'); ?>" +
                    id_program,
                type: "GET",
                dataType: "json",
                success: function(res) {
                    if (res.status === 'success') {
                        const d = res.data;

                        // isi modal detail (format dd/mm/yyyy)
                        function formatDateForDisplay(tgl) {
                            const o = parseToDateObj(tgl);
                            if (!o) return '-';
                            const dy = String(o.getDate()).padStart(2, '0');
                            const mo = String(o.getMonth() + 1).padStart(2, '0');
                            const yy = o.getFullYear();
                            return `${dy}/${mo}/${yy}`;
                        }

                        $('#detail_kode_program').text(d.kode_program || '-');
                        $('#detail_tanggal_program').text(formatDateForDisplay(d
                            .tanggal_program));
                        $('#detail_nama_program').text(d.nama_program || '-');
                        $('#detail_unit_kerja').text(d.unit_kerja || '-');
                        $('#detail_lokasi_pekerjaan').text(d.lokasi_pekerjaan || '-');
                        $('#detail_nilai_kontrak').text('Rp ' + parseInt(d.nilai_kontrak || 0)
                            .toLocaleString('id-ID'));
                        $('#detail_tanggal_mulai_kontrak').text(formatDateForDisplay(d
                            .tanggal_mulai_kontrak));
                        $('#detail_tanggal_selesai_kontrak').text(formatDateForDisplay(d
                            .tanggal_selesai_kontrak));
                        $('#detail_durasi_kontrak').text((d.durasi_kontrak || 0) + ' Hari');
                        $('#detail_tanggal_mulai_pho').text(formatDateForDisplay(d
                            .tanggal_mulai_pho));
                        $('#detail_tanggal_selesai_pho').text(formatDateForDisplay(d
                            .tanggal_selesai_pho));
                        $('#detail_durasi_pho').text((d.durasi_pho || 0) + ' Hari');
                        $('#detail_tanggal_fho').text(formatDateForDisplay(d.date_fho));
                        $('#detail_owner').text(d.owner || d.OWNER || '-');
                        $('#detail_pm_pusat').text(d.pm_pusat || '-');
                        $('#detail_gs').text(d.gs || '-');
                        $('#ubah_id_program').val(d.id_program || '');

                        $('#staticBackdrop-detail-program .btn-warning').data('id', d
                            .id_program || '');

                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: res.message,
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error ' + xhr.status,
                        text: xhr.statusText
                    });
                }
            });
        });

        /* ---------- Pindah ke modal ubah ---------- */

        $(document).on('click', '#staticBackdrop-detail-program .btn-warning', function() {

            const id_program = $(this).data('id') || $('#ubah_id_program').val();
            const data = {
                kode_program: $('#detail_kode_program').text().trim(),
                tanggal_program: $('#detail_tanggal_program').text().trim(), // dd/mm/yyyy
                nama_program: $('#detail_nama_program').text().trim(),
                unit_kerja: $('#detail_unit_kerja').text().trim(),
                lokasi_pekerjaan: $('#detail_lokasi_pekerjaan').text().trim(),
                nilai_kontrak: $('#detail_nilai_kontrak').text().trim().replace(/[^0-9]/g, ''),
                tanggal_mulai_kontrak: $('#detail_tanggal_mulai_kontrak').text().trim(), // dd/mm/yyyy
                durasi_kontrak: $('#detail_durasi_kontrak').text().replace('Hari', '').trim(),
                tanggal_selesai_kontrak: $('#detail_tanggal_selesai_kontrak').text()
                    .trim(), // dd/mm/yyyy
                tanggal_mulai_pho: $('#detail_tanggal_mulai_pho').text().trim(), // dd/mm/yyyy
                durasi_pho: $('#detail_durasi_pho').text().replace('Hari', '').trim(),
                tanggal_selesai_pho: $('#detail_tanggal_selesai_pho').text().trim(), // dd/mm/yyyy
                tanggal_fho: $('#detail_tanggal_fho').text().trim(), // dd/mm/yyyy
                owner: $('#detail_owner').text().trim(),
                pm_pusat: $('#detail_pm_pusat').text().trim(),
                gs: $('#detail_gs').text().trim()
            };

            $('#staticBackdrop-detail-program').modal('hide');

            setTimeout(function() {
                $('#ubah_id_program').val(id_program);

                // isi field di modal ubah
                $('#kd_ubah_program').val(data.kode_program);
                $('#ubah_tanggal_program').val(convertToDateInput(data
                    .tanggal_program)); // yyyy-mm-dd
                $('#ubah_nama_program').val(data.nama_program);
                $('#ubah_unit_kerja').val(data.unit_kerja);
                $('#ubah_lokasi_pekerjaan').val(data.lokasi_pekerjaan);
                $('#ubah_nilai_kontrak').val(data.nilai_kontrak || 0);
                $('#ubah_tanggal_mulai_kontrak').val(convertToDateInput(data
                    .tanggal_mulai_kontrak));
                $('#ubah_durasi_kontrak').val(data.durasi_kontrak || '');
                $('#ubah_tanggal_selesai_kontrak').val((data.tanggal_selesai_kontrak || '').replace(
                    /\//g, '-'));
                $('#ubah_tanggal_mulai_pho').val(convertToDateInput(data.tanggal_mulai_pho));
                $('#ubah_durasi_pho').val(data.durasi_pho || '');
                $('#ubah_tanggal_selesai_pho').val((data.tanggal_selesai_pho || '').replace(/\//g,
                    '-'));
                $('#ubah_tanggal_fho').val(convertToDateInput(data.tanggal_fho));
                $('#ubah_owner').val(data.owner);
                $('#ubah_pm_pusat').val(data.pm_pusat);
                $('#ubah_gs').val(data.gs);
                $('#ubah_tanggal_mulai_kontrak').trigger('change');
                $('#ubah_durasi_kontrak').trigger('change');
                $('#ubah_tanggal_mulai_pho').trigger('change');
                $('#ubah_durasi_pho').trigger('change');


                $('#staticBackdrop-ubah-program').modal('show');
            }, 350);
        });

        /* ---------- HITUNG OTOMATIS---------- */

        // kontrak -> selesai kontrak & set PHO min
        $('#ubah_tanggal_mulai_kontrak, #ubah_durasi_kontrak').on('change keyup', function() {
            const tglMulai = $('#ubah_tanggal_mulai_kontrak').val();
            const durasi = parseInt($('#ubah_durasi_kontrak').val());

            if (tglMulai && durasi && !isNaN(durasi)) {
                const tanggalSelesai = tambahHariFormat(tglMulai, durasi); // dd-mm-yyyy
                $('#ubah_tanggal_selesai_kontrak').val(tanggalSelesai);
                const tglSelesaiISO = ubahKeISOfromDDMMYYYY(tanggalSelesai);
                $('#ubah_tanggal_mulai_pho').val(tglSelesaiISO);
                $('#ubah_tanggal_mulai_pho').attr('min', tglSelesaiISO);
                $('#ubah_tanggal_fho').attr('min', tglSelesaiISO); // gunakan id modal ubah
            } else {
                $('#ubah_tanggal_selesai_kontrak').val('');
                $('#ubah_tanggal_mulai_pho').val('');
                $('#ubah_tanggal_mulai_pho').removeAttr('min');
                $('#ubah_tanggal_fho').removeAttr('min');
            }
        });

        // PHO -> selesai PHO & set FHO
        $('#ubah_tanggal_mulai_pho, #ubah_durasi_pho').on('change keyup', function() {
            const tglMulaiPHO = $('#ubah_tanggal_mulai_pho').val();
            const durasiPHO = parseInt($('#ubah_durasi_pho').val());

            if (tglMulaiPHO && durasiPHO && !isNaN(durasiPHO)) {
                const tanggalSelesaiPHO = tambahHariFormat(tglMulaiPHO, durasiPHO); // dd-mm-yyyy
                $('#ubah_tanggal_selesai_pho').val(tanggalSelesaiPHO);
                const tglFhoISO = ubahKeISOfromDDMMYYYY(tanggalSelesaiPHO);
                $('#ubah_tanggal_fho').val(tglFhoISO);
                $('#ubah_tanggal_fho').attr('min', tglFhoISO);
            } else {
                $('#ubah_tanggal_selesai_pho').val('');
                $('#ubah_tanggal_fho').val('');
                $('#ubah_tanggal_fho').removeAttr('min');
            }
        });

        /* ----------------------------------- UPDATE ----------------------------------- */

        $('#btn-update').on('click', function(e) {
            e.preventDefault();

            const form = $('#staticBackdrop-ubah-program form');
            const csrfName = form.find('input[type=hidden]').attr('name');
            const csrfHash = form.find('input[type=hidden]').val();

            const id_program = $('#ubah_id_program').val();

            const formData = {};
            formData[csrfName] = csrfHash;
            formData.id_program = id_program;
            formData.kode_program = $('#kd_ubah_program').val();
            formData.tanggal_program = $('#ubah_tanggal_program').val();
            formData.nama_program = $('#ubah_nama_program').val();
            formData.unit_kerja = $('#ubah_unit_kerja').val();
            formData.lokasi_pekerjaan = $('#ubah_lokasi_pekerjaan').val();
            formData.nilai_kontrak = $('#ubah_nilai_kontrak').val().replace(/[^\d]/g, '') || 0;
            formData.tanggal_mulai_kontrak = $('#ubah_tanggal_mulai_kontrak').val();
            formData.tanggal_selesai_kontrak = ubahKeISOfromDDMMYYYY($('#ubah_tanggal_selesai_kontrak')
                .val());
            formData.durasi_kontrak = $('#ubah_durasi_kontrak').val();
            formData.tanggal_mulai_pho = $('#ubah_tanggal_mulai_pho').val();
            formData.tanggal_selesai_pho = ubahKeISOfromDDMMYYYY($('#ubah_tanggal_selesai_pho').val());
            formData.durasi_pho = $('#ubah_durasi_pho').val();
            formData.date_fho = $('#ubah_tanggal_fho').val();
            formData.owner = $('#ubah_owner').val();
            formData.pm_pusat = $('#ubah_pm_pusat').val();
            formData.gs = $('#ubah_gs').val();

            $.ajax({
                url: "<?= base_url('Administrator/Rkapp/Data_program/data_program/update_program'); ?>",
                type: "POST",
                data: formData,
                dataType: "json",
                success: function(res) {

                    if (res.csrf_token) {
                        form.find('#csrf_token_ubah').val(res.csrf_token);
                    }

                    if (res.status === 'success') {

                        swal({
                            title: "Berhasil!",
                            text: res.message,
                            icon: "success",
                            timer: 1500,
                            buttons: false
                        }).then(() => {

                            $('#staticBackdrop-ubah-program').modal('hide');
                            reload_program_table();

                        });

                    } else {
                        swal({
                            title: "Gagal!",
                            text: res.message || "Gagal menyimpan data.",
                            icon: "error"
                        });
                    }

                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.statusText
                    });
                }
            });
        });



    });
</script>

<!-- ========================================================================================== -->

<script>
    $(document).ready(function() {
        $('[data-bs-toggle="tooltip"]').tooltip();
    });
</script>