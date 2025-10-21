@extends("admin.layout")

@section("do-du-lieu-tu-view")
    <h1 class="text-2xl font-semibold mb-4">Danh sách chấm công</h1>

    <div class="mb-4 flex items-center space-x-4">
        <form action="{{ url('chamcong/search') }}" method="GET" class="flex space-x-2">
            <input type="text" name="keyword" placeholder="Nhập mã hoặc tên nhân viên..."
                class="border px-3 py-2 rounded w-64" value="{{ request('keyword') }}">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                Tìm kiếm
            </button>
        </form>

        <a href="{{ url('chamcong/create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            + Thêm chấm công
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full text-sm text-left text-gray-600">
            <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">Mã chấm công</th>
                    <th class="px-6 py-3">Mã nhân viên</th>
                    <th class="px-6 py-3">Ngày chấm công</th>
                    <th class="px-6 py-3">Số giờ làm</th>
                    <th class="px-6 py-3">Số giờ tăng ca</th>
                    <th class="px-6 py-3">Trạng thái</th>
                    <th class="px-6 py-3 text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $cc)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="px-6 py-3">{{ $cc->maChamCong }}</td>
                        <td class="px-6 py-3">{{ $cc->maNhanVien }}</td>
                        <td class="px-6 py-3">{{ \Carbon\Carbon::parse($cc->ngayChamCong)->format('d/m/Y') }}</td>
                        <td class="px-6 py-3 text-center">{{ $cc->soGioLam }}</td>
                        <td class="px-6 py-3 text-center">{{ $cc->soGioTangCa }}</td>
                        <td class="px-6 py-3 text-center">{{ $cc->trangThai }}</td>
                        <td class="px-6 py-3 text-center space-x-2">
                            <a href="{{ url('chamcong/update/' . $cc->maChamCong) }}"
                                class="inline-block bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-medium hover:bg-blue-200 transition">
                                Sửa
                            </a>
                            <a href="{{ url('chamcong/delete/' . $cc->maChamCong) }}"
                                onclick="return confirm('Bạn có chắc muốn xóa bản chấm công này không?')"
                                class="inline-block bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-medium hover:bg-red-200 transition">
                                Xóa
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('admin.pagination', ['data' => $data])

@endsection
