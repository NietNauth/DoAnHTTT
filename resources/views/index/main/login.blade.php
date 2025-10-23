@extends("index.layout_main")

@section("content")
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Đăng nhập vào tài khoản</h2>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ url('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="tenDangNhap" class="block text-gray-700 mb-1">Tên đăng nhập</label>
                    <input type="text" name="tenDangNhap" id="tenDangNhap" value="{{ old('tenDangNhap') }}" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#55d5d2] focus:ring-1 focus:ring-[#55d5d2] outline-none transition">
                </div>

                <div>
                    <label for="matKhau" class="block text-gray-700 mb-1">Mật khẩu</label>
                    <input type="password" name="matKhau" id="matKhau" required
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#55d5d2] focus:ring-1 focus:ring-[#55d5d2] outline-none transition">
                </div>

                @if($errors->any())
                    <div class="text-red-500 text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button type="submit"
                    class="w-full bg-[#55d5d2] text-white py-3 rounded-lg font-semibold hover:bg-[#48c2bf] transition-colors shadow-md">
                    Đăng nhập
                </button>
            </form>

            <p class="text-center text-gray-500 mt-6">
                Chưa có tài khoản?
                <a href="{{ url('register') }}" class="text-[#55d5d2] hover:text-[#48c2bf] font-semibold">Đăng ký ngay</a>
            </p>
        </div>
    </div>



@endsection