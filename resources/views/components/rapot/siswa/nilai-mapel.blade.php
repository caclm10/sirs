<tr class="text-start">
    <th scope="row" colspan="7">{{ $judul }}</th>
</tr>

@foreach ($mataPelajaran as $mapel)
    @php
        $predikat = (object) [
            'pengetahuan' => $mapel->nilai->pengetahuan ? RapotHelper::predikatNilai($mapel->nilai->pengetahuan, $mapel->nilai->kbm) : '',
            'keterampilan' => $mapel->nilai->keterampilan ? RapotHelper::predikatNilai($mapel->nilai->keterampilan, $mapel->nilai->kbm) : '',
        ];
    @endphp

    @if ($isDeskripsi)
        <tr>
            <th scope="row" rowspan="2" class="text-center" style="width: 6%">{{ $loop->iteration }}</th>
            <td rowspan="2" style="width: 20%">{{ $mapel->nama }}</td>
            <td>Pengetahuan</td>
            <td>{{ $predikat->pengetahuan ? RapotHelper::deskripsiNilai($predikat->pengetahuan, $mapel->nilai->kd_pengetahuan, 'pengetahuan') : '' }}
            </td>
        </tr>
        <tr>
            <td>Keterampilan</td>
            <td>{{ $predikat->keterampilan ? RapotHelper::deskripsiNilai($predikat->keterampilan, $mapel->nilai->kd_keterampilan, 'keterampilan') : '' }}
        </tr>
    @else
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td class="text-start">{{ $mapel->nama }}</td>
            <td>{{ $mapel->nilai->kbm }}</td>
            <td>{{ $mapel->nilai->pengetahuan }}</td>
            <td>{{ $predikat->pengetahuan }}
            </td>
            <td>{{ $mapel->nilai->keterampilan }}</td>
            <td>{{ $predikat->keterampilan }}</td>
        </tr>
    @endif
@endforeach
