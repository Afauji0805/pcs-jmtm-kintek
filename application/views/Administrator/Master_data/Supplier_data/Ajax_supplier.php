<script>
    // tambah 
    $(document).ready(function() {

        // === Validasi Input ===
        function cekInput() {
            let nama = $('#nama_supplier').val().trim();
            let pic = $('#pic_supplier').val().trim();
            let alamat = $('#alamat_supplier').val().trim();

            if (nama !== '' && pic !== '' && alamat !== '') {
                $('#link-simpan').prop('disabled', false);
            } else {
                $('#link-simpan').prop('disabled', true);
            }
        }

        cekInput();

        // Cek ulang
        $('#nama_supplier, #pic_supplier, #alamat_supplier').on('keyup change', function() {
            cekInput();
        });

        // === Tombol Simpan Klik ===
        $(document).on('click', '#link-simpan', function(e) {
            e.preventDefault(); // stop form langsung submit

            let nama = $('#nama_supplier').val().trim();
            let pic = $('#pic_supplier').val().trim();
            let alamat = $('#alamat_supplier').val().trim();

            // Validasi manual sebelum swal
            if (nama === '' || pic === '' || alamat === '') {
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
                text: "Data alat akan disimpan ke database.",
                icon: "info",
                buttons: ["Batal", "Simpan Data"],
            })
            .then((willSave) => {
                if (willSave) {
                    $('#form-tambah-supplier').submit();
                } else {
                    swal("Batal Menyimpan", "Silakan periksa kembali data anda.", "error");
                }
            });
        });
    });

    $(document).ready(function () {

        // Batasi input hanya angka, spasi, tanda kurung (), tanda minus -, dan backspace
        $('#pic_supplier').on('keypress keydown paste', function (e) {
            const key = e.which || e.keyCode;
            const char = String.fromCharCode(key);

            // izinkan: backspace (8), delete (46), panah kiri (37), panah kanan (39), tab (9)
            // serta minus di beberapa layout keyboard (173, 189, 109)
            if ([8, 9, 37, 39, 46, 173, 189, 109].includes(key)) {
                return true;
            }

            // jika user paste teks
            if (e.type === 'paste') {
                const pasted = (e.originalEvent || e).clipboardData.getData('text');
                const clean = pasted.replace(/[^0-9\-\(\)\s]/g, ''); // hapus karakter tak diizinkan
                e.preventDefault();
                document.execCommand('insertText', false, clean);
                return;
            }

            // hanya izinkan karakter valid
            const allowed = /[0-9\-\(\)\s]/;
            if (!allowed.test(char)) {
                e.preventDefault();
            }
        });

    });

    //   tombol togglel aktif non aktif
    $(document).on('click', '.btn-toggle-status', function(e) {
        e.preventDefault();

        const btn = $(this);
        const idSupplier = btn.data('id');
        const currentStatus = btn.data('status');

        const actionText = currentStatus === 'Active' ? 'Menon-Aktifkan' : 'Mengaktifkan';
        const newStatus = currentStatus === 'Active' ? 'Non-Active' : 'Active';

        const statusSpan = $('#status-' + idSupplier);

        swal({
            title: `Apakah anda yakin ingin ${actionText} data ini?`,
            icon: "warning",
            buttons: ["Batal", actionText],
            dangerMode: currentStatus === 'Active',
        }).then((willChange) => {
            if (willChange) {
                $.ajax({
                    url: "<?= site_url('Administrator/Master_data/Master_supplier/Master_data_supplier/toggle_status') ?>",
                    type: "POST",
                    data: {
                        id_supplier: idSupplier,
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
    });

    // detail
    $(document).on('click', '.btn-detail', function() {
        var idSupplier = $(this).data('id');

        $.ajax({
            url: "<?= site_url('Administrator/Master_data/Master_supplier/Master_data_supplier/get_detail_supplier') ?>",
            type: "GET",
            data: {
                id_supplier: idSupplier
            },
            dataType: "json",
            success: function(data) {
                // update ---> modal Detail
                $('#kode-supplier').text(data.kode_supplier);
                $('#nama-supplier').text(data.nama_supplier);
                $('#pic-supplier').text(data.pic_supplier);
                $('#alamat-supplier').text(data.alamat_supplier);
                $('#status-supplier').html(`<span class="badge ${data.status_supplier === 'Active' ? 'text-bg-success' : 'text-bg-secondary'}">
                                        <i class="fa-solid ${data.status_supplier === 'Active' ? 'fa-recycle' : 'fa-ban'} fa-lg"></i>
                                        &nbsp; ${data.status_supplier}
                                     </span>`);
                $('#created-at').text(data.created_at);
                $('#updated-at').text(data.updated_at || '-');
                $('#insert-by').text(data.insert_by);
                $('#update-by').text(data.update_by || '-');

                // **Set data-id di modal Detail**
                $('#staticBackdrop-detail-supplier').data('id', data.id_supplier);
            },
            error: function() {
                swal("Gagal!", "Terjadi kesalahan. Silahkan coba lagi.", "error");
            }
        });
    });

    // Ubah
    $(document).on('click', '#btn-detail-ubah', function(e) {
        e.preventDefault();

        var idSupplier = $('#staticBackdrop-detail-supplier').data('id');
        if (!idSupplier) {
            swal("Error!", "ID supplier tidak ditemukan.", "error");
            return;
        }

        $.ajax({
            url: "<?= site_url('Administrator/Master_data/Master_supplier/Master_data_supplier/get_detail_supplier') ?>",
            type: "GET",
            data: {
                id_supplier: idSupplier
            },
            dataType: "json",
            success: function(data) {
                if (data.error) {
                    swal("Gagal!", data.error, "error");
                    return;
                }

                // isi form ---> modal Ubah
                $('#id_ubah_supplier').val(data.id_supplier);
                $('#kode_ubah_supplier').val(data.kode_supplier);
                $('#nama_ubah_supplier').val(data.nama_supplier);
                $('#pic_ubah_supplier').val(data.pic_supplier);
                $('#alamat_ubah_supplier').val(data.alamat_supplier);

                // --> show modal
                $('#staticBackdrop-ubah-supplier').modal('show');
            },
            error: function() {
                swal("Gagal!", "Terjadi kesalahan saat mengambil data.", "error");
            }
        });
    });

    // Simpan 
    $(document).on('click', '#link-ubah', function(e) {
        e.preventDefault();

        swal({
            title: "Apakah anda yakin data sudah terisi dengan benar?",
            text: "Proses Ubah Data",
            icon: "warning",
            buttons: ["Batal", "Ubah Data"],
            dangerMode: true
        }).then((willUpdate) => {
            if (willUpdate) {
                var idSupplier = $('#id_ubah_supplier').val();
                if (!idSupplier) {
                    swal("Error!", "ID supplier tidak ditemukan.", "error");
                    return;
                }

                $.ajax({
                    url: "<?= site_url('Administrator/Master_data/Master_supplier/Master_data_supplier/update_supplier') ?>",
                    type: "POST",
                    data: {
                        id_supplier: idSupplier,
                        nama_supplier: $('#nama_ubah_supplier').val(),
                        pic_supplier: $('#pic_ubah_supplier').val(),
                        alamat_supplier: $('#alamat_ubah_supplier').val(),
                        "<?= $this->security->get_csrf_token_name(); ?>": "<?= $this->security->get_csrf_hash(); ?>"
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.status === 'success') {
                            swal('Ubah Data', 'Anda berhasil mengubah data. :)', 'success').then(() => {
                                // tutup modal Ubah
                                $('#staticBackdrop-ubah-supplier').modal('hide');

                                // update isi modal Detail secara langsung
                                $('#nama-supplier').text($('#nama_ubah_supplier').val());
                                $('#alamat-supplier').text($('#alamat_ubah_supplier').val());
                                $('#pic-supplier').html('Rp ' + new Intl.NumberFormat('id-ID').format($('#pic_ubah_supplier').val()));
                            });
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
        $('#staticBackdrop-detail-supplier').modal('hide');
        setTimeout(() => location.reload(), 200);
    });

    // Reset form tambah supplier
    $('#staticBackdrop-tambah-supplier').on('hidden.bs.modal', function () {
        const form = $(this).find('form')[0];
        if (form) {
            form.reset();
        }

        $('#kode_supplier').val('<?= isset($kode_otomatis) ? $kode_otomatis : '' ?>');
        $('#nama_supplier').val('');
        $('#pic_supplier').val('');
        $('#alamat_supplier').val('');
    });
</script>