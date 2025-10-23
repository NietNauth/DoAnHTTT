<!-- resources/views/layouts/testimonials.blade.php -->
<section id="testimonials" class="py-20 bg-[#f8fefe]">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl font-bold text-[#55d5d2] mb-4">
                Khách Hàng Nói Gì
            </h2>
            <p class="text-xl text-gray-500 max-w-2xl mx-auto">
                Hơn <span class="font-semibold text-[#55d5d2]">10.000+</span> khách hàng hài lòng đã tin tưởng Kính mắt Anna
            </p>
        </div>

        <!-- Testimonials Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Testimonial 1 -->
            <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-t-4 border-[#55d5d2]">
                <!-- Rating -->
                <div class="flex gap-1 mb-4 justify-center">
                    @for ($i = 0; $i < 5; $i++)
                        <span class="material-icons text-yellow-400 text-lg">star</span>
                    @endfor
                </div>

                <!-- Content -->
                <p class="text-gray-600 mb-6 italic text-center">
                    "Chất lượng tuyệt vời, thiết kế sang trọng. Tôi rất hài lòng với mắt kính này!"
                </p>

                <!-- Author -->
                <div class="flex flex-col items-center border-t border-gray-200 pt-4">
                    <img src="{{ asset('images/khachhang.jpg') }}" alt="Nguyễn Văn A"
                        class="w-14 h-14 rounded-full object-cover mb-3 border-2 border-[#55d5d2]">
                    <p class="font-semibold text-[#55d5d2]">Nguyễn Văn A</p>
                    <p class="text-sm text-gray-500">Doanh nhân</p>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-t-4 border-[#55d5d2]">
                <div class="flex gap-1 mb-4 justify-center">
                    @for ($i = 0; $i < 5; $i++)
                        <span class="material-icons text-yellow-400 text-lg">star</span>
                    @endfor
                </div>

                <p class="text-gray-600 mb-6 italic text-center">
                    "Mẫu mắt kính đẹp nhất tôi từng sở hữu. Rất phù hợp với phong cách của tôi."
                </p>

                <div class="flex flex-col items-center border-t border-gray-200 pt-4">
                    <img src="{{ asset('images/khachhang.jpg') }}" alt="Trần Thị B"
                        class="w-14 h-14 rounded-full object-cover mb-3 border-2 border-[#55d5d2]">
                    <p class="font-semibold text-[#55d5d2]">Trần Thị B</p>
                    <p class="text-sm text-gray-500">Blogger thời trang</p>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="bg-white rounded-2xl p-8 shadow-md hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-t-4 border-[#55d5d2]">
                <div class="flex gap-1 mb-4 justify-center">
                    @for ($i = 0; $i < 5; $i++)
                        <span class="material-icons text-yellow-400 text-lg">star</span>
                    @endfor
                </div>

                <p class="text-gray-600 mb-6 italic text-center">
                    "Tròng kính chống UV tuyệt vời, đeo rất thoải mái suốt cả ngày dài."
                </p>

                <div class="flex flex-col items-center border-t border-gray-200 pt-4">
                    <img src="{{ asset('images/khachhang.jpg') }}" alt="Lê Minh C"
                        class="w-14 h-14 rounded-full object-cover mb-3 border-2 border-[#55d5d2]">
                    <p class="font-semibold text-[#55d5d2]">Lê Minh C</p>
                    <p class="text-sm text-gray-500">Nhiếp ảnh gia</p>
                </div>
            </div>
        </div>
    </div>
</section>
