@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">
        {{ isset($record) ? 'Cập nhật nhân viên' : 'Thêm nhân viên' }}
    </h1>

    <form method="POST" action="{{ $action }}" class="space-y-4">
        @csrf

        {{-- Mã nhân viên (tự sinh, không sửa) --}}
        <div>
            <label class="block mb-1 font-medium">Mã nhân viên</label>
            <input type="text" class="border rounded w-full px-3 py-2 bg-gray-100"
                   value="{{ isset($record) ? $record->maNhanVien : 'Hệ thống tự sinh' }}" disabled>
        </div>

        {{-- Người dùng liên kết --}}
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

        {{-- Ngày sinh + Giới tính --}}
        <div class="flex flex-col md:flex-row md:space-x-4">
            <div class="flex-1 mb-4 md:mb-0">
                <label class="block mb-1 font-medium">Ngày sinh</label>
                <input type="date" name="ngaySinh" class="border rounded w-full px-3 py-2"
                       value="{{ old('ngaySinh', isset($record) ? $record->ngaySinh->format('Y-m-d') : '') }}">
                @error('ngaySinh')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex-1">
                <label class="block mb-1 font-medium">Giới tính</label>
                <select name="gioiTinh" class="border rounded w-full px-3 py-2">
                    <option value="">-- Chọn giới tính --</option>
                    @foreach(['Nam','Nữ','Khác'] as $gt)
                        <option value="{{ $gt }}" {{ old('gioiTinh', $record->gioiTinh ?? '') == $gt ? 'selected' : '' }}>
                            {{ $gt }}
                        </option>
                    @endforeach
                </select>
                @error('gioiTinh')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Chức vụ + Ngày vào làm --}}
        <div class="flex flex-col md:flex-row md:space-x-4">
            <div class="flex-1 mb-4 md:mb-0">
                <label class="block mb-1 font-medium">Chức vụ</label>
                <select name="maChucVu" class="border rounded w-full px-3 py-2">
                    <option value="">-- Chọn chức vụ --</option>
                    @foreach($chucVuList as $cv)
                        <option value="{{ $cv->maChucVu }}"
                            {{ old('maChucVu', $record->maChucVu ?? '') == $cv->maChucVu ? 'selected' : '' }}>
                            {{ $cv->tenChucVu }}
                        </option>
                    @endforeach
                </select>
                @error('maChucVu')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex-1">
                <label class="block mb-1 font-medium">Ngày vào làm</label>
                <input type="date" name="ngayVaoLam" class="border rounded w-full px-3 py-2"
                       value="{{ old('ngayVaoLam', isset($record) ? $record->ngayVaoLam->format('Y-m-d') : '') }}">
                @error('ngayVaoLam')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Trạng thái --}}
        <div>
            <label class="block mb-1 font-medium">Trạng thái</label>
            <select name="trangThai" class="border rounded w-full px-3 py-2">
                <option value="1" {{ old('trangThai', $record->trangThai ?? '') == 1 ? 'selected' : '' }}>Đang làm</option>
                <option value="0" {{ old('trangThai', $record->trangThai ?? '') == 0 ? 'selected' : '' }}>Nghỉ việc</option>
            </select>
            @error('trangThai')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nút hành động --}}
        <div class="flex items-center space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ isset($record) ? 'Cập nhật' : 'Thêm mới' }}
            </button>
            <a href="{{ url('nhanvien') }}" class="text-gray-600 hover:underline">Hủy</a>
        </div>
    </form>
@endsection
