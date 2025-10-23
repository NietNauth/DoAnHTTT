@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">
        {{ isset($record) ? 'Cập nhật người dùng' : 'Thêm người dùng' }}
    </h1>

    <form method="POST" action="{{ $action }}" class="space-y-4">
        @csrf

        {{-- Hàng 1: Tên đăng nhập --}}
        <div>
            <label class="block mb-1 font-medium">Tên đăng nhập</label>
            <input type="text" name="tenDangNhap" class="border rounded w-full px-3 py-2"
                value="{{ old('tenDangNhap', $record->tenDangNhap ?? '') }}">
            @error('tenDangNhap')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Hàng 2: Mật khẩu --}}
        <div>
            <label class="block mb-1 font-medium">
                Mật khẩu {{ isset($record) ? '(để trống nếu không đổi)' : '' }}
            </label>
            <input type="password" name="matKhau" class="border rounded w-full px-3 py-2">
            @error('matKhau')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Hàng 3: Vai trò --}}
        <div>
            <label class="block mb-1 font-medium">Vai trò</label>
            <select name="vaiTro" class="border rounded w-full px-3 py-2">
                <option value="">-- Chọn vai trò --</option>
                @foreach($vaiTroList as $vt)
                    <option value="{{ $vt->maVaiTro }}"
                        {{ old('vaiTro', $record->vaiTro ?? '') == $vt->maVaiTro ? 'selected' : '' }}>
                        {{ $vt->tenVaiTro }}
                    </option>
                @endforeach
            </select>
            @error('vaiTro')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nút hành động --}}
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ isset($record) ? 'Cập nhật' : 'Thêm mới' }}
            </button>
            <a href="{{ url('admin/nguoidung') }}" class="ml-2 text-gray-600 hover:underline">Hủy</a>
        </div>
    </form>
@endsection
