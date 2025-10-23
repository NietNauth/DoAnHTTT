@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">
        {{ isset($record) ? 'Cập nhật chức vụ' : 'Thêm chức vụ' }}
    </h1>

    <form method="POST" action="{{ $action }}" class="space-y-4">
        @csrf

        {{-- Hàng 1: Tên chức vụ --}}
        <div>
            <label class="block mb-1 font-medium">Tên chức vụ</label>
            <input type="text" name="tenChucVu" class="border rounded w-full px-3 py-2"
                value="{{ old('tenChucVu', $record->tenChucVu ?? '') }}">
            @error('tenChucVu')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Hàng 2: Mô tả --}}
        <div>
            <label class="block mb-1 font-medium">Mô tả</label>
            <textarea name="moTa" class="border rounded w-full px-3 py-2" rows="4"
                placeholder="Nhập mô tả ngắn về chức vụ...">{{ old('moTa', $record->moTa ?? '') }}</textarea>
            @error('moTa')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nút hành động --}}
        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ isset($record) ? 'Cập nhật' : 'Thêm mới' }}
            </button>
            <a href="{{ url('admin/chucvu') }}" class="ml-2 text-gray-600 hover:underline">Hủy</a>
        </div>
    </form>
@endsection
