<script>
// tambahhh 
$(document).ready(function() {

    // === Validasi Input ===
    function cekInput() {
        let uraian = $('#uraian_bahan').val().trim();
        let satuan = $('#satuan_bahan').val().trim();

        if (uraian !== '' && satuan !== '') {
            $('#link-simpan').prop('disabled', false);
        } else {
            $('#link-simpan').prop('disabled', true);
        }
    }

    cekInput();

    // Cek ulang
    $('#uraian_bahan, #satuan_bahan').on('keyup change', function() {
        cekInput();
    });

    // === Tombol Simpan Klik ===
    $(document).on('click', '#link-simpan', function(e) {
        e.preventDefault(); // stop form langsung submit

        let uraian = $('#uraian_bahan').val().trim();
        let satuan = $('#satuan_bahan').val().trim();

        // Validasi manual sebelum swal
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
            text: "Data bahan akan disimpan ke database.",
            icon: "info",
            buttons: ["Batal", "Simpan Data"],
        })
        .then((willSave) => {
            if (willSave) {
                $('#form-tambah-bahan').submit();
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
        const idBahan = btn.data('id');
        const currentStatus = btn.data('status');

        const actionText = currentStatus === 'Active' ? 'Menon-Aktifkan' : 'Mengaktifkan';
        const newStatus = currentStatus === 'Active' ? 'Non-Active' : 'Active';

        const statusSpan = $('#status-' + idBahan);

        swal({
            title: `Apakah anda yakin ingin ${actionText} data ini?`,
            icon: "warning",
            buttons: ["Batal", actionText],
            dangerMode: currentStatus === 'Active',
        }).then((willChange) => {
            if (willChange) {
                $.ajax({
                    url: "<?= site_url('Administrator/Master_data/Master_bahan/Master_data_bahan/toggle_status') ?>",
                    type: "POST",
                    data: {
                        id_bahan: idBahan,
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
        var idBahan = $(this).data('id');

        $.ajax({
            url: "<?= site_url('Administrator/Master_data/Master_bahan/Master_data_bahan/get_detail_bahan') ?>",
            type: "GET",
            data: {
                id_bahan: idBahan
            },
            dataType: "json",
            success: function(data) {
                // update ---> modal Detail
                $('#kode-bahan').text(data.kode_bahan);
                $('#uraian-bahan').text(data.uraian_bahan);
                $('#satuan-bahan').text(data.satuan_bahan);
                $('#status-bahan').html(`<span class="badge ${data.status_bahan === 'Active' ? 'text-bg-success' : 'text-bg-secondary'}">
                                        <i class="fa-solid ${data.status_bahan === 'Active' ? 'fa-recycle' : 'fa-ban'} fa-lg"></i>
                                        &nbsp; ${data.status_bahan}
                                     </span>`);
                $('#created-at').text(data.created_at);
                $('#updated-at').text(data.updated_at || '-');
                $('#insert-by').text(data.insert_by);
                $('#update-by').text(data.update_by || '-');

                // **Set data-id di modal Detail**
                $('#staticBackdrop-detail-bahan').data('id', data.id_bahan);

                // Load tabel detail supplier
                loadTable(data.kode_bahan);
                },

            error: function() {
                swal("Gagal!", "Terjadi kesalahan. Silahkan coba lagi.", "error");
            }
        });
    });

    // Ubah
    $(document).on('click', '#btn-detail-ubah', function(e) {
        e.preventDefault();

        var idBahan = $('#staticBackdrop-detail-bahan').data('id');
        if (!idBahan) {
            swal("Error!", "ID bahan tidak ditemukan.", "error");
            return;
        }

        $.ajax({
            url: "<?= site_url('Administrator/Master_data/Master_bahan/Master_data_bahan/get_detail_bahan') ?>",
            type: "GET",
            data: {
                id_bahan: idBahan
            },
            dataType: "json",
            success: function(data) {
                if (data.error) {
                    swal("Gagal!", data.error, "error");
                    return;
                }

                // isi form ---> modal Ubah
                $('#id_ubah_bahan').val(data.id_bahan);
                $('#kode_ubah_bahan').val(data.kode_bahan);
                $('#uraian_ubah_bahan').val(data.uraian_bahan);
                $('#satuan_ubah_bahan').val(data.satuan_bahan);

                // --> show modal
                $('#staticBackdrop-ubah-bahan').modal('show');
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
                var idBahan = $('#id_ubah_bahan').val();
                if (!idBahan) {
                    swal("Error!", "ID bahan tidak ditemukan.", "error");
                    return;
                }

                $.ajax({
                    url: "<?= site_url('Administrator/Master_data/Master_bahan/Master_data_bahan/update_bahan') ?>",
                    type: "POST",
                    data: {
                        id_bahan: idBahan,
                        uraian_bahan: $('#uraian_ubah_bahan').val(),
                        satuan_bahan: $('#satuan_ubah_bahan').val(),
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.status === 'success') {
                            swal('Ubah Data', 'Anda berhasil mengubah data. :)', 'success').then(() => {
                                // tutup modal Ubah
                                $('#staticBackdrop-ubah-bahan').modal('hide');

                                // update isi modal Detail secara langsung
                                $('#uraian-bahan').text($('#uraian_ubah_bahan').val());
                                $('#satuan-bahan').text($('#satuan_ubah_bahan').val());
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
        $('#staticBackdrop-detail-bahan').modal('hide');
        setTimeout(() => location.reload(), 200);
    });

 // Saat tombol "Tambah Detail Bahan Per-Supplier" diklik
$(document).on('click', '.btn-detail-bahan', function() {
    const idBahan = $(this).data('id'); // ambil id_bahan
    const kodeBahan = $(this).data('kode');

    // Ambil data master bahan via AJAX
    $.ajax({
        url: "<?= site_url('Administrator/Master_data/Master_bahan/Master_data_bahan/get_detail_bahan') ?>",
        type: "GET",
        data: { id_bahan: idBahan },
        dataType: "json",
        success: function(data) {
            if(data.error){
                swal("Gagal!", data.error, "error");
                return;
            }

            // Set data di modal
            $('#kode-bahan-suplier').text(data.kode_bahan);
            $('#uraian-bahan-suplier').text(data.uraian_bahan);
            $('#satuan-bahan-suplier').text(data.satuan_bahan);

            // Status
            const statusBadge = data.status_bahan === 'Active' ?
                '<span class="badge text-bg-success"><i class="fa-solid fa-recycle fa-lg"></i>&nbsp;Active</span>' :
                '<span class="badge text-bg-secondary"><i class="fa-solid fa-ban fa-lg"></i>&nbsp;Non-Active</span>';
            $('#status-bahan-suplier').html(statusBadge);

            // Kode otomatis supplier baru
            $('#kode_otomatis_persuplier').val(data.kode_bahan + ".1");

            // Load tabel detail supplier
            loadDetailTable(data.kode_bahan);

            // Tampilkan modal
            $('#staticBackdrop-tambah-detail-bahan-supplier').modal('show');
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
            url: "<?= site_url('Administrator/Master_data/Master_bahan/Master_data_bahan/get_supplier_list') ?>",
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
        $('#search_supplier_bahan').on('input', function() {
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
        $('#staticBackdrop-tambah-detail-bahan-supplier').on('shown.bs.modal', function() {
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
        // Reset form tambah detail bahan persupplier
        $('#staticBackdrop-tambah-detail-bahan-supplier').on('hidden.bs.modal', function() {
            // Reset semua input dan teks di dalam modal
            $(this).find('input[type="text"], input[type="number"]').val('');
            $(this).find('#kode-bahan-suplier, #uraian-bahan-suplier, #satuan-bahan-suplier').text('');
            $(this).find('#search_supplier_bahan').val('');
            $(this).find('#nama_detail_supplier').val('');
            $(this).find('#harsat_detail_supplier').val('');
            $(this).find('#curr_detail_supplier').val('');
            $(this).find('#date_detail_supplier').val(new Date().toLocaleDateString('id-ID'));
        });

        // Reset form modal tambah bahan
        $('#staticBackdrop-tambah-bahan').on('hidden.bs.modal', function() {
            $('#uraian_bahan').val('');
            $('#satuan_bahan').val('');
        });

    });

 
    // tambah suplier
    $(document).on('click', '#link-tambah-tabel-persuplier', function(e) {
        const kodeBahan = $('#hidden_kode_bahan').val().trim() || $('#kode-bahan-suplier').text().trim();
        const kodeSupplier = $('#search_supplier_bahan').val().trim();
        const namaSupplier = $('#nama_detail_supplier').val().trim();
        const hargaSatuan = $('#harsat_detail_supplier').val().trim();

        if (!kodeBahan || !kodeSupplier || !namaSupplier || !hargaSatuan) {
            swal("Data Belum Lengkap", "Harap isi semua kolom sebelum menyimpan!", "warning");
            return;
        }

        swal({
            title: "Tambahkan ke tabel?",
            text: "Pastikan data sudah benar.",
            type: "info",
            showCancelButton: true,
            confirmButtonText: "Ya, Simpan!",
            cancelButtonText: "Batal"
        }).then((result) => {

            if (result.value) {

                $.ajax({
                    url: "<?= site_url('Administrator/Master_data/Master_bahan/Master_data_bahan/simpan_detail_tabel_persupplier') ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                        kode_bahan: kodeBahan,
                        kode_supplier: kodeSupplier,
                        harga_satuan: hargaSatuan,
                        "<?= $this->security->get_csrf_token_name(); ?>": "<?= $this->security->get_csrf_hash(); ?>"
                    },
                    success: function(res) {
                        if (res.status === 'success') {

                            swal("Berhasil!", res.message, "success");
                            loadDetailTable(kodeBahan);
                            updateSupplierBadge(kodeBahan); // update badge otomatis

                            // Reset field
                            $('#search_supplier_bahan').val('');
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
function loadTable(kodeBahan){
    $.ajax({
        url: "<?= site_url('Administrator/Master_data/Master_bahan/Master_data_bahan/get_detail_tabel_persuplier') ?>",
        type: "GET",
        data: { kode_bahan: kodeBahan },
        dataType: "json",
        success: function(res){
            let tbody = '';
            if(res.status === 'success' && res.data.length > 0){
                res.data.forEach(function(row){
                    tbody += `
                        <tr>
                            <td class="text-center">${row.kode_bahan_detail}</td>
                            <td class="text-center">${row.kode_supplier}</td>
                            <td>${row.nama_supplier || '-'}</td>
                            <td class="text-end">${row.harga_satuan}</td>
                            <td class="text-center">${row.created_at}</td>>
                        </tr>
                    `;
                });
            } else {
                tbody = '<tr><td colspan="6" class="text-center text-muted">Belum ada data</td></tr>';
            }
            $('#tabel-detail').html(tbody);
        },
        error: function(){
            $('#tabel-detail').html('<tr><td colspan="6" class="text-center text-danger">Gagal memuat data</td></tr>');
        }
    });
}

// Fungsi load tabel detail supplier
function loadDetailTable(kodeBahan){
    $.ajax({
        url: "<?= site_url('Administrator/Master_data/Master_bahan/Master_data_bahan/get_detail_tabel_persuplier') ?>",
        type: "GET",
        data: { kode_bahan: kodeBahan },
        dataType: "json",
        success: function(res){
            let tbody = '';
            if(res.status === 'success' && res.data.length > 0){
                res.data.forEach(function(row){
                    tbody += `
                        <tr>
                            <td class="text-center">${row.kode_bahan_detail}</td>
                            <td class="text-center">${row.kode_supplier}</td>
                            <td>${row.nama_supplier || '-'}</td>
                            <td class="text-end">${row.harga_satuan}</td>
                            <td class="text-center">${row.created_at}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-danger hapus-detail" data-id="${row.id_bahan_detail}" data-kode="${kodeBahan}">
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
        error: function(){
            $('#tabel-detail-persupplier').html('<tr><td colspan="6" class="text-center text-danger">Gagal memuat data</td></tr>');
        }
    });
}

// Tombol hapus detail supplier
$(document).on('click', '.hapus-detail', function(){
    const idDetail = $(this).data('id');
    const kodeBahan = $(this).data('kode'); // untuk reload tabel

    if(!idDetail){
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
        if(willDelete){
            $.ajax({
                url: "<?= site_url('Administrator/Master_data/Master_bahan/Master_data_bahan/hapus_detail_supplier') ?>",
                type: "POST",
                data: { id_bahan_detail: idDetail },
                dataType: "json",
                success: function(res){
                    if(res.status === 'success'){
                        swal("Berhasil!", "Data berhasil dihapus.", "success");
                        loadDetailTable(kodeBahan); // refresh tabel
                        updateSupplierBadge(kodeBahan); // update badge otomatis

                    } else {
                        swal("Gagal!", res.message || "Gagal menghapus data", "error");
                    }
                },
                error: function(err){
                    swal("Error!", "Terjadi kesalahan server.", "error");
                    console.log(err);
                }
            });
        }
    });
});

function updateSupplierBadge(kodeBahan) {
    $.getJSON("<?= site_url('Administrator/Master_data/Master_bahan/Master_data_bahan/count_supplier/') ?>" + kodeBahan, function(data) {
        let badge = $('#badge-supplier-' + kodeBahan);
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