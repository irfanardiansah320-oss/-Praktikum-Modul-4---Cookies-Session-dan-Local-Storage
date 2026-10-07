<h1>Dashboard</h1>
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>

<h2>Selamat datang, {{ auth()->user()->nama_lengkap }}!</h2>
<p>Halaman ini hanya bisa dibuka setelah login.</p>
<p>Username: {{ auth()->user()->username }}</p>