@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">
        {{ isset($record) ? 'Cập nhật hình ảnh SP' : 'Thêm hình ảnh SP' }}
    </h1>

    <form method="POST" action="{{ $action }}" class="space-y-4" enctype="multipart/form-data">
        @csrf

        {{-- Mã sản phẩm + Thứ tự 1 dòng --}}
        <div class="flex flex-col md:flex-row md:space-x-4">
            <div class="flex-1 mb-4 md:mb-0">
                <label class="block mb-1 font-medium">Mã sản phẩm</label>
                <select name="maSanPham" class="border rounded w-full px-3 py-2">
                    <option value="">-- Chọn sản phẩm --</option>
                    @foreach($sanPhamList as $sp)
                        <option value="{{ $sp->maSanPham }}" {{ old('maSanPham', $record->maSanPham ?? '') == $sp->maSanPham ? 'selected' : '' }}>
                            {{ $sp->tenSanPham }}
                        </option>
                    @endforeach
                </select>
                @error('maSanPham')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex-1">
                <label class="block mb-1 font-medium">Thứ tự</label>
                <input type="number" name="thuTu" min="0" class="border rounded w-full px-3 py-2"
                    value="{{ old('thuTu', $record->thuTu ?? 0) }}" placeholder="Nhập thứ tự hiển thị">
                @error('thuTu')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Ảnh sản phẩm --}}
        <div>
            <label class="block mb-1 font-medium">Ảnh sản phẩm</label>
            <input type="file" name="duongDan" class="border rounded w-full px-3 py-2" accept="image/*">
            @if(isset($record) && $record->duongDan)
                <div class="mt-2">
                    <img src="{{ asset($record->duongDan) }}" alt="Ảnh hiện tại" class="w-32 h-32 object-cover rounded">
                </div>
            @endif
            @error('duongDan')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nút hành động --}}
        <div class="flex items-center space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ isset($record) ? 'Cập nhật' : 'Thêm mới' }}
            </button>
            <a href="{{ url('sanpham-hinhanh') }}" class="text-gray-600 hover:underline">Hủy</a>
        </div>
    </form>
@endsection
