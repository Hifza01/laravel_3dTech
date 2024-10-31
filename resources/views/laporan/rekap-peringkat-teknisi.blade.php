<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rekap Peringkat Teknisi</title>
        <style>
            body {
                font-family: Arial, sans-serif;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }
            th {
                background-color: #f2f2f2;
            }
            h2 {
                text-align: center;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <h2>Rekap Peringkat Teknisi {{ $bulan != 0 ? \Carbon\Carbon::createFromFormat('m', $bulan)->format('F') : 'Tahun' }} {{ $tahun }}</h2>    
        <table>
            <thead>
                <tr>
                    <th>Peringkat</th>
                    <th>Nama Teknisi</th>
                    <th>Jumlah Tugas Selesai</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $teknisi)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $teknisi->name }}</td>
                        <td>{{ $teknisi->tasks_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
