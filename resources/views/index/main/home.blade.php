@php
    use App\Http\Controllers\Index\HomeController;
    $hotProducts = HomeController::hotProducts();
    $getProductsByCategory = HomeController::getProductsByCategory();
@endphp

@extends("index.layout_home")

@section("content")
    {{-- ======================= 🔥 SẢN PHẨM BÁN CHẠY NHẤT ======================= --}}
    <section id="best-sellers" class="py-16 bg-gray-50 overflow-hidden">
        <div class="container mx-auto px-4">
            <!-- Header -->
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-bold mb-3">
                    <span class="text-gray-900">Sản phẩm </span>
                    <span class="text-[#55d5d2]">bán chạy nhất</span>
                </h2>
                <p class="text-base md:text-lg text-gray-500 max-w-2xl mx-auto">
                    Những mẫu kính được yêu thích nhất bởi khách hàng của
                    <span class="font-semibold text-[#55d5d2]">Kính Mắt Anna</span>.
                </p>
            </div>

            <!-- Auto Scroll Wrapper -->
            <div class="relative overflow-hidden">
                <div class="flex gap-6 animate-scroll hover:pause-scroll">
                    @foreach ($hotProducts as $item)
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden min-w-[230px] sm:min-w-[260px] group hover:shadow-lg transition-all duration-300">
                            <div class="relative overflow-hidden">
                                <img src="{{ asset($item->hinhAnh ?? 'assets/no-image.png') }}" alt="{{ $item->tenSanPham }}"
                                     class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute top-2 left-2 bg-[#55d5d2] text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                                    Bán chạy
                                </div>
                                <a href="{{ url('products/detail/' . $item->maSanPham) }}"
                                   class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white font-semibold text-sm backdrop-blur-sm transition-all">
                                   Xem chi tiết
                                </a>
                            </div>
                            <div class="p-4">
                                <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-[#55d5d2] transition-colors">
                                    {{ $item->tenSanPham }}
                                </h3>
                                <!-- <p class="text-sm text-gray-500 mb-3 line-clamp-2">{{ $item->moTa }}</p> -->

                                {{-- Màu sắc --}}
                                <div class="flex gap-1.5 mb-3">
                                    @if (!empty($item->mauSac))
                                        @foreach ($item->mauSac as $color)
                                            <span class="w-4 h-4 rounded-full border border-gray-300 shadow-sm"
                                                  style="background-color: {{ $color }}"></span>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-bold text-[#55d5d2]">{{ number_format($item->giaGoc,0,',','.') }}đ</span>
                                    <button class="flex items-center gap-1 bg-[#55d5d2] text-white px-2.5 py-1.5 rounded-md hover:bg-[#48c2bf] transition-all transform hover:scale-105">
                                        <span class="material-icons text-sm">shopping_cart</span>
                                        <span class="hidden sm:inline text-sm">Mua</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ======================= 🛍️ SẢN PHẨM THEO DANH MỤC ======================= --}}
    <section id="category-products" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            @foreach ($getProductsByCategory as $category)
                @if (!empty($category['sanPham']))
                    <div class="mb-20">
                        <!-- Tiêu đề danh mục -->
                        <div class="flex items-center justify-between mb-8">
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 border-l-4 border-[#55d5d2] pl-3">
                                {{ $category['tenDanhMuc'] }}
                            </h2>
                            <a href="{{ url('products/category/' . $category['maDanhMuc']) }}"
                               class="text-[#55d5d2] font-semibold hover:underline">Xem tất cả →</a>
                        </div>

                        <!-- Auto Scroll Wrapper -->
                        <div class="relative overflow-hidden">
                            <div class="flex gap-6 animate-scroll hover:pause-scroll">
                                @foreach ($category['sanPham'] as $product)
                                    <div class="bg-gray-50 rounded-2xl shadow-sm hover:shadow-lg overflow-hidden group transition-all duration-300 min-w-[230px] sm:min-w-[260px]">
                                        <div class="relative">
                                            <img src="{{ asset($product->hinhAnh ?? 'assets/no-image.png') }}" alt="{{ $product->tenSanPham }}"
                                                 class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-500">
                                            <a href="{{ url('products/detail/' . $product->maSanPham) }}"
                                               class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white font-semibold text-sm backdrop-blur-sm transition-all">
                                               Xem chi tiết
                                            </a>
                                        </div>
                                        <div class="p-4">
                                            <h3 class="text-base font-bold text-gray-900 mb-1 group-hover:text-[#55d5d2] transition-colors">
                                                {{ $product->tenSanPham }}
                                            </h3>
                                            <!-- <p class="text-sm text-gray-500 mb-3 line-clamp-2">{{ $product->moTa }}</p> -->

                                            <div class="flex gap-1.5 mb-3">
                                                @if (!empty($product->mauSac))
                                                    @foreach ($product->mauSac as $color)
                                                        <span class="w-4 h-4 rounded-full border border-gray-300 shadow-sm"
                                                              style="background-color: {{ $color }}"></span>
                                                    @endforeach
                                                @endif
                                            </div>

                                            <div class="flex items-center justify-between">
                                                <span class="text-lg font-bold text-[#55d5d2]">{{ number_format($product->giaGoc,0,',','.') }}đ</span>
                                                <button class="flex items-center gap-1 bg-[#55d5d2] text-white px-2.5 py-1.5 rounded-md hover:bg-[#48c2bf] transition-all transform hover:scale-105">
                                                    <span class="material-icons text-sm">shopping_cart</span>
                                                    <span class="hidden sm:inline text-sm">Mua</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>

    <!-- Animation -->
    <style>
        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-scroll { display: flex; width: max-content; animation: scroll 25s linear infinite; }
        .hover\:pause-scroll:hover { animation-play-state: paused; }
    </style>
@endsection
