@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">
        Cập nhật thưởng / phạt
    </h1>

    <form method="POST" action="{{ $action }}" class="space-y-4">
        @csrf

        {{-- Hàng 1: Thưởng + Phạt --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-medium">Thưởng</label>
                <input type="number" name="thuong" min="0" step="1000" 
                    class="border rounded w-full px-3 py-2" 
                    value="{{ old('thuong', $record->thuong ?? 0) }}">
                @error('thuong')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-medium">Phạt</label>
                <input type="number" name="phat" min="0" step="1000" 
                    class="border rounded w-full px-3 py-2" 
                    value="{{ old('phat', $record->phat ?? 0) }}">
                @error('phat')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Hàng 2: Ghi chú --}}
        <div>
            <label class="block mb-1 font-medium">Ghi chú</label>
            <input type="text" name="ghiChu" class="border rounded w-full px-3 py-2"
                value="{{ old('ghiChu', $record->ghiChu ?? '') }}">
            @error('ghiChu')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nút hành động --}}
        <div class="pt-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Cập nhật
            </button>
            <a href="{{ url('tinhluong') }}" class="ml-2 text-gray-600 hover:underline">Hủy</a>
        </div>
    </form>
@endsection
