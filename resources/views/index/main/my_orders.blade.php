@extends('index.layout_main')

@section('content')
<div class="container mx-auto py-20">
    <h1 class="text-3xl font-bold mb-12 text-center text-gray-900">Đơn hàng của tôi</h1>

    @if($donHangs->isEmpty())
        <p class="text-center text-gray-500 text-lg">Bạn chưa có đơn hàng nào.</p>
        <div class="text-center mt-6">
            <a href="{{ url('/') }}"
               class="bg-blue-400 hover:bg-blue-500 text-white px-6 py-3 rounded-lg font-medium transition">
               Tiếp tục mua sắm
            </a>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-lg rounded-xl overflow-hidden">
                <thead class="bg-gradient-to-r from-blue-400 to-blue-500 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left">Mã đơn</th>
                        <th class="px-6 py-3 text-left">Ngày đặt</th>
                        <th class="px-6 py-3 text-left">Tổng tiền</th>
                        <th class="px-6 py-3 text-left">Trạng thái</th>
                        <th class="px-6 py-3 text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donHangs as $donHang)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-mono text-gray-800">{{ $donHang->maDonHang }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $donHang->ngayDat ? $donHang->ngayDat->format('d/m/Y H:i') : 'N/A' }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-800">{{ number_format($donHang->tongTien,0,',','.') }}đ</td>
                            <td class="px-6 py-4">
                                @if($donHang->trangThai == 'Chờ xử lý')
                                    <span class="px-3 py-1 bg-yellow-200 text-yellow-800 rounded-full text-sm font-medium">{{ $donHang->trangThai }}</span>
                                @elseif($donHang->trangThai == 'Đang giao')
                                    <span class="px-3 py-1 bg-blue-200 text-blue-800 rounded-full text-sm font-medium">{{ $donHang->trangThai }}</span>
                                @elseif($donHang->trangThai == 'Hoàn thành')
                                    <span class="px-3 py-1 bg-green-200 text-green-800 rounded-full text-sm font-medium">{{ $donHang->trangThai }}</span>
                                @else
                                    <span class="px-3 py-1 bg-red-200 text-red-800 rounded-full text-sm font-medium">{{ $donHang->trangThai }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('orders.detail', $donHang->maDonHang) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition">
                                   Xem chi tiết
                                </a>
                                &nbsp;
                                <a href=""
                                   class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium transition">
                                   Hủy đơn
                                </a>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
