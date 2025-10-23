<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-center">Đăng nhập</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block mb-1 font-medium">Tên đăng nhập</label>
                <input type="text" name="tenDangNhap" class="border rounded w-full px-3 py-2"
                    value="{{ old('tenDangNhap') }}">
                @error('tenDangNhap')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-medium">Mật khẩu</label>
                <input type="password" name="matKhau" class="border rounded w-full px-3 py-2">
                @error('matKhau')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white w-full py-2 rounded hover:bg-blue-700">Đăng
                nhập</button>
        </form>
    </div>
</body>

</html>