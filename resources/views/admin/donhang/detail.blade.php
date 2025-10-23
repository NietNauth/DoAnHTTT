@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">Chi tiết đơn hàng: {{ $record->maDonHang }}</h1>

    {{-- Thông tin cơ bản --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Thông tin đơn hàng</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
            <p><strong>Khách hàng:</strong> {{ $record->hoTen ?? 'Chưa có' }}</p>
            <p><strong>Email:</strong> {{ $record->email ?? 'Chưa có' }}</p>
            <p><strong>Điện thoại:</strong> {{ $record->soDienThoai ?? 'Chưa có' }}</p>
            <p><strong>Địa chỉ:</strong> {{ $record->diaChi ?? 'Chưa có' }}</p>
            <p><strong>Ngày đặt:</strong> {{ \Carbon\Carbon::parse($record->ngayDat)->format('d/m/Y H:i') }}</p>
            <p><strong>Trạng thái:</strong>
                <span class="px-3 py-1 rounded-full text-sm font-medium 
                                                @if($record->trangThai == 'Chờ xử lý') bg-yellow-100 text-yellow-700
                                                @elseif($record->trangThai == 'Đang chuẩn bị') bg-blue-100 text-blue-700
                                                @elseif($record->trangThai == 'Đang giao') bg-purple-100 text-purple-700
                                                @elseif($record->trangThai == 'Hoàn thành') bg-green-100 text-green-700
                                                @else bg-red-100 text-red-700 @endif">
                    {{ $record->trangThai }}
                </span>
            </p>
            <p><strong>Tổng tiền:</strong> {{ number_format($record->tongTien, 0, ',', '.') }}₫</p>
            <p><strong>Mã khuyến mãi:</strong> {{ $record->maKhuyenMai ?? 'Không' }}</p>
            <p class="md:col-span-2"><strong>Ghi chú:</strong> {{ $record->ghiChu ?? 'Không' }}</p>
        </div>
    </div>

    {{-- Danh sách sản phẩm --}}
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">Chi tiết sản phẩm</h2>
        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full text-sm text-left text-gray-600">
                <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 w-[200px]">Hình ảnh</th>
                        <th class="px-6 py-3">Tên sản phẩm</th>
                        <th class="px-6 py-3">Màu sắc</th>
                        <th class="px-6 py-3">Số lượng</th>
                        <th class="px-6 py-3">Đơn giá</th>
                        <th class="px-6 py-3">Giảm giá</th>
                        <th class="px-6 py-3">Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($record->chiTietDonHang as $ct)
                        <tr class="border-b hover:bg-gray-100 transition w-[200px]">
                            <td class="px-6 py-3 w-20">
                                <img src="{{ asset($ct->sanPhamThuocTinh->sanPham->hinhAnhs?->first()?->duongDan ?? '') }}"
                                    alt="Hình sản phẩm" class="w-24 h-24 object-cover rounded">
                            </td>
                            <td class="px-6 py-3">{{ $ct->sanPhamThuocTinh->sanPham->tenSanPham ?? '' }}</td>
                            @php
                                // Chia chuỗi màu thành mảng, bỏ khoảng trắng nếu có
                                $colors = !empty($ct->sanPhamThuocTinh->mauSac)
                                    ? array_map('trim', explode(',', $ct->sanPhamThuocTinh->mauSac))
                                    : [];
                            @endphp

                            <td class="px-6 py-3 text-center">
                                <div class="flex justify-center items-center gap-1">
                                    @if (!empty($colors))
                                        @foreach ($colors as $color)
                                            <span class="w-5 h-5 rounded-full border border-gray-300 shadow-sm"
                                                style="background-color: {{ $color }};" title="{{ $color }}">
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="text-gray-400 text-xs">Không có màu</span>
                                    @endif
                                </div>
                            </td>


                            </td>
                            <td class="px-6 py-3">{{ $ct->soLuong }}</td>
                            <td class="px-6 py-3">{{ number_format($ct->donGia, 0, ',', '.') }}₫</td>
                            <td class="px-6 py-3">{{ number_format($ct->giamGia, 0, ',', '.') }}₫</td>
                            <td class="px-6 py-3">{{ number_format($ct->thanhTien, 0, ',', '.') }}₫</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Nút quay lại --}}
    <div class="mt-8 flex justify-center">
        <a href="{{ url('admin/donhang') }}"
            class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg transition font-medium shadow-sm">
            ← Quay lại danh sách
        </a>
    </div>
@endsection