<!DOCTYPE html>
<html>

<head>
    <title>Data Klien</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h2>Daftar Klien</h2>
    <table>
        <thead>
            <tr>
                <th>Kode Rak</th>
                <th>Nama Klien</th>
                <th>Jenis Permohonan</th>
                <th>Tanggal Pengajuan</th>
                <th>Status Permohonan</th>
                <th>Keterangan Permohonan</th>
                <th>Tanggal Pembayaran</th>
                <th>Total Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permohonan as $item)
                <tr>
                    <td>{{ $item->rak->kode_rak }}</td>
                    <td>{{ $item->klien->nama_klien }}</td>
                    <td>{{ $item->jenis_permohonan }}</td>
                    <td>{{ $item->tanggal_pengajuan ?? '-' }}</td>
                    <td>{{ $item->status_permohonan }}</td>
                    <td>{{ $item->keterangan_permohonan }}</td>
                    <td>{{ $item->pembayaran->tgl_pembayaran ?? '-' }}</td>
                    <td>{{ $item->pembayaran->total_pembayaran ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
