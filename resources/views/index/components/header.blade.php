@php
    use App\Http\Controllers\Index\HomeController;
    $categories = HomeController::getAllCategories();

    // Lấy giỏ hàng từ session
    $cart = session()->get('cart', []);
    $cartCount = 0;
    foreach ($cart as $item) {
        $cartCount += $item['soLuong'] ?? 0;
    }

    // Tính tổng tiền
    $cartTotal = array_sum(array_map(fn($i) => $i['giaGoc'] * $i['soLuong'], $cart));
@endphp

<nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center gap-3 cursor-pointer select-none" onclick="window.location='{{ url('') }}'">
                <img src="{{ asset('images/logo.png') }}" alt="Kính mắt Anna"
                    class="h-20 md:h-24 w-auto object-contain transition-transform duration-300 hover:scale-105 drop-shadow-lg">
                <span class="text-3xl md:text-4xl font-extrabold tracking-wide text-gray-900">
                    Kính mắt <span class="text-[#55d5d2]">Anna</span>
                </span>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ url('/') }}" class="text-gray-900 hover:text-[#55d5d2] transition-colors">Trang chủ</a>

                <!-- Dropdown Danh mục -->
                <div class="relative group">
                    <button onclick="window.location='{{ url('products/all') }}'"
                        class="text-gray-900 hover:text-[#55d5d2] transition-colors flex items-center gap-1">
                        Danh mục <span class="material-icons text-sm">arrow_drop_down</span>
                    </button>
                    <div
                        class="absolute top-full left-0 mt-2 w-48 bg-white shadow-lg rounded-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all">
                        @foreach($categories as $category)
                            <a href="{{ url('products/category/' . $category->maDanhMuc) }}"
                                class="block px-4 py-2 text-gray-900 hover:bg-[#55d5d2] hover:text-white transition-colors">
                                {{ $category->tenDanhMuc }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <a href="#features" class="text-gray-900 hover:text-[#55d5d2] transition-colors">Tính năng</a>
                <a href="#testimonials" class="text-gray-900 hover:text-[#55d5d2] transition-colors">Đánh giá</a>
                <a href="#contact"
                    class="bg-[#55d5d2] text-white px-4 py-2 rounded hover:bg-[#45c2bf] transition-colors">Liên hệ</a>

                <!-- Cart Icon Desktop -->
                <div class="relative cursor-pointer group">
                    <span
                        class="material-icons text-[#55d5d2] text-3xl hover:scale-110 transition-transform" onclick="window.location=' {{ url('cart') }}'">shopping_cart</span>
                    @if($cartCount > 0)
                        <span
                            class="absolute -top-1 -right-2 bg-[#55d5d2] text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                            {{ $cartCount }}
                        </span>
                    @endif

                    <!-- Mini Cart Desktop -->
                    <div
                        class="absolute right-0 mt-2 w-64 bg-white border rounded-lg shadow-lg p-4 hidden group-hover:block z-50">
                        @if(!empty($cart))
                            <ul class="space-y-3 max-h-64 overflow-y-auto">
                                @foreach($cart as $item)
                                    <li class="flex items-center gap-3">
                                        <img src="{{ !empty($item['hinhAnh']) ? asset($item['hinhAnh']) : asset('assets/no-image.png') }}"
                                            alt="{{ $item['tenSanPham'] }}" class="w-12 h-12 object-cover rounded">
                                        <div class="flex-1">
                                            <p class="text-sm font-semibold">{{ $item['tenSanPham'] }}</p>
                                            <p class="text-xs text-gray-500">{{ $item['soLuong'] }} x
                                                {{ number_format($item['giaGoc'], 0, ',', '.') }}đ
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="mt-3 text-right font-semibold">
                                Tổng: {{ number_format($cartTotal, 0, ',', '.') }}đ
                            </div>
                            <!-- <a href="{{ url('cart') }}"
                                class="block mt-3 text-center bg-[#55d5d2] text-white py-2 rounded hover:bg-[#48c2bf] transition">
                                Xem giỏ hàng
                            </a> -->
                        @else
                            <p class="text-center text-gray-500 text-sm">Giỏ hàng trống</p>
                        @endif
                    </div>
                </div>

                <!-- Account -->
                <div class="relative group">
                    @if(Auth::check())
                        <!-- Nếu đã đăng nhập -->
                        <button class="text-gray-900 hover:text-[#55d5d2] transition-colors flex items-center gap-1">
                            {{ Auth::user()->khachHang->hoTen ?? Auth::user()->hoTen }}
                            <span class="material-icons text-sm">arrow_drop_down</span>
                        </button>
                        <div
                            class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all">
                            <a href="{{ url('tai-khoan') }}"
                                class="block px-4 py-2 text-gray-900 hover:bg-[#55d5d2] hover:text-white transition-colors">
                                Trang cá nhân
                            </a>
                            <a href="{{ url('my-orders') }}"
                                class="block px-4 py-2 text-gray-900 hover:bg-[#55d5d2] hover:text-white transition-colors">
                                Đơn hàng của tôi
                            </a>
                            <form method="POST" action="{{ url('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-gray-900 hover:bg-red-500 hover:text-white transition-colors">
                                    Đăng xuất
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- Nếu chưa đăng nhập -->
                        <a href="{{ url('login') }}" class="text-gray-900 hover:text-[#55d5d2] transition-colors">Đăng nhập</a>
                        
                    @endif
                </div>
            </div>

            <!-- Mobile Menu Button & Cart -->
            <div class="md:hidden flex items-center gap-3">
                <!-- Cart Icon Mobile -->
                <div class="relative cursor-pointer group">
                    <span class="material-icons text-[#55d5d2] text-3xl">shopping_cart</span>
                    @if($cartCount > 0)
                        <span
                            class="absolute -top-1 -right-2 bg-[#55d5d2] text-white text-xs font-bold px-1.5 py-0.5 rounded-full " onclick="window.location=' {{ url('cart') }}'">
                            {{ $cartCount }}
                        </span>
                    @endif

                    <!-- Mini Cart Mobile -->
                    <div
                        class="absolute right-0 mt-2 w-64 bg-white border rounded-lg shadow-lg p-4 hidden group-hover:block z-50">
                        @if(!empty($cart))
                            <ul class="space-y-3 max-h-64 overflow-y-auto">
                                @foreach($cart as $item)
                                    <li class="flex items-center gap-3">
                                        <img src="{{ !empty($item['hinhAnh']) ? asset($item['hinhAnh']) : asset('assets/no-image.png') }}"
                                            alt="{{ $item['tenSanPham'] }}" class="w-12 h-12 object-cover rounded">
                                        <div class="flex-1">
                                            <p class="text-sm font-semibold">{{ $item['tenSanPham'] }}</p>
                                            <p class="text-xs text-gray-500">{{ $item['soLuong'] }} x
                                                {{ number_format($item['giaGoc'], 0, ',', '.') }}đ
                                            </p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="mt-3 text-right font-semibold">
                                Tổng: {{ number_format($cartTotal, 0, ',', '.') }}đ
                            </div>
                            <a href="{{ url('cart') }}"
                                class="block mt-3 text-center bg-[#55d5d2] text-white py-2 rounded hover:bg-[#48c2bf] transition">
                                Xem giỏ hàng
                            </a>
                        @else
                            <p class="text-center text-gray-500 text-sm">Giỏ hàng trống</p>
                        @endif
                    </div>
                </div>

                <!-- Menu Toggle -->
                <input type="checkbox" id="menu-toggle" class="hidden" />
                <label for="menu-toggle"
                    class="cursor-pointer text-gray-900 hover:text-[#55d5d2] transition-colors duration-200">
                    <span class="material-icons" id="menu-icon">menu</span>
                </label>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden py-4 space-y-4 hidden" id="mobile-menu">
            <a href="{{ url('/') }}" class="block text-gray-900 hover:text-[#55d5d2] transition-colors">Trang chủ</a>

            <!-- Mobile Danh mục -->
            <div class="space-y-1">
                <span class="block text-gray-900 font-semibold px-4 py-2">Danh mục</span>
                @foreach($categories as $category)
                    <a href="{{ url('san-pham/danh-muc/' . $category->maDanhMuc) }}"
                        class="block pl-8 pr-4 py-2 text-gray-900 hover:bg-[#55d5d2] hover:text-white rounded transition-colors">
                        {{ $category->tenDanhMuc }}
                    </a>
                @endforeach
            </div>

            <!-- Mobile Account -->
            <div class="space-y-1">
                @if(Auth::check())
                    <span class="block text-gray-900 font-semibold px-4 py-2">Xin chào, {{ Auth::user()->khachHang->hoTen ?? Auth::user()->hoTen }}</span>
                    <a href="{{ url('tai-khoan') }}"
                        class="block pl-8 pr-4 py-2 text-gray-900 hover:bg-[#55d5d2] hover:text-white rounded transition-colors">
                        Trang cá nhân
                    </a>
                    <a href="{{ url('my-orders') }}"
                        class="block pl-8 pr-4 py-2 text-gray-900 hover:bg-[#55d5d2] hover:text-white rounded transition-colors">
                        Đơn hàng của tôi
                    </a>
                    <form method="POST" action="{{ url('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-left pl-8 pr-4 py-2 text-gray-900 hover:bg-red-500 hover:text-white rounded transition-colors">
                            Đăng xuất
                        </button>
                    </form>
                @else
                    <a href="{{ url('login') }}"
                        class="block pl-4 pr-4 py-2 text-gray-900 hover:bg-[#55d5d2] hover:text-white rounded transition-colors">
                        Đăng nhập
                    </a>
                @endif
            </div>

            <a href="#features" class="block text-gray-900 hover:text-[#55d5d2] transition-colors">Tính năng</a>
            <a href="#testimonials" class="block text-gray-900 hover:text-[#55d5d2] transition-colors">Đánh giá</a>
            <a href="#contact"
                class="block w-full text-center bg-[#55d5d2] text-white px-4 py-2 rounded hover:bg-[#45c2bf] transition-colors">
                Liên hệ
            </a>
        </div>
    </div>
</nav>

@push('scripts')
    <script>
        const menuToggle = document.getElementById("menu-toggle");
        const mobileMenu = document.getElementById("mobile-menu");
        const menuIcon = document.getElementById("menu-icon");

        menuToggle.addEventListener("change", () => {
            if (menuToggle.checked) {
                mobileMenu.classList.remove("hidden");
                menuIcon.textContent = "close";
            } else {
                mobileMenu.classList.add("hidden");
                menuIcon.textContent = "menu";
            }
        });
    </script>
@endpush
