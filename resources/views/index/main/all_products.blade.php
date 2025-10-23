@extends("index.layout_main")

@section("content")
<section id="all-products" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl md:text-4xl font-extrabold mb-8 text-gray-900 text-center">
            Tất cả sản phẩm
        </h1>

        @if(!empty($products) && count($products) > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden group">
                        
                        {{-- Hình ảnh --}}
                        <div class="relative overflow-hidden">
                            <img src="{{ !empty($product->images) ? asset($product->images[0]->duongDan) : asset('assets/no-image.png') }}"
                                 alt="{{ $product->tenSanPham }}"
                                 class="w-full h-40 object-cover transition-transform duration-500 group-hover:scale-105">

                            @if($product->isHot ?? false)
                                <div class="absolute top-2 left-2 bg-linear-to-r from-pink-500 via-red-500 to-yellow-400 text-white text-xs font-semibold px-2 py-1 rounded-full shadow animate-pulse">
                                    Bán chạy
                                </div>
                            @endif
                        </div>

                        {{-- Thông tin --}}
                        <div class="p-3 flex flex-col justify-between">
                            <div>
                                <h2 class="text-sm font-semibold text-gray-900 mb-1 truncate">{{ $product->tenSanPham }}</h2>
                                <div class="text-[#55d5d2] font-bold text-base mb-1">
                                    {{ number_format($product->giaGoc, 0, ',', '.') }}đ
                                </div>

                                {{-- Màu sắc --}}
                                @if(!empty($product->attributes))
                                    <div class="flex items-center gap-1 mt-1">
                                        @foreach($product->attributes as $attr)
                                            @if(!empty($attr->mauSac))
                                                <span class="w-4 h-4 rounded-full border border-gray-200 cursor-pointer hover:ring-1 hover:ring-[#55d5d2] transition-all duration-200"
                                                      style="background-color: {{ $attr->mauSac }}" title="{{ $attr->mauSac }}">
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            {{-- Nút Xem chi tiết --}}
                            <a href="{{ url('products/detail/' . $product->maSanPham) }}"
                               class="mt-2 flex items-center justify-center gap-1 bg-[#55d5d2] text-white px-3 py-1.5 rounded-lg hover:bg-[#48c2bf] hover:scale-105 transition-transform text-xs shadow-sm">
                                <span class="material-icons text-sm">visibility</span>
                                <span>Xem chi tiết</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-400 text-center mt-16 text-lg">Hiện chưa có sản phẩm nào.</p>
        @endif
    </div>
</section>
@endsection
