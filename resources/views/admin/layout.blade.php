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
          <a href="{{ url('/') }}"
            class="flex items-center px-4 py-2 text-textSub hover:text-accent hover:bg-indigo-50 rounded-lg transition">
            <span class="material-icons mr-3">dashboard</span>
            Trang chủ
          </a>
        </li>
        <li>
          <a href="{{ url('/nhanvien') }}"
            class="flex items-center px-4 py-2 text-textSub hover:text-accent hover:bg-indigo-50 rounded-lg transition">
            <span class="material-icons mr-3">work</span>
            Nhân viên
          </a>
        </li>
        <li>
          <a href="{{ url('/khachhang') }}"
            class="flex items-center px-4 py-2 text-textSub hover:text-accent hover:bg-indigo-50 rounded-lg transition">
            <span class="material-icons mr-3">groups</span>
            Khách hàng
          </a>
        </li>
        <li>
          <a href="{{ url('/nguoidung') }}"
            class="flex items-center px-4 py-2 text-textSub hover:text-accent hover:bg-indigo-50 rounded-lg transition">
            <span class="material-icons mr-3">person</span>
            Người dùng
          </a>
        </li>
        <li>
          <a href="{{ url('/chucvu') }}"
            class="flex items-center px-4 py-2 text-textSub hover:text-accent hover:bg-indigo-50 rounded-lg transition">
            <span class="material-icons mr-3">badge</span>
            Chức vụ
          </a>
        </li>
        <li>
          <a href="{{ url('/vaitro') }}"
            class="flex items-center px-4 py-2 text-textSub hover:text-accent hover:bg-indigo-50 rounded-lg transition">
            <span class="material-icons mr-3">supervisor_account</span>
            Vai trò
          </a>
        </li>
      </ul>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 ml-64 p-8">
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

  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</body>

</html>