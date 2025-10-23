@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">
        {{ isset($record) ? 'Cập nhật chấm công' : 'Thêm chấm công' }}
    </h1>

    <form method="POST" action="{{ $action }}" class="space-y-4" id="chamCongForm">
        @csrf

        {{-- Hàng 1: Mã nhân viên + Ngày chấm công --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-medium">Nhân viên</label>
                <select name="maNhanVien" class="border rounded w-full px-3 py-2">
                    <option value="">-- Chọn nhân viên --</option>
                    @foreach ($nhanVienList as $nv)
                        <option value="{{ $nv->maNhanVien }}" {{ old('maNhanVien', $record->maNhanVien ?? '') == $nv->maNhanVien ? 'selected' : '' }}>
                            {{ $nv->hoTen }}
                        </option>
                    @endforeach
                </select>
                @error('maNhanVien')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-medium">Ngày chấm công</label>
                <input type="date" name="ngay" class="border rounded w-full px-3 py-2"
                    value="{{ old('ngay', isset($record->ngay) ? \Carbon\Carbon::parse($record->ngay)->format('Y-m-d') : '') }}">
                @error('ngay')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Hàng 2: Giờ vào + Giờ ra --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-medium">Giờ vào</label>
                <input type="time" id="gioVao" name="gioVao" class="border rounded w-full px-3 py-2"
                    value="{{ old('gioVao', $record->gioVao ?? '') }}">
                @error('gioVao')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label class="block mb-1 font-medium">Giờ ra</label>
                <input type="time" id="gioRa" name="gioRa" class="border rounded w-full px-3 py-2"
                    value="{{ old('gioRa', $record->gioRa ?? '') }}">
                @error('gioRa')
                    <div class="text-red-600 text-sm">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Hàng 3: Số giờ làm + Số giờ tăng ca --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-medium">Số giờ làm</label>
                <input type="number" id="soGioLam" name="soGioLam" min="0" step="0.5"
                    class="border rounded w-full px-3 py-2 bg-gray-100" readonly
                    value="{{ old('soGioLam', $record->soGioLam ?? '') }}">
            </div>

            <div>
                <label class="block mb-1 font-medium">Số giờ tăng ca</label>
                <input type="number" id="soGioTangCa" name="soGioTangCa" min="0" step="0.5"
                    class="border rounded w-full px-3 py-2 bg-gray-100" readonly
                    value="{{ old('soGioTangCa', $record->soGioTangCa ?? '') }}">
            </div>
        </div>

        {{-- Hàng 4: Trạng thái + Ghi chú --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-medium">Trạng thái</label>
                <select name="trangThai" class="border rounded w-full px-3 py-2">
                    <option value="Đi làm" {{ old('trangThai', $record->trangThai ?? '') == 'Đi làm' ? 'selected' : '' }}>Đi
                        làm</option>
                    <option value="Nghỉ phép" {{ old('trangThai', $record->trangThai ?? '') == 'Nghỉ phép' ? 'selected' : '' }}>Nghỉ phép</option>
                    <option value="Nghỉ không phép" {{ old('trangThai', $record->trangThai ?? '') == 'Nghỉ không phép' ? 'selected' : '' }}>Nghỉ không phép</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium">Ghi chú</label>
                <input type="text" name="ghiChu" class="border rounded w-full px-3 py-2"
                    value="{{ old('ghiChu', $record->ghiChu ?? '') }}">
            </div>
        </div>

        {{-- Nút hành động --}}
        <div class="pt-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ isset($record) ? 'Cập nhật' : 'Thêm mới' }}
            </button>
            <a href="{{ url('admin/chamcong') }}" class="ml-2 text-gray-600 hover:underline">Hủy</a>
        </div>
    </form>

    {{-- Script tính giờ --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const gioVao = document.getElementById('gioVao');
            const gioRa = document.getElementById('gioRa');
            const soGioLam = document.getElementById('soGioLam');
            const soGioTangCa = document.getElementById('soGioTangCa');

            // Cấu hình khoảng nghỉ (mặc định: 12:00 - 13:30)
            const breakStart = { h: 12, m: 0 };
            const breakEnd = { h: 13, m: 30 };

            // Chuyển giờ "HH:MM" -> số giờ dạng thập phân, trên cùng một ngày base
            function timeToHours(t) {
                const [hh, mm] = t.split(':').map(Number);
                return hh + mm / 60;
            }

            // Tính overlap (giờ) giữa 2 đoạn [a1,a2] và [b1,b2]
            function overlapHours(a1, a2, b1, b2) {
                const start = Math.max(a1, b1);
                const end = Math.min(a2, b2);
                return Math.max(0, end - start);
            }

            function tinhGio() {
                if (!gioVao.value || !gioRa.value) return;

                let start = timeToHours(gioVao.value);
                let end = timeToHours(gioRa.value);

                // Nếu end < start => qua đêm, cộng 24h cho end để tính diff đúng
                if (end < start) {
                    end += 24;
                }

                // Tính tổng giờ làm thực tế (chưa trừ nghỉ)
                let totalWorked = end - start;

                // Tính overlap với khoảng nghỉ (chú ý handle qua ngày)
                // Thực hiện check cả bản sao break + 24 để cover trường hợp start trước nửa đêm và end sau nửa đêm
                const breakStartH = breakStart.h + breakStart.m / 60;
                const breakEndH = breakEnd.h + breakEnd.m / 60;

                // Tính overlap trên cùng "trục" giờ
                let breakOverlap = 0;

                // 1) Check overlap bình thường (không qua đêm)
                breakOverlap += overlapHours(start, end, breakStartH, breakEndH);

                // 2) Nếu end > 24 (qua đêm), cần kiểm tra khoảng nghỉ +24
                if (end > 24) {
                    breakOverlap += overlapHours(start, end, breakStartH + 24, breakEndH + 24);
                }

                // Đảm bảo không trừ quá nhiều
                if (breakOverlap > totalWorked) breakOverlap = totalWorked;

                // Giờ làm chuẩn = tổng giờ trừ phần nghỉ (tối đa 8)
                let actualWorked = Math.max(0, totalWorked - breakOverlap);
                let normalWork = Math.min(actualWorked, 8);
                let overtime = Math.max(0, actualWorked - 8);

                // Làm tròn 2 chữ số thập phân (bạn có thể đổi step)
                soGioLam.value = Number(normalWork.toFixed(2));
                soGioTangCa.value = Number(overtime.toFixed(2));
            }

            gioVao.addEventListener('change', tinhGio);
            gioRa.addEventListener('change', tinhGio);

            tinhGio();
        });
    </script>
@endsection