@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">
        {{ isset($record) ? 'Cập nhật sản phẩm' : 'Thêm sản phẩm' }}
    </h1>

    <form method="POST" action="{{ $action }}" class="space-y-4">
        @csrf

        {{-- Mã sản phẩm + Tên sản phẩm 1 dòng --}}
        <div class="flex flex-col md:flex-row md:space-x-4">
            <div class="flex-1 mb-4 md:mb-0">
                <label class="block mb-1 font-medium">Mã sản phẩm</label>
                <input type="text" name="maSanPham" class="border rounded w-full px-3 py-2"
                    value="{{ old('maSanPham', $record->maSanPham ?? '') }}" placeholder="Nhập mã sản phẩm">
                @error('maSanPham')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex-1">
                <label class="block mb-1 font-medium">Tên sản phẩm</label>
                <input type="text" name="tenSanPham" class="border rounded w-full px-3 py-2"
                    value="{{ old('tenSanPham', $record->tenSanPham ?? '') }}" placeholder="Nhập tên sản phẩm">
                @error('tenSanPham')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Mô tả --}}
        <div>
            <label class="block mb-1 font-medium">Mô tả</label>
            <textarea name="moTa" class="border rounded w-full px-3 py-2" rows="4" placeholder="Mô tả sản phẩm">{{ old('moTa', $record->moTa ?? '') }}</textarea>
            @error('moTa')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Giá gốc --}}
        <div>
            <label class="block mb-1 font-medium">Giá gốc (VNĐ)</label>
            <input type="number" step="0.01" min="0" name="giaGoc" class="border rounded w-full px-3 py-2"
                value="{{ old('giaGoc', $record->giaGoc ?? '') }}">
            @error('giaGoc')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Giá nhập --}}
        <div>
            <label class="block mb-1 font-medium">Giá nhập (VNĐ)</label>
            <input type="number" step="0.01" min="0" name="giaNhap" class="border rounded w-full px-3 py-2"
                value="{{ old('giaNhap', $record->giaNhap ?? '') }}">
            @error('giaNhap')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Danh mục + Nhà cung cấp 1 dòng --}}
        <div class="flex flex-col md:flex-row md:space-x-4">
            <div class="flex-1 mb-4 md:mb-0">
                <label class="block mb-1 font-medium">Danh mục</label>
                <select name="maDanhMuc" class="border rounded w-full px-3 py-2">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach($danhMucList as $dm)
                        <option value="{{ $dm->maDanhMuc }}" {{ old('maDanhMuc', $record->maDanhMuc ?? '') == $dm->maDanhMuc ? 'selected' : '' }}>
                            {{ $dm->tenDanhMuc }}
                        </option>
                    @endforeach
                </select>
                @error('maDanhMuc')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex-1">
                <label class="block mb-1 font-medium">Nhà cung cấp</label>
                <select name="maNCC" class="border rounded w-full px-3 py-2">
                    <option value="">-- Chọn nhà cung cấp --</option>
                    @foreach($nhaCCList as $ncc)
                        <option value="{{ $ncc->maNCC }}" {{ old('maNCC', $record->maNCC ?? '') == $ncc->maNCC ? 'selected' : '' }}>
                            {{ $ncc->tenNCC }}
                        </option>
                    @endforeach
                </select>
                @error('maNCC')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Trạng thái --}}
        <div>
            <label class="block mb-1 font-medium">Trạng thái</label>
            <select name="trangThai" class="border rounded w-full px-3 py-2">
                <option value="1" {{ old('trangThai', $record->trangThai ?? '') == 1 ? 'selected' : '' }}>Hiển thị</option>
                <option value="0" {{ old('trangThai', $record->trangThai ?? '') == 0 ? 'selected' : '' }}>Ẩn</option>
            </select>
            @error('trangThai')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nút hành động --}}
        <div class="flex items-center space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ isset($record) ? 'Cập nhật' : 'Thêm mới' }}
            </button>
            <a href="{{ url('admin/sanpham') }}" class="text-gray-600 hover:underline">Hủy</a>
        </div>
    </form>
@endsection
