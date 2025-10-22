@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">
        {{ isset($record) ? 'Cập nhật danh mục' : 'Thêm danh mục' }}
    </h1>

    <form method="POST" action="{{ $action }}" class="space-y-4">
        @csrf

        {{-- Mã danh mục (tự sinh, không sửa) --}}
        <div>
            <label class="block mb-1 font-medium">Mã danh mục</label>
            <input type="text" class="border rounded w-full px-3 py-2 bg-gray-100"
                value="{{ isset($record) ? $record->maDanhMuc : 'Hệ thống tự sinh' }}" disabled>
        </div>

        {{-- Tên danh mục --}}
        <div>
            <label class="block mb-1 font-medium">Tên danh mục</label>
            <input type="text" name="tenDanhMuc" class="border rounded w-full px-3 py-2"
                value="{{ old('tenDanhMuc', $record->tenDanhMuc ?? '') }}">
            @error('tenDanhMuc')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Mô tả --}}
        <div>
            <label class="block mb-1 font-medium">Mô tả</label>
            <textarea name="moTa" class="border rounded w-full px-3 py-2" rows="4">{{ old('moTa', $record->moTa ?? '') }}</textarea>
            @error('moTa')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
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
            <a href="{{ url('danhmuc') }}" class="text-gray-600 hover:underline">Hủy</a>
        </div>
    </form>
@endsection
s