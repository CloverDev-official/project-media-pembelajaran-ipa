   // ambil base URL project otomatis
    const baseUrl = window.location.origin + "/" + window.location.pathname.split("/")[1];

    tinymce.init({
        selector: '#teks',
        plugins: [
             "advlist", "anchor", "autolink", "charmap", "code",
            "fullscreen", "help", "image", "insertdatetime", "link", "lists",
            "media", "preview", "searchreplace", "table", "visualblocks"
        ],
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link image table | code help',
        height: 500,

        /* biar bisa pilih gambar dari komputer */
        images_upload_url: baseUrl + '/php/upload.php',
        file_picker_types: 'image',
        file_picker_callback: function (cb, value, meta) {
            let input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function () {
                let file = this.files[0];
                let formData = new FormData();
                formData.append('file', file);

                // kirim ke PHP upload handler pakai baseUrl
                fetch(baseUrl + '/php/upload.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.location) {
                        cb(data.location, { title: file.name });
                    } else {
                        alert('Upload gagal: ' + (data.error || 'Tidak diketahui'));
                    }
                })
                .catch(err => {
                    alert('Upload gagal: ' + err);
                });
            };
            input.click();
        }
    });