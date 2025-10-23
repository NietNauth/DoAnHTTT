@extends("index.layout_main")

@section("content")
<section id="product-detail" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">

            {{-- Hình ảnh sản phẩm --}}
            <div>
                <div class="relative rounded-2xl shadow-lg overflow-hidden">
                    <img id="mainImage"
                        src="{{ !empty($images) ? asset($images[0]->duongDan) : asset('assets/no-image.png') }}"
                        alt="{{ $product->tenSanPham }}"
                        class="w-full h-96 object-cover rounded-2xl transition-transform duration-500 hover:scale-105">

                    @if($product->isHot ?? false)
                        <div class="absolute top-3 left-3 bg-[#55d5d2] text-white text-sm font-semibold px-3 py-1 rounded-full shadow">
                            Bán chạy
                        </div>
                    @endif
                </div>

                @if(!empty($images) && count($images) > 1)
                    <div class="flex gap-4 mt-4 overflow-x-auto">
                        @foreach($images as $img)
                            <img src="{{ asset($img->duongDan) }}" alt="Hình {{ $loop->iteration }}"
                                class="w-28 h-28 sm:w-32 sm:h-32 object-cover rounded-lg border-2 border-gray-200 cursor-pointer hover:scale-105 transition-transform"
                                onclick="document.getElementById('mainImage').src='{{ asset($img->duongDan) }}'">
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Thông tin sản phẩm --}}
            <div class="flex flex-col justify-start">
                <h1 class="text-3xl md:text-4xl font-extrabold mb-3 text-gray-900">{{ $product->tenSanPham }}</h1>
                <p class="text-gray-500 mb-6">{{ $product->moTa }}</p>

                {{-- Giá sản phẩm --}}
                <div class="text-3xl font-bold text-[#55d5d2] mb-6">
                    {{ number_format($product->giaGoc, 0, ',', '.') }}đ
                </div>

                {{-- Chọn màu sắc --}}
                @if(!empty($attributes))
                    <div class="flex items-center gap-3 mb-4" id="colorOptions">
                        @foreach($attributes as $attr)
                            @if(!empty($attr->mauSac))
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="mauSac" value="{{ $attr->mauSac }}" class="hidden" data-stock="{{ $attr->soLuong }}">
                                    <span class="w-7 h-7 rounded-full border-2 border-gray-300 shadow-sm block"
                                        style="background-color: {{ $attr->mauSac }}" title="{{ $attr->mauSac }}">
                                    </span>
                                </label>
                            @endif
                        @endforeach
                    </div>
                    <div id="stockInfo" class="text-sm text-gray-600 mb-6"></div>
                @endif

                {{-- Chọn số lượng --}}
                <div class="mb-6">
                    <label class="block mb-1 font-medium text-gray-700">Số lượng:</label>
                    <input type="number" id="soLuongInput" name="soLuong" value="1" min="1" class="w-20 border rounded px-2 py-1">
                </div>

                {{-- Form thêm vào giỏ --}}
                <form id="addToCartForm" action="{{ url('cart/buy') }}" method="POST">
                    @csrf
                    <input type="hidden" name="maSanPham" value="{{ $product->maSanPham }}">
                    <input type="hidden" id="hiddenSoLuong" name="soLuong" value="1">
                    <input type="hidden" id="hiddenMauSac" name="mauSac" value="">
                    <button type="submit"
                        class="flex items-center justify-center gap-3 bg-[#55d5d2] text-white px-6 py-3 rounded-xl hover:bg-[#48c2bf] hover:scale-105 transition-transform shadow-lg">
                        <span class="material-icons text-lg">shopping_cart</span>
                        <span class="font-semibold text-lg">Thêm vào giỏ</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <style>
        #product-detail img { transition: all 0.3s ease-in-out; }
    </style>

    <script>
        const form = document.getElementById('addToCartForm');
        const colorOptions = document.querySelectorAll('#colorOptions input[type="radio"]');
        const stockInfo = document.getElementById('stockInfo');
        const soLuongInput = document.getElementById('soLuongInput');
        const hiddenSoLuong = document.getElementById('hiddenSoLuong');
        const hiddenMauSac = document.getElementById('hiddenMauSac');

        let selectedStock = 0;

        // Khi chọn màu
        colorOptions.forEach(input => {
            input.addEventListener('change', () => {
                // highlight
                colorOptions.forEach(i => i.nextElementSibling.classList.remove('ring-2', 'ring-[#55d5d2]'));
                input.nextElementSibling.classList.add('ring-2', 'ring-[#55d5d2]');

                // hiển thị tồn kho
                selectedStock = parseInt(input.dataset.stock);
                stockInfo.textContent = `Còn ${selectedStock} sản phẩm trong kho.`;

                // giới hạn số lượng
                soLuongInput.max = selectedStock;
                if (soLuongInput.value > selectedStock) soLuongInput.value = selectedStock;

                // đồng bộ màu vào hidden
                hiddenMauSac.value = input.value;
            });
        });

        // Đồng bộ số lượng
        soLuongInput.addEventListener('input', () => {
            let val = parseInt(soLuongInput.value);
            if (isNaN(val) || val < 1) val = 1;
            if (selectedStock && val > selectedStock) val = selectedStock;
            soLuongInput.value = val;
            hiddenSoLuong.value = val;
        });

        // Kiểm tra trước khi submit
        form.addEventListener('submit', function (e) {
            if (!hiddenMauSac.value) {
                e.preventDefault();
                alert('Vui lòng chọn màu sắc trước khi thêm vào giỏ!');
            }
        });
    </script>
</section>
@endsection
