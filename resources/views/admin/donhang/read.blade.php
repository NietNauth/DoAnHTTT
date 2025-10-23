@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">Danh sách đơn hàng</h1>

    <div class="mb-4 flex items-center space-x-4">
        <form action="{{ url('admin/donhang/search') }}" method="GET" class="flex space-x-2">
            <input type="text" name="keyword" placeholder="Nhập mã đơn hoặc trạng thái..."
                class="border px-3 py-2 rounded w-64" value="{{ request('keyword') }}">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                Tìm kiếm
            </button>
        </form>

        <a href="{{ url('admin/donhang/create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Thêm đơn hàng
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Mã đơn</th>
                    <th class="px-6 py-3">Khách hàng</th>
                    <th class="px-6 py-3">Trạng thái</th>
                    <th class="px-6 py-3">Tổng tiền</th>
                    <th class="px-6 py-3">Ngày đặt</th>
                    <th class="px-6 py-3">Ngày tạo</th>
                    <th class="px-6 py-3">Ngày cập nhật</th>
                    <th class="px-6 py-3 text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $dh)
                    <tr class="border-b hover:bg-gray-100 transition">
                        <td class="px-6 py-3">{{ $dh->maDonHang }}</td>
                        <td class="px-6 py-3">{{ App\Models\Admin\KhachHang::find($dh->maKhachHang)->hoTen ?? 'Chưa có' }}</td>
                        <td class="px-6 py-3 w-[150px]">
                            <span
                                class="px-2 py-1 rounded text-sm font-medium 
                                    @if($dh->trangThai == 'Chờ xử lý') bg-yellow-100 text-yellow-700
                                    @elseif($dh->trangThai == 'Đang chuẩn bị') bg-blue-100 text-blue-700
                                    @elseif($dh->trangThai == 'Đang giao') bg-purple-100 text-purple-700
                                    @elseif($dh->trangThai == 'Hoàn thành') bg-green-100 text-green-700
                                    @else bg-red-100 text-red-700 @endif">
                                {{ $dh->trangThai }}
                            </span>
                        </td>
                        <td class="px-6 py-3">{{ number_format($dh->tongTien, 0, ',', '.') }}₫</td>
                        <td class="px-6 py-3">{{ $dh->ngayDat ? date('d/m/Y', strtotime($dh->ngayDat)) : 'Chưa có' }}</td>
                        <td class="px-6 py-3">{{ $dh->ngayTao ? date('d/m/Y', strtotime($dh->ngayTao)) : 'Chưa có' }}</td>
                        <td class="px-6 py-3">{{ $dh->ngayCapNhat ? date('d/m/Y', strtotime($dh->ngayCapNhat)) : 'Chưa có' }}</td>

                        <td class="px-6 py-3 text-center space-x-2">
                            <a href="{{ url('admin/donhang/detail/' . $dh->maDonHang) }}"
                                class="inline-block bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-medium hover:bg-green-200 transition">
                                Xem
                            </a>

                            <a href="{{ url('admin/donhang/update/' . $dh->maDonHang) }}"
                                class="inline-block bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-medium hover:bg-blue-200 transition">
                                Sửa
                            </a>

                            <a href="{{ url('admin/donhang/delete/' . $dh->maDonHang) }}"
                                onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này không?')"
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
