<!-- resources/views/layouts/product-showcase.blade.php -->
<section id="products" class="py-20 bg-gray-100">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl font-bold text-blue-600 mb-4">Bộ Sưu Tập Nổi Bật</h2>
            <p class="text-xl text-gray-500 max-w-2xl mx-auto">
                Khám phá những mẫu mắt kính được yêu thích nhất với thiết kế độc đáo và chất lượng vượt trội
            </p>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Product 1 -->
            <div class="bg-white rounded-lg overflow-hidden shadow-md group hover:shadow-xl transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="{{ asset('assets/glasses-1.jpg') }}" alt="Classic Aviator"
                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-blue-600 mb-2">Classic Aviator</h3>
                    <p class="text-gray-500 mb-4">Kính phi công cổ điển với gọng vàng cao cấp</p>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-yellow-400">2.990.000đ</span>
                        <button class="bg-yellow-400 text-white p-2 rounded-lg hover:bg-yellow-500 transition-transform group-hover:scale-110">
                            <span class="material-icons text-lg">shopping_cart</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="bg-white rounded-lg overflow-hidden shadow-md group hover:shadow-xl transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="{{ asset('assets/glasses-2.jpg') }}" alt="Modern Round"
                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-blue-600 mb-2">Modern Round</h3>
                    <p class="text-gray-500 mb-4">Gọng tròn hiện đại phong cách vintage</p>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-yellow-400">1.990.000đ</span>
                        <button class="bg-yellow-400 text-white p-2 rounded-lg hover:bg-yellow-500 transition-transform group-hover:scale-110">
                            <span class="material-icons text-lg">shopping_cart</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="bg-white rounded-lg overflow-hidden shadow-md group hover:shadow-xl transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="{{ asset('assets/glasses-3.jpg') }}" alt="Fashion Cat-Eye"
                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-blue-600 mb-2">Fashion Cat-Eye</h3>
                    <p class="text-gray-500 mb-4">Thiết kế mắt mèo thời trang nổi bật</p>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-yellow-400">2.490.000đ</span>
                        <button class="bg-yellow-400 text-white p-2 rounded-lg hover:bg-yellow-500 transition-transform group-hover:scale-110">
                            <span class="material-icons text-lg">shopping_cart</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="bg-white rounded-lg overflow-hidden shadow-md group hover:shadow-xl transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="{{ asset('assets/glasses-4.jpg') }}" alt="Executive Rectangle"
                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-blue-600 mb-2">Executive Rectangle</h3>
                    <p class="text-gray-500 mb-4">Gọng vuông thanh lịch cho doanh nhân</p>
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-yellow-400">1.790.000đ</span>
                        <button class="bg-yellow-400 text-white p-2 rounded-lg hover:bg-yellow-500 transition-transform group-hover:scale-110">
                            <span class="material-icons text-lg">shopping_cart</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button xem tất cả sản phẩm -->
        <div class="text-center mt-12">
            <a href="#all-products" class="inline-block px-8 py-4 bg-gray-200 text-gray-800 font-semibold rounded-lg hover:bg-gray-300 transition-colors">
                Xem tất cả sản phẩm
            </a>
        </div>
    </div>
</section>
