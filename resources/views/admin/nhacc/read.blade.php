@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">Danh sách nhà cung cấp</h1>

    <div class="mb-4 flex items-center space-x-4">
        <form action="{{ url('nhacc/search') }}" method="GET" class="flex space-x-2">
            <input type="text" name="keyword" placeholder="Nhập mã hoặc tên nhà cung cấp..."
                class="border px-3 py-2 rounded w-64" value="{{ request('keyword') }}">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                Tìm kiếm
            </button>
        </form>

        <a href="{{ url('nhacc/create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Thêm nhà cung cấp
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Mã NCC</th>
                    <th class="px-6 py-3">Tên nhà cung cấp</th>
                    <th class="px-6 py-3">Số điện thoại</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Địa chỉ</th>
                    <th class="px-6 py-3">Người liên hệ</th>
                    <th class="px-6 py-3 w-[150px]">Trạng thái</th>
                    <th class="px-6 py-3">Ngày tạo</th>
                    <th class="px-6 py-3">Ngày cập nhật</th>
                    <th class="px-6 py-3 text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $ncc)
                    <tr class="border-b hover:bg-gray-100 transition">
                        <td class="px-6 py-3">{{ $ncc->maNCC }}</td>
                        <td class="px-6 py-3">{{ $ncc->tenNCC }}</td>
                        <td class="px-6 py-3">{{ $ncc->soDienThoai ?? 'Chưa có' }}</td>
                        <td class="px-6 py-3">{{ $ncc->email ?? 'Chưa có' }}</td>
                        <td class="px-6 py-3">{{ $ncc->diaChi ?? 'Chưa có' }}</td>
                        <td class="px-6 py-3">{{ $ncc->nguoiLienHe ?? 'Chưa có' }}</td>
                        <td class="px-6 py-3 w-[150px]">
                            <span
                                class="px-2 py-1 rounded text-sm font-medium 
                                        {{ $ncc->trangThai == 1 ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-700' }}">
                                {{ $ncc->trangThai == 1 ? 'Hoạt động' : 'Ngưng' }}
                            </span>
                        </td>
                        <td class="px-6 py-3">{{ $ncc->ngayTao ? date('d/m/Y', strtotime($ncc->ngayTao)) : 'Chưa có' }}</td>
                        <td class="px-6 py-3">{{ $ncc->ngayCapNhat ? date('d/m/Y', strtotime($ncc->ngayCapNhat)) : 'Chưa có' }}</td>

                        <td class="px-6 py-3 text-center space-x-2">
                            <a href="{{ url('nhacc/detail/' . $ncc->maNCC) }}"
                                class="inline-block bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-medium hover:bg-green-200 transition">
                                Xem
                            </a>

                            <a href="{{ url('nhacc/update/' . $ncc->maNCC) }}"
                                class="inline-block bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-medium hover:bg-blue-200 transition">
                                Sửa
                            </a>

                            <a href="{{ url('nhacc/delete/' . $ncc->maNCC) }}"
                                onclick="return confirm('Bạn có chắc muốn xóa nhà cung cấp này không?')"
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
