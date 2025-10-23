@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">Danh sách khách hàng</h1>

    <div class="mb-4 flex items-center space-x-4">
        <form action="{{ url('admin/khachhang/search') }}" method="GET" class="flex space-x-2">
            <input type="text" name="keyword" placeholder="Nhập mã, tên hoặc email khách hàng..."
                class="border px-3 py-2 rounded w-64" value="{{ request('keyword') }}">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                Tìm kiếm
            </button>
        </form>

        <a href="{{ url('admin/khachhang/create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            + Thêm khách hàng
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Mã khách hàng</th>
                    <th class="px-6 py-3">Tên khách hàng</th>
                    <th class="px-6 py-3">Số điện thoại</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Địa chỉ</th>
                    <th class="px-6 py-3">Điểm thưởng</th>
                    <th class="px-6 py-3">Ngày tạo</th>
                    <th class="px-6 py-3">Ngày cập nhật</th>
                    <th class="px-6 py-3 text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $kh)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-6 py-3">{{ $kh->maKhachHang }}</td>
                        <td class="px-6 py-3">{{ $kh->hoTen }}</td>
                        <td class="px-6 py-3">{{ $kh->soDienThoai }}</td>
                        <td class="px-6 py-3">{{ $kh->email ?? 'Chưa có' }}</td>
                        <td class="px-6 py-3">{{ $kh->diaChi ?? 'Chưa có' }}</td>
                        <td class="px-6 py-3">{{ $kh->diemThuong }}</td>
                        <td class="px-6 py-3">{{ $kh->ngayTao }}</td>
                        <td class="px-6 py-3">{{ $kh->ngayCapNhat }}</td>
                        <td class="px-6 py-3 text-center space-x-2">
                            <a href="{{ url('admin/khachhang/update/' . $kh->maKhachHang) }}"
                                class="inline-block bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-medium hover:bg-blue-200 transition">
                                Sửa
                            </a>
                            <a href="{{ url('admin/khachhang/delete/' . $kh->maKhachHang) }}"
                                onclick="return confirm('Bạn có chắc muốn xóa khách hàng này không?')"
                                class="inline-block bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-medium hover:bg-red-200 transition">
                                Xóa
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('admin.pagination', ['data' => $data])

@endsection