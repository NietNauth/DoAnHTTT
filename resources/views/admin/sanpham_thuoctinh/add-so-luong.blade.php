@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">Thêm số lượng cho thuộc tính SP</h1>

    <form method="POST" action="{{ $action }}" class="space-y-4">
        @csrf

        {{-- Hiển thị thông tin thuộc tính (không chỉnh sửa) --}}
        <div class="flex flex-col md:flex-row md:space-x-4">
            <div class="flex-1 mb-4 md:mb-0">
                <label class="block mb-1 font-medium">Mã sản phẩm</label>
                <input type="text" class="border rounded w-full px-3 py-2 bg-gray-100" 
                       value="{{ $record->maSanPham }}" disabled>
            </div>

            <div class="flex-1">
                <label class="block mb-1 font-medium">Màu sắc</label>
                <input type="text" class="border rounded w-full px-3 py-2 bg-gray-100"
                       value="{{ $record->mauSac }}" disabled>
            </div>
        </div>

        {{-- Nhập số lượng muốn thêm --}}
        <div>
            <label class="block mb-1 font-medium">Số lượng thêm</label>
            <input type="number" name="soLuongThem" min="1" class="border rounded w-full px-3 py-2"
                   value="{{ old('soLuongThem', 1) }}" placeholder="Nhập số lượng muốn thêm">
            @error('soLuongThem')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nút hành động --}}
        <div class="flex items-center space-x-2">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Thêm số lượng
            </button>
            <a href="{{ url('admin/sanpham-thuoctinh') }}" class="text-gray-600 hover:underline">Hủy</a>
        </div>
    </form>
@endsection
