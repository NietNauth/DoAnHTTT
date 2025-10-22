<nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center gap-3 cursor-pointer select-none">
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
                <a href="#products" class="text-gray-900 hover:text-[#55d5d2] transition-colors">Sản phẩm</a>
                <a href="#features" class="text-gray-900 hover:text-[#55d5d2] transition-colors">Tính năng</a>
                <a href="#testimonials" class="text-gray-900 hover:text-[#55d5d2] transition-colors">Đánh giá</a>
                <a href="#contact"
                    class="bg-[#55d5d2] text-white px-4 py-2 rounded hover:bg-[#45c2bf] transition-colors">Liên hệ</a>

                <!-- Cart Icon -->
                <div class="relative cursor-pointer">
                    <span class="material-icons text-[#55d5d2] text-3xl hover:scale-110 transition-transform">shopping_cart</span>
                    <span
                        class="absolute -top-1 -right-2 bg-[#55d5d2] text-white text-xs font-bold px-1.5 py-0.5 rounded-full">2</span>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden flex items-center gap-3">
                <!-- Cart Icon (Mobile) -->
                <div class="relative cursor-pointer">
                    <span class="material-icons text-[#55d5d2] text-3xl">shopping_cart</span>
                    <span
                        class="absolute -top-1 -right-2 bg-[#55d5d2] text-white text-xs font-bold px-1.5 py-0.5 rounded-full">2</span>
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
            <a href="#products" class="block text-gray-900 hover:text-[#55d5d2] transition-colors">Sản phẩm</a>
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
