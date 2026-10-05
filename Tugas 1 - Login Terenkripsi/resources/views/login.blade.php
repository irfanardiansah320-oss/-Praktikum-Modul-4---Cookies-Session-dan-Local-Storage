<h1>Login</h1>
<p>Masuk untuk membuka dashboard</p>

@if ($errors->any())
    <p style="color:red">{{ $errors->first }}</p>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf
    <label>Username</label><br>
    <input type="text" name="username" value="{{ old('username') }}" required><br>
    <label>Password</label><br>
    <input type="password" name="password" required>
    <button type="submit">Masuk</button>
</form>