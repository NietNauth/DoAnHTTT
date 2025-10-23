@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">Danh sách danh mục</h1>

    <div class="mb-4 flex items-center space-x-4">
        <form action="{{ url('admin/danhmuc/search') }}" method="GET" class="flex space-x-2">
            <input type="text" name="keyword" placeholder="Nhập mã hoặc tên danh mục..."
                class="border px-3 py-2 rounded w-64" value="{{ request('keyword') }}">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                Tìm kiếm
            </button>
        </form>

        <a href="{{ url('admin/danhmuc/create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Thêm danh mục
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Mã DM</th>
                    <th class="px-6 py-3">Tên danh mục</th>
                    <th class="px-6 py-3">Mô tả</th>
                    <th class="px-6 py-3 w-[120px]">Trạng thái</th>
                    <th class="px-6 py-3">Ngày tạo</th>
                    <th class="px-6 py-3">Ngày cập nhật</th>
                    <th class="px-6 py-3 text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $dm)
                    <tr class="border-b hover:bg-gray-100 transition">
                        <td class="px-6 py-3">{{ $dm->maDanhMuc }}</td>
                        <td class="px-6 py-3">{{ $dm->tenDanhMuc }}</td>
                        <td class="px-6 py-3">{{ $dm->moTa ?? 'Chưa có' }}</td>
                        <td class="px-6 py-3 w-[120px]">
                            <span
                                class="px-2 py-1 rounded text-sm font-medium 
                                        {{ $dm->trangThai == 1 ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-700' }}">
                                {{ $dm->trangThai == 1 ? 'Hiển thị' : 'Ẩn' }}
                            </span>
                        </td>
                        <td class="px-6 py-3">{{ $dm->ngayTao ? date('d/m/Y', strtotime($dm->ngayTao)) : 'Chưa có' }}</td>
                        <td class="px-6 py-3">{{ $dm->ngayCapNhat ? date('d/m/Y', strtotime($dm->ngayCapNhat)) : 'Chưa có' }}</td>

                        <td class="px-6 py-3 text-center space-x-2">
                            <a href="{{ url('admin/danhmuc/update/' . $dm->maDanhMuc) }}"
                                class="inline-block bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-medium hover:bg-blue-200 transition">
                                Sửa
                            </a>

                            <a href="{{ url('admin/danhmuc/delete/' . $dm->maDanhMuc) }}"
                                onclick="return confirm('Bạn có chắc muốn xóa danh mục này không?')"
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
