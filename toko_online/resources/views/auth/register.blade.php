@extends('layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm"><div class="card-body">
            <h4 class="mb-3">Daftar Akun</h4>
            <form method="POST" action="{{ route('register') }}">@csrf
                <div class="mb-2"><label class="form-label">Nama Lengkap</label>
                    <input name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="form-control" required></div>
                <div class="mb-2"><label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required></div>
                <div class="mb-2"><label class="form-label">Username</label>
                    <input name="username" value="{{ old('username') }}" class="form-control" required></div>
                <div class="mb-2"><label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required></div>
                <div class="mb-2"><label class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required></div>
                <div class="mb-2"><label class="form-label">No. HP</label>
                    <input name="no_hp" value="{{ old('no_hp') }}" class="form-control"></div>
                <div class="mb-3"><label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2">{{ old('alamat') }}</textarea></div>
                <button class="btn btn-primary w-100">Daftar</button>
            </form>
        </div></div>
    </div>
</div>
@endsection