@extends('layout')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card shadow-sm"><div class="card-body">
            <h4 class="mb-3">Login</h4>
            <form method="POST" action="{{ route('login') }}">@csrf
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button class="btn btn-primary w-100">Login</button>
            </form>
            <p class="mt-3 mb-0 small">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
        </div></div>
    </div>
</div>
@endsection