@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">Chi tiết bảng lương</h1>

    {{-- Thông tin nhân viên và bảng lương --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4 flex items-center gap-2">
            Thông tin nhân viên
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
            <p><strong class="text-gray-900">Mã nhân viên:</strong> {{ $record->maNhanVien }}</p>
            <p><strong class="text-gray-900">Họ tên:</strong> {{ $record->hoTen }}</p>
        </div>
    </div>

    {{-- Thông tin lương --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4 flex items-center gap-2">
            Thông tin lương
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
            @php
                $date = \Carbon\Carbon::parse($record->thangNam.'-01');
            @endphp
            <p><strong class="text-gray-900">Tháng:</strong> {{ $date->format('m') }}</p>
            <p><strong class="text-gray-900">Năm:</strong> {{ $date->format('Y') }}</p>
            <p><strong class="text-gray-900">Số ngày làm:</strong> {{ $record->tongCong }}</p>
            <p><strong class="text-gray-900">Giờ tăng ca:</strong> {{ $record->tongGioTangCa }}</p>
            <p><strong class="text-gray-900">Lương cơ bản:</strong> {{ number_format($record->luongCoBan, 0, ',', '.') }} đ</p>
            <p><strong class="text-gray-900">Phụ cấp:</strong> {{ number_format($record->phuCap, 0, ',', '.') }} đ</p>
            <p><strong class="text-gray-900">Lương tăng ca:</strong> {{ number_format($record->luongTangCa, 0, ',', '.') }} đ</p>
            <p><strong class="text-gray-900">Thưởng:</strong> {{ number_format($record->thuong, 0, ',', '.') }} đ</p>
            <p><strong class="text-gray-900">Phạt:</strong> {{ number_format($record->phat, 0, ',', '.') }} đ</p>
            <p class="md:col-span-2"><strong class="text-gray-900">Tổng lương:</strong> {{ number_format($record->tongLuong, 0, ',', '.') }} đ</p>
            <p class="md:col-span-2"><strong class="text-gray-900">Ghi chú:</strong> {{ $record->ghiChu }}</p>
        </div>
    </div>

    {{-- Ngày tính lương --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4 flex items-center gap-2">
            Thông tin hệ thống
        </h2>
        <div class="space-y-2 text-gray-700">
            <p><strong class="text-gray-900">Ngày tính lương:</strong>
                {{ \Carbon\Carbon::parse($record->ngayTinhLuong ?? now())->format('d/m/Y') }}
            </p>
        </div>
    </div>

    {{-- Nút quay lại --}}
    <div class="mt-8 flex justify-center">
        <a href="{{ url('admin/tinhluong') }}"
            class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg transition font-medium shadow-sm">
            ← Quay lại danh sách
        </a>
    </div>
@endsection
