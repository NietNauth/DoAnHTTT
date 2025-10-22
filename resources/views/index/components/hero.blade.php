<!-- resources/views/layouts/hero.blade.php -->
<section id="home" class="relative min-h-screen flex items-center pt-16">
    <!-- Background Image + Overlay -->
    <div class="absolute inset-0 bg-cover bg-center" 
         style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('assets/hero-glasses.jpg') }}');">
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl">
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6">
                Phong Cách Của Bạn
                <br />
                <span class="text-yellow-400">Tầm Nhìn Của Chúng Tôi</span>
            </h1>
            <p class="text-xl md:text-2xl text-white/90 mb-8">
                Khám phá bộ sưu tập mắt kính cao cấp được thiết kế hoàn hảo cho phong cách và sự thoải mái của bạn.
            </p>

            <div class="flex flex-col sm:flex-row gap-4">
                <!-- Button Khám phá ngay -->
                <a href="#products" class="inline-flex items-center justify-center bg-yellow-400 text-white px-6 py-3 rounded-lg font-semibold hover:bg-yellow-500 transition-colors group">
                    Khám phá ngay
                    <span class="material-icons ml-2 text-lg group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>

                <!-- Button Tìm hiểu thêm -->
                <a href="#features" class="inline-flex items-center justify-center border border-white text-white bg-white/10 hover:bg-white hover:text-blue-600 px-6 py-3 rounded-lg font-semibold transition-colors">
                    Tìm hiểu thêm
                </a>
            </div>
        </div>
    </div>
</section>
