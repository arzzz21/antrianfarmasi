@php
    $NOMOR = $list['KUNJUNGAN'];
@endphp

<div class="row">
    <!-- Upload Form -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h5>Upload File</h5></div>
            <div class="card-body">
                <form id="upload-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_tambahan">Nama File</label>
                        <input type="text" class="form-control" name="nama_tambahan" id="nama_tambahan" required>
                    </div>
                    <div class="form-group">
                        <label for="file">Pilih File</label>
                        <input type="file" class="form-control" name="file" id="file" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Upload</button>
                </form>
            </div>
        </div>
    </div>

    <!-- File List -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h5>Uploaded Files</h5></div>
            <div class="card-body" id="file-list">
                @if(isset($files) && $files->count())
                    <ul class="list-group">
                        @foreach($files as $file)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <a href="{{ asset('storage/files/upload/' . $file->filename) }}" target="_blank">
                                        {{ $file->title }}
                                    </a>
                                    <br>
                                    <small><i>Nama Tambahan: {{ $file->nama_tambahan }}</i></small>
                                </div>
                                <button class="btn btn-danger btn-sm delete-file" data-id="{{ $file->id }}">Hapus</button>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>Tidak ada file diunggah.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const NOMOR = @json($NOMOR);

        // Fungsi untuk load ulang daftar file dan render ke #file-list
        function loadFileList() {
            fetch(`/api/emr/file-upload/${NOMOR}/list`)
            .then(res => res.json())
            .then(files => {
                const fileList = document.getElementById('file-list');
                if (files.length === 0) {
                    fileList.innerHTML = '<p>Tidak ada file diunggah.</p>';
                    return;
                }
                let html = '<ul class="list-group">';
                files.forEach(file => {
                    html += `
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <a href="href="/storage/files/upload/${file.filename}" target="_blank">
                                    ${file.title}
                                </a>
                                <br>
                                <small><i>Nama File: ${file.nama_tambahan}</i></small>
                            </div>
                            <button class="btn btn-danger btn-sm delete-file" data-id="${file.id}">Hapus</button>
                        </li>
                    `;
                });
                html += '</ul>';
                fileList.innerHTML = html;
            });
        }

        // Upload via AJAX
        document.getElementById('upload-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch(`/api/emr/file-upload/${NOMOR}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    loadFileList();  // refresh list saja, tanpa reload halaman
                    document.getElementById('upload-form').reset(); // reset form input file
                } else {
                    alert('Upload gagal.');
                }
            });
        });

        // Delete file via AJAX
        document.getElementById('file-list').addEventListener('click', function (e) {
            if (e.target.classList.contains('delete-file')) {
                const id = e.target.dataset.id;

                if (confirm('Yakin ingin menghapus file ini?')) {
                    fetch(`/api/emr/file-upload/${NOMOR}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            loadFileList();  // refresh list tanpa reload halaman
                        } else {
                            alert('Gagal menghapus file.');
                        }
                    });
                }
            }
        });

        // Load daftar file saat pertama kali halaman dibuka
        loadFileList();
    });

</script>
