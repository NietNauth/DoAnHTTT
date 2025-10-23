<!-- resources/views/layouts/footer.blade.php -->
<footer class="bg-[#042f2e] text-white">
    <div class="container mx-auto px-4 py-14">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
            <!-- Logo + Giới thiệu -->
            <div>
                <div class="flex items-center gap-3 mb-5">
                    <img src="{{ asset('images/logo.png') }}" alt="Kính mắt Anna"
                        class="h-12 w-auto object-contain drop-shadow-md">
                    <span class="text-2xl font-extrabold tracking-wide">
                        Kính mắt <span class="text-[#55d5d2]">Anna</span>
                    </span>
                </div>
                <p class="text-white/80 leading-relaxed">
                    Mang đến phong cách và tầm nhìn hoàn hảo cho bạn với những sản phẩm kính chất lượng cao,
                    thời trang và bền bỉ theo thời gian.
                </p>
            </div>

            <!-- Sản phẩm -->
            <div>
                <h3 class="font-semibold mb-4 text-[#55d5d2] uppercase tracking-wide">Sản phẩm</h3>
                <ul class="space-y-2 text-white/80">
                    <li><a href="#" class="hover:text-[#55d5d2] transition-colors">Kính râm</a></li>
                    <li><a href="#" class="hover:text-[#55d5d2] transition-colors">Gọng kính</a></li>
                    <li><a href="#" class="hover:text-[#55d5d2] transition-colors">Kính thể thao</a></li>
                    <li><a href="#" class="hover:text-[#55d5d2] transition-colors">Phụ kiện</a></li>
                </ul>
            </div>

            <!-- Hỗ trợ -->
            <div>
                <h3 class="font-semibold mb-4 text-[#55d5d2] uppercase tracking-wide">Hỗ trợ</h3>
                <ul class="space-y-2 text-white/80">
                    <li><a href="#" class="hover:text-[#55d5d2] transition-colors">Chính sách đổi trả</a></li>
                    <li><a href="#" class="hover:text-[#55d5d2] transition-colors">Hướng dẫn chọn kính</a></li>
                    <li><a href="#" class="hover:text-[#55d5d2] transition-colors">Câu hỏi thường gặp</a></li>
                    <li><a href="#" class="hover:text-[#55d5d2] transition-colors">Liên hệ</a></li>
                </ul>
            </div>

            <!-- Liên hệ -->
            <div>
                <h3 class="font-semibold mb-4 text-[#55d5d2] uppercase tracking-wide">Liên hệ</h3>
                <ul class="space-y-3 text-white/80">
                    <li class="flex items-center gap-2">
                        <span class="material-icons text-[#55d5d2]">phone</span>
                        <span>1900 888 999</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-icons text-[#55d5d2]">email</span>
                        <span>info@kinhmatanna.vn</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="material-icons text-[#55d5d2]">location_on</span>
                        <span>123 Nguyễn Trãi, Q.1, TP.HCM</span>
                    </li>
                </ul>

                <!-- Mạng xã hội -->
                <div class="flex gap-5 mt-5">
                    <a href="#" class="hover:text-[#55d5d2] transition-colors">
                        <span class="material-icons text-2xl">facebook</span>
                    </a>
                    <a href="#" class="hover:text-[#55d5d2] transition-colors">
                        <span class="material-icons text-2xl">instagram</span>
                    </a>
                    <a href="#" class="hover:text-[#55d5d2] transition-colors">
                        <span class="material-icons text-2xl">tiktok</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-white/10 mt-10 pt-6 text-center text-white/60 text-sm">
            <p>&copy; 2025 <span class="text-[#55d5d2] font-semibold">Kính mắt Anna</span>. Tất cả quyền được bảo lưu.</p>
        </div>
    </div>
</footer>
