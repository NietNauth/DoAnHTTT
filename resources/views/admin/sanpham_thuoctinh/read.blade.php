@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">Danh sách thuộc tính sản phẩm</h1>

    <div class="mb-4 flex items-center space-x-4">
        <form action="{{ url('admin/sanpham-thuoctinh/search') }}" method="GET" class="flex space-x-2">
            <input type="text" name="keyword" placeholder="Nhập mã SP hoặc màu sắc..."
                class="border px-3 py-2 rounded w-64" value="{{ request('keyword') }}">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                Tìm kiếm
            </button>
        </form>

        <a href="{{ url('admin/sanpham-thuoctinh/create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Thêm thuộc tính
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Mã SP</th>
                    <th class="px-6 py-3">Màu sắc</th>
                    <th class="px-6 py-3">Số lượng</th>
                    <th class="px-6 py-3">Ngày tạo</th>
                    <th class="px-6 py-3">Ngày cập nhật</th>
                    <th class="px-6 py-3 text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $tt)
                    <tr class="border-b hover:bg-gray-100 transition">
                        <td class="px-6 py-3">{{ $tt->maSanPham }}</td>
                        <td class="px-6 py-3">{{ $tt->mauSac }}</td>
                        <td class="px-6 py-3">{{ $tt->soLuong }}</td>
                        <td class="px-6 py-3">{{ $tt->ngayTao ? date('d/m/Y', strtotime($tt->ngayTao)) : 'Chưa có' }}</td>
                        <td class="px-6 py-3">{{ $tt->ngayCapNhat ? date('d/m/Y', strtotime($tt->ngayCapNhat)) : 'Chưa có' }}</td>
                        <td class="px-6 py-3 text-center space-x-2">
                            <a href="{{ url('admin/sanpham-thuoctinh/update/' . $tt->maSPTT) }}"
                                class="inline-block bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-medium hover:bg-blue-200 transition">
                                Sửa
                            </a>
                            <a href="{{ url('admin/sanpham-thuoctinh/delete/' . $tt->maSPTT) }}"
                                onclick="return confirm('Bạn có chắc muốn xóa thuộc tính này không?')"
                                class="inline-block bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-medium hover:bg-red-200 transition">
                                Xóa
                            </a>
                            <a href="{{ url('admin/sanpham-thuoctinh/add-so-luong/' . $tt->maSPTT) }}"
                                class="inline-block bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-medium hover:bg-green-200 transition">
                                Thêm số lượng
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('admin.pagination', ['data' => $data])
@endsection
