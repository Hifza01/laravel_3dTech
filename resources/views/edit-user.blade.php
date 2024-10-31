@extends('layouts.app')

@section('content')
<div class="container-card">
    <div class="card-profile">
        <div class="card-profile-body">
            <h5 class="card-profile-title">Edit profil</h5>
            <div class="card-profile-text">
                <form action="{{ route('EditUser')}}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" id="" value="{{$user->id}}">
                    <div class="mb-3 d-flex align-items-center">
                        <label for="name" class="card-profile-label me-3">Nama</label>
                        <input type="text" value="{{$user->name}}" class="form-control flex-grow-1" id="name" name="name">
                    </div> 
                    <div class="mb-3 d-flex align-items-center">
                        <label for="email" class="card-profile-label me-3">Email</label>
                        <input type="email" value="{{$user->email}}" class="form-control flex-grow-1" id="email" name="email">
                    </div> 
                    <div class="mb-3 d-flex align-items-center">
                        <label for="password" class="card-profile-label me-3">Kata Sandi</label>
                        <input type="password" class="form-control flex-grow-1" id="password" name="password">
                    </div> 
                    <div class="mb-3 d-flex align-items-center">
                        <label for="password_confirmation" class="card-profile-label me-3">Konfirmasi Kata Sandi</label>
                        <input type="password" class="form-control flex-grow-1" id="password_confirmation" name="password_confirmation">
                    </div>
                    <div class="profile-footer">
                        <a href="{{ route('dashboard') }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection