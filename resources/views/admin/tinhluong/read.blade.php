@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">Danh sách bảng lương</h1>

    <div class="mb-4 flex items-center space-x-4">

        {{-- Form tìm kiếm --}}
        <form action="{{ url('admin/tinhluong/search') }}" method="GET" class="flex space-x-2">
            <input type="text" name="keyword" placeholder="Nhập mã hoặc tên nhân viên..."
                class="border px-3 py-2 rounded w-64" value="{{ request('keyword') }}">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                Tìm kiếm
            </button>
        </form>

        {{-- Form chọn tháng để tính lương --}}
        <form action="{{ url('admin/tinhluong/tinh') }}" method="POST" class="flex space-x-2 items-center">
            @csrf
            <input type="month" name="thang" class="border px-3 py-2 rounded"
                value="{{ old('thang', date('Y-m')) }}">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                + Tính lương tháng này
            </button>
        </form>
    </div>

    {{-- Thông báo --}}
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- Bảng lương --}}
    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Mã nhân viên</th>
                    <th class="px-6 py-3">Họ tên</th>
                    <th class="px-6 py-3 text-center">Tháng</th>
                    <th class="px-6 py-3 text-center">Năm</th>
                    <th class="px-6 py-3 text-center">Số ngày làm</th>
                    <th class="px-6 py-3 text-center">Giờ tăng ca</th>
                    <th class="px-6 py-3 text-right">Tổng lương (VNĐ)</th>
                    <th class="px-6 py-3 text-center">Ngày tính</th>
                    <th class="px-6 py-3 text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $row)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-6 py-3">{{ $row->maNhanVien }}</td>
                        <td class="px-6 py-3">{{ $row->hoTen ?? '—' }}</td>

                        {{-- Tách tháng và năm từ thangNam --}}
                        @php
                            $date = \Carbon\Carbon::parse($row->thangNam.'-01');
                        @endphp
                        <td class="px-6 py-3 text-center">{{ $date->format('m') }}</td>
                        <td class="px-6 py-3 text-center">{{ $date->format('Y') }}</td>

                        <td class="px-6 py-3 text-center">{{ $row->tongCong }}</td>
                        <td class="px-6 py-3 text-center">{{ $row->tongGioTangCa }}</td>
                        <td class="px-6 py-3 text-right font-semibold text-gray-800">
                            {{ number_format($row->tongLuong, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-3 text-center">
                            {{ \Carbon\Carbon::parse($row->ngayTinhLuong)->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-3 text-center space-x-2">
                            <a href="{{ url('admin/tinhluong/detail/' . $row->maTinhLuong) }}"
                                class="inline-block bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-medium hover:bg-green-200 transition">
                                Xem
                            </a>
                            <a href="{{ url('admin/tinhluong/update/' . $row->maTinhLuong) }}"
                                class="inline-block bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-medium hover:bg-blue-200 transition">
                                Sửa
                            </a>
                            <a href="{{ url('admin/tinhluong/delete/' . $row->maTinhLuong) }}"
                                onclick="return confirm('Bạn có chắc muốn xóa bản lương này không?')"
                                class="inline-block bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-medium hover:bg-red-200 transition">
                                Xóa
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @include('admin.pagination', ['data' => $data])
@endsection
