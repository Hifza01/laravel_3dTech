@extends('layouts.app')

@section('content')
<div class="container" style="min-height: 80vh">
    <div class="row">
        <div class="col-sm-3 mb-3 mb-sm-0">
            <div class="card card-laporan">
                <div class="card-body card-body-laporan">
                    <h5 class="card-title card-title-laporan">To do</h5>
                    <h1 class="card-text card-text-laporan">{{ $toDoCount }}</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card card-laporan">
                <div class="card-body card-body-laporan">
                    <h5 class="card-title card-title-laporan">In progress</h5>
                    <h1 class="card-text card-text-laporan">{{ $inProgressCount }}</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card card-laporan">
                <div class="card-body card-body-laporan">
                    <h5 class="card-title card-title-laporan">Done</h5>
                    <h1 class="card-text card-text-laporan">{{ $doneCount }}</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card card-laporan">
                <div class="card-body card-body-laporan">
                    <h5 class="card-title card-title-laporan">Backlog</h5>
                    <h1 class="card-text card-text-laporan">{{ $backlogCount }}</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-sm-6" style="margin-top: 5%">
            <div class="col-12">
                <h3 style="font-size: 24px">Peringkat Teknisi {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}
                </h3>
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>Peringkat</th>
                            <th>Nama Teknisi</th>
                            <th>Jumlah Tugas Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teknisiRanking as $index => $tech)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $tech->name }}</td>
                                <td>{{ $tech->tasks_count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>            
        </div>
        @if(Auth::check() && Auth::user()->level === 'admin')
            <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card card-laporan">
                    <div class="card-body card-body-laporan">
                        <h5 class="card-title card-title-laporan">Download PDF</h5>
                        <form action="{{ route('download.pdf') }}" method="POST">
                            @csrf
                            <select name="jenis_laporan" class="form-select card-text-laporan" required>
                                <option value="">Pilih jenis laporan</option>
                                <option value="1">Rekap Tugas yang Selesai</option>
                                <option value="2">Rekap Tugas yang Paling Banyak Diajukan</option>
                                <option value="3">Rekap Laporan Bulanan & Tahunan</option>
                                <option value="4">Rekap Peringkat Teknisi</option>
                            </select>
                            <select name="bulan" class="form-select card-text-laporan" required>
                                <option value="">Pilih bulan</option>
                                <option value="0">Semua Bulan</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                            <select name="tahun" class="form-select card-text-laporan" required>
                                <option value="">Pilih tahun</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                            <button type="submit" class="btn btn-primary" style="margin-top: 20px; margin-left: 70%">Unduh</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif      
    </div>
</div>

@endsection
