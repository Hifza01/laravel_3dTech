@extends('layouts.app')

@section('content')
<div class="container-card">
    <div class="card-profile">
        <div class="card-profile-body">
            <h5 class="card-profile-title">Tambah Akun</h5>            
            <div class="card-profile-text">
                <form action="{{ route('AddUser')}}" method="POST">
                    @csrf
                    <div class="mb-3 d-flex align-items-center">
                        <label for="name" class="card-profile-label me-3">Nama Akun</label>
                        <input type="text" value="{{old('name')}}" class="form-control flex-grow-1" id="name" name="name">
                        @error('name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div> 
                    <div class="mb-3 d-flex align-items-center">
                        <label for="email" class="card-profile-label me-3">Email</label>
                        <input type="email" value="{{old('email')}}" class="form-control flex-grow-1" id="email" name="email">
                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div> 
                    <div class="mb-3 d-flex align-items-center">
                        <label for="password" class="card-profile-label me-3">Kata Sandi</label>
                        <input type="password" class="form-control flex-grow-1" id="password" name="password">
                        @error('password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div> 
                    <div class="mb-3 d-flex align-items-center">
                        <label for="password_confirmation" class="card-profile-label me-3">Konfirmasi Kata Sandi</label>
                        <input type="password" class="form-control flex-grow-1" id="password_confirmation" name="password_confirmation">
                        @error('password_confirmation')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div> 
                    <div class="mb-3 d-flex align-items-center">
                        <label for="level" class="card-profile-label me-3">Role</label>
                        <select class="form-select flex-grow-1" id="level" name="level">
                            <option value=""></option>
                            <option value="admin">Admin</option>
                            <option value="teknisi">Teknisi</option>
                        </select>
                        @error('level')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="profile-footer">
                        <a href="{{ route('dashboard') }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection