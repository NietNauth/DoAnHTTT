@php
    use App\Http\Controllers\Index\HomeController;
    $categories = HomeController::getAllCategories();

    // Lấy giỏ hàng từ session
    $cart = session()->get('cart', []);
    $cartCount = 0;
    foreach ($cart as $item) {
        $cartCount += $item['soLuong'] ?? 0;
    }
@endphp

<nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center gap-3 cursor-pointer select-none" onclick="window.location='{{ url('') }}'">
                <img src="{{ asset('images/logo.png') }}" alt="Kính mắt Anna"
                    class="h-20 md:h-24 w-auto object-contain transition-transform duration-300 hover:scale-105 drop-shadow-lg">
                <span class="text-3xl md:text-4xl font-extrabold tracking-wide text-gray-900">
                    Kính mắt
                    <span class="text-[#55d5d2]">Anna</span>
                </span>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-8">
                <a href="#home" class="text-gray-900 hover:text-[#55d5d2] transition-colors">Trang chủ</a>

                <!-- Dropdown Danh mục -->
                <div class="relative group">
                    <button onclick="window.location='{{ url('products/all') }}'"
                        class="text-gray-900 hover:text-[#55d5d2] transition-colors flex items-center gap-1">
                        Danh mục
                        <span class="material-icons text-sm">arrow_drop_down</span>
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

                <!-- Cart Icon -->
                <div class="relative cursor-pointer" onclick="window.location='{{ url('cart') }}'">
                    <span class="material-icons text-[#55d5d2] text-3xl hover:scale-110 transition-transform">shopping_cart</span>
                    @if($cartCount > 0)
                        <span class="absolute -top-1 -right-2 bg-[#55d5d2] text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                            {{ $cartCount }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center gap-3">
                <!-- Cart Icon (Mobile) -->
                <div class="relative cursor-pointer" onclick="window.location='{{ url('cart') }}'">
                    <span class="material-icons text-[#55d5d2] text-3xl">shopping_cart</span>
                    @if($cartCount > 0)
                        <span class="absolute -top-1 -right-2 bg-[#55d5d2] text-white text-xs font-bold px-1.5 py-0.5 rounded-full">
                            {{ $cartCount }}
                        </span>
                    @endif
                </div>

                <input type="checkbox" id="menu-toggle" class="hidden" />
                <label for="menu-toggle" class="cursor-pointer text-gray-900">
                    <span class="material-icons" id="menu-icon">menu</span>
                </label>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden py-4 space-y-4 hidden" id="mobile-menu">
            <a href="#home" class="block text-gray-900 hover:text-[#55d5d2] transition-colors">Trang chủ</a>

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

            <a href="#features" class="block text-gray-900 hover:text-[#55d5d2] transition-colors">Tính năng</a>
            <a href="#testimonials" class="block text-gray-900 hover:text-[#55d5d2] transition-colors">Đánh giá</a>
            <a href="#contact"
                class="block w-full text-center bg-[#55d5d2] text-white px-4 py-2 rounded hover:bg-[#45c2bf] transition-colors">Liên
                hệ</a>
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
