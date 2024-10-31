@extends('layouts.login')

@section('content')
<div class="card p-4" style="max-width: 420px; width: 100%;">
    <form action="{{ route('login') }}" method="POST">
    @csrf           
        <div class="text-center mb-4">
            <img src="{{ asset('img/Logo.png') }}" alt="Logo" class="img-fluid">
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukan Email" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password" required>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Masuk</button>
        </div>
    </form>
    @if($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
@endsection
