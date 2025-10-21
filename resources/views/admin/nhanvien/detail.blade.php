@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">Thông tin chi tiết nhân viên</h1>

    {{-- Thông tin cá nhân --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4 flex items-center gap-2">
            Thông tin cá nhân
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
            <p><strong class="text-gray-900">Mã nhân viên:</strong> {{ $record->maNhanVien }}</p>
            <p><strong class="text-gray-900">Họ tên:</strong> {{ $record->hoTen }}</p>
            <p><strong class="text-gray-900">Ngày sinh:</strong>
                {{ \Carbon\Carbon::parse($record->ngaySinh)->format('d/m/Y') }}</p>
            <p><strong class="text-gray-900">Giới tính:</strong> {{ $record->gioiTinh }}</p>
            <p><strong class="text-gray-900">Số điện thoại:</strong> {{ $record->soDienThoai }}</p>
            <p><strong class="text-gray-900">Email:</strong> {{ $record->email }}</p>
            <p class="md:col-span-2"><strong class="text-gray-900">Địa chỉ:</strong> {{ $record->diaChi }}</p>
        </div>
    </div>

    {{-- Thông tin công việc --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4 flex items-center gap-2">
            Thông tin công việc
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
            <p><strong class="text-gray-900">Chức vụ:</strong> {{ App\Models\Admin\ChucVu::find($record->maChucVu)->tenChucVu ?? 'Chưa có' }}</p>
            <p><strong class="text-gray-900">Ngày vào làm:</strong>
                {{ \Carbon\Carbon::parse($record->ngayVaoLam)->format('d/m/Y') }}</p>
            <p><strong class="text-gray-900">Lương cơ bản:</strong>
                {{ number_format($record->luongCoBan, 0, ',', '.') }} đ</p>
            <p><strong class="text-gray-900">Phụ cấp:</strong>
                {{ number_format($record->phuCap, 0, ',', '.') }} đ</p>
        </div>
    </div>

    {{-- Thông tin hệ thống --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4 flex items-center gap-2">
            Thông tin hệ thống
        </h2>
        <div class="space-y-2 text-gray-700">
            <p><strong class="text-gray-900">Ngày tạo:</strong>
                {{ \Carbon\Carbon::parse($record->ngayTao)->format('d/m/Y H:i') }}</p>
            <p><strong class="text-gray-900">Ngày cập nhật:</strong>
                {{ \Carbon\Carbon::parse($record->ngayCapNhat)->format('d/m/Y H:i') }}</p>
            <p>
                <strong class="text-gray-900">Trạng thái:</strong>
                <span class="px-3 py-1 rounded-full text-sm font-medium 
                    {{ $record->trangThai ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $record->trangThai ? 'Hoạt động' : 'Ngừng hoạt động' }}
                </span>
            </p>
        </div>
    </div>

    {{-- Nút quay lại --}}
    <div class="mt-8 flex justify-center">
        <a href="{{ url('nhanvien') }}"
            class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg transition font-medium shadow-sm">
            ← Quay lại danh sách
        </a>
    </div>
@endsection
