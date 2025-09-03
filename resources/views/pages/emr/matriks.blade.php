
    <input type="hidden" name="nomor" value="{{ $list['KUNJUNGAN'] }}">

    <div class="card">
        <div class="card-header">
            <h5>Nomor Kunjungan: {{ $list['KUNJUNGAN'] }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="align-middle">
                        <tr>
                            <th>No.</th>
                            <th>Aspek Regulasi</th>
                            <th>Dijamin RITL</th>
                            <th>Dijamin RJTL</th>
                            <th>Tidak Dijamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @php
                            $fields = [
                                'no1a' => 'a. Mengancam nyawa, membahayakan diri dan orang lain/lingkungan',
                                'no1b' => 'b. Adanya gangguan pada jalan nafas, pernafasan, dan sirkulasi',
                                'no1c' => 'c. Adanya penurunan kesadaran',
                                'no1d' => 'd. Adanya gangguan hemodiomi',
                                'no1e' => 'e. Memerlukan tindakan segera',
                                'no2a' => 'a. Tidak dirujuk',
                                'no2b' => 'b. Dirujuk',
                                'no3' => 'Telah stabil Menunggu dirujuk',
                                'no4' => 'Pelayanan yang diberikan di IGD >6 jam',
                                'no5' => 'Mendapatkan tatalaksana Rawat Inap',
                                'no6' => 'Memenuhi administrasi Rawat Inap',
                                'no7' => 'Memenuhi indikasi medis Rawat Inap',
                                'no8' => 'Telah menempati ruang perawatan, dan telah mendapatkan visistasi dari DPJP',
                            ];
                        @endphp

                        <tr>
                            <td rowspan="6">1</td>
                            <td class="text-start">Memenuhi salah satu kriteria Gawat Darurat</td>
                            <td>+</td><td>+</td><td>-</td>
                        </tr>

                        @foreach (['no1a','no1b','no1c','no1d','no1e'] as $key)
                        <tr>
                            <td class="text-start">{{ $fields[$key] }}</td>
                            <td><input class="form-check-input" type="radio" name="{{ $key }}" value="1" {{ (isset($data) && $data->$key == '1') ? 'checked' : '' }}></td>
                            <td><input class="form-check-input" type="radio" name="{{ $key }}" value="2" {{ (isset($data) && $data->$key == '2') ? 'checked' : '' }}></td>
                            <td><input class="form-check-input" type="radio" name="{{ $key }}" value="3" {{ (isset($data) && $data->$key == '3') ? 'checked' : '' }}></td>
                            <td class="action-cell"></td>
                        </tr>
                        @endforeach

                        <tr>
                            <td rowspan="4">2</td>
                            <td class="text-start">Perawatan IGD yang diberikan RS dilakukan sampai tuntas.</td>
                            <td></td><td></td><td></td>
                        </tr>

                        @foreach (['no2a','no2b'] as $key)
                        <tr>
                            <td class="text-start">{{ $fields[$key] }}</td>
                            <td><input class="form-check-input" type="radio" name="{{ $key }}" value="1" {{ (isset($data) && $data->$key == '1') ? 'checked' : '' }}></td>
                            <td><input class="form-check-input" type="radio" name="{{ $key }}" value="2" {{ (isset($data) && $data->$key == '2') ? 'checked' : '' }}></td>
                            <td><input class="form-check-input" type="radio" name="{{ $key }}" value="3" {{ (isset($data) && $data->$key == '3') ? 'checked' : '' }}></td>
                            <td class="action-cell"></td>
                        </tr>
                        @endforeach

                        <tr>
                            <td class="text-start">Note: Telah mendapatkan tatalaksana sesuai indikasi medis sampai tuntas</td>
                            <td></td><td></td><td></td>
                        </tr>

                        @foreach (['no3','no4','no5','no6','no7','no8'] as $key)
                        <tr>
                            <td>{{ ltrim($key, 'no') }}</td>
                            <td class="text-start">{{ $fields[$key] }}</td>
                            <td><input class="form-check-input" type="radio" name="{{ $key }}" value="1" {{ (isset($data) && $data->$key == '1') ? 'checked' : '' }}></td>
                            <td><input class="form-check-input" type="radio" name="{{ $key }}" value="2" {{ (isset($data) && $data->$key == '2') ? 'checked' : '' }}></td>
                            <td><input class="form-check-input" type="radio" name="{{ $key }}" value="3" {{ (isset($data) && $data->$key == '3') ? 'checked' : '' }}></td>
                            <td class="action-cell"></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3 text-end">
        <button type="submit" class="btn btn-primary" onclick="simpanForm()">Simpan</button>
    </div>

<!-- JavaScript -->
<script>
    $(document).ready(function() {
        $('input[type=radio]').on('change', function () {
            const $row = $(this).closest('tr');
            const $actionCell = $row.find('.action-cell');

            // Kosongkan semua radio di baris tersebut, kecuali yang ini
            $row.find('input[type=radio]').not(this).prop('checked', false);

            if ($actionCell.length) {
                $actionCell.empty();

                const $deleteBtn = $('<button>')
                    .addClass('btn btn-sm btn-danger')
                    .text('Hapus')
                    .on('click', function () {
                        $row.find('input[type=radio]').prop('checked', false);
                        $actionCell.empty();
                    });

                $actionCell.append($deleteBtn);
            }
        });

        // $('#form-matriks').on('submit', function (e) {
        //     e.preventDefault();
        //     simpanForm();
        // });

        tampilForm("{{ $list['KUNJUNGAN'] }}");
    });

    function tampilForm(nomor) {
        // tampil isian
        $.ajax({
            url: `/api/emr/matriks/${nomor}`,
            type: 'GET',
            dataType: 'json',
            success: function (res) {
                const data = res; // pastikan sudah dalam bentuk object hasil `json_decode`

                const fields = [
                    'no1a','no1b','no1c','no1d','no1e',
                    'no2a','no2b',
                    'no3','no4','no5','no6','no7','no8'
                ];

                fields.forEach(function (key) {
                    const value = data[key];

                    if (value) {
                        // Uncheck dulu semua radio untuk field ini
                        $(`input[name="${key}"]`).prop('checked', false);

                        // Check radio yang sesuai
                        $(`input[name="${key}"][value="${value}"]`).prop('checked', true);
                    } else {
                        // Kalau value = 0 atau null, pastikan semua radio untuk field ini tidak tercentang
                        $(`input[name="${key}"]`).prop('checked', false);
                    }
                });
            },
            error: function (xhr) {
                alert('Gagal mengambil data: ' + xhr.responseText);
                console.error(xhr);
            }
        })
    }

    function simpanForm() {
        const payload = {};

        // Ambil semua radio yang dicek
        $('input[type=radio]:checked').each(function () {
            const name = $(this).attr('name');
            const value = $(this).val();
            payload[name] = value;
        });

        // Tambahkan field `nomor` dari input hidden
        payload['nomor'] = $('input[name="nomor"]').val();

        // Tambahkan nilai default "0" jika radio tidak dipilih
        const fields = [
            'no1a','no1b','no1c','no1d','no1e',
            'no2a','no2b',
            'no3','no4','no5','no6','no7','no8'
        ];

        fields.forEach(function (key) {
            if (!(key in payload)) {
                payload[key] = '0';
            }
        });

        // AJAX POST
        $.ajax({
            url: '/api/emr/matriks',
            method: 'POST',
            contentType: 'application/json',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: JSON.stringify(payload),
            success: function (res) {
                alert('Data berhasil disimpan!');
                console.log(res);
                tampilForm(nomor);
            },
            error: function (xhr) {
                alert('Gagal menyimpan data:\n' + xhr.responseText);
                console.error('Error detail:', xhr);
            }
        });
    }


</script>
