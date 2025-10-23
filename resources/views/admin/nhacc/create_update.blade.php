@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">
        {{ isset($record) ? 'Cập nhật nhà cung cấp' : 'Thêm nhà cung cấp' }}
    </h1>

    <form method="POST" action="{{ $action }}" class="space-y-4">
        @csrf

        {{-- Mã nhà cung cấp (tự sinh, không sửa) --}}
        <div>
            <label class="block mb-1 font-medium">Mã NCC</label>
            <input type="text" class="border rounded w-full px-3 py-2 bg-gray-100"
                value="{{ isset($record) ? $record->maNCC : 'Hệ thống tự sinh' }}" disabled>
        </div>

        {{-- Tên NCC + Số điện thoại --}}
        <div class="flex flex-col md:flex-row md:space-x-4">
            <div class="flex-1 mb-4 md:mb-0">
                <label class="block mb-1 font-medium">Tên nhà cung cấp</label>
                <input type="text" name="tenNCC" class="border rounded w-full px-3 py-2"
                    value="{{ old('tenNCC', $record->tenNCC ?? '') }}">
                @error('tenNCC')
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

        {{-- Người liên hệ + Trạng thái --}}
        <div class="flex flex-col md:flex-row md:space-x-4">
            <div class="flex-1 mb-4 md:mb-0">
                <label class="block mb-1 font-medium">Người liên hệ</label>
                <input type="text" name="nguoiLienHe" class="border rounded w-full px-3 py-2"
                    value="{{ old('nguoiLienHe', $record->nguoiLienHe ?? '') }}">
                @error('nguoiLienHe')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex-1">
                <label class="block mb-1 font-medium">Trạng thái</label>
                <select name="trangThai" class="border rounded w-full px-3 py-2">
                    <option value="1" {{ old('trangThai', $record->trangThai ?? '') == 1 ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ old('trangThai', $record->trangThai ?? '') == 0 ? 'selected' : '' }}>Ngưng</option>
                </select>
                @error('trangThai')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Nút hành động --}}
        <div class="flex items-center space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ isset($record) ? 'Cập nhật' : 'Thêm mới' }}
            </button>
            <a href="{{ url('admin/nhacc') }}" class="text-gray-600 hover:underline">Hủy</a>
        </div>
    </form>
@endsection
