@extends("index.layout_main")

@section("content")
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Tạo tài khoản mới</h2>

        <form method="POST" action="{{ url('register') }}" class="space-y-5">
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

            <div>
                <label for="matKhau_confirmation" class="block text-gray-700 mb-1">Xác nhận mật khẩu</label>
                <input type="password" name="matKhau_confirmation" id="matKhau_confirmation" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-[#55d5d2] focus:ring-1 focus:ring-[#55d5d2] outline-none transition">
            </div>

            @if($errors->any())
                <div class="text-red-500 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <button type="submit"
                class="w-full bg-[#55d5d2] text-white py-3 rounded-lg font-semibold hover:bg-[#48c2bf] transition-colors shadow-md">
                Đăng ký
            </button>
        </form>

        <p class="text-center text-gray-500 mt-6">
            Đã có tài khoản?
            <a href="{{ url('login') }}" class="text-[#55d5d2] hover:text-[#48c2bf] font-semibold">Đăng nhập</a>
        </p>
    </div>
</div>
@endsection
