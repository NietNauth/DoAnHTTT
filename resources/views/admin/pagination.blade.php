@if ($data->hasPages())
    <div class="mt-6 flex justify-center">
        <ul class="inline-flex items-center -space-x-px">
            {{-- Nút Previous --}}
            @if ($data->onFirstPage())
                <li>
                    <span
                        class="px-3 py-2 ml-0 leading-tight text-gray-400 bg-white border border-gray-300 rounded-l-lg cursor-not-allowed">
                        Trước
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $data->previousPageUrl() }}"
                        class="px-3 py-2 ml-0 leading-tight text-gray-700 bg-white border border-gray-300 rounded-l-lg hover:bg-blue-50 hover:text-blue-600">
                        Trước
                    </a>
                </li>
            @endif

            {{-- Các số trang --}}
            @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                @if ($page == $data->currentPage())
                    <li>
                        <span
                            class="px-3 py-2 leading-tight text-white bg-blue-600 border border-blue-600">{{ $page }}</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $url }}"
                            class="px-3 py-2 leading-tight text-gray-700 bg-white border border-gray-300 hover:bg-blue-50 hover:text-blue-600">
                            {{ $page }}
                        </a>
                    </li>
                @endif
            @endforeach

            {{-- Nút Next --}}
            @if ($data->hasMorePages())
                <li>
                    <a href="{{ $data->nextPageUrl() }}"
                        class="px-3 py-2 leading-tight text-gray-700 bg-white border border-gray-300 rounded-r-lg hover:bg-blue-50 hover:text-blue-600">
                        Tiếp
                    </a>
                </li>
            @else
                <li>
                    <span
                        class="px-3 py-2 leading-tight text-gray-400 bg-white border border-gray-300 rounded-r-lg cursor-not-allowed">
                        Tiếp
                    </span>
                </li>
            @endif
        </ul>
    </div>
@endif