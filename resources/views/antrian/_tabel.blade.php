@foreach($dataAntrian as $row)
<tr id="row-{{ $row->id }}">
  <td>{{ $row->nomor }}</td>
  <td>{{ $row->jenis }}</td>
  <td>{{ $row->subjenis }}</td>
  <td>{{ $row->loket ?? '-' }}</td>
  <td>{{ ucfirst($row->status) }}</td>
  <td>
    @if($row->status === 'menunggu')
      <button class="btn btn-sm btn-primary btn-panggil"
        data-id="{{ $row->id }}"
        data-nomor="{{ $row->nomor }}"
        data-jenis="{{ $row->jenis }}"
        data-sub="{{ $row->subjenis }}"
        data-loket="{{ $row->loket }}">
        Panggil
      </button>
    @else
      <button class="btn btn-sm btn-secondary" disabled>Dipanggil</button>
      <button class="btn btn-sm btn-warning btn-panggil-ulang"
          data-id="{{ $row->id }}"
          data-nomor="{{ $row->nomor }}"
          data-jenis="{{ $row->jenis }}"
          data-sub="{{ $row->subjenis }}"
          data-loket="{{ $row->loket ?? '' }}">
        🔊 Ulang
      </button>
    @endif
  </td>
</tr>
@endforeach
