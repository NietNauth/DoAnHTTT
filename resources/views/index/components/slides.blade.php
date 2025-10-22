<div x-data="{ current: 0, slides: ['{{ asset('images/slide1.jpg') }}', '{{ asset('images/slide2.jpg') }}', '{{ asset('images/slide3.jpg') }}'] }"
     x-init="setInterval(() => current = (current + 1) % slides.length, 5000)"
     class="relative w-full h-[80vh] overflow-hidden bg-gray-100">

    <!-- Slides -->
    <template x-for="(slide, index) in slides" :key="index">
        <div class="absolute inset-0 transition-transform duration-700 ease-in-out"
             :style="`transform: translateX(${(index - current) * 100}%);`">
            <img :src="slide" class="w-full h-full object-cover" alt="Kính mắt Anna slide">
            <div class="absolute inset-0 bg-black/40 flex flex-col justify-center items-center text-center text-white px-4">
                <template x-if="index === 0">
                    <div>
                        <h1 class="text-4xl md:text-6xl font-extrabold mb-4">Kính mắt <span class="text-[#55d5d2]">Anna</span></h1>
                        <p class="text-lg md:text-2xl mb-6 max-w-2xl">Thời trang – chất lượng – tự tin trong từng ánh nhìn.</p>
                        <a href="#products"
                           class="bg-[#55d5d2] px-6 py-3 rounded-lg text-white font-semibold hover:bg-[#44c2bf] transition-all duration-300 shadow-lg">
                           Khám phá ngay
                        </a>
                    </div>
                </template>

                <template x-if="index === 1">
                    <div>
                        <h1 class="text-4xl md:text-6xl font-extrabold mb-4">Đẳng cấp <span class="text-[#55d5d2]">Phong cách</span></h1>
                        <p class="text-lg md:text-2xl mb-6 max-w-2xl">Mắt kính cao cấp phù hợp mọi khuôn mặt và cá tính.</p>
                        <a href="#features"
                           class="bg-[#55d5d2] px-6 py-3 rounded-lg text-white font-semibold hover:bg-[#44c2bf] transition-all duration-300 shadow-lg">
                           Xem thêm
                        </a>
                    </div>
                </template>

                <template x-if="index === 2">
                    <div>
                        <h1 class="text-4xl md:text-6xl font-extrabold mb-4">Bảo vệ <span class="text-[#55d5d2]">Đôi mắt</span> bạn</h1>
                        <p class="text-lg md:text-2xl mb-6 max-w-2xl">Tròng kính chống tia UV – bảo vệ và tôn lên phong cách riêng.</p>
                        <a href="#contact"
                           class="bg-[#55d5d2] px-6 py-3 rounded-lg text-white font-semibold hover:bg-[#44c2bf] transition-all duration-300 shadow-lg">
                           Liên hệ ngay
                        </a>
                    </div>
                </template>
            </div>
        </div>
    </template>

    <!-- Nút chuyển -->
    <button @click="current = (current - 1 + slides.length) % slides.length"
            class="absolute left-4 top-1/2 -translate-y-1/2 bg-black/30 hover:bg-[#55d5d2]/60 text-white p-3 rounded-full">
        <span class="material-icons">chevron_left</span>
    </button>

    <button @click="current = (current + 1) % slides.length"
            class="absolute right-4 top-1/2 -translate-y-1/2 bg-black/30 hover:bg-[#55d5d2]/60 text-white p-3 rounded-full">
        <span class="material-icons">chevron_right</span>
    </button>

    <!-- Chấm tròn -->
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-3">
        <template x-for="(slide, index) in slides" :key="index">
            <button @click="current = index"
                    class="w-3 h-3 rounded-full transition-all duration-300"
                    :class="current === index ? 'bg-[#55d5d2] scale-125' : 'bg-white/70'"></button>
        </template>
    </div>
</div>
