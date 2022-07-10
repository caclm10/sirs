<tr class="text-start">
    <th scope="row" colspan="4">{{ $judul }}</th>
</tr>
@foreach ($mataPelajaran as $mapel)
    <tr>
        <td class="text-start">{{ $mapel->nama }}</td>
        <td>{{ $mapel->nilai->kbm }}</td>
        <td>{{ $mapel->nilai->pengetahuan }}</td>
        <td>{{ $mapel->nilai->keterampilan }}</td>
        <td>
            <a href="{{ route('dashboard.rapot.mapel.edit', [$nis, $mapel->kode, 'semester' => $semester]) }}"
                class="btn btn-outline-info btn-sm"><span class="iconify" data-icon="carbon:edit"></span> Edit
            </a>
        </td>
    </tr>
@endforeach
