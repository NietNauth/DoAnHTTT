<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GlassyStore - Cửa hàng mắt kính</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="font-sans">
  {{-- Include Header --}}
  @include('index.components.header')

  <main>
    @yield('content')
  </main> 

  {{-- Include Footer --}}
  @include('index.components.footer')
</body>

</html>
