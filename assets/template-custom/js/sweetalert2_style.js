// Alert Redirect to Another Link
$(document).on('click', '#link-tambah', function(e) {
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
                'Silahkan isi data dengan lengkap :)',
                'error'
                )
            }
        })
});
// Alert Redirect to Another Link
$(document).on('click', '#link-ubah', function(e) {
    swal({
        title: "Apakah anda yakin data sudah terisi dengan benar?", 
        text: "Proses Ubah Data", 
        type: "warning",
        confirmButtonText: "Ubah Data",
        showCancelButton: true
    })
        .then((result) => {
            if (result.value) {
                swal(
                    'Ubah Data',
                    'Anda berhasil mengubah data. :)',
                    'success'
                    )
            } else if (result.dismiss === 'cancel') {
                swal(
                'Batal Mengubah',
                'Silahkan isi data dengan lengkap :)',
                'error'
                )
            }
        })
});
// Alert Redirect to Another Link
$(document).on('click', '#link-hapus', function(e) {
    swal({
        title: "Apakah anda yakin ingin menghapus data ini?", 
        text: "Proses Hapus Data", 
        type: "error",
        confirmButtonText: "Hapus Data",
        dangerMode: true,
        showCancelButton: true
    })
        .then((result) => {
            if (result.value) {
                swal(
                    'Hapus Data',
                    'Anda berhasil menghapus data. :)',
                    'success'
                    )
            } else if (result.dismiss === 'cancel') {
                swal(
                'Batal Menghapus',
                'Silahkan cek data kembali :)',
                'error'
                )
            }
        })
});

// Alert Redirect to Another Link
$(document).on('click', '#link-tambah-siup', function(e) {
    swal({
        title: "Apakah anda yakin data sudah terisi dengan benar?", 
        text: "Proses Simpan Data", 
        type: "warning",
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
                'Silahkan isi data dengan lengkap :)',
                'error'
                )
            }
        })
});
// Alert Redirect to Another Link
$(document).on('click', '#link-ubah-siup', function(e) {
    swal({
        title: "Apakah anda yakin data sudah terisi dengan benar?", 
        text: "Proses Ubah Data", 
        type: "warning",
        confirmButtonText: "Ubah Data",
        showCancelButton: true
    })
        .then((result) => {
            if (result.value) {
                swal(
                    'Ubah Data',
                    'Anda berhasil mengubah data. :)',
                    'success'
                    )
            } else if (result.dismiss === 'cancel') {
                swal(
                'Batal Mengubah',
                'Silahkan isi data dengan lengkap :)',
                'error'
                )
            }
        })
});
// Alert Redirect to Another Link
$(document).on('click', '#link-hapus-siup', function(e) {
    swal({
        title: "Apakah anda yakin ingin menghapus data ini?", 
        text: "Proses Hapus Data", 
        type: "warning",
        confirmButtonText: "Hapus Data",
        showCancelButton: true
    })
        .then((result) => {
            if (result.value) {
                swal(
                    'Hapus Data',
                    'Anda berhasil menghapus data. :)',
                    'success'
                    )
            } else if (result.dismiss === 'cancel') {
                swal(
                'Batal Menghapus',
                'Silahkan cek data kembali :)',
                'error'
                )
            }
        })
});