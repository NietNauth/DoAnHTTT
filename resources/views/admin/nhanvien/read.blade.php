@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">Danh sách nhân viên</h1>

    <div class="mb-4 flex items-center space-x-4">
        <form action="{{ url('admin/nhanvien/search') }}" method="GET" class="flex space-x-2">
            <input type="text" name="keyword" placeholder="Nhập mã, tên hoặc email nhân viên..."
                class="border px-3 py-2 rounded w-64" value="{{ request('keyword') }}">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                Tìm kiếm
            </button>
        </form>

        <a href="{{ url('admin/nhanvien/create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Thêm nhân viên
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Mã NV</th>
                    <th class="px-6 py-3">Họ tên</th>
                    <th class="px-6 py-3">Số điện thoại</th>
                    <th class="px-6 py-3">Chức vụ</th>
                    <th class="px-6 py-3 w-[150px]">Trạng thái</th>
                    <th class="px-6 py-3">Ngày tạo</th>
                    <th class="px-6 py-3">Ngày cập nhật</th>
                    <th class="px-6 py-3 text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $nv)
                    <tr class="border-b hover:bg-gray-100 transition">
                        <td class="px-6 py-3">{{ $nv->maNhanVien }}</td>
                        <td class="px-6 py-3">{{ $nv->hoTen }}</td>
                        <td class="px-6 py-3">{{ $nv->soDienThoai ?? 'Chưa có' }}</td>
                        <td class="px-6 py-3">{{ App\Models\Admin\ChucVu::find($nv->maChucVu)->tenChucVu ?? 'Chưa có' }}</td>
                        <td class="px-6 py-3 w-[150px]">
                            <span
                                class="px-2 py-1 rounded text-sm font-medium 
                                        {{ $nv->trangThai == 1 ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-700' }}">
                                {{ $nv->trangThai == 1 ? 'Đang làm' : 'Nghỉ việc' }}
                            </span>
                        </td>
                        <td class="px-6 py-3">{{ $nv->ngayTao ? date('d/m/Y', strtotime($nv->ngayTao)) : 'Chưa có' }}</td>
                        <td class="px-6 py-3">{{ $nv->ngayCapNhat ? date('d/m/Y', strtotime($nv->ngayCapNhat)) : 'Chưa có' }}
                        </td>

                        <td class="px-6 py-3 text-center space-x-2">
                            <a href="{{ url('admin/nhanvien/detail/' . $nv->maNhanVien) }}"
                                class="inline-block bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-medium hover:bg-green-200 transition">
                                Xem
                            </a>

                            <a href="{{ url('admin/nhanvien/update/' . $nv->maNhanVien) }}"
                                class="inline-block bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-medium hover:bg-blue-200 transition">
                                Sửa
                            </a>

                            <a href="{{ url('admin/nhanvien/delete/' . $nv->maNhanVien) }}"
                                onclick="return confirm('Bạn có chắc muốn xóa nhân viên này không?')"
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