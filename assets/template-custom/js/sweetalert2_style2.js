// Alert Redirect to Another Link
document.getElementById('link-tambah-identitas').onclick = function(){
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
};