<script>
    var tbl_subkon; // GLOBAL

    $(document).ready(function() {

        function init_subkon_table() {
            tbl_subkon = $('.example_ubah').DataTable({ // <-- FIX: SIMPAN INSTANCE
                destroy: true,
                responsive: false,
                processing: true,
                serverSide: true,
                lengthChange: false,
                ordering: false,

                ajax: {
                    url: "<?= base_url('Administrator/Master_data/Master_subkon/Master_data_subkon/get_data_subkon'); ?>",
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
        init_subkon_table();
    });

    // 🔥 Global function untuk reload
    function reload_subkon_table() {
        if (tbl_subkon) {
            tbl_subkon.ajax.reload(null, false);
        }
    }
</script>

<script>
    // tambahhh 
    $(document).ready(function() {

        // === Validasi Input ===
        function cekInput() {
            let uraian = $('#uraian_subkon').val().trim();
            let satuan = $('#satuan_subkon').val().trim();

            if (uraian !== '' && satuan !== '') {
                $('#link-simpan').prop('disabled', false);
            } else {
                $('#link-simpan').prop('disabled', true);
            }
        }

        cekInput();

        // Cek ulang
        $('#uraian_subkon, #satuan_subkon').on('keyup change', function() {
            cekInput();
        });

        // === Tombol Simpan Klik ===
        $(document).on('click', '#link-simpan', function(e) {
            e.preventDefault();

            let uraian = $('#uraian_subkon').val().trim();
            let satuan = $('#satuan_subkon').val().trim();
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
                text: "Data subkon akan disimpan ke database.",
                icon: "info",
                buttons: ["Batal", "Simpan Data"],
            }).then((willSave) => {
                if (willSave) {

                    $.ajax({
                        url: '<?= base_url('Administrator/Master_data/Master_subkon/Master_data_subkon/tambah') ?>',
                        type: "POST",
                        data: {
                            [csrfName]: csrfHash,
                            uraian_subkon: uraian,
                            satuan_subkon: satuan
                        },
                        dataType: "json",
                        success: function(res) {

                            // Update CSRF token
                            $('#csrf_token_tambah').val(res.csrf);

                            swal("Berhasil!", "Data subkon telah disimpan.", "success");

                            // Reset form
                            $('#form-tambah-subkon')[0].reset();

                            // Reload table
                            reload_subkon_table();

                            // Tutup modal
                            $('#staticBackdrop-tambah-subkon').modal('hide');
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
        const idSubkon = btn.data('id');
        const currentStatus = btn.data('status');

        const actionText = currentStatus === 'Active' ? 'Menon-Aktifkan' : 'Mengaktifkan';
        const newStatus = currentStatus === 'Active' ? 'Non-Active' : 'Active';

        const statusSpan = $('#status-' + idSubkon);

        swal({
            title: `Apakah anda yakin ingin ${actionText} data ini?`,
            icon: "warning",
            buttons: ["Batal", actionText],
            dangerMode: currentStatus === 'Active',
        }).then((willChange) => {
            if (willChange) {
                $.ajax({
                    url: "<?= site_url('Administrator/Master_data/Master_subkon/Master_data_subkon/toggle_status') ?>",
                    type: "POST",
                    data: {
                        id_subkon: idSubkon,
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
        var idSubkon = $(this).data('id');

        $.ajax({
            url: "<?= site_url('Administrator/Master_data/Master_subkon/Master_data_subkon/get_detail_subkon') ?>",
            type: "GET",
            data: {
                id_subkon: idSubkon
            },
            dataType: "json",
            success: function(data) {
                // update ---> modal Detail
                $('#kode-subkon').text(data.kode_subkon);
                $('#uraian-subkon').text(data.uraian_subkon);
                $('#satuan-subkon').text(data.satuan_subkon);
                $('#status-subkon').html(`<span class="badge ${data.status_subkon === 'Active' ? 'text-bg-success' : 'text-bg-secondary'}">
                                        <i class="fa-solid ${data.status_subkon === 'Active' ? 'fa-recycle' : 'fa-ban'} fa-lg"></i>
                                        &nbsp; ${data.status_subkon}
                                     </span>`);
                $('#created-at').text(data.created_at);
                $('#updated-at').text(data.updated_at || '-');
                $('#insert-by').text(data.insert_by);
                $('#update-by').text(data.update_by || '-');

                // **Set data-id di modal Detail**
                $('#staticBackdrop-detail-subkon').data('id', data.id_subkon);

                // Load tabel detail supplier
                loadTable(data.kode_subkon);
                reload_subkon_table();
            },

            error: function() {
                swal("Gagal!", "Terjadi kesalahan. Silahkan coba lagi.", "error");
            }
        });
    });

    // Ubah
    $(document).on('click', '#btn-detail-ubah', function(e) {

        e.preventDefault();

        var idSubkon = $('#staticBackdrop-detail-subkon').data('id');
        if (!idSubkon) {
            swal("Error!", "ID subkon tidak ditemukan.", "error");
            return;
        }

        $.ajax({
            url: "<?= site_url('Administrator/Master_data/Master_subkon/Master_data_subkon/get_detail_subkon') ?>",
            type: "GET",
            data: {
                id_subkon: idSubkon
            },
            dataType: "json",
            success: function(data) {
                if (data.error) {
                    swal("Gagal!", data.error, "error");
                    return;
                }

                // isi form ---> modal Ubah
                $('#id_ubah_subkon').val(data.id_subkon);
                $('#kode_ubah_subkon').val(data.kode_subkon);
                $('#uraian_ubah_subkon').val(data.uraian_subkon);
                $('#satuan_ubah_subkon').val(data.satuan_subkon);

                // --> show modal
                $('#staticBackdrop-ubah-subkon').modal('show');
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
                var idSubkon = $('#id_ubah_subkon').val();
                if (!idSubkon) {
                    swal("Error!", "ID subkon tidak ditemukan.", "error");
                    return;
                }

                $.ajax({
                    url: "<?= site_url('Administrator/Master_data/Master_subkon/Master_data_subkon/update_subkon') ?>",
                    type: "POST",
                    data: {
                        id_subkon: idSubkon,
                        uraian_subkon: $('#uraian_ubah_subkon').val(),
                        satuan_subkon: $('#satuan_ubah_subkon').val(),
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.status === 'success') {
                            swal('Ubah Data', 'Anda berhasil mengubah data. :)', 'success').then(() => {
                                // tutup modal Ubah
                                $('#staticBackdrop-ubah-subkon').modal('hide');

                                // update isi modal Detail secara langsung
                                $('#uraian-subkon').text($('#uraian_ubah_subkon').val());
                                $('#satuan-subkon').text($('#satuan_ubah_subkon').val());
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
        $('#staticBackdrop-detail-subkon').modal('hide');
        reload_subkon_table();
    });

    // Saat tombol "Tambah Detail Subkon Per-Supplier" diklik
    $(document).on('click', '.btn-detail-subkon', function() {
        const idSubkon = $(this).data('id'); // ambil id_subkon
        const kodeSubkon = $(this).data('kode');


        // Ambil data master subkon via AJAX
        $.ajax({
            url: "<?= site_url('Administrator/Master_data/Master_subkon/Master_data_subkon/get_detail_subkon') ?>",
            type: "GET",
            data: {
                id_subkon: idSubkon
            },
            dataType: "json",
            success: function(data) {
                if (data.error) {
                    swal("Gagal!", data.error, "error");
                    return;
                }

                // Set data di modal
                $('#hidden_id_subkon').val(idSubkon);
                $('#hidden_kode_subkon').val(data.kode_subkon);
                $('#kode-subkon-suplier').text(data.kode_subkon);
                $('#uraian-subkon-suplier').text(data.uraian_subkon);
                $('#satuan-subkon-suplier').text(data.satuan_subkon);

                // Status
                const statusBadge = data.status_subkon === 'Active' ?
                    '<span class="badge text-bg-success"><i class="fa-solid fa-recycle fa-lg"></i>&nbsp;Active</span>' :
                    '<span class="badge text-bg-secondary"><i class="fa-solid fa-ban fa-lg"></i>&nbsp;Non-Active</span>';
                $('#status-subkon-suplier').html(statusBadge);

                // Kode otomatis supplier baru
                $('#kode_otomatis_persuplier').val(data.kode_subkon + ".1");

                // Load tabel detail supplier
                loadDetailTable(data.kode_subkon);
                reload_subkon_table();
                // Tampilkan modal
                $('#staticBackdrop-tambah-detail-subkon-supplier').modal('show');
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
            url: "<?= site_url('Administrator/Master_data/Master_subkon/Master_data_subkon/get_supplier_list') ?>",
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
        $('#search_supplier_subkon').on('input', function() {
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
        $('#staticBackdrop-tambah-detail-subkon-supplier').on('shown.bs.modal', function() {
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
        // Reset form tambah detail subkon persupplier
        $('#staticBackdrop-tambah-detail-subkon-supplier').on('hidden.bs.modal', function() {
            // Reset semua input dan teks di dalam modal
            $(this).find('input[type="text"], input[type="number"]').val('');
            $(this).find('#kode-subkon-suplier, #uraian-subkon-suplier, #satuan-subkon-suplier').text('');
            $(this).find('#search_supplier_subkon').val('');
            $(this).find('#nama_detail_supplier').val('');
            $(this).find('#harsat_detail_supplier').val('');
            $(this).find('#curr_detail_supplier').val('');
            $(this).find('#date_detail_supplier').val(new Date().toLocaleDateString('id-ID'));
        });

        // Reset form modal tambah subkon
        $('#staticBackdrop-tambah-subkon').on('hidden.bs.modal', function() {
            $('#uraian_subkon').val('');
            $('#satuan_subkon').val('');
        });

    });


    // tambah suplier
    $(document).on('click', '#link-tambah-tabel-persuplier', function(e) {
        const kodeSubkon = $('#hidden_kode_subkon').val().trim() || $('#kode-subkon-suplier').text().trim();
        const kodeSupplier = $('#search_supplier_subkon').val().trim();
        const namaSupplier = $('#nama_detail_supplier').val().trim();
        const hargaSatuan = $('#harsat_detail_supplier').val().trim();

        if (!kodeSubkon || !kodeSupplier || !namaSupplier || !hargaSatuan) {
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
                    url: "<?= site_url('Administrator/Master_data/Master_subkon/Master_data_subkon/simpan_detail_tabel_persupplier') ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                        kode_subkon: kodeSubkon,
                        kode_supplier: kodeSupplier,
                        harga_satuan: hargaSatuan,
                        "<?= $this->security->get_csrf_token_name(); ?>": "<?= $this->security->get_csrf_hash(); ?>"
                    },
                    success: function(res) {
                        if (res.status === 'success') {

                            swal("Berhasil!", res.message, "success");
                            loadDetailTable(kodeSubkon);
                            updateSupplierBadge(); // update badge otomatis
                            reload_subkon_table();
                            // Reset field
                            $('#search_supplier_subkon').val('');
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
    function loadTable(kodeSubkon) {
        $.ajax({
            url: "<?= site_url('Administrator/Master_data/Master_subkon/Master_data_subkon/get_detail_tabel_persuplier') ?>",
            type: "GET",
            data: {
                kode_subkon: kodeSubkon
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
    function loadDetailTable(kodeSubkon) {

        $.ajax({
            url: "<?= site_url('Administrator/Master_data/Master_subkon/Master_data_subkon/get_detail_tabel_persuplier') ?>",
            type: "GET",
            data: {
                kode_subkon: kodeSubkon
            },
            dataType: "json",
            success: function(res) {
                let tbody = '';
                if (res.status === 'success' && res.data.length > 0) {
                    res.data.forEach(function(row) {
                        console.log(row);

                        tbody += `
                            <tr>
                                <td class="text-center">${row.kd_detail_master_ubas}</td>
                                <td class="text-center">${row.kode_supplier}</td>
                                <td>${row.nama_supplier || '-'}</td>
                                <td class="text-end">${row.harsat_detail_master_ubas}</td>
                                <td class="text-center">${row.date_detail}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-danger hapus-detail" data-id="${row.id_detail_master_ubas}" data-kode="${kodeSubkon}">
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
        const kodeSubkon = $(this).data('kode'); // untuk reload tabel

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
                    url: "<?= site_url('Administrator/Master_data/Master_subkon/Master_data_subkon/hapus_detail_supplier') ?>",
                    type: "POST",
                    data: {
                        id_detail_master_ubas: idDetail
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.status === 'success') {
                            swal("Berhasil!", "Data berhasil dihapus.", "success");
                            loadDetailTable(kodeSubkon); // refresh tabel
                            updateSupplierBadge(kodeSubkon); // update badge otomatis
                            reload_subkon_table();
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

    function updateSupplierBadge(kodeSubkon) {
        $.getJSON("<?= site_url('Administrator/Master_data/Master_subkon/Master_data_subkon/count_supplier/') ?>" + kodeSubkon, function(data) {
            let badge = $('#badge-supplier-' + kodeSubkon);
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