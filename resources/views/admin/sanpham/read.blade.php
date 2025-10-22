@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">Danh sách sản phẩm</h1>

    <div class="mb-4 flex items-center space-x-4">
        <form action="{{ url('sanpham/search') }}" method="GET" class="flex space-x-2">
            <input type="text" name="keyword" placeholder="Nhập mã hoặc tên sản phẩm..."
                class="border px-3 py-2 rounded w-64" value="{{ request('keyword') }}">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                Tìm kiếm
            </button>
        </form>

        <a href="{{ url('sanpham/create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Thêm sản phẩm
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Mã SP</th>
                    <th class="px-6 py-3">Tên sản phẩm</th>
                    <th class="px-6 py-3">Giá gốc</th>
                    <th class="px-6 py-3">Danh mục</th>
                    <th class="px-6 py-3">Nhà cung cấp</th>
                    <th class="px-6 py-3 w-[120px]">Trạng thái</th>
                    <th class="px-6 py-3">Ngày tạo</th>
                    <th class="px-6 py-3">Ngày cập nhật</th>
                    <th class="px-6 py-3 text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $sp)
                    <tr class="border-b hover:bg-gray-100 transition">
                        <td class="px-6 py-3">{{ $sp->maSanPham }}</td>
                        <td class="px-6 py-3">{{ $sp->tenSanPham }}</td>
                        <td class="px-6 py-3">{{ number_format($sp->giaGoc, 0, ',', '.') }} VNĐ</td>
                        <td class="px-6 py-3">{{ App\Models\Admin\DanhMuc::find($sp->maDanhMuc)->tenDanhMuc ?? '—' }}</td>
                        <td class="px-6 py-3">{{ App\Models\Admin\NhaCC::find($sp->maNCC)->tenNCC ?? '—' }}</td>
                        <td class="px-6 py-3 w-[120px]">
                            <span
                                class="px-2 py-1 rounded text-sm font-medium 
                                        {{ $sp->trangThai == 1 ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-700' }}">
                                {{ $sp->trangThai == 1 ? 'Hiển thị' : 'Ẩn' }}
                            </span>
                        </td>
                        <td class="px-6 py-3">{{ $sp->ngayTao ? date('d/m/Y', strtotime($sp->ngayTao)) : 'Chưa có' }}</td>
                        <td class="px-6 py-3">{{ $sp->ngayCapNhat ? date('d/m/Y', strtotime($sp->ngayCapNhat)) : 'Chưa có' }}</td>

                        <td class="px-6 py-3 text-center space-x-2">
                            <a href="{{ url('sanpham/update/' . $sp->maSanPham) }}"
                                class="inline-block bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-medium hover:bg-blue-200 transition">
                                Sửa
                            </a>

                            <a href="{{ url('sanpham/delete/' . $sp->maSanPham) }}"
                                onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')"
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
