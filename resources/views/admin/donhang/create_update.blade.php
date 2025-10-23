@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">
        {{ isset($record) ? 'Cập nhật đơn hàng' : 'Thêm đơn hàng' }}
    </h1>

    <form method="POST" action="{{ $action }}" class="space-y-4">
        @csrf

        {{-- Mã đơn hàng (tự sinh, không sửa) --}}
        <div>
            <label class="block mb-1 font-medium">Mã đơn hàng</label>
            <input type="text" class="border rounded w-full px-3 py-2 bg-gray-100"
                value="{{ isset($record) ? $record->maDonHang : 'Hệ thống tự sinh' }}" disabled>
        </div>

        {{-- Khách hàng --}}
        <div>
            <label class="block mb-1 font-medium">Khách hàng</label>
            <select name="maKhachHang" class="border rounded w-full px-3 py-2">
                <option value="">-- Chọn khách hàng --</option>
                @foreach($khachHangList as $kh)
                    <option value="{{ $kh->maKhachHang }}" 
                        {{ old('maKhachHang', $record->maKhachHang ?? '') == $kh->maKhachHang ? 'selected' : '' }}>
                        {{ $kh->hoTen }} ({{ $kh->email }})
                    </option>
                @endforeach
            </select>
            @error('maKhachHang')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email + Số điện thoại --}}
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
                <label class="block mb-1 font-medium">Số điện thoại</label>
                <input type="text" name="soDienThoai" class="border rounded w-full px-3 py-2"
                    value="{{ old('soDienThoai', $record->soDienThoai ?? '') }}">
                @error('soDienThoai')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Địa chỉ + Ghi chú --}}
        <div class="flex flex-col md:flex-row md:space-x-4">
            <div class="flex-1 mb-4 md:mb-0">
                <label class="block mb-1 font-medium">Địa chỉ</label>
                <input type="text" name="diaChi" class="border rounded w-full px-3 py-2"
                    value="{{ old('diaChi', $record->diaChi ?? '') }}">
                @error('diaChi')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex-1">
                <label class="block mb-1 font-medium">Ghi chú</label>
                <textarea name="ghiChu" class="border rounded w-full px-3 py-2">{{ old('ghiChu', $record->ghiChu ?? '') }}</textarea>
                @error('ghiChu')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Ngày đặt --}}
        <div>
            <label class="block mb-1 font-medium">Ngày đặt</label>
            <input type="datetime-local" name="ngayDat" class="border rounded w-full px-3 py-2"
                value="{{ old('ngayDat', isset($record) ? \Carbon\Carbon::parse($record->ngayDat)->format('Y-m-d\TH:i') : '') }}">
            @error('ngayDat')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Trạng thái --}}
        <div>
            <label class="block mb-1 font-medium">Trạng thái</label>
            <select name="trangThai" class="border rounded w-full px-3 py-2">
                @foreach(['Chờ xử lý','Đang chuẩn bị','Đang giao','Hoàn thành','Hủy'] as $status)
                    <option value="{{ $status }}" {{ old('trangThai', $record->trangThai ?? '') == $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
            @error('trangThai')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tổng tiền --}}
        <div>
            <label class="block mb-1 font-medium">Tổng tiền (VNĐ)</label>
            <input type="number" step="0.01" min="0" name="tongTien" class="border rounded w-full px-3 py-2"
                value="{{ old('tongTien', $record->tongTien ?? '') }}">
            @error('tongTien')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Mã khuyến mãi --}}
        <div>
            <label class="block mb-1 font-medium">Mã khuyến mãi</label>
            <input type="text" name="maKhuyenMai" class="border rounded w-full px-3 py-2"
                value="{{ old('maKhuyenMai', $record->maKhuyenMai ?? '') }}">
            @error('maKhuyenMai')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nút hành động --}}
        <div class="flex items-center space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ isset($record) ? 'Cập nhật' : 'Thêm mới' }}
            </button>
            <a href="{{ url('admin/donhang') }}" class="text-gray-600 hover:underline">Hủy</a>
        </div>
    </form>
@endsection
