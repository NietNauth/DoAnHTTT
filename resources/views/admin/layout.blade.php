<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý mắt kính</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <script>
    tailwind.config = {
      darkMode: false,
      theme: {
        extend: {
          colors: {
            accent: '#6366F1', // Indigo 500 – xanh tím nhẹ
            lightBg: '#F9FAFB', // nền xám sáng
            textMain: '#1F2937', // text xám đậm
            textSub: '#6B7280' // text phụ
          }
        }
      }
    }
  </script>
</head>

<body class="bg-lightBg flex font-sans text-textMain">

  <!-- Sidebar -->
  <aside class="w-64 h-screen fixed bg-white shadow-sm border-r border-gray-300">
    <div class="p-5 border-b border-gray-300">
      <h1 class="text-xl font-semibold text-accent tracking-tight">Admin Panel</h1>
      <p class="text-sm text-textSub">Kính mắt ANNA</p>
    </div>

    <nav class="mt-4">
      <ul class="space-y-1">
        <li>
          <a href="{{ url('admin/') }}"
            class="flex items-center px-4 py-2 text-textSub hover:text-accent hover:bg-indigo-50 rounded-lg transition">
            <span class="material-icons mr-3">dashboard</span>
            Trang chủ
          </a>
        </li>

        <li
          x-data="{ open: {{ request()->is('admin/sanpham*') || request()->is('admin/sanpham-hinhanh*') || request()->is('admin/sanpham-thuoctinh*') ? 'true' : 'false' }} }">

          <!-- Menu cha -->
          <button @click="open = !open" class="flex items-center justify-between w-full text-left px-4 py-2 rounded-lg transition
    {{ request()->is('admin/sanpham*') || request()->is('admin/sanpham-hinhanh*') || request()->is('admin/sanpham-thuoctinh*')
  ? 'bg-indigo-50 text-accent font-medium'
  : 'text-textSub hover:text-accent hover:bg-indigo-50' }}">

            <div class="flex items-center">
              <span
                class="material-icons mr-3 shrink-0 {{ request()->is('admin/sanpham*') || request()->is('admin/sanpham-hinhanh*') || request()->is('admin/sanpham-thuoctinh*') ? 'text-accent' : '' }}">
                inventory
              </span>
              <span class="whitespace-normal wrap-break-words leading-snug truncate">
                Quản lý sản phẩm
              </span>
            </div>

            <span class="material-icons transition-transform duration-200"
              :class="open ? 'rotate-180 text-accent' : ''">
              expand_more
            </span>
          </button>

          <!-- Menu con -->
          <ul x-show="open" x-collapse class="pl-8 mt-1 space-y-1">
            <li>
              <a href="{{ url('admin/sanpham') }}" class="flex items-center px-3 py-2 rounded-lg transition
    {{ request()->is('admin/sanpham') || request()->is('admin/sanpham/*') ? 'bg-indigo-50 text-accent font-medium border-l-4 border-accent'
  : 'text-textSub hover:text-accent hover:bg-indigo-50' }}">
                <span
                  class="material-icons mr-3 text-sm {{ request()->is('admin/sanpham') || request()->is('admin/sanpham/*') ? 'text-accent' : '' }}">
                  inventory_2
                </span>
                Sản phẩm
              </a>
            </li>

            <li>
              <a href="{{ url('admin/sanpham-hinhanh') }}" class="flex items-center px-3 py-2 rounded-lg transition
    {{ request()->is('admin/sanpham-hinhanh*') ? 'bg-indigo-50 text-accent font-medium border-l-4 border-accent'
  : 'text-textSub hover:text-accent hover:bg-indigo-50' }}">
                <span
                  class="material-icons mr-3 text-sm {{ request()->is('admin/sanpham-hinhanh*') ? 'text-accent' : '' }}">
                  image
                </span>
                Sản phẩm hình ảnh
              </a>
            </li>

            <li>
              <a href="{{ url('admin/sanpham-thuoctinh') }}" class="flex items-center px-3 py-2 rounded-lg transition
    {{ request()->is('admin/sanpham-thuoctinh*') ? 'bg-indigo-50 text-accent font-medium border-l-4 border-accent'
  : 'text-textSub hover:text-accent hover:bg-indigo-50' }}">
                <span
                  class="material-icons mr-3 text-sm {{ request()->is('admin/sanpham-thuoctinh*') ? 'text-accent' : '' }}">
                  tune
                </span>
                Sản phẩm thuộc tính
              </a>
            </li>
          </ul>
        </li>

        <li>
          <a href="{{ url('admin/nhacc') }}"
            class="flex items-center px-4 py-2 text-textSub hover:text-accent hover:bg-indigo-50 rounded-lg transition">
            <span class="material-icons mr-3">store</span>
            Nhà Cung Cấp
          </a>
        </li>
        <li>
          <a href="{{ url('admin/danhmuc') }}"
            class="flex items-center px-4 py-2 text-textSub hover:text-accent hover:bg-indigo-50 rounded-lg transition">
            <span class="material-icons mr-3">category</span>
            Danh Mục
          </a>
        </li>
        <li>
          <a href="{{ url('admin/tinhluong') }}"
            class="flex items-center px-4 py-2 text-textSub hover:text-accent hover:bg-indigo-50 rounded-lg transition">
            <span class="material-icons mr-3">payments</span>
            Tính Lương
          </a>
        </li>
        <li>
          <a href="{{ url('admin/chamcong') }}"
            class="flex items-center px-4 py-2 text-textSub hover:text-accent hover:bg-indigo-50 rounded-lg transition">
            <span class="material-icons mr-3">schedule</span>
            Chấm Công
          </a>
        </li>
        <li>
          <a href="{{ url('admin/nhanvien') }}"
            class="flex items-center px-4 py-2 text-textSub hover:text-accent hover:bg-indigo-50 rounded-lg transition">
            <span class="material-icons mr-3">work</span>
            Nhân viên
          </a>
        </li>
        <li>
          <a href="{{ url('admin/khachhang') }}"
            class="flex items-center px-4 py-2 text-textSub hover:text-accent hover:bg-indigo-50 rounded-lg transition">
            <span class="material-icons mr-3">groups</span>
            Khách hàng
          </a>
        </li>
        <li>
          <a href="{{ url('admin/nguoidung') }}"
            class="flex items-center px-4 py-2 text-textSub hover:text-accent hover:bg-indigo-50 rounded-lg transition">
            <span class="material-icons mr-3">person</span>
            Người dùng
          </a>
        </li>
        <li>
          <a href="{{ url('admin/chucvu') }}"
            class="flex items-center px-4 py-2 text-textSub hover:text-accent hover:bg-indigo-50 rounded-lg transition">
            <span class="material-icons mr-3">badge</span>
            Chức vụ
          </a>
        </li>
        <li>
          <a href="{{ url('admin/vaitro') }}"
            class="flex items-center px-4 py-2 text-textSub hover:text-accent hover:bg-indigo-50 rounded-lg transition">
            <span class="material-icons mr-3">supervisor_account</span>
            Vai trò
          </a>
        </li>
      </ul>
    </nav>
  </aside>

  <!-- Main Content -->
  <!-- Main Content Wrapper -->
  <div class="flex-1 ml-64 flex flex-col min-h-screen">

    <!-- Header -->
    <header class="flex justify-between items-center bg-white shadow-sm border-b border-gray-300 px-6 h-16">
      <div class="text-lg font-semibold text-accent">
        Quản lý mắt kính
      </div>

      <!-- User info -->
      <div class="flex items-center space-x-4">
        <div class="text-textSub text-sm">
          Xin chào, <span class="font-medium">{{ session('tenDangNhap') ?? 'Người dùng' }}</span>
          (<span>{{ session('vaiTro') == 1 ? 'Admin' : 'Nhân viên' }}</span>)
        </div>
        <img src="images/khachhang.jpg" alt="Avatar"
          class="w-10 h-10 rounded-full object-cover border border-gray-300">

        <!-- Logout button -->
        <form action="{{ route('logout') }}" method="GET">
          @csrf
          <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
            Đăng xuất
          </button>
        </form>
      </div>
    </header>

    <!-- Main content -->
    <main class="flex-1 p-8 bg-lightBg">
      <div class="bg-white shadow-sm rounded-xl p-6 border border-gray-300">
        <h2 class="text-2xl font-semibold text-accent mb-4 flex items-center gap-2">
          <span class="material-icons text-accent">dashboard</span>
          Trang quản trị
        </h2>

        <div class="text-textSub leading-relaxed">
          @yield("do-du-lieu-tu-view")
        </div>
      </div>
    </main>
  </div>

  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</body>

</html>