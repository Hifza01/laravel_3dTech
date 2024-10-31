<!DOCTYPE html>
<html>
    <head>
        <title>Rekap Tugas yang Paling Banyak Diajukan</title>
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            h1 {
                text-align: center;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>
        <h1>Rekap Tugas yang Paling Banyak Diajukan {{ $bulan != 0 ? \Carbon\Carbon::createFromFormat('m', $bulan)->format('F') : 'Tahun' }} {{ $tahun }}</h1>
        <table>
            <thead>
                <tr>
                    <th>Kategori Tugas</th>
                    <th>Total Pengajuan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $task)
                    <tr>
                        <td>{{ $task->category }}</td>
                        <td>{{ $task->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
