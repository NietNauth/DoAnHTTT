@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">
        {{ isset($record) ? 'Cập nhật khách hàng' : 'Thêm khách hàng' }}
    </h1>

    <form method="POST" action="{{ $action }}" class="space-y-4">
        @csrf

        {{-- Mã khách hàng (tự sinh, không sửa được) --}}
        <div>
            <label class="block mb-1 font-medium">Mã khách hàng</label>
            <input type="text" class="border rounded w-full px-3 py-2 bg-gray-100"
                   value="{{ isset($record) ? $record->maKhachHang : 'Hệ thống tự sinh' }}" disabled>
        </div>

        {{-- Chọn người dùng liên kết --}}
        <div>
            <label class="block mb-1 font-medium">Người dùng liên kết</label>
            <select name="maNguoiDung" class="border rounded w-full px-3 py-2">
                <option value="">-- Chọn người dùng --</option>
                @foreach($nguoiDungList as $nd)
                    <option value="{{ $nd->maNguoiDung }}"
                        {{ old('maNguoiDung', $record->maNguoiDung ?? '') == $nd->maNguoiDung ? 'selected' : '' }}>
                        {{ $nd->tenDangNhap }}
                    </option>
                @endforeach
            </select>
            @error('maNguoiDung')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Họ tên + Số điện thoại --}}
        <div class="flex flex-col md:flex-row md:space-x-4">
            <div class="flex-1 mb-4 md:mb-0">
                <label class="block mb-1 font-medium">Họ tên</label>
                <input type="text" name="hoTen" class="border rounded w-full px-3 py-2"
                       value="{{ old('hoTen', $record->hoTen ?? '') }}">
                @error('hoTen')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex-1">
                <label class="block mb-1 font-medium">Số điện thoại</label>
                <input type="text" name="soDienThoai" class="border rounded w-full px-3 py-2"
                       value="{{ old('soDienThoai', $record->soDienThoai ?? '') }}">
                @error('soDienThoai')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Email + Địa chỉ --}}
        <div class="flex flex-col md:flex-row md:space-x-4">
            <div class="flex-1 mb-4 md:mb-0">
                <label class="block mb-1 font-medium">Email</label>
                <input type="email" name="email" class="border rounded w-full px-3 py-2"
                       value="{{ old('email', $record->email ?? '') }}">
                @error('email')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex-1">
                <label class="block mb-1 font-medium">Địa chỉ</label>
                <input type="text" name="diaChi" class="border rounded w-full px-3 py-2"
                       value="{{ old('diaChi', $record->diaChi ?? '') }}">
                @error('diaChi')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Nút hành động --}}
        <div class="flex items-center space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ isset($record) ? 'Cập nhật' : 'Thêm mới' }}
            </button>
            <a href="{{ url('khachhang') }}" class="text-gray-600 hover:underline">Hủy</a>
        </div>
    </form>
@endsection
