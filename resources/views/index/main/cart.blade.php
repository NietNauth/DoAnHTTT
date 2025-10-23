@extends('index.layout_main')

@section('content')
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-extrabold mb-8 text-gray-900 text-center">Giỏ hàng của bạn</h1>

            {{-- Thông báo --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            @if(!empty($cart) && count($cart) > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg shadow-md">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th class="px-6 py-3 text-left">Sản phẩm</th>
                                <th class="px-6 py-3 text-center">Màu sắc</th>
                                <th class="px-6 py-3 text-center">Giá</th>
                                <th class="px-6 py-3 text-center">Số lượng</th>
                                <th class="px-6 py-3 text-center">Tổng</th>
                                <th class="px-6 py-3 text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach($cart as $cartKey => $item)
                                @php
                                    $subTotal = $item['giaGoc'] * $item['soLuong'];
                                    $total += $subTotal;
                                    $displayColor = $item['mauSac'] ?? null;
                                @endphp
                                <tr class="border-b">
                                    {{-- Hình ảnh + tên --}}
                                    <td class="px-6 py-4 flex items-center gap-4">
                                        <img src="{{ !empty($item['hinhAnh']) ? asset($item['hinhAnh']) : asset('assets/no-image.png') }}"
                                            alt="{{ $item['tenSanPham'] }}" class="w-16 h-16 object-cover rounded">
                                        <span class="font-semibold text-gray-800">{{ $item['tenSanPham'] }}</span>
                                    </td>

                                    {{-- Màu sắc --}}
                                    <td class="px-6 py-4 text-center">
                                        @if($displayColor)
                                            <span class="inline-block w-6 h-6 rounded-full border border-gray-300"
                                                style="background-color: {{ $displayColor }}"></span>
                                        @else
                                            <span class="text-gray-500">Chưa chọn</span>
                                        @endif
                                    </td>

                                    {{-- Giá --}}
                                    <td class="px-6 py-4 text-center text-gray-700">
                                        {{ number_format($item['giaGoc'], 0, ',', '.') }}đ
                                    </td>

                                    {{-- Số lượng --}}
                                    <td class="px-6 py-4 text-center">
                                        <form action="{{ url('cart/update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="cartKey" value="{{ $cartKey }}">
                                            <input type="number" name="soLuong" value="{{ $item['soLuong'] }}" min="1"
                                                class="w-16 px-2 py-1 border rounded text-center auto-submit">
                                        </form>
                                    </td>


                                    {{-- Tổng --}}
                                    <td class="px-6 py-4 text-center font-semibold text-gray-900">
                                        {{ number_format($subTotal, 0, ',', '.') }}đ
                                    </td>

                                    {{-- Xóa --}}
                                    <td class="px-6 py-4 text-center">
                                        <form action="{{ url('cart/remove') }}" method="POST"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xoá sản phẩm này?');">
                                            @csrf
                                            <input type="hidden" name="cartKey" value="{{ $cartKey }}">
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition">Xoá</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Tổng cộng & nút --}}
                <div class="mt-6 flex flex-col md:flex-row md:justify-between md:items-center">
                    <div class="text-lg font-semibold text-gray-800">
                        Tổng cộng: {{ number_format($total, 0, ',', '.') }}đ
                    </div>
                    <div class="mt-4 md:mt-0 flex gap-4">
                        {{-- Xoá toàn bộ giỏ --}}
                        <form action="{{ url('cart/clear') }}" method="POST"
                            onsubmit="return confirm('Bạn có chắc chắn muốn xoá toàn bộ giỏ hàng?');">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition">
                                Xoá toàn bộ giỏ
                            </button>
                        </form>

                        {{-- Thanh toán --}}
                        @if(Auth::check())
                            <button type="submit" onclick="location.href='{{ url('cart/checkout') }}'" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition">
                                Thanh toán
                            </button>
                        @else
                            <a href="{{ url('login') }}"
                                class="bg-gray-400 cursor-not-allowed text-white px-4 py-2 rounded transition">
                                Vui lòng đăng nhập để thanh toán
                            </a>
                        @endif

                        {{-- Tiếp tục mua sắm --}}
                        <a href="{{ url('/') }}"
                            class="bg-[#55d5d2] hover:bg-[#48c2bf] text-white px-4 py-2 rounded transition">
                            Tiếp tục mua sắm
                        </a>
                    </div>

                </div>
            @else
                <p class="text-gray-500 text-center mt-10 text-lg">Giỏ hàng trống.</p>
                <div class="text-center mt-6">
                    <a href="{{ url('/') }}" class="bg-[#55d5d2] hover:bg-[#48c2bf] text-white px-4 py-2 rounded transition">
                        Tiếp tục mua sắm
                    </a>
                </div>
            @endif
        </div>
    </section>
    <script>
        document.querySelectorAll('.auto-submit').forEach(input => {
            input.addEventListener('change', function () {
                this.closest('form').submit();
            });
        });
    </script>

@endsection