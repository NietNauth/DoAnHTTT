@extends('index.layout_main')

@section('content')
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-extrabold mb-12 text-center text-gray-900">Thanh toán giỏ hàng</h1>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-6 text-center font-medium">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-6 text-center font-medium">
                    {{ session('error') }}
                </div>
            @endif

            @if(!empty($cart) && count($cart) > 0)
                @php
                    $total = 0;
                    $discount = session('couponAmount') ?? 0;

                    // Lấy thông tin khách hàng từ Auth
                    $hoTen = Auth::check() ? (Auth::user()->khachHang->hoTen ?? Auth::user()->hoTen) : '';
                    $diaChi = Auth::check() ? (Auth::user()->khachHang->diaChi ?? Auth::user()->diaChi ?? '') : '';
                    $soDienThoai = Auth::check() ? (Auth::user()->khachHang->soDienThoai ?? Auth::user()->soDienThoai ?? '') : '';
                    $email = Auth::check() ? (Auth::user()->khachHang->email ?? Auth::user()->email ?? '') : '';
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Bên trái: Giỏ hàng --}}
                    <div>
                        <h2 class="text-xl font-semibold mb-4 text-gray-800">Sản phẩm trong giỏ</h2>
                        <div class="space-y-4">
                            @foreach($cart as $item)
                                @php
                                    $subTotal = $item['giaGoc'] * $item['soLuong'];
                                    $total += $subTotal;
                                @endphp
                                <div class="flex items-center gap-4 p-4 bg-white rounded-xl shadow hover:shadow-lg transition">
                                    <img src="{{ !empty($item['hinhAnh']) ? asset($item['hinhAnh']) : asset('assets/no-image.png') }}"
                                        alt="{{ $item['tenSanPham'] }}" class="w-20 h-20 object-cover rounded-lg">
                                    <div class="flex-1">
                                        <h3 class="text-lg font-semibold text-gray-800">{{ $item['tenSanPham'] }}</h3>
                                        @if(!empty($item['mauSac']))
                                            <div class="flex items-center gap-2 mt-1">
                                                <span class="text-gray-600 text-sm">Màu:</span>
                                                <span class="w-5 h-5 rounded-full border border-gray-300"
                                                    style="background-color: {{ $item['mauSac'] }}"></span>
                                            </div>
                                        @endif
                                        <p class="text-gray-600 mt-1">Số lượng: {{ $item['soLuong'] }}</p>
                                        <p class="text-gray-900 font-semibold mt-1">{{ number_format($subTotal, 0, ',', '.') }}đ</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Bên phải: Form thanh toán --}}
                    <div class="bg-white p-8 rounded-2xl shadow-lg space-y-4">
                        <h2 class="text-2xl font-semibold mb-4 text-gray-800 text-center">Thông tin khách hàng</h2>

                        <div class="text-right text-xl font-bold text-gray-900 mb-4">
                            Tổng tiền: {{ number_format($total, 0, ',', '.') }}đ
                        </div>

                        <form action="{{ route('cart.processCheckout') }}" method="POST">
                            @csrf

                            <div>
                                <label class="block mb-1 font-medium text-gray-700">Họ tên</label>
                                <input type="text" name="hoTen"
                                    class="border rounded-lg w-full px-4 py-2 focus:ring-2 focus:ring-blue-400"
                                    value="{{ old('hoTen', $hoTen) }}" required>
                                @error('hoTen') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div>
                                <label class="block mb-1 font-medium text-gray-700">Địa chỉ</label>
                                <input type="text" name="diaChi"
                                    class="border rounded-lg w-full px-4 py-2 focus:ring-2 focus:ring-blue-400"
                                    value="{{ old('diaChi', $diaChi) }}" required>
                                @error('diaChi') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div>
                                <label class="block mb-1 font-medium text-gray-700">Số điện thoại</label>
                                <input type="tel" name="soDienThoai"
                                    class="border rounded-lg w-full px-4 py-2 focus:ring-2 focus:ring-blue-400"
                                    value="{{ old('soDienThoai', $soDienThoai) }}" required>
                                @error('soDienThoai') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div>
                                <label class="block mb-1 font-medium text-gray-700">Email</label>
                                <input type="email" name="email"
                                    class="border rounded-lg w-full px-4 py-2 focus:ring-2 focus:ring-blue-400"
                                    value="{{ old('email', $email) }}" required>
                                @error('email') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                            </div>

                            {{-- Mã giảm giá --}}
                            <div>
                                <label class="block mb-1 font-medium text-gray-700">Mã giảm giá (nếu có)</label>
                                <div class="flex gap-2">
                                    <input type="text" name="maKhuyenMai"
                                        class="border rounded-lg flex-1 px-4 py-2 focus:ring-2 focus:ring-blue-400"
                                        value="{{ old('maKhuyenMai') }}">
                                    <button type="submit" name="applyCoupon" value="1"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                                        Áp dụng
                                    </button>
                                </div>
                                @if(session('couponError'))
                                    <div class="text-red-600 text-sm mt-1">{{ session('couponError') }}</div>
                                @endif
                                @if(session('couponSuccess'))
                                    <div class="text-green-600 text-sm mt-1">{{ session('couponSuccess') }}</div>
                                @endif
                            </div>

                            {{-- Tổng tiền sau giảm --}}
                            @if($discount > 0)
                                <div class="text-right text-lg font-semibold text-gray-700">
                                    Giảm: {{ number_format($discount, 0, ',', '.') }}đ
                                </div>
                                <div class="text-right text-xl font-bold text-gray-900">
                                    Tổng sau giảm: {{ number_format($total - $discount, 0, ',', '.') }}đ
                                </div>
                            @endif

                            <div>
                                <label class="block mb-1 font-medium text-gray-700">Phương thức thanh toán</label>
                                <select name="phuongThuc" required
                                    class="border rounded-lg w-full px-4 py-2 focus:ring-2 focus:ring-blue-400">
                                    <option value="">-- Chọn phương thức --</option>
                                    <option value="Tiền mặt">Tiền mặt</option>
                                    <option value="Chuyển khoản">Chuyển khoản</option>
                                    <option value="Ví điện tử">Ví điện tử</option>
                                </select>
                                @error('phuongThuc') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div>
                                <label class="block mb-1 font-medium text-gray-700">Ghi chú (nếu có)</label>
                                <textarea name="ghiChu"
                                    class="border rounded-lg w-full px-4 py-2 focus:ring-2 focus:ring-blue-400"
                                    rows="3">{{ old('ghiChu') }}</textarea>
                                @error('ghiChu')
                                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Nút thanh toán --}}
                            <div class="flex flex-col md:flex-row gap-4 mt-6">
                                @if(Auth::check())
                                    <button type="submit"
                                        class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-3 rounded-xl transition">
                                        Thanh toán
                                    </button>
                                @else
                                    <a href="{{ url('login') }}"
                                        class="bg-gray-400 cursor-not-allowed text-white font-semibold px-6 py-3 rounded-xl text-center transition">
                                        Đăng nhập để thanh toán
                                    </a>
                                @endif
                                <a href="{{ url('/') }}"
                                    class="bg-blue-400 hover:bg-blue-500 text-white font-semibold px-6 py-3 rounded-xl text-center transition">
                                    Tiếp tục mua sắm
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

            @else
                <p class="text-gray-500 text-center mt-10 text-lg">Giỏ hàng trống.</p>
                <div class="text-center mt-6">
                    <a href="{{ url('/') }}" class="bg-blue-400 hover:bg-blue-500 text-white px-6 py-3 rounded-xl transition">
                        Tiếp tục mua sắm
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection