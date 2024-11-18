<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>document</title>
    </head>
    <body>
        <h1>INI HOME</h1>
    <nav>
        <a href="{{ route('home') }}">Home</a>  
    </nav>
 </body>
 </html>

 <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Kontak</title>
</head>
<body>
    <h1>Kontak Kami</h1>

    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('kontak.submit') }}" method="POST">
        @csrf
        <div>
            <label for="name">Nama:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            @error('email')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="message">Pesan:</label>
            <textarea name="message" id="message" required>{{ old('message') }}</textarea>
            @error('message')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <button type="submit">Kirim Pesan</button>
        </div>
    </form>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Kontak Website</title>
</head>
<body>
    <h1>Pesan Baru dari Kontak Website</h1>
    <p><strong>Nama:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Pesan:</strong></p>
    <p>{{ $data['message'] }}</p>
</body>
</html>
