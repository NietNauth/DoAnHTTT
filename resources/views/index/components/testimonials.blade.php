<!-- resources/views/layouts/testimonials.blade.php -->
<section id="testimonials" class="py-20 bg-gray-100">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-4xl md:text-5xl font-bold text-blue-600 mb-4">Khách Hàng Nói Gì</h2>
            <p class="text-xl text-gray-500 max-w-2xl mx-auto">
                Hàng nghìn khách hàng hài lòng đã tin tưởng lựa chọn chúng tôi
            </p>
        </div>

        <!-- Testimonials Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
            <!-- Testimonial 1 -->
            <div class="bg-white rounded-lg p-6 shadow-md hover:shadow-xl transition-all duration-300">
                <!-- Rating -->
                <div class="flex gap-1 mb-4">
                    @for ($i = 0; $i < 5; $i++)
                        <span class="material-icons text-yellow-400 text-lg">star</span>
                    @endfor
                </div>
                <!-- Content -->
                <p class="text-gray-500 mb-4 italic">
                    "Chất lượng tuyệt vời, thiết kế sang trọng. Tôi rất hài lòng với mắt kính này!"
                </p>
                <!-- Author -->
                <div class="border-t border-gray-200 pt-4">
                    <p class="font-semibold text-blue-600">Nguyễn Văn A</p>
                    <p class="text-sm text-gray-500">Doanh nhân</p>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="bg-white rounded-lg p-6 shadow-md hover:shadow-xl transition-all duration-300">
                <div class="flex gap-1 mb-4">
                    @for ($i = 0; $i < 5; $i++)
                        <span class="material-icons text-yellow-400 text-lg">star</span>
                    @endfor
                </div>
                <p class="text-gray-500 mb-4 italic">
                    "Mẫu mắt kính đẹp nhất tôi từng sở hữu. Rất phù hợp với phong cách của tôi."
                </p>
                <div class="border-t border-gray-200 pt-4">
                    <p class="font-semibold text-blue-600">Trần Thị B</p>
                    <p class="text-sm text-gray-500">Blogger thời trang</p>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="bg-white rounded-lg p-6 shadow-md hover:shadow-xl transition-all duration-300">
                <div class="flex gap-1 mb-4">
                    @for ($i = 0; $i < 5; $i++)
                        <span class="material-icons text-yellow-400 text-lg">star</span>
                    @endfor
                </div>
                <p class="text-gray-500 mb-4 italic">
                    "Tròng kính chống UV tuyệt vời, đeo rất thoải mái suốt cả ngày dài."
                </p>
                <div class="border-t border-gray-200 pt-4">
                    <p class="font-semibold text-blue-600">Lê Minh C</p>
                    <p class="text-sm text-gray-500">Nhiếp ảnh gia</p>
                </div>
            </div>
        </div>
    </div>
</section>
