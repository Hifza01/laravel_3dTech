@extends('layouts.app')

@section('content')
<div class="container mt-5" style="overflow-x:auto; min-height:80vh">
    <table class="table table-bordered table-hover text-center">
        <thead class="table-primary">
            <tr>
                <th scope="col">Nama Teknisi</th>
                <th scope="col">Kategori</th>
                <th scope="col">Waktu</th>
                <th scope="col">Isi Aduan</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengajuan as $task)
            <tr>
                <td>{{ $task->teknisi->name }}</td>
                <td>{{ $task->category }}</td>
                <td>{{ $task->due }}</td>
                <td>{{ $task->content }}</td>
                <td>
                <form action="{{ route('task.approve', $task->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-primary" type="submit">Terima</button>
                    </form>
                    <form action="{{ route('task.reject', $task->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-danger" type="submit">Tolak</button>
                    </form>                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
