@extends('index.layout_main')

@section('content')
<div class="container mx-auto py-20 px-4">
    <h1 class="text-3xl font-bold mb-8 text-center text-gray-900">
        Chi tiết đơn hàng: <span class="text-[#55d5d2]">{{ $donHang->maDonHang }}</span>
    </h1>

    {{-- Thông tin đơn hàng --}}
    <div class="bg-white p-6 rounded-2xl shadow-md space-y-2">
        <p><strong>Ngày đặt:</strong> {{ $donHang->ngayDat ?? 'N/A' }}</p>
        <p><strong>Tổng tiền:</strong> 
            <span class="text-xl font-bold text-[#55d5d2]">{{ number_format($donHang->tongTien,0,',','.') }}đ</span>
        </p>
        <p><strong>Trạng thái:</strong> 
            <span class="px-3 py-1 rounded-full text-white font-semibold
                {{ $donHang->trangThai == 'Chờ xử lý' ? 'bg-yellow-500' : '' }}
                {{ $donHang->trangThai == 'Đang chuẩn bị' ? 'bg-blue-500' : '' }}
                {{ $donHang->trangThai == 'Đang giao' ? 'bg-indigo-500' : '' }}
                {{ $donHang->trangThai == 'Hoàn thành' ? 'bg-green-500' : '' }}
                {{ $donHang->trangThai == 'Hủy' ? 'bg-red-500' : '' }}
            ">
                {{ $donHang->trangThai }}
            </span>
        </p>
        <p><strong>Ghi chú:</strong> {{ $donHang->ghiChu ?? '-' }}</p>
    </div>

    {{-- Danh sách sản phẩm --}}
    <h2 class="text-2xl font-semibold mt-8 mb-4 text-gray-800">Sản phẩm trong đơn</h2>
    <div class="space-y-4">
        @foreach($chiTiets as $item)
            @php
                $sp = $item->sanPhamThuocTinh->sanPham ?? null;
                $hinhAnh = $sp && $sp->hinhAnhs->first() ? $sp->hinhAnhs->first()->duongDan : 'assets/no-image.png';
            @endphp
            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4 p-4 bg-white rounded-2xl shadow hover:shadow-lg transition">
                <img src="{{ asset($hinhAnh) }}" alt="{{ $sp->tenSanPham ?? $item->maSPTT }}" class="w-24 h-24 object-cover rounded-lg flex-shrink-0">

                <div class="flex-1 space-y-1">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $sp->tenSanPham ?? $item->maSPTT }}</h3>
                    @if(!empty($item->sanPhamThuocTinh->mauSac))
                        <p class="text-gray-600 text-sm flex items-center gap-2">
                            Màu: 
                            <span class="w-5 h-5 rounded-full border border-gray-300" 
                                style="background-color: {{ $item->sanPhamThuocTinh->mauSac }}"></span>
                            {{ $item->sanPhamThuocTinh->mauSac }}
                        </p>
                    @endif
                    <p class="text-gray-600 text-sm">Số lượng: {{ $item->soLuong }}</p>
                </div>

                <div class="text-right space-y-1">
                    <p class="text-gray-900 font-semibold">Đơn giá: {{ number_format($item->donGia,0,',','.') }}đ</p>
                    <p class="text-gray-500 text-sm">Giảm: {{ number_format($item->giamGia ?? 0,0,',','.') }}đ</p>
                    <p class="text-gray-700 font-medium">Thành tiền: {{ number_format(($item->donGia - ($item->giamGia ?? 0)) * $item->soLuong,0,',','.') }}đ</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8 text-center">
        <a href="{{ route('orders.myOrders') }}"
           class="inline-block bg-[#55d5d2] hover:bg-[#48c2bf] text-white px-6 py-3 rounded-2xl font-semibold transition shadow-lg">
           Quay lại danh sách đơn hàng
        </a>
    </div>
</div>
@endsection
