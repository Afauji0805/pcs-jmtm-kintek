<script>
    var tbl_upah; // GLOBAL

    $(document).ready(function() {

        function init_upah_table() {
            tbl_upah = $('.example_ubah').DataTable({ // <-- FIX: SIMPAN INSTANCE
                destroy: true,
                responsive: false,
                processing: true,
                serverSide: true,
                lengthChange: false,
                ordering: false,

                ajax: {
                    url: "<?= base_url('Administrator/Master_data/Master_upah/Master_data_upah/get_data_upah'); ?>",
                    type: "POST"
                },

                columns: [{
                        data: 0,
                        className: "text-center",
                        render: function(data) {
                            return `
                          <small>
                              <span class="d-inline-block text-truncate" style="max-width:250px" title="${data}">
                                  ${data}
                              </span>
                          </small>`;
                        }
                    },

                    {
                        data: 1,
                        className: "text-start",
                        render: function(data) {
                            return `
                          <small>
                              <span class="d-inline-block text-truncate" style="max-width:250px" title="${data}">
                                  ${data}
                              </span>
                          </small>`;
                        }
                    },

                    {
                        data: 2,
                        className: "text-start",
                        render: function(data) {
                            return `
                          <small>
                              <span class="d-inline-block text-truncate" style="max-width:250px" title="${data}">
                                  ${data}
                              </span>
                          </small>`;
                        }
                    },

                    {
                        data: 3,
                        className: "text-center"
                    },
                    {
                        data: 4,
                        className: "text-center"
                    },
                    {
                        data: 5,
                        className: "text-center"
                    }
                ],

                buttons: ['print', 'pdf', 'colvis'],

                initComplete: function() {
                    this.api().buttons().container()
                        .appendTo($('.col-md-6:eq(0)', this.api().table().container()));
                }
            });
        }

        // Init pertama kali
        init_upah_table();
    });

    // 🔥 Global function untuk reload
    function reload_upah_table() {
        if (tbl_upah) {
            tbl_upah.ajax.reload(null, false);
        }
    }
</script>

<script>
    // tambahhh 
    $(document).ready(function() {

        // === Validasi Input ===
        function cekInput() {
            let uraian = $('#uraian_upah').val().trim();
            let satuan = $('#satuan_upah').val().trim();

            if (uraian !== '' && satuan !== '') {
                $('#link-simpan').prop('disabled', false);
            } else {
                $('#link-simpan').prop('disabled', true);
            }
        }

        cekInput();

        // Cek ulang
        $('#uraian_upah, #satuan_upah').on('keyup change', function() {
            cekInput();
        });

        // === Tombol Simpan Klik ===
        $(document).on('click', '#link-simpan', function(e) {
            e.preventDefault();

            let uraian = $('#uraian_upah').val().trim();
            let satuan = $('#satuan_upah').val().trim();
            let csrfName = $('#csrf_token_tambah').attr('name');
            let csrfHash = $('#csrf_token_tambah').val();

            if (uraian === '' || satuan === '') {
                swal({
                    title: "Data Belum Lengkap",
                    text: "Pastikan semua field sudah diisi dengan benar.",
                    icon: "warning",
                    button: "OK"
                });
                return;
            }

            swal({
                title: "Apakah anda yakin?",
                text: "Data upah akan disimpan ke database.",
                icon: "info",
                buttons: ["Batal", "Simpan Data"],
            }).then((willSave) => {
                if (willSave) {

                    $.ajax({
                        url: '<?= base_url('Administrator/Master_data/Master_upah/Master_data_upah/tambah') ?>',
                        type: "POST",
                        data: {
                            [csrfName]: csrfHash,
                            uraian_upah: uraian,
                            satuan_upah: satuan
                        },
                        dataType: "json",
                        success: function(res) {

                            // Update CSRF token
                            $('#csrf_token_tambah').val(res.csrf);

                            swal("Berhasil!", "Data upah telah disimpan.", "success");

                            // Reset form
                            $('#form-tambah-upah')[0].reset();

                            // Reload table
                            reload_upah_table();

                            // Tutup modal
                            $('#staticBackdrop-tambah-upah').modal('hide');
                        },
                        error: function() {
                            swal("Gagal!", "Terjadi kesalahan sistem.", "error");
                        }
                    });

                } else {
                    swal("Batal Menyimpan", "Silakan periksa kembali data anda.", "error");
                }
            });
        });

    });




    //   tombol togglel aktif non aktif
    $(document).on('click', '.btn-toggle-status', function(e) {
        e.preventDefault();

        const btn = $(this);
        const idUpah = btn.data('id');
        const currentStatus = btn.data('status');

        const actionText = currentStatus === 'Active' ? 'Menon-Aktifkan' : 'Mengaktifkan';
        const newStatus = currentStatus === 'Active' ? 'Non-Active' : 'Active';

        const statusSpan = $('#status-' + idUpah);

        swal({
            title: `Apakah anda yakin ingin ${actionText} data ini?`,
            icon: "warning",
            buttons: ["Batal", actionText],
            dangerMode: currentStatus === 'Active',
        }).then((willChange) => {
            if (willChange) {
                $.ajax({
                    url: "<?= site_url('Administrator/Master_data/Master_upah/Master_data_upah/toggle_status') ?>",
                    type: "POST",
                    data: {
                        id_upah: idUpah,
                        status: newStatus,
                        "<?= $this->security->get_csrf_token_name(); ?>": "<?= $this->security->get_csrf_hash(); ?>"
                    },
                    success: function(response) {
                        // Update ---->
                        if (newStatus === 'Active') {
                            statusSpan.removeClass('text-bg-secondary').addClass('text-bg-success');
                            statusSpan.html('<i class="fa-solid fa-recycle fa-lg"></i> Active');

                            btn.removeClass('btn-success').addClass('btn-danger');
                            btn.data('status', 'Active');
                            btn.find('i').removeClass('fa-check').addClass('fa-ban');
                            btn.attr('title', 'Non-Aktifkan');
                        } else {
                            statusSpan.removeClass('text-bg-success').addClass('text-bg-secondary');
                            statusSpan.html('<i class="fa-solid fa-ban fa-lg"></i> Non-Active');

                            btn.removeClass('btn-danger').addClass('btn-success');
                            btn.data('status', 'Non-Active');
                            btn.find('i').removeClass('fa-ban').addClass('fa-check');
                            btn.attr('title', 'Aktifkan');
                        }

                        swal("Berhasil!", `Data berhasil di ${actionText}.`, "success");
                    },
                    error: function() {
                        swal("Gagal!", "Terjadi kesalahan. Silahkan coba lagi.", "error");
                    }
                });
            } else {
                swal("Batal!", "Status data tetap sama.", "info");
            }
        });
    });;

    // detail
    $(document).on('click', '.btn-detail', function() {
        var idUpah = $(this).data('id');

        $.ajax({
            url: "<?= site_url('Administrator/Master_data/Master_upah/Master_data_upah/get_detail_upah') ?>",
            type: "GET",
            data: {
                id_upah: idUpah
            },
            dataType: "json",
            success: function(data) {
                // update ---> modal Detail
                $('#kode-upah').text(data.kode_upah);
                $('#uraian-upah').text(data.uraian_upah);
                $('#satuan-upah').text(data.satuan_upah);
                $('#status-upah').html(`<span class="badge ${data.status_upah === 'Active' ? 'text-bg-success' : 'text-bg-secondary'}">
                                        <i class="fa-solid ${data.status_upah === 'Active' ? 'fa-recycle' : 'fa-ban'} fa-lg"></i>
                                        &nbsp; ${data.status_upah}
                                     </span>`);
                $('#created-at').text(data.created_at);
                $('#updated-at').text(data.updated_at || '-');
                $('#insert-by').text(data.insert_by);
                $('#update-by').text(data.update_by || '-');

                // **Set data-id di modal Detail**
                $('#staticBackdrop-detail-upah').data('id', data.id_upah);

                // Load tabel detail supplier
                loadTable(data.kode_upah);
                reload_upah_table();
            },

            error: function() {
                swal("Gagal!", "Terjadi kesalahan. Silahkan coba lagi.", "error");
            }
        });
    });

    // Ubah
    $(document).on('click', '#btn-detail-ubah', function(e) {

        e.preventDefault();

        var idUpah = $('#staticBackdrop-detail-upah').data('id');
        if (!idUpah) {
            swal("Error!", "ID upah tidak ditemukan.", "error");
            return;
        }

        $.ajax({
            url: "<?= site_url('Administrator/Master_data/Master_upah/Master_data_upah/get_detail_upah') ?>",
            type: "GET",
            data: {
                id_upah: idUpah
            },
            dataType: "json",
            success: function(data) {
                if (data.error) {
                    swal("Gagal!", data.error, "error");
                    return;
                }

                // isi form ---> modal Ubah
                $('#id_ubah_upah').val(data.id_upah);
                $('#kode_ubah_upah').val(data.kode_upah);
                $('#uraian_ubah_upah').val(data.uraian_upah);
                $('#satuan_ubah_upah').val(data.satuan_upah);

                // --> show modal
                $('#staticBackdrop-ubah-upah').modal('show');
            },
            error: function() {
                swal("Gagal!", "Terjadi kesalahan saat mengambil data.", "error");
            }
        });
    });

    // Simpan 
    $(document).on('click', '#link-ubah', function(e) {
        $.ajaxSetup({
            data: {
                '<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>'
            }
        });
        e.preventDefault();
        swal({
            title: "Apakah anda yakin data sudah terisi dengan benar?",
            text: "Proses Ubah Data",
            icon: "warning",
            buttons: ["Batal", "Ubah Data"],
            dangerMode: true
        }).then((willUpdate) => {
            if (willUpdate) {
                var idUpah = $('#id_ubah_upah').val();
                if (!idUpah) {
                    swal("Error!", "ID upah tidak ditemukan.", "error");
                    return;
                }

                $.ajax({
                    url: "<?= site_url('Administrator/Master_data/Master_upah/Master_data_upah/update_upah') ?>",
                    type: "POST",
                    data: {
                        id_upah: idUpah,
                        uraian_upah: $('#uraian_ubah_upah').val(),
                        satuan_upah: $('#satuan_ubah_upah').val(),
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.status === 'success') {
                            swal('Ubah Data', 'Anda berhasil mengubah data. :)', 'success').then(() => {
                                // tutup modal Ubah
                                $('#staticBackdrop-ubah-upah').modal('hide');

                                // update isi modal Detail secara langsung
                                $('#uraian-upah').text($('#uraian_ubah_upah').val());
                                $('#satuan-upah').text($('#satuan_ubah_upah').val());
                            });

                            if (response.csrf_token) {
                                $('#csrf_token_ubah').val(response.csrf_token);
                                $.ajaxSetup({
                                    data: {
                                        '<?= $this->security->get_csrf_token_name(); ?>': response
                                            .csrf_token
                                    }
                                });
                            }
                        } else {
                            swal("Gagal!", "Terjadi kesalahan server.", "error");
                        }
                    },
                    error: function() {
                        swal("Gagal!", "Terjadi kesalahan saat menyimpan.", "error");
                    }
                });
            } else {
                swal('Batal Mengubah', 'Silahkan isi data dengan lengkap', 'error');
            }
        });
    });

    // tutup tombol realod
    $(document).on('click', '#btn-tutup-detail', function() {
        // Tutup modal
        $('#staticBackdrop-detail-upah').modal('hide');
        reload_upah_table();
    });

    // Saat tombol "Tambah Detail Upah Per-Supplier" diklik
    $(document).on('click', '.btn-detail-upah', function() {
        const idUpah = $(this).data('id'); // ambil id_upah
        const kodeUpah = $(this).data('kode');


        // Ambil data master upah via AJAX
        $.ajax({
            url: "<?= site_url('Administrator/Master_data/Master_upah/Master_data_upah/get_detail_upah') ?>",
            type: "GET",
            data: {
                id_upah: idUpah
            },
            dataType: "json",
            success: function(data) {
                if (data.error) {
                    swal("Gagal!", data.error, "error");
                    return;
                }

                // Set data di modal
                $('#hidden_id_upah').val(idUpah);
                $('#hidden_kode_upah').val(data.kode_upah);
                $('#kode-upah-suplier').text(data.kode_upah);
                $('#uraian-upah-suplier').text(data.uraian_upah);
                $('#satuan-upah-suplier').text(data.satuan_upah);

                // Status
                const statusBadge = data.status_upah === 'Active' ?
                    '<span class="badge text-bg-success"><i class="fa-solid fa-recycle fa-lg"></i>&nbsp;Active</span>' :
                    '<span class="badge text-bg-secondary"><i class="fa-solid fa-ban fa-lg"></i>&nbsp;Non-Active</span>';
                $('#status-upah-suplier').html(statusBadge);

                // Kode otomatis supplier baru
                $('#kode_otomatis_persuplier').val(data.kode_upah + ".1");

                // Load tabel detail supplier
                loadDetailTable(data.kode_upah);
                reload_upah_table();
                // Tampilkan modal
                $('#staticBackdrop-tambah-detail-upah-supplier').modal('show');
            },
            error: function() {
                swal("Error!", "Gagal mengambil data dari server.", "error");
            }
        });
    });


    // ambil kode supplier dan nama suplier otomatis ketika kode dipilih
    $(document).ready(function() {
        // ambil daftar supplier saat halaman siap
        $.ajax({
            url: "<?= site_url('Administrator/Master_data/Master_upah/Master_data_upah/get_supplier_list') ?>",
            type: "GET",
            dataType: "json",
            success: function(data) {
                let options = '';
                data.forEach(function(item) {
                    options += `<option value="${item.kode_supplier}">${item.kode_supplier} || ${item.nama_supplier}</option>`;
                });
                $('#datalistOptions_supplier').html(options);
            },
            error: function() {
                console.error("Gagal memuat data supplier.");
            }
        });

        // ketika kode supplier dipilih
        $('#search_supplier_upah').on('input', function() {
            const kode = $(this).val();
            let namaSupplier = '';

            // cari option yang sesuai kode
            $('#datalistOptions_supplier option').each(function() {
                if ($(this).val() === kode) {
                    const teks = $(this).text();
                    const parts = teks.split('||');
                    if (parts.length > 1) {
                        namaSupplier = parts[1].trim(); // ambil bagian nama saja
                    }
                    return false; // hentikan loop
                }
            });

            // isi nama supplier ke kolom
            $('#nama_detail_supplier').val(namaSupplier);
        });
    });

    // curr
    $(document).ready(function() {

        // === otomatis isi tanggal sekarang di kolom "Date (Now)" ===
        function setCurrentDate() {
            const today = new Date();

            // Format ke dd/mm/yyyy
            const day = String(today.getDate()).padStart(2, '0');
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const year = today.getFullYear();

            const formatted = `${day}/${month}/${year}`;
            $('#date_detail_supplier').val(formatted);
        }

        // panggil saat halaman siap
        setCurrentDate();

        // kalau kamu mau tanggal reset ulang tiap kali modal dibuka:
        $('#staticBackdrop-tambah-detail-upah-supplier').on('shown.bs.modal', function() {
            setCurrentDate();
        });

        // hanya izinkan angka di kolom input harga
        $('#harsat_detail_supplier').on('keypress', function(e) {
            const charCode = e.which ? e.which : e.keyCode;
            // hanya angka dan backspace yang boleh
            if (charCode !== 8 && (charCode < 48 || charCode > 57)) {
                e.preventDefault();
            }
        });

        // ketika nilai berubah, update kolom currency
        $('#harsat_detail_supplier').on('input', function() {
            let value = $(this).val().replace(/\D/g, ''); // hanya angka

            // format ribuan
            const formatted = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            // tampilkan ke kolom currency
            $('#curr_detail_supplier').val('Rp ' + (formatted || '0'));
        });
    });


    // reset form
    $(document).ready(function() {
        // Reset form tambah detail upah persupplier
        $('#staticBackdrop-tambah-detail-upah-supplier').on('hidden.bs.modal', function() {
            // Reset semua input dan teks di dalam modal
            $(this).find('input[type="text"], input[type="number"]').val('');
            $(this).find('#kode-upah-suplier, #uraian-upah-suplier, #satuan-upah-suplier').text('');
            $(this).find('#search_supplier_upah').val('');
            $(this).find('#nama_detail_supplier').val('');
            $(this).find('#harsat_detail_supplier').val('');
            $(this).find('#curr_detail_supplier').val('');
            $(this).find('#date_detail_supplier').val(new Date().toLocaleDateString('id-ID'));
        });

        // Reset form modal tambah upah
        $('#staticBackdrop-tambah-upah').on('hidden.bs.modal', function() {
            $('#uraian_upah').val('');
            $('#satuan_upah').val('');
        });

    });


    // tambah suplier
    $(document).on('click', '#link-tambah-tabel-persuplier', function(e) {
        const kodeUpah = $('#hidden_kode_upah').val().trim() || $('#kode-upah-suplier').text().trim();
        const kodeSupplier = $('#search_supplier_upah').val().trim();
        const namaSupplier = $('#nama_detail_supplier').val().trim();
        const hargaSatuan = $('#harsat_detail_supplier').val().trim();

        if (!kodeUpah || !kodeSupplier || !namaSupplier || !hargaSatuan) {
            swal("Data Belum Lengkap", "Harap isi semua kolom sebelum menyimpan!", "warning");
            return;
        }
        // 
        swal({
            title: "Tambahkan ke tabel test data?",
            text: "Pastikan data sudah benar.",
            type: "info",
            showCancelButton: true,
            confirmButtonText: "Ya, Simpan!",
            cancelButtonText: "Batal"
        }).then((result) => {

            if (result.value) {

                $.ajax({
                    url: "<?= site_url('Administrator/Master_data/Master_upah/Master_data_upah/simpan_detail_tabel_persupplier') ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                        kode_upah: kodeUpah,
                        kode_supplier: kodeSupplier,
                        harga_satuan: hargaSatuan,
                        "<?= $this->security->get_csrf_token_name(); ?>": "<?= $this->security->get_csrf_hash(); ?>"
                    },
                    success: function(res) {
                        if (res.status === 'success') {

                            swal("Berhasil!", res.message, "success");
                            loadDetailTable(kodeUpah);
                            updateSupplierBadge(); // update badge otomatis
                            reload_upah_table();
                            // Reset field
                            $('#search_supplier_upah').val('');
                            $('#nama_detail_supplier').val('');
                            $('#harsat_detail_supplier').val('');
                            $('#curr_detail_supplier').val('Rp 0');

                        } else {
                            swal("Gagal!", res.message, "error");
                        }
                    },
                    error: function() {
                        swal("Gagal!", "Terjadi kesalahan saat menyimpan data.", "error");
                    }
                });

            } else if (result.dismiss === 'cancel') {
                swal("Dibatalkan", "Data tidak disimpan.", "error");
            }

        });

    });

    // Fungsi load tabel detail supplier
    function loadTable(kodeUpah) {
        $.ajax({
            url: "<?= site_url('Administrator/Master_data/Master_upah/Master_data_upah/get_detail_tabel_persuplier') ?>",
            type: "GET",
            data: {
                kode_upah: kodeUpah
            },
            dataType: "json",
            success: function(res) {
                let tbody = '';
                if (res.status === 'success' && res.data.length > 0) {
                    res.data.forEach(function(row) {
                        tbody += `
                            <tr>
                                <td class="text-center">${row.kd_detail_master_ubas}</td>
                                <td class="text-center">${row.kode_supplier}</td>
                                <td>${row.nama_supplier || '-'}</td>
                                <td class="text-end">${row.harsat_detail_master_ubas}</td>
                                <td class="text-center">${row.date_detail}</td>
                            </tr>
                        `;
                    });
                } else {
                    tbody = '<tr><td colspan="6" class="text-center text-muted">Belum ada data</td></tr>';
                }
                $('#tabel-detail').html(tbody);
            },
            error: function() {
                $('#tabel-detail').html('<tr><td colspan="6" class="text-center text-danger">Gagal memuat data</td></tr>');
            }
        });
    }

    // Fungsi load tabel detail supplier
    function loadDetailTable(kodeUpah) {
        console.log('angga', kodeUpah);

        $.ajax({
            url: "<?= site_url('Administrator/Master_data/Master_upah/Master_data_upah/get_detail_tabel_persuplier') ?>",
            type: "GET",
            data: {
                kode_upah: kodeUpah
            },
            dataType: "json",
            success: function(res) {
                let tbody = '';
                if (res.status === 'success' && res.data.length > 0) {
                    res.data.forEach(function(row) {
                        tbody += `
                            <tr>
                                <td class="text-center">${row.kd_detail_master_ubas}</td>
                                <td class="text-center">${row.kode_supplier}</td>
                                <td>${row.nama_supplier || '-'}</td>
                                <td class="text-end">${row.harsat_detail_master_ubas}</td>
                                <td class="text-center">${row.date_detail}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-danger hapus-detail" data-id="${row.kd_detail_master_ubas}" data-kode="${kodeUpah}">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    tbody = '<tr><td colspan="6" class="text-center text-muted">Belum ada data</td></tr>';
                }
                $('#tabel-detail-persupplier').html(tbody);
            },
            error: function() {
                $('#tabel-detail-persupplier').html('<tr><td colspan="6" class="text-center text-danger">Gagal memuat data</td></tr>');
            }
        });
    }

    // Tombol hapus detail supplier
    $(document).on('click', '.hapus-detail', function() {
        const idDetail = $(this).data('id');
        const kodeUpah = $(this).data('kode'); // untuk reload tabel

        if (!idDetail) {
            swal("Error!", "ID detail tidak ditemukan.", "error");
            return;
        }

        swal({
            title: "Yakin ingin menghapus?",
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: "<?= site_url('Administrator/Master_data/Master_upah/Master_data_upah/hapus_detail_supplier') ?>",
                    type: "POST",
                    data: {
                        id_upah_detail: idDetail
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.status === 'success') {
                            swal("Berhasil!", "Data berhasil dihapus.", "success");
                            loadDetailTable(kodeUpah); // refresh tabel
                            updateSupplierBadge(kodeUpah); // update badge otomatis
                            reload_upah_table();
                        } else {
                            swal("Gagal!", res.message || "Gagal menghapus data", "error");
                        }
                    },
                    error: function(err) {
                        swal("Error!", "Terjadi kesalahan server.", "error");
                        console.log(err);
                    }
                });
            }
        });
    });

    function updateSupplierBadge(kodeUpah) {
        $.getJSON("<?= site_url('Administrator/Master_data/Master_upah/Master_data_upah/count_supplier/') ?>" + kodeUpah, function(data) {
            let badge = $('#badge-supplier-' + kodeUpah);
            if (data.jumlah > 0) {
                badge.html(`<i class="fa-solid fa-recycle fa-lg"></i> ${data.jumlah} Supplier`);
                badge.removeClass('text-bg-danger').addClass('text-bg-info');
            } else {
                badge.html(`<i class="fa-solid fa-recycle fa-lg"></i> 0 Supplier`);
                badge.removeClass('text-bg-info').addClass('text-bg-danger');
            }
        });
    }
</script>